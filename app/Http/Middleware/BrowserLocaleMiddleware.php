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
        if (session()->has('locale')) {

            App::setLocale(
                session('locale')
            );
        } else {

            foreach ($request->getLanguages() as $language) {

                $language = substr(
                    $language,
                    0,
                    2
                );

                if (
                    in_array(
                        $language,
                        $this->supportedLocales
                    )
                ) {

                    session()->put(
                        'locale',
                        $language
                    );

                    App::setLocale(
                        $language
                    );

                    break;
                }
            }
        }

        LocaleVisit::create([
            'locale' => App::getLocale()
        ]);

        return $next($request);
    }
}