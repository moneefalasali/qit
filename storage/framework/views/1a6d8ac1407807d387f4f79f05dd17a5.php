<?php $__env->startSection('title', 'طلب عمالة - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .request-container {
        max-width: 800px;
        margin: 60px auto;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .request-container h1 {
        color: var(--primary-green);
        margin-bottom: 10px;
        text-align: center;
        font-size: 28px;
    }

    .request-container p {
        text-align: center;
        color: var(--light-text);
        margin-bottom: 30px;
    }

    .info-box {
        background-color: #f9f7f4;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 30px;
        border-right: 4px solid var(--primary-green);
    }

    .info-box p {
        margin: 0;
        color: var(--light-text);
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--dark-text);
        font-weight: 600;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 5px rgba(45, 80, 22, 0.2);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-green);
        color: white;
        border: none;
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: var(--light-green);
    }

    .login-prompt {
        background-color: #e8dcc8;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        margin-top: 30px;
    }

    .login-prompt p {
        margin: 0 0 15px 0;
        color: var(--dark-text);
    }

    .login-prompt a {
        display: inline-block;
        background-color: var(--primary-green);
        color: white;
        padding: 10px 30px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
        margin: 0 10px;
    }

    .login-prompt a:hover {
        background-color: goldenrod;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .request-container {
            margin: 30px 20px;
            padding: 20px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="request-container">
    <h1>طلب عمالة</h1>
    <p>احصل على العمالة الزراعية المطلوبة بأسرع وقت وبأسهل تجربة.</p>

    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->role === 'farmer'): ?>
            <div class="info-box">
                <p><i class="fas fa-info-circle"></i> يمكنك تقديم طلب جديد مباشرة من صفحة الطلبات الخاصة بك.</p>
            </div>
            <div class="form-group text-center">
                <a href="<?php echo e(route('farmer.request.create')); ?>" class="submit-btn" style="display: inline-block; width: auto;">إنشاء طلب جديد</a>
            </div>
        <?php else: ?>
            <div class="login-prompt">
                <p>يجب أن تكون مسجلاً دخولاً كمزارع لإنشاء طلب عمالة.</p>
                <div>
                    <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
                    <a href="<?php echo e(route('register')); ?>">إنشاء حساب مزارع</a>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="login-prompt">
            <p>يجب أن تكون مسجلاً دخولاً كمزارع لإنشاء طلب عمالة.</p>
            <div>
                <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
                <a href="<?php echo e(route('register')); ?>">إنشاء حساب</a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/pages/request-labor.blade.php ENDPATH**/ ?>