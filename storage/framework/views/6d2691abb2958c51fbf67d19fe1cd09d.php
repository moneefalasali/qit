<?php $__env->startSection('title', 'لوحة تحكم الإدارة - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'لوحة تحكم الإدارة'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">إجمالي الطلبات</p>
                    <h4 class="fw-bold mb-1"><?php echo e($totalRequests); ?></h4>
                    <span class="text-success small"><?php echo e($completedRequests); ?> مكتملة</span>
                </div>
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="fas fa-list-ul fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">إجمالي المزارعين</p>
                    <h4 class="fw-bold mb-1"><?php echo e($totalFarmers); ?></h4>
                    <span class="text-success small">مستخدمون مسجلون</span>
                </div>
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="fas fa-tractor fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">طلبات قيد المراجعة</p>
                    <h4 class="fw-bold mb-1 text-warning"><?php echo e($pendingWorkers); ?></h4>
                    <span class="text-muted small">تحتاج إلى إجراء</span>
                </div>
                <div class="stat-icon bg-info-subtle text-info">
                    <i class="fas fa-clipboard-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">إجمالي العمالة المسجلة</p>
                    <h4 class="fw-bold mb-1"><?php echo e($totalWorkers); ?></h4>
                    <span class="text-success small"><?php echo e($totalEarnings); ?> ر.س دخل</span>
                </div>
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="fas fa-users fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card admin-card rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(90deg, #d4c5b0 0%, #e8dcc8 100%);">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-danger p-2 rounded-circle text-white shadow-sm">
                <i class="fas fa-bell"></i>
            </div>
            <h5 class="m-0 fw-bold" style="color: #2d5a27;">طلبات تسجيل عمال جديدة تحتاج مراجعة</h5>
            <span class="badge bg-danger rounded-pill"><?php echo e($pendingWorkers); ?></span>
        </div>
        <a href="<?php echo e(route('admin.workers')); ?>" class="btn btn-outline-dark border-0 fw-bold">عرض الطلبات ←</a>
    </div>
</div>

<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold m-0">أحدث الطلبات</h6>
        <a href="<?php echo e(route('admin.requests')); ?>" class="btn btn-sm btn-outline-qitaf">عرض الكل</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 border-0">#</th>
                    <th class="px-4 py-3 border-0">المزارع</th>
                    <th class="px-4 py-3 border-0">الخدمة</th>
                    <th class="px-4 py-3 border-0">عدد العمال</th>
                    <th class="px-4 py-3 border-0">الحالة</th>
                    <th class="px-4 py-3 border-0">تاريخ البداية</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-3 border-0"><?php echo e($request->id); ?></td>
                        <td class="px-4 py-3 border-0 fw-bold"><?php echo e($request->farmer->user->name ?? '-'); ?></td>
                        <td class="px-4 py-3 border-0"><?php echo e($request->service_type ?? '-'); ?></td>
                        <td class="px-4 py-3 border-0"><?php echo e($request->number_of_workers); ?></td>
                        <td class="px-4 py-3 border-0"><span class="badge bg-warning-subtle text-warning px-3 py-2"><?php echo e($request->status); ?></span></td>
                        <td class="px-4 py-3 border-0"><?php echo e($request->start_date ? $request->start_date->format('Y-m-d') : '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">لا توجد طلبات بعد</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>