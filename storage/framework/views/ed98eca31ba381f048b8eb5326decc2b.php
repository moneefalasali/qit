<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'قطاف القصيم - منصتك الموثوقة للعمالة الزراعية'); ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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

        .navbar-collapse.collapse,
        .navbar-collapse.collapse.show {
            visibility: visible !important;
        }

        .toast-stack {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: min(92vw, 520px);
            pointer-events: none;
        }

        .toast-item {
            pointer-events: auto;
            border: 0;
            border-radius: 14px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.16);
            overflow: hidden;
        }

        .toast-item .toast-icon {
            font-size: 1.1rem;
        }

        @media (min-width: 992px) {
            .navbar-expand-lg .navbar-collapse {
                visibility: visible !important;
            }
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
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="<?php echo e(asset('logo.png')); ?>" alt="قطاف القصيم">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="<?php echo e(__('messages.toggle_navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="/"><?php echo e(__('messages.home')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="/about"><?php echo e(__('messages.about')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="/services"><?php echo e(__('messages.services')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact"><?php echo e(__('messages.contact')); ?></a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <select class="form-select form-select-sm" style="min-width: 140px;" onchange="window.location.href=this.value">
                        <option value="<?php echo e(route('locale.set', ['locale' => 'ar'])); ?>" <?php echo e(app()->getLocale() === 'ar' ? 'selected' : ''); ?>>العربية</option>
                        <option value="<?php echo e(route('locale.set', ['locale' => 'en'])); ?>" <?php echo e(app()->getLocale() === 'en' ? 'selected' : ''); ?>>English</option>
                        <option value="<?php echo e(route('locale.set', ['locale' => 'hi'])); ?>" <?php echo e(app()->getLocale() === 'hi' ? 'selected' : ''); ?>>हिन्दी</option>
                        <option value="<?php echo e(route('locale.set', ['locale' => 'ur'])); ?>" <?php echo e(app()->getLocale() === 'ur' ? 'selected' : ''); ?>>اردو</option>
                        <option value="<?php echo e(route('locale.set', ['locale' => 'bn'])); ?>" <?php echo e(app()->getLocale() === 'bn' ? 'selected' : ''); ?>>বাংলা</option>
                        <option value="<?php echo e(route('locale.set', ['locale' => 'fa-AF'])); ?>" <?php echo e(app()->getLocale() === 'fa-AF' ? 'selected' : ''); ?>>فارسی</option>
                        <option value="<?php echo e(route('locale.set', ['locale' => 'ps'])); ?>" <?php echo e(app()->getLocale() === 'ps' ? 'selected' : ''); ?>>پښتو</option>
                    </select>
                    <?php if(auth()->guard()->check()): ?>
                        <?php
                            $unreadNotifications = auth()->user()->notifications()->whereNull('read_at')->count();
                        ?>
                        <a href="<?php echo e(route(auth()->user()->role . '.notifications')); ?>" class="btn btn-outline-qitaf position-relative">
                            <i class="fas fa-bell"></i>
                            <?php if($unreadNotifications > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo e($unreadNotifications); ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="<?php echo e(route(auth()->user()->role . '.dashboard')); ?>" class="btn btn-primary-qitaf">لوحة التحكم</a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-link text-dark text-decoration-none p-0">خروج</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-qitaf"><?php echo e(__('messages.login')); ?></a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary-qitaf"><?php echo e(__('messages.register')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?php
            $flashTypes = ['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'info'];
            $flashMessages = [];
            foreach ($flashTypes as $sessionKey => $alertType) {
                if (session()->has($sessionKey)) {
                    $flashMessages[] = ['type' => $alertType, 'message' => session($sessionKey)];
                }
            }
        ?>

        <?php if(!empty($flashMessages)): ?>
            <div class="toast-stack">
                <?php $__currentLoopData = $flashMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="toast-item toast align-items-center text-bg-<?php echo e($flash['type']); ?> border-0 show mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="4000">
                        <div class="d-flex align-items-start p-3 gap-2">
                            <div class="toast-icon mt-1">
                                <?php if($flash['type'] === 'success'): ?>
                                    <i class="fas fa-check-circle"></i>
                                <?php elseif($flash['type'] === 'danger'): ?>
                                    <i class="fas fa-exclamation-circle"></i>
                                <?php elseif($flash['type'] === 'warning'): ?>
                                    <i class="fas fa-exclamation-triangle"></i>
                                <?php else: ?>
                                    <i class="fas fa-info-circle"></i>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1"><?php echo e($flash['message']); ?></div>
                            <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-logo mb-4">
                        <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo">
                    </div>
                    <p class="text-secondary"><?php echo e(__('messages.about_text')); ?></p>
                </div>
                <div class="col-lg-2">
                    <h5 class="mb-4 fw-bold"><?php echo e(__('messages.quick_links')); ?></h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/" class="text-secondary text-decoration-none"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="mb-2"><a href="/services" class="text-secondary text-decoration-none"><?php echo e(__('messages.services')); ?></a></li>
                        <li class="mb-2"><a href="/about" class="text-secondary text-decoration-none"><?php echo e(__('messages.about')); ?></a></li>
                        <li class="mb-2"><a href="/contact" class="text-secondary text-decoration-none"><?php echo e(__('messages.contact')); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="mb-4 fw-bold"><?php echo e(__('messages.contact_us')); ?></h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-2"><i class="fas fa-phone-alt ms-2"></i> <a href="tel:+966501234567" class="text-secondary text-decoration-none">+966 50 123 4567</a></li>
                        <li class="mb-2"><i class="fas fa-envelope ms-2"></i> <a href="mailto:info@qitafalqaseem.sa" class="text-secondary text-decoration-none">info@qitafalqaseem.sa</a></li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt ms-2"></i> القصيم، المملكة العربية السعودية</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="mb-4 fw-bold"><?php echo e(__('messages.follow_us')); ?></h5>
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
                <p><?php echo e(__('messages.all_rights_reserved')); ?> &copy; 2026 <?php echo e(__('messages.app_name')); ?></p>
            </div>
        </div>
    </footer>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/layouts/app.blade.php ENDPATH**/ ?>