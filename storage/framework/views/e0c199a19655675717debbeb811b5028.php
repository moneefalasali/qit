

<?php $__env->startSection('title', 'الإشعارات - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'الإشعارات'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">الإشعارات</h5>
        <span class="badge bg-light text-dark"><?php echo e($notifications->total()); ?> إشعار</span>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="border rounded-4 p-3 mb-3">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="fw-bold mb-1"><?php echo e($notification->title); ?></h6>
                    <p class="mb-0 text-muted"><?php echo e($notification->message); ?></p>
                </div>
                <span class="badge bg-success-subtle text-success"><?php echo e($notification->created_at->diffForHumans()); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center py-5 text-muted">لا توجد إشعارات حالياً</div>
    <?php endif; ?>

    <div class="mt-3"><?php echo e($notifications->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\admin\notifications.blade.php ENDPATH**/ ?>