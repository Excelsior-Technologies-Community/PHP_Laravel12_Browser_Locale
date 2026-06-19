# PHP_Laravel12_Browser_Locale

A Laravel 12 localization-based web application that automatically detects a visitor's preferred browser language using the HTTP `Accept-Language` header and dynamically sets the application locale.

This project demonstrates how Laravel applications can implement automatic multilingual support by detecting browser preferences, managing locale sessions, and loading translated content dynamically.

The application provides both automatic browser-based language detection and manual language switching functionality.

---

# Features

* Automatic browser language detection using Accept-Language header
* Dynamic locale switching based on browser preference
* Support for multiple languages
* Manual language selection option
* Session-based language persistence
* Middleware-based locale management
* Laravel localization and translation files
* Dynamic multilingual Blade interface
* Responsive modern Bootstrap 5 UI
* Laravel 12 compatible architecture
* Easy to extend with additional languages

---

## Requirements

* PHP 8.2+
* Composer
* Laravel 12
* MySQL
* XAMPP / Laragon

---

# Create Project

## Step 1: Create a new Laravel 12 project:

```bash
composer create-project laravel/laravel PHP_Laravel12_Browser_Locale "12.*"
```

Move into project directory:

```bash
cd PHP_Laravel12_Browser_Locale
```

---

## Step 2: Create Controller

Generate controller:

```bash
php artisan make:controller HomeController
```

File:

```php
app/Http/Controllers/HomeController.php
```

Code:

```php
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
```

---

## Step 3: Create Middleware

Generate middleware:

```bash
php artisan make:middleware BrowserLocaleMiddleware
```

File:

```php
app/Http/Middleware/BrowserLocaleMiddleware.php
```

Code:

```php
<?php

namespace App\Http\Middleware;


use Closure;
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
    ): Response
    {


        if(session()->has('locale'))
        {

            App::setLocale(
                session('locale')
            );

        }
        else
        {

            foreach($request->getLanguages() as $language)
            {

                $language = substr($language,0,2);


                if(in_array(
                    $language,
                    $this->supportedLocales
                ))
                {

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


        return $next($request);

    }
}
```

---

## Step 4: Register Middleware

Open:

```php
bootstrap/app.php
```

Locate the middleware section and update it:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(
    basePath: dirname(__DIR__)
)

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {


        $middleware->web(append: [

            \App\Http\Middleware\BrowserLocaleMiddleware::class,

        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {})
    ->create();

```

---

## Step 5: Create Language Files

Create folders:

```text
lang
├── en
├── fr
└── es
```

### English Translation

File: lang/en/messages.php

Code:

```php
<?php

return [

    'title' => 'Browser Locale Demo',

    'welcome' => 'Welcome to Laravel Browser Locale Project',

    'description' =>
        'The application automatically detects your browser language.',

];
```

### French Translation

File: lang/fr/messages.php


Code:

```php
<?php

return [

    'title' => 'Démonstration Browser Locale',

    'welcome' =>
        'Bienvenue dans le projet Laravel Browser Locale',

    'description' =>
        'L’application détecte automatiquement la langue du navigateur.',

];
```


### Spanish Translation

File: lang/es/messages.php


Code:

```php
<?php

return [

    'title' => 'Demostración Browser Locale',

    'welcome' =>
        'Bienvenido al proyecto Laravel Browser Locale',

    'description' =>
        'La aplicación detecta automáticamente el idioma del navegador.',

];
```

---

## Step 6: Create View

Create file:

```php
resources/views/home.blade.php
```

code:

```html
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('messages.title') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
        }

        .main-card {
            border: none;
            border-radius: 25px;
            background: white;
        }

        .logo {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: auto;
        }

        .feature-card {
            border: none;
            border-radius: 18px;
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
        }

        .locale-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 18px;
        }

        .language-btn {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
        }
    </style>

</head>

