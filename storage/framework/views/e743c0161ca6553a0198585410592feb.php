<?php $__env->startSection('title', 'الإعدادات - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .settings-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: var(--primary-green);
        font-size: 28px;
        margin-bottom: 10px;
    }

    .settings-section {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        color: var(--primary-green);
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .settings-group {
        margin-bottom: 25px;
    }

    .settings-group:last-child {
        margin-bottom: 0;
    }

    .setting-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .setting-item:last-child {
        border-bottom: none;
    }

    .setting-label {
        flex: 1;
    }

    .setting-label h3 {
        color: var(--dark-text);
        margin-bottom: 5px;
        font-size: 16px;
    }

    .setting-label p {
        color: var(--light-text);
        font-size: 14px;
    }

    .setting-control {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .toggle-switch {
        position: relative;
        width: 50px;
        height: 28px;
        background-color: #ccc;
        border-radius: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .toggle-switch.active {
        background-color: var(--primary-green);
    }

    .toggle-switch::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 24px;
        background-color: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: left 0.3s;
    }

    .toggle-switch.active::after {
        left: 24px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background-color: var(--primary-green);
        color: white;
    }

    .btn-primary:hover {
        background-color: goldenrod;
    }

    .btn-secondary {
        background-color: transparent;
        color: var(--primary-green);
        border: 2px solid var(--primary-green);
    }

    .btn-secondary:hover {
        background-color: var(--primary-green);
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
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
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .danger-zone {
        background-color: #fff5f5;
        border: 2px solid #dc3545;
        border-radius: 10px;
        padding: 20px;
    }

    .danger-zone h3 {
        color: #dc3545;
        margin-bottom: 15px;
    }

    .danger-zone p {
        color: var(--light-text);
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .setting-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .setting-control {
            width: 100%;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="settings-container">
    <div class="page-header">
        <h1>الإعدادات</h1>
        <p style="color: var(--light-text);">إدارة إعدادات حسابك والتفضيلات</p>
    </div>

    <!-- Notification Settings -->
    <div class="settings-section">
        <h2 class="section-title">إعدادات الإشعارات</h2>
        <div class="settings-group">
            <div class="setting-item">
                <div class="setting-label">
                    <h3>إشعارات البريد الإلكتروني</h3>
                    <p>تلقي إشعارات عبر البريد الإلكتروني عند وجود طلبات جديدة</p>
                </div>
                <div class="setting-control">
                    <div class="toggle-switch active"></div>
                </div>
            </div>
            <div class="setting-item">
                <div class="setting-label">
                    <h3>إشعارات الرسائل النصية</h3>
                    <p>تلقي رسائل نصية قصيرة للتنبيهات المهمة</p>
                </div>
                <div class="setting-control">
                    <div class="toggle-switch"></div>
                </div>
            </div>
            <div class="setting-item">
                <div class="setting-label">
                    <h3>إشعارات التطبيق</h3>
                    <p>تلقي إشعارات داخل التطبيق</p>
                </div>
                <div class="setting-control">
                    <div class="toggle-switch active"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Settings -->
    <div class="settings-section">
        <h2 class="section-title">إعدادات الخصوصية</h2>
        <div class="settings-group">
            <div class="setting-item">
                <div class="setting-label">
                    <h3>ملفك الشخصي عام</h3>
                    <p>السماح للآخرين برؤية ملفك الشخصي</p>
                </div>
                <div class="setting-control">
                    <div class="toggle-switch active"></div>
                </div>
            </div>
            <div class="setting-item">
                <div class="setting-label">
                    <h3>إظهار معلومات الاتصال</h3>
                    <p>السماح بعرض رقم الهاتف والبريد الإلكتروني</p>
                </div>
                <div class="setting-control">
                    <div class="toggle-switch"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings -->
    <div class="settings-section">
        <h2 class="section-title">إعدادات الحساب</h2>
        <form method="POST" action="#">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label>اللغة المفضلة</label>
                <select name="language">
                    <option value="ar">العربية</option>
                    <option value="en">English</option>
                    <option value="hi">हिन्दी</option>
                    <option value="ur">اردو</option>
                    <option value="bn">বাংলা</option>
                    <option value="fa-AF">دری</option>
                    <option value="ps">پښتو</option>
                </select>
            </div>
            <div class="form-group">
                <label>المنطقة الزمنية</label>
                <select name="timezone">
                    <option value="Asia/Riyadh">Asia/Riyadh (GMT+3)</option>
                    <option value="UTC">UTC</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
        </form>
    </div>

    <!-- Security Settings -->
    <div class="settings-section">
        <h2 class="section-title">إعدادات الأمان</h2>
        <div class="settings-group">
            <div class="setting-item">
                <div class="setting-label">
                    <h3>تغيير كلمة المرور</h3>
                    <p>تحديث كلمة المرور الخاصة بك</p>
                </div>
                <div class="setting-control">
                    <a href="#" class="btn btn-secondary">تغيير</a>
                </div>
            </div>
            <div class="setting-item">
                <div class="setting-label">
                    <h3>المصادقة الثنائية</h3>
                    <p>تفعيل المصادقة الثنائية لحماية إضافية</p>
                </div>
                <div class="setting-control">
                    <div class="toggle-switch"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="settings-section danger-zone">
        <h3>منطقة الخطر</h3>
        <p>هذه الإجراءات لا يمكن التراجع عنها. يرجى التأكد قبل المتابعة.</p>
        <div style="display: flex; gap: 10px;">
            <button class="btn btn-danger">حذف الحساب</button>
            <button class="btn btn-secondary">تنزيل بيانات حسابي</button>
        </div>
    </div>
</div>

<script>
    // Toggle switch functionality
    document.querySelectorAll('.toggle-switch').forEach(toggle => {
        toggle.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\farmer\settings.blade.php ENDPATH**/ ?>