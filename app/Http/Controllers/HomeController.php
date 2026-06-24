<?php

namespace App\Http\Controllers;

use App\Models\LocaleVisit;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $stats = LocaleVisit::selectRaw(
            'locale, COUNT(*) as total'
        )
            ->groupBy('locale')
            ->pluck('total', 'locale');

        return view('home', [
            'currentLocale' => App::getLocale(),
            'stats' => $stats
        ]);
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'fr', 'es'])) {

            session()->put(
                'locale',
                $locale
            );

            App::setLocale(
                $locale
            );
        }

        return redirect('/');
    }

    public function resetLocale()
    {
        session()->forget('locale');

        return redirect('/');
    }

    public function translations()
    {
        return response()->json([
            'locale' => App::getLocale(),
            'translations' => trans('messages')
        ]);
    }
}