<body>


    <div class="container py-4">

        <div class="row justify-content-center">

            <div class="col-xl-9">


                <div class="card main-card shadow-lg">

                    <div class="card-body p-4">


                        <div class="text-center">

                            <div class="logo mb-3">
                                🌐
                            </div>

                            <h1 class="fw-bold">
                                {{ __('messages.title') }}
                            </h1>

                            <p class="text-muted">
                                {{ __('messages.description') }}
                            </p>

                        </div>


                        <hr>


                        <div class="row g-3">


                            <div class="col-md-4">

                                <div class="card feature-card shadow-sm">

                                    <div class="card-body text-center">

                                        <h6>Current Locale</h6>

                                        <h3>
                                            <span class="badge bg-success">
                                                {{ $currentLocale }}
                                            </span>
                                        </h3>

                                        <small class="text-muted">
                                            Detected Language
                                        </small>

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-4">

                                <div class="card feature-card shadow-sm">

                                    <div class="card-body text-center">

                                        <h6>Browser Detection</h6>

                                        <h3>✅</h3>

                                        <small class="text-muted">
                                            Accept-Language Header
                                        </small>

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-4">

                                <div class="card feature-card shadow-sm">

                                    <div class="card-body text-center">

                                        <h6>Laravel 12</h6>

                                        <h3>🚀</h3>

                                        <small class="text-muted">
                                            Localization Ready
                                        </small>

                                    </div>

                                </div>

                            </div>


                        </div>



                        <div class="locale-box mt-4">

                            <h5 class="fw-bold">
                                {{ __('messages.welcome') }}
                            </h5>

                            <p class="mb-0 text-muted">
                                Laravel automatically detects browser language and loads translation files.
                            </p>

                        </div>



                        <div class="text-center mt-4">


                            <h6 class="mb-3">
                                Choose Language
                            </h6>


                            <a href="{{ route('language.change','en') }}"
                                class="btn btn-primary language-btn mx-1">
                                🇺🇸 English
                            </a>


                            <a href="{{ route('language.change','fr') }}"
                                class="btn btn-warning language-btn mx-1">
                                🇫🇷 French
                            </a>


                            <a href="{{ route('language.change','es') }}"
                                class="btn btn-danger language-btn mx-1">
                                🇪🇸 Spanish
                            </a>


                        </div>



                        <div class="alert alert-light text-center mt-4 mb-0">

                            <strong>
                                Browser Locale System
                            </strong>

                            <br>

                            Detect → Match → Translate → Display

                        </div>



                    </div>

                </div>


            </div>

        </div>

    </div>


</body>

</html>
```

---

## Step 7: Create Routes

Open:

```php
routes/web.php
```

Replace the file contents with:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get(
    '/language/{locale}',
    [HomeController::class, 'changeLanguage']
)->name('language.change');
```

---

## Step 8: Run the Application

Start the Laravel development server:

```bash
php artisan serve
```

Application URL:

```text
http://127.0.0.1:8000
```

Open the URL in your browser.

The application will automatically detect the browser's preferred language and display translated content.

---

## Screenshots

### English Locale

<img width="1918" height="1027" alt="Screenshot 2026-06-19 162622" src="https://github.com/user-attachments/assets/dec14f1c-0a72-4e54-b63a-dd727be1866e" />

### French Locale

<img width="1918" height="1025" alt="Screenshot 2026-06-19 162637" src="https://github.com/user-attachments/assets/304553c9-a74e-4e90-9d9e-d7bde3bcccaa" />

### Spanish Locale

<img width="1918" height="1027" alt="Screenshot 2026-06-19 162652" src="https://github.com/user-attachments/assets/d8df29e7-fd75-4826-b40b-dfb194d33be9" />

---

## Project Structure

```text
PHP_Laravel12_Browser_Locale
│
├── app
│   │
│   ├── Http
│   │   │
│   │   ├── Controllers
│   │   │   │
│   │   │   └── HomeController.php
│   │   │
│   │   └── Middleware
│   │       │
│   │       └── BrowserLocaleMiddleware.php
│   │
│   └── Models
│
│
├── bootstrap
│   │
│   └── app.php
│
│
├── config
│   │
│   └── app.php
│
│
├── lang
│   │
│   ├── en
│   │   │
│   │   └── messages.php
│   │
│   ├── fr
│   │   │
│   │   └── messages.php
│   │
│   └── es
│       │
│       └── messages.php
│
│
├── public
│
│
├── resources
│   │
│   └── views
│       │
│       └── home.blade.php
│
│
├── routes
│   │
│   ├── web.php
│   └── console.php
│
│
├── storage
│
│
├── tests
│
│
├── .env
│
├── artisan
│
├── composer.json
│
├── package.json
│
├── phpunit.xml
│
└── README.md
```

---

# Conclusion

PHP_Laravel12_Browser_Locale demonstrates a practical implementation of Laravel 12 localization by combining browser language detection, middleware, sessions, and translation files to create a scalable multilingual web application.



