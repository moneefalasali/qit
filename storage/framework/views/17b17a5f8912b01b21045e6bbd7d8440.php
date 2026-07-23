<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4 fw-bold" style="color: #2d5a27;">طلباتي المقدمة</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">الخدمة</th>
                                    <th class="px-4 py-3">المزارع</th>
                                    <th class="px-4 py-3">التاريخ</th>
                                    <th class="px-4 py-3">الأجر المتفق عليه</th>
                                    <th class="px-4 py-3">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-4 py-3"><?php echo e($application->laborRequest->service->name ?? 'خدمة زراعية'); ?></td>
                                    <td class="px-4 py-3"><?php echo e($application->laborRequest->farmer->user->name); ?></td>
                                    <td class="px-4 py-3"><?php echo e($application->created_at->format('Y/m/d')); ?></td>
                                    <td class="px-4 py-3"><?php echo e($application->agreed_wage); ?> ر.س</td>
                                    <td class="px-4 py-3">
                                        <?php if($application->status == 'pending'): ?>
                                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                        <?php elseif($application->status == 'accepted'): ?>
                                            <span class="badge bg-success">مقبول</span>
                                        <?php elseif($application->status == 'rejected'): ?>
                                            <span class="badge bg-danger">مرفوض</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?php echo e($application->status); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">لا يوجد طلبات مقدمة حالياً.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <?php echo e($applications->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\worker\applications.blade.php ENDPATH**/ ?>