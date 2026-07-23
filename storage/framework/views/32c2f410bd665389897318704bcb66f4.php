<?php $__env->startSection('title', 'الملف الشخصي - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .profile-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .profile-header {
        background: linear-gradient(135deg, var(--primary-green), var(--light-green));
        color: white;
        padding: 40px;
        border-radius: 10px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    .profile-info h1 {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .profile-info p {
        opacity: 0.9;
    }

    .profile-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }

    .profile-form {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-form h2 {
        color: var(--primary-green);
        margin-bottom: 20px;
        font-size: 20px;
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
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-size: 14px;
    }

    .form-group input:focus,
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
    }

    .submit-btn:hover {
        background-color:goldenrod;
    }

    .profile-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .sidebar-card {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .sidebar-card h3 {
        color: var(--primary-green);
        margin-bottom: 15px;
        font-size: 16px;
    }

    .sidebar-card p {
        color: var(--light-text);
        font-size: 14px;
        margin-bottom: 10px;
    }

    .stat-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-label {
        color: var(--light-text);
    }

    .stat-value {
        color: var(--primary-green);
        font-weight: 600;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            text-align: center;
        }

        .profile-content {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            <i class="fas fa-user-tie"></i>
        </div>
        <div class="profile-info">
            <h1><?php echo e(auth()->user()->name); ?></h1>
            <p><?php echo e(auth()->user()->email); ?></p>
            <p><?php echo e(auth()->user()->phone); ?></p>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="profile-content">
        <div class="profile-form">
            <h2>معلومات المزرعة</h2>
            <form method="POST" action="<?php echo e(route('farmer.profile.update')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="farm_name">اسم المزرعة</label>
                    <input type="text" id="farm_name" name="farm_name" value="<?php echo e($farmer->farm_name ?? ''); ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="farm_location">موقع المزرعة</label>
                        <input type="text" id="farm_location" name="farm_location" value="<?php echo e($farmer->farm_location ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="farm_area">مساحة المزرعة (هكتار)</label>
                        <input type="number" id="farm_area" name="farm_area" value="<?php echo e($farmer->farm_area ?? ''); ?>" step="0.01">
                    </div>
                </div>

                <div class="form-group">
                    <label for="farm_type">نوع المحصول الرئيسي</label>
                    <input type="text" id="farm_type" name="farm_type" value="<?php echo e($farmer->farm_type ?? ''); ?>" placeholder="مثال: نخيل، تمور">
                </div>

                <div class="form-group">
                    <label for="farm_description">وصف المزرعة</label>
                    <textarea id="farm_description" name="farm_description"><?php echo e($farmer->farm_description ?? ''); ?></textarea>
                </div>

                <button type="submit" class="submit-btn">حفظ التغييرات</button>
            </form>
        </div>

        <div class="profile-sidebar">
            <div class="sidebar-card">
                <h3>إحصائيات المزرعة</h3>
                <div class="stat-item">
                    <span class="stat-label">إجمالي الطلبات</span>
                    <span class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">الطلبات النشطة</span>
                    <span class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">الطلبات المنجزة</span>
                    <span class="stat-value">0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">التقييم</span>
                    <span class="stat-value">-</span>
                </div>
            </div>

            <div class="sidebar-card">
                <h3>معلومات الحساب</h3>
                <div class="stat-item">
                    <span class="stat-label">البريد الإلكتروني</span>
                </div>
                <p style="color: var(--light-text); font-size: 13px;"><?php echo e(auth()->user()->email); ?></p>
                <div class="stat-item" style="border-top: 1px solid var(--border-color); padding-top: 10px;">
                    <span class="stat-label">رقم الهاتف</span>
                </div>
                <p style="color: var(--light-text); font-size: 13px;"><?php echo e(auth()->user()->phone); ?></p>
                <div class="stat-item" style="border-top: 1px solid var(--border-color); padding-top: 10px;">
                    <span class="stat-label">المدينة</span>
                </div>
                <p style="color: var(--light-text); font-size: 13px;"><?php echo e(auth()->user()->city); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\farmer\profile.blade.php ENDPATH**/ ?>