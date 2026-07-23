

<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0 overflow-hidden" style="min-height: calc(100vh - 80px);">
    <div class="auth-split row g-0 h-100 flex-lg-row">
        <!-- Right Side Image -->
        <div class="col-lg-6 d-none d-lg-block position-relative">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('/images/22.png') center/cover no-repeat;"></div>
        </div>

        <!-- Left Side Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white py-5">
            <div class="w-100 px-4" style="max-width: 500px;">
                <div class="text-center mb-5">
                    <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo" class="mb-4" style="height: 120px;">
                    <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                        <div style="height: 2px; width: 40px; background: #d4c5b0;"></div>
                        <h2 class="fw-bold m-0" style="color: #2d5a27;">تسجيل الدخول</h2>
                        <div style="height: 2px; width: 40px; background: #d4c5b0;"></div>
                    </div>
                </div>

                <form method="POST" action="<?php echo e(route('login.post')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="email" class="form-label text-secondary fw-bold">البريد الإلكتروني أو رقم الجوال</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-start-0"><i class="far fa-user text-muted"></i></span>
                            <input type="email" class="form-control bg-light border-end-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="أدخل بريدك الإلكتروني" required>
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-secondary fw-bold">كلمة المرور</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-start-0"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" class="form-control bg-light border-end-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder="أدخل كلمة المرور" required>
                            <span class="input-group-text bg-light border-start-0"><i class="far fa-eye text-muted"></i></span>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-secondary small" for="remember">تذكرني</label>
                        </div>
                        <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none small" style="color: #2d5a27;">نسيت كلمة المرور؟</a>
                    </div>

                    <button type="submit" class="btn btn-primary-qitaf w-100 py-3 fs-5 mb-4">دخول</button>

                    <div class="position-relative text-center mb-4">
                        <hr>
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">أو</span>
                    </div>

                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-qitaf w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                        <i class="fas fa-user-plus"></i> إنشاء حساب جديد
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group-text {
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
    }
    .form-control {
        border-radius: 8px !important;
        border: 1px solid #dee2e6;
        padding: 12px;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #2d5a27;
    }
    .btn-primary-qitaf {
        background: linear-gradient(135deg, #2d5a27, #4f7f3f);
        border: none;
        color: white;
    }
    .btn-outline-qitaf {
        border: 1px solid #2d5a27;
        color: #2d5a27;
    }
    .btn-outline-qitaf:hover {
        background-color: #2d5a27;
        color: white;
    }
    .auth-split {
        position: relative;
    }
    .auth-divider {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 12px;
        transform: translateX(-50%);
        pointer-events: none;
        z-index: 3;
        background: linear-gradient(180deg, #d7b35d 0%, #c89b3c 45%, #8b6327 100%);
        clip-path: polygon(0 0, 100% 0, 100% 100%, 60% 100%, 46% 86%, 30% 72%, 18% 54%, 8% 24%, 0 0);
        box-shadow: 0 0 0 1px rgba(255,255,255,0.75);
        opacity: 1;
    }

    @media (max-width: 991.98px) {
        .auth-divider {
            display: none !important;
        }

        .auth-split {
            flex-direction: column !important;
        }

        .auth-split .col-lg-6 {
            width: 100%;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/auth/login.blade.php ENDPATH**/ ?>