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
        background-color: var(--light-green);
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
    <p>قم بتقديم طلب عمالة جديد للحصول على العمال المؤهلين</p>

    <?php if(auth()->check() && auth()->user()->role === 'farmer'): ?>
        <div class="info-box">
            <p><i class="fas fa-info-circle"></i> يرجى ملء جميع الحقول المطلوبة بدقة لضمان حصولك على أفضل النتائج</p>
        </div>

        <form method="POST" action="<?php echo e(route('farmer.request.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="service_type">نوع الخدمة المطلوبة</label>
                <select id="service_type" name="service_type" required>
                    <option value="">اختر نوع الخدمة</option>
                    <option value="جني_التمور">جني التمور</option>
                    <option value="تلقيح_النخيل">تلقيح النخيل</option>
                    <option value="تقليم_النخيل">تقليم النخيل</option>
                    <option value="الري_والعناية">الري والعناية</option>
                    <option value="الفرز_والتعبئة">الفرز والتعبئة</option>
                    <option value="تحميل_ونقل">تحميل ونقل</option>
                    <option value="خدمات_أخرى">خدمات أخرى</option>
                </select>
                <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span style="color: #dc3545; font-size: 13px;"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="number_of_workers">عدد العمال المطلوبين</label>
                    <input type="number" id="number_of_workers" name="number_of_workers" min="1" required>
                    <?php $__errorArgs = ['number_of_workers'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: #dc3545; font-size: 13px;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="daily_wage">الأجر اليومي (ر.س)</label>
                    <input type="number" id="daily_wage" name="daily_wage" min="0" step="0.01" required>
                    <?php $__errorArgs = ['daily_wage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: #dc3545; font-size: 13px;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="start_date">تاريخ البداية</label>
                    <input type="date" id="start_date" name="start_date" required>
                    <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: #dc3545; font-size: 13px;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="end_date">تاريخ النهاية (اختياري)</label>
                    <input type="date" id="end_date" name="end_date">
                    <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span style="color: #dc3545; font-size: 13px;"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="description">وصف الخدمة المطلوبة</label>
                <textarea id="description" name="description" placeholder="أضف تفاصيل إضافية عن الخدمة المطلوبة..."></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span style="color: #dc3545; font-size: 13px;"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="submit-btn">تقديم الطلب</button>
        </form>
    <?php else: ?>
        <div class="login-prompt">
            <p>يجب أن تكون مسجلاً دخولاً كمزارع لتقديم طلب عمالة</p>
            <div>
                <a href="<?php echo e(route('login')); ?>">تسجيل الدخول</a>
                <a href="<?php echo e(route('register')); ?>">إنشاء حساب</a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/pages/request-labor.blade.php ENDPATH**/ ?>