<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-card {
            border: none;
            border-radius: 25px;
            background: white;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .language-btn {
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all .3s;
            border: 2px solid transparent;
        }

        .language-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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

        .cookie-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .cookie-active {
            background: #d4edda;
            color: #155724;
        }

        .cookie-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .browser-icon {
            font-size: 32px;
            line-height: 1;
        }

        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .flag-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: all .2s;
            border: 2px solid transparent;
            text-decoration: none;
            color: inherit;
        }

        .flag-option:hover {
            background: #f8f9fa;
            border-color: #667eea;
        }

        .flag-option.active {
            background: #eef1ff;
            border-color: #667eea;
        }

        .flag-icon {
            font-size: 28px;
            line-height: 1;
        }

        .chart-container {
            position: relative;
            height: 260px;
            margin-top: 10px;
        }

        .chart-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 260px;
            background: #f8f9fa;
            border-radius: 12px;
            color: #6c757d;
            font-size: 14px;
            margin-top: 10px;
        }

        .info-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: .3s;
        }

        .info-card:hover {
            transform: translateY(-3px);
        }

        .visit-table {
            font-size: 14px;
        }

        .visit-table th {
            background: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .section-title {
            position: relative;
            padding-left: 20px;
            margin-bottom: 20px;
            font-weight: 700;
            color: #333;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 3px;
        }

        .filter-bar {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: .5; }
            100% { opacity: 1; }
        }

        .scrollable-table {
            max-height: 400px;
            overflow-y: auto;
        }

        .live-badge {
            animation: pulse 1.5s infinite;
        }

        .loader {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loader.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">

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

                            <div class="mt-2">
                                @if(request()->hasCookie('locale'))
                                    <span class="cookie-indicator cookie-active">
                                        🍪 Cookie Saved ({{ request()->cookie('locale') }})
                                    </span>
                                @else
                                    <span class="cookie-indicator cookie-inactive">
                                        🍪 No Cookie Saved
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="card stat-card shadow-sm bg-primary text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white-50">{{ __('messages.total_visits') }}</h6>
                                        <h2>{{ $totalVisits }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card shadow-sm bg-success text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white-50">{{ __('messages.unique_visitors') }}</h6>
                                        <h2>{{ $uniqueVisitors }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card shadow-sm bg-warning text-dark">
                                    <div class="card-body text-center">
                                        <h6>{{ __('messages.current_locale') }}</h6>
                                        <span class="badge bg-dark badge-locale">
                                            {{ strtoupper($currentLocale) }} {{ $localeFlags[$currentLocale] ?? '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card shadow-sm bg-info text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white-50">{{ __('messages.browser_detection') }}</h6>
                                        <h2>✅</h2>
                                        <small>{{ __('messages.auto_detect') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="locale-box mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="fw-bold">
                                        {{ __('messages.welcome') }}
                                    </h4>
                                    <p class="mb-0 text-muted">
                                        Browser language is automatically detected and translations are loaded dynamically.
                                    </p>
                                </div>
                                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#languageModal">
                                    🌐 {{ __('messages.live_switch') }}
                                </button>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <h5 class="mb-3">{{ __('messages.select_language') }}</h5>
                            <div class="btn-group" role="group">
                                <a href="{{ route('language.change', 'en') }}" class="btn btn-primary language-btn">
                                    🇬🇧 English
                                </a>
                                <a href="{{ route('language.change', 'fr') }}" class="btn btn-warning language-btn">
                                    🇫🇷 French
                                </a>
                                <a href="{{ route('language.change', 'es') }}" class="btn btn-danger language-btn">
                                    🇪🇸 Spanish
                                </a>
                            </div>
                            <a href="{{ route('locale.reset') }}" class="btn btn-secondary language-btn ms-2">
                                🔄 {{ __('messages.reset') }}
                            </a>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card info-card h-100">
                                    <div class="card-body text-center">
                                        <div class="browser-icon mb-2">
                                            @php
                                                $browserIcons = ['Chrome' => '🌐', 'Firefox' => '🦊', 'Safari' => '🧭', 'Edge' => '🌊', 'Opera' => '🎭', 'IE' => '💻', 'Unknown' => '🌍'];
                                                echo $browserIcons[$currentBrowserInfo['browser'] ?? 'Unknown'] ?? '🌍';
                                            @endphp
                                        </div>
                                        <h6>{{ __('messages.your_browser') }}</h6>
                                        <p class="mb-0 fw-bold">{{ $currentBrowserInfo['browser'] ?? 'Unknown' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card h-100">
                                    <div class="card-body text-center">
                                        <div class="browser-icon mb-2">
                                            @php
                                                $osIcons = ['Windows' => '🪟', 'MacOS' => '🍎', 'Linux' => '🐧', 'Android' => '🤖', 'iOS' => '📱', 'Unknown' => '💻'];
                                                echo $osIcons[$currentBrowserInfo['os'] ?? 'Unknown'] ?? '💻';
                                            @endphp
                                        </div>
                                        <h6>{{ __('messages.your_os') }}</h6>
                                        <p class="mb-0 fw-bold">{{ $currentBrowserInfo['os'] ?? 'Unknown' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card info-card h-100">
                                    <div class="card-body text-center">
                                        <div class="browser-icon mb-2">
                                            @php
                                                $deviceIcons = ['mobile' => '📱', 'tablet' => '📱', 'desktop' => '🖥️'];
                                                echo $deviceIcons[$currentBrowserInfo['device_type'] ?? 'desktop'] ?? '🖥️';
                                            @endphp
                                        </div>
                                        <h6>{{ __('messages.your_device') }}</h6>
                                        <p class="mb-0 fw-bold text-capitalize">{{ $currentBrowserInfo['device_type'] ?? 'desktop' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5 shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">
                                    📊 {{ __('messages.analytics_dashboard') }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <h6 class="section-title">{{ __('messages.languages') }}</h6>
                                        @if($stats->count() > 0)
                                            <div class="chart-container">
                                                <canvas id="localeChart"></canvas>
                                            </div>
                                        @else
                                            <div class="chart-placeholder">
                                                <span>📊 No visit data available yet</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="section-title">{{ __('messages.daily_trends') }}</h6>
                                        <div class="chart-container">
                                            <canvas id="trendChart"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <h6 class="section-title">{{ __('messages.browsers') }}</h6>
                                        @if($browserStats->count() > 0)
                                            <div class="chart-container">
                                                <canvas id="browserChart"></canvas>
                                            </div>
                                        @else
                                            <div class="chart-placeholder">
                                                <span>🌐 No browser data available yet</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="section-title">{{ __('messages.operating_systems') }}</h6>
                                        @if($osStats->count() > 0)
                                            <div class="chart-container">
                                                <canvas id="osChart"></canvas>
                                            </div>
                                        @else
                                            <div class="chart-placeholder">
                                                <span>💻 No OS data available yet</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="filter-bar">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">{{ __('messages.locale') }}</label>
                                            <select id="filterLocale" class="form-select">
                                                <option value="">{{ __('messages.all') }}</option>
                                                <option value="en">🇬🇧 English</option>
                                                <option value="fr">🇫🇷 French</option>
                                                <option value="es">🇪🇸 Spanish</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">{{ __('messages.from') }}</label>
                                            <input type="date" id="filterFrom" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">{{ __('messages.to') }}</label>
                                            <input type="date" id="filterTo" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-primary w-100" onclick="loadVisitHistory()">
                                                🔍 {{ __('messages.filter') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="section-title">{{ __('messages.visit_history') }}</h6>
                                <div class="loader" id="tableLoader">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </div>
                                <div class="scrollable-table">
                                    <table class="table table-hover table-bordered visit-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.locale') }}</th>
                                                <th>{{ __('messages.browser') }}</th>
                                                <th>{{ __('messages.operating_systems') }}</th>
                                                <th>{{ __('messages.devices') }}</th>
                                                <th>{{ __('messages.ip_address') }}</th>
                                                <th>{{ __('messages.visit_time') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="visitTableBody">
                                            @foreach($recentVisits as $visit)
                                                <tr>
                                                    <td>{{ $visit->id }}</td>
                                                    <td>
                                                        {{ $localeFlags[$visit->locale] ?? '' }} {{ strtoupper($visit->locale) }}
                                                    </td>
                                                    <td>
                                                        {{ $visit->browser_icon }} {{ $visit->browser ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $visit->os_icon }} {{ $visit->os ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {{ $visit->device_icon }} {{ ucfirst($visit->device_type ?? 'N/A') }}
                                                    </td>
                                                    <td><code>{{ $visit->ip_address ?? 'N/A' }}</code></td>
                                                    <td>{{ $visit->created_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-outline-primary btn-sm" onclick="exportCSV()">
                                        📥 {{ __('messages.export_csv') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success mt-4 text-center">
                            <strong>Translation API:</strong>
                            <a href="/translations" class="fw-bold">/translations</a>
                        </div>

                        <div class="footer-box text-center mt-4">
                            <h6 class="fw-bold">Browser Locale System</h6>
                            <p class="mb-0 text-muted">Detect → Match → Translate → Display | Cookie Persistence | Analytics</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="languageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        🌐 {{ __('messages.switch_language') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalLoader" class="loader show">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <div id="modalContent" style="display: none;">
                        <div class="d-grid gap-2">
                            <a href="javascript:void(0)" class="flag-option" onclick="switchLanguage('en', this)">
                                <span class="flag-icon">🇬🇧</span>
                                <div>
                                    <div class="fw-bold">English</div>
                                    <small class="text-muted">English</small>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="flag-option" onclick="switchLanguage('fr', this)">
                                <span class="flag-icon">🇫🇷</span>
                                <div>
                                    <div class="fw-bold">Français</div>
                                    <small class="text-muted">French</small>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="flag-option" onclick="switchLanguage('es', this)">
                                <span class="flag-icon">🇪🇸</span>
                                <div>
                                    <div class="fw-bold">Español</div>
                                    <small class="text-muted">Spanish</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('messages.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const localeFlags = @json($localeFlags);
        const currentLocale = '{{ $currentLocale }}';

        document.querySelectorAll('.flag-option').forEach(option => {
            if (option.dataset.locale === currentLocale) {
                option.classList.add('active');
            }
        });

        function switchLanguage(locale, element) {
            document.querySelectorAll('.flag-option').forEach(opt => opt.classList.remove('active'));
            if (element) element.classList.add('active');

            const modalLoader = document.getElementById('modalLoader');
            const modalContent = document.getElementById('modalContent');

            modalLoader.classList.add('show');
            modalContent.style.display = 'none';

            fetch('/language/switch', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ locale: locale })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('{{ __('messages.language_switch_success') }}');
                    setTimeout(() => location.reload(), 800);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                modalLoader.classList.remove('show');
                modalContent.style.display = 'block';
            });
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'alert alert-success position-fixed top-0 end-0 m-3';
            toast.style.zIndex = '9999';
            toast.innerHTML = '✅ ' + message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        function loadVisitHistory() {
            const locale = document.getElementById('filterLocale').value;
            const from = document.getElementById('filterFrom').value;
            const to = document.getElementById('filterTo').value;
            const loader = document.getElementById('tableLoader');
            const tbody = document.getElementById('visitTableBody');

            loader.classList.add('show');

            const params = new URLSearchParams();
            if (locale) params.append('locale', locale);
            if (from) params.append('start_date', from);
            if (to) params.append('end_date', to);

            fetch('/analytics/visits?' + params.toString())
                .then(response => response.json())
                .then(data => {
                    tbody.innerHTML = '';
                    if (data.data && data.data.length > 0) {
                        data.data.forEach(visit => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${visit.id}</td>
                                <td>${localeFlags[visit.locale] || ''} ${visit.locale.toUpperCase()}</td>
                                <td>${visit.browser_icon || ''} ${visit.browser || 'N/A'}</td>
                                <td>${visit.os_icon || ''} ${visit.os || 'N/A'}</td>
                                <td>${visit.device_icon || ''} ${visit.device_type ? visit.device_type.charAt(0).toUpperCase() + visit.device_type.slice(1) : 'N/A'}</td>
                                <td><code>${visit.ip_address || 'N/A'}</code></td>
                                <td>${visit.created_at}</td>
                            `;
                            tbody.appendChild(row);
                        });
                    } else {
                        tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">No data available</td></tr>';
                    }
                    loader.classList.remove('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    loader.classList.remove('show');
                });
        }

        function exportCSV() {
            const locale = document.getElementById('filterLocale').value;
            const from = document.getElementById('filterFrom').value;
            const to = document.getElementById('filterTo').value;

            const params = new URLSearchParams();
            if (locale) params.append('locale', locale);
            if (from) params.append('start_date', from);
            if (to) params.append('end_date', to);
            params.append('per_page', 1000);

            window.open('/analytics/visits?' + params.toString(), '_blank');
        }

        function initCharts() {
            const ctxLocale = document.getElementById('localeChart');
            const ctxTrend = document.getElementById('trendChart');
            const ctxBrowser = document.getElementById('browserChart');
            const ctxOs = document.getElementById('osChart');

            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            };

            if (ctxLocale) {
                const labels = [
                    @foreach($stats as $locale => $count)
                        '{{ ucfirst($locale) }}'@if(!$loop->last),@endif
                    @endforeach
                ];
                const data = [
                    @foreach($stats as $locale => $count)
                        {{ $count }}@if(!$loop->last),@endif
                    @endforeach
                ];
                const colors = [
                    '#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#43e97b'
                ];

                if (labels.length > 0 && data.length > 0) {
                    new Chart(ctxLocale, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: colors.slice(0, data.length),
                                borderWidth: 2,
                                borderColor: '#fff'
                            }]
                        },
                        options: chartOptions
                    });
                }
            }

            if (ctxTrend) {
                fetch('/analytics/chart-data?days=7')
                    .then(response => response.json())
                    .then(data => {
                        if (data.labels && data.labels.length > 0 && data.values && data.values.length > 0) {
                            new Chart(ctxTrend, {
                                type: 'line',
                                data: {
                                    labels: data.labels,
                                    datasets: [{
                                        label: 'Visits',
                                        data: data.values,
                                        borderColor: '#667eea',
                                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                                        fill: true,
                                        tension: 0.4,
                                        pointRadius: 4,
                                        pointBackgroundColor: '#667eea',
                                        pointBorderColor: '#fff',
                                        pointBorderWidth: 2
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: { display: false }
                                    }
                                }
                            });
                        } else {
                            ctxTrend.parentElement.innerHTML = '<div class="chart-placeholder"><span>📈 No trend data for last 7 days</span></div>';
                        }
                    })
                    .catch(() => {
                        if (ctxTrend.parentElement) {
                            ctxTrend.parentElement.innerHTML = '<div class="chart-placeholder"><span>📈 Unable to load trend data</span></div>';
                        }
                    });
            }

            if (ctxBrowser && @json($browserStats->count()) > 0) {
                new Chart(ctxBrowser, {
                    type: 'pie',
                    data: {
                        labels: @json($browserStats->pluck('browser')),
                        datasets: [{
                            data: @json($browserStats->pluck('total')),
                            backgroundColor: [
                                '#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe'
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: chartOptions
                });
            }

            if (ctxOs && @json($osStats->count()) > 0) {
                new Chart(ctxOs, {
                    type: 'pie',
                    data: {
                        labels: @json($osStats->pluck('os')),
                        datasets: [{
                            data: @json($osStats->pluck('total')),
                            backgroundColor: [
                                '#28a745', '#17a2b8', '#ffc107', '#dc3545', '#6610f2'
                            ],
                            borderWidth: 2,
                            borderColor: '#fff'
                        }]
                    },
                    options: chartOptions
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initCharts();
        });
    </script>
</body>

</html>
