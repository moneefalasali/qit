

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 fw-bold" style="color: #2d5a27;">الإشعارات</h2>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="list-group-item p-4 <?php echo e($notification->read_at ? '' : 'bg-light'); ?>">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 fw-bold"><?php echo e($notification->title); ?></h5>
                                <small class="text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                            </div>
                            <p class="mb-1 text-secondary"><?php echo e($notification->message); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-bell-slash fs-1 d-block mb-3"></i>
                            لا يوجد إشعارات جديدة.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <?php echo e($notifications->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\farmer\notifications.blade.php ENDPATH**/ ?>