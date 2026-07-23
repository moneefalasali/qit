<?php $__env->startSection('title', 'إنشاء حساب - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .auth-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .auth-container h2 {
        color: var(--primary-green);
        margin-bottom: 30px;
        text-align: center;
        font-size: 28px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
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
    .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-size: 14px;
        background-color: #f9f7f4;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 5px rgba(45, 80, 22, 0.2);
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
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
    }

    .submit-btn:hover {
        background-color: goldenrod;
    }

    .links {
        text-align: center;
        margin-top: 20px;
    }

    .links a {
        color: var(--primary-green);
        text-decoration: none;
    }

    .links a:hover {
        text-decoration: underline;
    }

    .alert {
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-container">
    <h2>إنشاء حساب جديد</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('register.post')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-row full">
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-row full">
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة المرور</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" required>
                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group">
                <label for="city">المدينة</label>
                <input type="text" id="city" name="city" value="<?php echo e(old('city')); ?>" required>
                <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-row full">
            <div class="form-group">
                <label for="role">نوع الحساب</label>
                <select id="role" name="role" required onchange="toggleNationalIdField()">
                    <option value="">اختر نوع الحساب</option>
                    <option value="farmer" <?php echo e(old('role') === 'farmer' ? 'selected' : ''); ?>>مزارع</option>
                    <option value="worker" <?php echo e(old('role') === 'worker' ? 'selected' : ''); ?>>عامل زراعي</option>
                </select>
                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <?php if(old('role') === 'worker'): ?>
            <div class="form-row full" id="national-id-row">
                <div class="form-group">
                    <label for="national_id">رقم الهوية الوطنية</label>
                    <input type="text" id="national_id" name="national_id" value="<?php echo e(old('national_id')); ?>" placeholder="مطلوب عند تسجيل عامل زراعي">
                    <small style="color:#6c757d; display:block; margin-top:5px;">رقم الهوية مطلوب عند تسجيل عامل زراعي.</small>
                    <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="error-message"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="form-row full" id="national-id-row" style="display:none;"></div>
        <?php endif; ?>

        <button type="submit" class="submit-btn">إنشاء الحساب</button>

        <div class="links">
            هل لديك حساب بالفعل؟ <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
        </div>
    </form>
</div>

<script>
    function toggleNationalIdField() {
        var role = document.getElementById('role').value;
        document.getElementById('national-id-row').style.display = role === 'worker' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleNationalIdField();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\auth\register.blade.php ENDPATH**/ ?>