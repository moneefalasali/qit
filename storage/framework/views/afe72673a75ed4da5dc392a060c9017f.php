

<?php $__env->startSection('title', 'تفاصيل الطلب - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .request-shell {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px 40px;
    }

    .request-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .request-header {
        background: linear-gradient(135deg, #f7f0e2 0%, #fff 100%);
        padding: 28px 32px;
        border-bottom: 1px solid #eee3ce;
    }

    .request-body {
        padding: 24px 32px 32px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .detail-box {
        background: #f8f7f3;
        border: 1px solid #ece6db;
        border-radius: 12px;
        padding: 16px;
    }

    .detail-label {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #2c2c2c;
        font-weight: 700;
    }

    .action-row {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
    }

    .btn-primary-soft {
        background: #2d5a27;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
    }

    .btn-secondary-soft {
        background: #f3efe8;
        color: #2d5a27;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
    }

    .table-responsive {
        margin-top: 16px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="request-shell">
    <div class="request-card">
        <div class="request-header">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h2 class="mb-2" style="color: #2d5a27;">طلب رقم #<?php echo e($laborRequest->id); ?></h2>
                    <p class="mb-0 text-muted">تفاصيل الطلب والحالة الحالية</p>
                </div>
                <span class="badge <?php echo e($laborRequest->status_badge_class); ?>"><?php echo e($laborRequest->status_label); ?></span>
            </div>
        </div>

        <div class="request-body">
            <div class="detail-grid">
                <div class="detail-box">
                    <div class="detail-label">الخدمة المطلوبة</div>
                    <div class="detail-value"><?php echo e($laborRequest->service_type); ?></div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">عدد العمال</div>
                    <div class="detail-value"><?php echo e($laborRequest->number_of_workers); ?></div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">تاريخ البداية</div>
                    <div class="detail-value"><?php echo e(optional($laborRequest->start_date)->format('Y-m-d')); ?></div>
                </div>
                <div class="detail-box">
                    <div class="detail-label">الأجر اليومي</div>
                    <div class="detail-value"><?php echo e(number_format($laborRequest->daily_wage, 2)); ?> ر.س</div>
                </div>
            </div>

            <?php if($laborRequest->description): ?>
                <div class="detail-box mb-3">
                    <div class="detail-label">الوصف</div>
                    <div class="detail-value"><?php echo e($laborRequest->description); ?></div>
                </div>
            <?php endif; ?>

            <div class="action-row">
                <a href="<?php echo e(route('farmer.requests')); ?>" class="btn-secondary-soft">العودة إلى القائمة</a>
                <?php if(in_array($laborRequest->status, ['approved', 'waiting_for_payment'])): ?>
                    <a href="<?php echo e(route('payment.form', $laborRequest->id)); ?>" class="btn-primary-soft">إتمام الدفع</a>
                <?php endif; ?>
            </div>

            <h4 class="mt-4" style="color: #2d5a27;">الطلبات المقدمة من العمال</h4>
            <?php if($applications->count()): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الرسالة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($application->worker->user->name ?? '-'); ?></td>
                                    <td><?php echo e($application->application_message ?? '-'); ?></td>
                                    <td><?php echo e($application->status); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3"><?php echo e($applications->links()); ?></div>
            <?php else: ?>
                <div class="alert alert-light mt-3" role="alert">
                    لا توجد طلبات من العمال حتى الآن.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\farmer\show-request.blade.php ENDPATH**/ ?>