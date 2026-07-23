<?php $__env->startSection('title', 'إدارة المزارعين - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'إدارة المزارعين'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة المزارعين</h5>
        <span class="badge bg-light text-dark"><?php echo e($farmers->total()); ?> مزارع</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">#</th>
                    <th class="px-3 py-3 border-0">الاسم</th>
                    <th class="px-3 py-3 border-0">البريد</th>
                    <th class="px-3 py-3 border-0">الهاتف</th>
                    <th class="px-3 py-3 border-0">اسم المزرعة</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-3 py-3 border-0"><?php echo e($farmer->id); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($farmer->user->name ?? '-'); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($farmer->user->email ?? '-'); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($farmer->user->phone ?? '-'); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($farmer->farm_name ?? '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">لا توجد مزارعين حتى الآن</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3"><?php echo e($farmers->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\admin\farmers.blade.php ENDPATH**/ ?>