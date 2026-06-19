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