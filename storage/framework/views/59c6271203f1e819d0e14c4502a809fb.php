<?php $__env->startSection('title', 'سجل النشاطات - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'سجل النشاطات'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1" style="color: #2d5a27;">تتبع جميع النشاطات والعمليات</h5>
            <p class="text-muted mb-0">سجلات حقيقية من النظام</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">المستخدم</th>
                    <th class="px-3 py-3 border-0">نوع النشاط</th>
                    <th class="px-3 py-3 border-0">الوصف</th>
                    <th class="px-3 py-3 border-0">التاريخ والوقت</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-3 py-3 border-0"><?php echo e($activity['user']); ?></td>
                        <td class="px-3 py-3 border-0"><span class="badge <?php echo e($activity['badge_class']); ?>"><?php echo e($activity['type']); ?></span></td>
                        <td class="px-3 py-3 border-0"><?php echo e($activity['description']); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($activity['time']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">لا توجد نشاطات مسجلة</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\admin\activity-log.blade.php ENDPATH**/ ?>