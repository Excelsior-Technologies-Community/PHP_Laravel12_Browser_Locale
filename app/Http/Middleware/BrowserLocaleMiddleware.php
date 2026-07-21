<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LocaleVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class BrowserLocaleMiddleware
{
    protected $supportedLocales = [
        'en',
        'fr',
        'es'
    ];

    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if ($request->hasCookie('locale') && in_array($request->cookie('locale'), $this->supportedLocales)) {
            App::setLocale($request->cookie('locale'));
        } elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        } else {
            foreach ($request->getLanguages() as $language) {
                $language = substr($language, 0, 2);

                if (in_array($language, $this->supportedLocales)) {
                    App::setLocale($language);
                    break;
                }
            }
        }

        $userAgent = $request->userAgent() ?? $request->header('User-Agent');
        $browserInfo = LocaleVisit::parseBrowserInfo($userAgent);

        LocaleVisit::create([
            'locale' => App::getLocale(),
            'user_agent' => $userAgent,
            'browser' => $browserInfo['browser'],
            'os' => $browserInfo['os'],
            'device_type' => $browserInfo['device_type'],
            'ip_address' => $request->ip()
        ]);

        return $next($request);
    }
}
