

<?php $__env->startSection('title', 'طلبات المزارعين - قطاف القصيم'); ?>

<?php $__env->startSection('page-title', 'طلبات المزارعين'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="card admin-card rounded-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0" style="color: #2d5a27;">قائمة الطلبات</h5>
        <span class="badge bg-light text-dark"><?php echo e($requests->total()); ?> طلب</span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-3 py-3 border-0">#</th>
                    <th class="px-3 py-3 border-0">المزارع</th>
                    <th class="px-3 py-3 border-0">الخدمة</th>
                    <th class="px-3 py-3 border-0">عدد العمال</th>
                    <th class="px-3 py-3 border-0">الحالة</th>
                    <th class="px-3 py-3 border-0">الإجراءات</th>
                    <th class="px-3 py-3 border-0">تاريخ البداية</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-3 py-3 border-0"><?php echo e($request->id); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($request->farmer->user->name ?? '-'); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($request->service_type ?? '-'); ?></td>
                        <td class="px-3 py-3 border-0"><?php echo e($request->number_of_workers); ?></td>
                        <td class="px-3 py-3 border-0">
                            <span class="badge bg-warning-subtle text-warning"><?php echo e($request->status); ?></span>
                        </td>
                        <td class="px-3 py-3 border-0">
                            <form method="POST" action="<?php echo e(route('admin.request.status', $request->id)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                    <option value="pending" <?php echo e($request->status === 'pending' ? 'selected' : ''); ?>>قيد الانتظار</option>
                                    <option value="approved" <?php echo e($request->status === 'approved' ? 'selected' : ''); ?>>موافق</option>
                                    <option value="in_progress" <?php echo e($request->status === 'in_progress' ? 'selected' : ''); ?>>قيد التنفيذ</option>
                                    <option value="completed" <?php echo e($request->status === 'completed' ? 'selected' : ''); ?>>مكتمل</option>
                                    <option value="cancelled" <?php echo e($request->status === 'cancelled' ? 'selected' : ''); ?>>ملغي</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-3 py-3 border-0"><?php echo e($request->start_date ? $request->start_date->format('Y-m-d') : '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">لا توجد طلبات حتى الآن</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3"><?php echo e($requests->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/admin/requests.blade.php ENDPATH**/ ?>