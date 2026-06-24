<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.title') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Segoe UI', sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 25px;
            background: white;
            overflow: hidden;
        }

        .logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: auto;
        }

        .stat-card {
            border: none;
            border-radius: 20px;
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .language-btn {
            border-radius: 30px;
            padding: 12px 28px;
            font-weight: 600;
        }

        .locale-box {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 20px;
        }

        .badge-locale {
            font-size: 18px;
            padding: 10px 18px;
        }

        .footer-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 15px;
        }
    </style>


</head>

<body>


    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="card main-card shadow-lg">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">

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

                                <div class="card stat-card shadow-sm">

                                    <div class="card-body text-center">

                                        <h6>Current Locale</h6>

                                        <span class="badge bg-success badge-locale">
                                            {{ strtoupper($currentLocale) }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="card stat-card shadow-sm">

                                    <div class="card-body text-center">

                                        <h6>Browser Detection</h6>

                                        <h2>✅</h2>

                                        <small class="text-muted">
                                            Auto Detect
                                        </small>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="card stat-card shadow-sm">

                                    <div class="card-body text-center">

                                        <h6>Laravel 12</h6>

                                        <h2>🚀</h2>

                                        <small class="text-muted">
                                            Localization Ready
                                        </small>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="locale-box mt-4">

                            <h4 class="fw-bold">
                                {{ __('messages.welcome') }}
                            </h4>

                            <p class="mb-0 text-muted">
                                Browser language is automatically detected and translations are loaded dynamically.
                            </p>

                        </div>

                        <div class="text-center mt-4">

                            <h5 class="mb-3">
                                Select Language
                            </h5>

                            <a href="{{ route('language.change', 'en') }}" class="btn btn-primary language-btn mx-1">
                                🇺🇸 English
                            </a>

                            <a href="{{ route('language.change', 'fr') }}" class="btn btn-warning language-btn mx-1">
                                🇫🇷 French
                            </a>

                            <a href="{{ route('language.change', 'es') }}" class="btn btn-danger language-btn mx-1">
                                🇪🇸 Spanish
                            </a>

                            <a href="{{ route('locale.reset') }}" class="btn btn-secondary language-btn mx-1">
                                🔄 Reset
                            </a>

                        </div>

                        <div class="card mt-5 shadow-sm">

                            <div class="card-header bg-dark text-white">

                                <h5 class="mb-0">
                                    📊 Locale Statistics Dashboard
                                </h5>

                            </div>

                            <div class="card-body">

                                <table class="table table-hover table-bordered">

                                    <thead class="table-light">

                                        <tr>
                                            <th>Language</th>
                                            <th>Total Visits</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>🇺🇸 English</td>
                                            <td>{{ $stats['en'] ?? 0 }}</td>
                                        </tr>

                                        <tr>
                                            <td>🇫🇷 French</td>
                                            <td>{{ $stats['fr'] ?? 0 }}</td>
                                        </tr>

                                        <tr>
                                            <td>🇪🇸 Spanish</td>
                                            <td>{{ $stats['es'] ?? 0 }}</td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="alert alert-success mt-4 text-center">

                            <strong>
                                Translation API:
                            </strong>

                            <a href="/translations" class="fw-bold">
                                /translations
                            </a>

                        </div>

                        <div class="footer-box text-center mt-4">

                            <h6 class="fw-bold">
                                Browser Locale System
                            </h6>

                            <p class="mb-0 text-muted">
                                Detect → Match → Translate → Display
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>