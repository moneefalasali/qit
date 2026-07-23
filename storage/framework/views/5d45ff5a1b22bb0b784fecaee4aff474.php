<?php $__env->startSection('title', 'التقارير - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'التقارير'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">إجمالي الإيرادات</p>
            <h4 class="fw-bold mb-0"><?php echo e($totalEarnings); ?> ر.س</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">إجمالي الطلبات</p>
            <h4 class="fw-bold mb-0"><?php echo e($totalRequests); ?></h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">الطلبات المكتملة</p>
            <h4 class="fw-bold mb-0"><?php echo e($completedRequests); ?></h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card admin-card p-3 rounded-4">
            <p class="text-muted small mb-1">العمال المعتمدين</p>
            <h4 class="fw-bold mb-0"><?php echo e($approvedWorkers); ?></h4>
        </div>
    </div>
</div>

<div class="card admin-card rounded-4 p-4">
    <h5 class="fw-bold mb-3" style="color: #2d5a27;">ملخص سريع</h5>
    <p class="text-muted mb-0">إجمالي العمال المسجلين: <?php echo e($totalWorkers); ?><br>طلبات معلقة: <?php echo e($pendingRequests); ?></p>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\admin\reports.blade.php ENDPATH**/ ?>