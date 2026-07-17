

<?php $__env->startSection('styles'); ?>
<style>
    .admin-shell {
        background-color: #f0f2f5;
        min-height: 100vh;
        padding: 16px 0;
    }

    .admin-nav-link {
        display: block;
        padding: 10px 12px;
        border-radius: 12px;
        color: #5b5b5b;
        text-decoration: none;
        transition: all 0.2s ease;
        font-weight: 600;
    }

    .admin-nav-link:hover,
    .admin-nav-link.active {
        background-color: #d4c5b0;
        color: #2d5a27;
    }

    .admin-card {
        border: 0;
        border-radius: 20px;
        box-shadow: 0 6px 16px rgba(45, 90, 39, 0.08);
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-shell">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <h2 class="fw-bold m-0" style="color: #2d5a27;"><?php echo $__env->yieldContent('page-title', __('messages.dashboard')); ?></h2>
            </div>
            <div class="d-flex align-items-center gap-3">
                <select class="form-select form-select-sm" style="min-width: 110px;" onchange="window.location.href='<?php echo e(route('locale.set', ['locale' => '__LOCALE__'])); ?>'.replace('__LOCALE__', this.value)">
                    <option value="ar" <?php echo e(app()->getLocale() === 'ar' ? 'selected' : ''); ?>>العربية</option>
                    <option value="en" <?php echo e(app()->getLocale() === 'en' ? 'selected' : ''); ?>>English</option>
                </select>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end d-none d-md-block">
                        <p class="m-0 fw-bold small"><?php echo e(auth()->user()->name ?? __('messages.admin')); ?></p>
                        <p class="m-0 text-muted" style="font-size: 0.7rem;"><?php echo e(auth()->user()->role ?? __('messages.admin')); ?></p>
                    </div>
                    <div class="bg-white p-1 rounded-circle shadow-sm">
                        <i class="fas fa-user-circle fs-2 text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-2 d-none d-lg-block">
                <div class="bg-white rounded-4 shadow-sm p-3 h-100">
                    <div class="text-center mb-4 py-3">
                        <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo" style="height: 60px;">
                        <p class="small text-muted mt-2 mb-0"><?php echo e(__('messages.about_text')); ?></p>
                    </div>
                    <ul class="nav flex-column gap-2">
                        <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"><i class="fas fa-chart-line ms-2"></i> <?php echo e(__('messages.dashboard')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.farmers')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.farmers') ? 'active' : ''); ?>"><i class="fas fa-tractor ms-2"></i> <?php echo e(__('messages.about')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.workers')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.workers') ? 'active' : ''); ?>"><i class="fas fa-users-cog ms-2"></i> <?php echo e(__('messages.register_worker')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.requests')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.requests') ? 'active' : ''); ?>"><i class="fas fa-clipboard-list ms-2"></i> <?php echo e(__('messages.request_labor')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.services')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.services') ? 'active' : ''); ?>"><i class="fas fa-concierge-bell ms-2"></i> <?php echo e(__('messages.services')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.reports')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.reports') ? 'active' : ''); ?>"><i class="fas fa-file-alt ms-2"></i> <?php echo e(__('messages.contact_us')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.activity-log')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.activity-log') ? 'active' : ''); ?>"><i class="fas fa-history ms-2"></i> <?php echo e(__('messages.follow_us')); ?></a></li>
                        <li class="mt-4">
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="admin-nav-link text-danger border-0 bg-transparent w-100 text-end">
                                    <i class="fas fa-sign-out-alt ms-2"></i> <?php echo e(__('messages.logout')); ?>

                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-10">
                <?php echo $__env->yieldContent('admin-content'); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/layouts/admin.blade.php ENDPATH**/ ?>