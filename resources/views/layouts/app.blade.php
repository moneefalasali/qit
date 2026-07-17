<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'قطاف القصيم - منصتك الموثوقة للعمالة الزراعية')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2d5a27;
            --secondary-green: #4a7c2c;
            --accent-gold: #d4c5b0;
            --light-bg: #f9f7f4;
            --dark-text: #2c2c2c;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            overflow-x: hidden;
        }

        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 10px 0;
        }

        .navbar-brand img {
            height: 60px;
        }

        .nav-link {
            color: var(--dark-text) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-green) !important;
        }

        .btn-primary-qitaf {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-qitaf:hover {
            background-color: var(--secondary-green);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-qitaf {
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-outline-qitaf:hover {
            background-color: var(--primary-green);
            color: white;
        }

        footer {
            background-color: #1a1a1a;
            color: white;
            padding: 60px 0 20px;
        }

        .footer-logo img {
            height: 80px;
            filter: brightness(0) invert(1);
        }

        .social-links a {
            color: white;
            font-size: 20px;
            margin-left: 15px;
            transition: color 0.3s;
        }

        .social-links a:hover {
            color: var(--accent-gold);
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 20px;
                border-radius: 10px;
                margin-top: 10px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('logo.png') }}" alt="قطاف القصيم">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">{{ __('messages.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">{{ __('messages.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="/services">{{ __('messages.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">{{ __('messages.contact') }}</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <select class="form-select form-select-sm" style="min-width: 140px;" onchange="window.location.href='{{ route('locale.set', ['locale' => '__LOCALE__']) }}'.replace('__LOCALE__', this.value)">
                        <option value="ar" {{ app()->getLocale() === 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                        <option value="hi" {{ app()->getLocale() === 'hi' ? 'selected' : '' }}>हिन्दी</option>
                        <option value="ur" {{ app()->getLocale() === 'ur' ? 'selected' : '' }}>اردو</option>
                        <option value="bn" {{ app()->getLocale() === 'bn' ? 'selected' : '' }}>বাংলা</option>
                        <option value="fa-AF" {{ app()->getLocale() === 'fa-AF' ? 'selected' : '' }}>فارسی</option>
                        <option value="ps" {{ app()->getLocale() === 'ps' ? 'selected' : '' }}>پښتو</option>
                    </select>
                    @auth
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="btn btn-primary-qitaf">لوحة التحكم</a>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-link text-dark text-decoration-none p-0">خروج</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-qitaf">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" class="btn btn-primary-qitaf">{{ __('messages.register') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-logo mb-4">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </div>
                    <p class="text-secondary">{{ __('messages.about_text') }}</p>
                </div>
                <div class="col-lg-2">
                    <h5 class="mb-4 fw-bold">{{ __('messages.quick_links') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/" class="text-secondary text-decoration-none">{{ __('messages.home') }}</a></li>
                        <li class="mb-2"><a href="/services" class="text-secondary text-decoration-none">{{ __('messages.services') }}</a></li>
                        <li class="mb-2"><a href="/about" class="text-secondary text-decoration-none">{{ __('messages.about') }}</a></li>
                        <li class="mb-2"><a href="/contact" class="text-secondary text-decoration-none">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="mb-4 fw-bold">{{ __('messages.contact_us') }}</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="fas fa-phone-alt ms-2"></i> </li>
                        <li class="mb-2"><i class="fas fa-envelope ms-2"></i> </li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt ms-2"></i> القصيم، المملكة العربية السعودية</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="mb-4 fw-bold">{{ __('messages.follow_us') }}</h5>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-secondary small">
                <p>{{ __('messages.all_rights_reserved') }} &copy; 2026 {{ __('messages.app_name') }}</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
