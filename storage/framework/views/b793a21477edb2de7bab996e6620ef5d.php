<?php $__env->startSection('title', 'إدارة العمال - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'إدارة العمال'); ?>

<?php $__env->startSection('admin-content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success rounded-4 mb-3">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة العمال</h5>
        <span class="badge bg-light text-dark"><?php echo e($workers->total()); ?> عامل</span>
    </div>

    <?php if($workers->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-3 py-3 border-0">الاسم</th>
                        <th class="px-3 py-3 border-0">البريد</th>
                        <th class="px-3 py-3 border-0">الهاتف</th>
                        <th class="px-3 py-3 border-0">الحالة</th>
                        <th class="px-3 py-3 border-0">الخبرة</th>
                        <th class="px-3 py-3 border-0">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $workers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="px-3 py-3 border-0"><?php echo e($worker->user->name ?? '-'); ?></td>
                            <td class="px-3 py-3 border-0"><?php echo e($worker->user->email ?? '-'); ?></td>
                            <td class="px-3 py-3 border-0"><?php echo e($worker->user->phone ?? '-'); ?></td>
                            <td class="px-3 py-3 border-0">
                                <span class="badge <?php echo e($worker->status === 'approved' ? 'bg-success-subtle text-success' : ($worker->status === 'rejected' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning')); ?>">
                                    <?php echo e($worker->status === 'approved' ? 'موافق عليه' : ($worker->status === 'rejected' ? 'مرفوض' : 'قيد الانتظار')); ?>

                                </span>
                            </td>
                            <td class="px-3 py-3 border-0"><?php echo e($worker->years_experience ?? '-'); ?> سنة</td>
                            <td class="px-3 py-3 border-0">
                                <?php if($worker->status === 'pending'): ?>
                                    <form method="POST" action="<?php echo e(route('admin.worker.approve', $worker->id)); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success ms-1">موافقة</button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('admin.worker.reject', $worker->id)); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">رفض</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">تمت المعالجة</span>
                                <?php endif; ?>
                                <a href="#" class="btn btn-sm btn-outline-secondary">عرض</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3"><?php echo e($workers->links()); ?></div>
    <?php else: ?>
        <div class="text-center py-5 text-muted">لا يوجد عمال مسجلين</div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/admin/workers.blade.php ENDPATH**/ ?>