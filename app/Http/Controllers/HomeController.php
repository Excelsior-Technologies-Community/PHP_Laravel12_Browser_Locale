<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class HomeController extends Controller
{

    public function index()
    {
        return view('home', [
            'currentLocale' => App::getLocale()
        ]);
    }


    public function changeLanguage($locale)
    {

        if (in_array($locale, ['en', 'fr', 'es'])) {

            session()->put(
                'locale',
                $locale
            );


            App::setLocale($locale);
        }


        return redirect('/');
    }
}
