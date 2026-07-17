

<?php $__env->startSection('title', 'إدارة الخدمات - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'إدارة الخدمات'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة الخدمات</h5>
        <span class="badge bg-light text-dark"><?php echo e($services->total()); ?> خدمة</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">#</th>
                    <th class="px-3 py-3 border-0">الاسم</th>
                    <th class="px-3 py-3 border-0">الوصف</th>
                    <th class="px-3 py-3 border-0">الحالة</th>
                    <th class="px-3 py-3 border-0">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-3 py-3 border-0"><?php echo e($service->id); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($service->name); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($service->description); ?></td>
                        <td class="px-3 py-3 border-0">
                            <span class="badge <?php echo e($service->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary'); ?>">
                                <?php echo e($service->is_active ? 'نشط' : 'غير نشط'); ?>

                            </span>
                        </td>
                        <td class="px-3 py-3 border-0">
                            <form method="POST" action="<?php echo e(route('admin.service.toggle', $service->id)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm <?php echo e($service->is_active ? 'btn-outline-danger' : 'btn-outline-success'); ?>">
                                    <?php echo e($service->is_active ? 'إلغاء التفعيل' : 'تفعيل'); ?>

                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">لا توجد خدمات حتى الآن</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3"><?php echo e($services->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/admin/services.blade.php ENDPATH**/ ?>