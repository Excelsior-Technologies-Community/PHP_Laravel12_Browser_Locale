<?php

namespace App\Http\Controllers;

use App\Models\LocaleVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $currentLocale = App::getLocale();
        $localeFlags = [
            'en' => '🇬🇧',
            'fr' => '🇫🇷',
            'es' => '🇪🇸'
        ];

        $stats = LocaleVisit::selectRaw('locale, COUNT(*) as total')
            ->groupBy('locale')
            ->pluck('total', 'locale');

        $browserStats = LocaleVisit::selectRaw('browser, COUNT(*) as total')
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $osStats = LocaleVisit::selectRaw('os, COUNT(*) as total')
            ->whereNotNull('os')
            ->groupBy('os')
            ->orderByDesc('total')
            ->get();

        $deviceStats = LocaleVisit::selectRaw('device_type, COUNT(*) as total')
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->get();

        $totalVisits = LocaleVisit::count();
        $uniqueVisitors = LocaleVisit::select('ip_address')
            ->distinct()
            ->count();

        $recentVisits = LocaleVisit::orderByDesc('created_at')
            ->limit(10)
            ->get();

        $currentBrowserInfo = LocaleVisit::parseBrowserInfo($request->userAgent() ?? $request->header('User-Agent'));

        return view('home', [
            'currentLocale' => $currentLocale,
            'localeFlags' => $localeFlags,
            'stats' => $stats,
            'browserStats' => $browserStats,
            'osStats' => $osStats,
            'deviceStats' => $deviceStats,
            'totalVisits' => $totalVisits,
            'uniqueVisitors' => $uniqueVisitors,
            'recentVisits' => $recentVisits,
            'currentBrowserInfo' => $currentBrowserInfo,
            'currentUserAgent' => $request->userAgent() ?? $request->header('User-Agent')
        ]);
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'fr', 'es'])) {
            session()->put('locale', $locale);
            App::setLocale($locale);

            cookie()->queue('locale', $locale, 60 * 24 * 30);
        }

        return redirect('/');
    }

    public function ajaxChangeLanguage(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:en,fr,es'
        ]);

        $locale = $request->input('locale');

        session()->put('locale', $locale);
        App::setLocale($locale);

        cookie()->queue('locale', $locale, 60 * 24 * 30);

        return response()->json([
            'success' => true,
            'locale' => $locale,
            'translations' => trans('messages')
        ]);
    }

    public function resetLocale()
    {
        session()->forget('locale');
        cookie()->queue('locale', null, -1);

        return redirect('/');
    }

    public function translations()
    {
        return response()->json([
            'locale' => App::getLocale(),
            'translations' => trans('messages')
        ]);
    }

    public function getChartData(Request $request)
    {
        $days = $request->get('days', 7);
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($days);

        $localeData = LocaleVisit::selectRaw('locale, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('locale')
            ->pluck('total', 'locale');

        $dailyData = LocaleVisit::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $dailyData->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('M d');
        })->toArray();

        $values = $dailyData->pluck('total')->toArray();

        return response()->json([
            'localeData' => $localeData,
            'labels' => $labels,
            'values' => $values,
            'totalPeriodVisits' => $dailyData->sum('total')
        ]);
    }

    public function getVisitHistory(Request $request)
    {
        $locale = $request->get('locale');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $perPage = $request->get('per_page', 20);

        $query = LocaleVisit::query()->orderByDesc('created_at');

        if ($locale && in_array($locale, ['en', 'fr', 'es'])) {
            $query->where('locale', $locale);
        }

        if ($startDate) {
            $query->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        }

        if ($endDate) {
            $query->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        $visits = $query->paginate($perPage);

        $visits->getCollection()->transform(function ($visit) {
            return [
                'id' => $visit->id,
                'locale' => $visit->locale,
                'browser' => $visit->browser,
                'os' => $visit->os,
                'device_type' => $visit->device_type,
                'ip_address' => $visit->ip_address,
                'created_at' => $visit->created_at->format('Y-m-d H:i:s'),
                'browser_icon' => $visit->browser_icon,
                'os_icon' => $visit->os_icon,
                'device_icon' => $visit->device_icon
            ];
        });

        return response()->json($visits);
    }
}
 