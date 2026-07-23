

<?php $__env->startSection('title', 'العمالة - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .workers-shell {
        max-width: 1180px;
        margin: 40px auto;
        padding: 0 20px 48px;
    }

    .workers-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 28px;
    }

    .workers-header h1 {
        color: var(--primary-green);
        margin-bottom: 8px;
        font-size: 28px;
    }

    .workers-header p {
        color: var(--light-text);
        margin-bottom: 0;
    }

    .workers-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .workers-actions a {
        padding: 10px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
    }

    .workers-actions .primary-action {
        background: var(--primary-green);
        color: white;
    }

    .workers-actions .secondary-action {
        border: 1px solid var(--primary-green);
        color: var(--primary-green);
        background: white;
    }

    .workers-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .worker-card {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    }

    .worker-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
    }

    .worker-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: #edf5ea;
        color: var(--primary-green);
        font-size: 22px;
    }

    .worker-card h2 {
        color: var(--dark-text);
        font-size: 18px;
        margin: 0 0 5px;
    }

    .worker-card .worker-specialization {
        color: var(--light-text);
        font-size: 13px;
        margin: 0;
    }

    .worker-details {
        display: grid;
        gap: 12px;
        margin-bottom: 18px;
    }

    .worker-detail {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        border-bottom: 1px solid #f0f1f2;
        padding-bottom: 10px;
        font-size: 14px;
    }

    .worker-detail:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .worker-detail-label {
        color: var(--light-text);
    }

    .worker-detail-value {
        color: var(--dark-text);
        font-weight: 600;
        text-align: left;
    }

    .worker-request {
        background: #f8f9fa;
        border-radius: 6px;
        padding: 12px;
        font-size: 13px;
    }

    .worker-request a {
        color: var(--primary-green);
        font-weight: 600;
        text-decoration: none;
    }

    .empty-workers {
        background: white;
        border: 1px dashed #cfd8d0;
        border-radius: 10px;
        padding: 70px 20px;
        text-align: center;
        color: var(--light-text);
    }

    .empty-workers i {
        color: #9bb397;
        font-size: 52px;
        margin-bottom: 16px;
    }

    .pagination {
        justify-content: center;
        margin-top: 30px;
    }

    @media (max-width: 992px) {
        .workers-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .workers-header {
            align-items: stretch;
            flex-direction: column;
        }

        .workers-actions a {
            flex: 1;
            text-align: center;
        }

        .workers-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="workers-shell">
    <div class="workers-header">
        <div>
            <h1>العمالة</h1>
            <p>تابع العمال المرتبطين بطلباتك وحالة كل مهمة.</p>
        </div>
        <div class="workers-actions">
            <a href="<?php echo e(route('farmer.requests')); ?>" class="secondary-action">طلبات العمالة</a>
            <a href="<?php echo e(route('farmer.request.create')); ?>" class="primary-action">+ طلب عمالة جديد</a>
        </div>
    </div>

    <?php if($workers->count()): ?>
        <div class="workers-grid">
            <?php $__currentLoopData = $workers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $worker = $assignment->worker;
                    $workerName = $worker?->user?->name ?? 'عامل مسجل';
                    $statusLabel = $assignment->status === 'completed' ? 'مكتملة' : 'نشطة';
                    $statusClass = $assignment->status === 'completed' ? 'bg-success-subtle text-success' : 'bg-primary-subtle text-primary';
                ?>
                <article class="worker-card">
                    <div class="worker-card-header">
                        <div class="worker-avatar"><i class="fas fa-user"></i></div>
                        <div>
                            <h2><?php echo e($workerName); ?></h2>
                            <p class="worker-specialization"><?php echo e($worker?->specialization ?: 'عامل زراعي'); ?></p>
                        </div>
                    </div>

                    <div class="worker-details">
                        <div class="worker-detail">
                            <span class="worker-detail-label">الحالة</span>
                            <span class="badge <?php echo e($statusClass); ?>"><?php echo e($statusLabel); ?></span>
                        </div>
                        <div class="worker-detail">
                            <span class="worker-detail-label">سنوات الخبرة</span>
                            <span class="worker-detail-value"><?php echo e($worker?->years_experience ?? 0); ?> سنة</span>
                        </div>
                        <div class="worker-detail">
                            <span class="worker-detail-label">الأجر المتفق</span>
                            <span class="worker-detail-value"><?php echo e($assignment->agreed_wage ? number_format($assignment->agreed_wage, 2) . ' ر.س' : 'حسب الطلب'); ?></span>
                        </div>
                    </div>

                    <div class="worker-request">
                        <span class="text-muted">مرتبط بطلب:</span>
                        <a href="<?php echo e(route('farmer.request.show', $assignment->laborRequest->id)); ?>">
                            <?php echo e($assignment->laborRequest->service_type); ?> #<?php echo e($assignment->laborRequest->id); ?>

                        </a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="pagination">
            <?php echo e($workers->links()); ?>

        </div>
    <?php else: ?>
        <div class="empty-workers">
            <i class="fas fa-users"></i>
            <h2>لا توجد عمالة مرتبطة بطلباتك</h2>
            <p>عند قبول أحد العمال لطلبك سيظهر هنا مع تفاصيل المهمة.</p>
            <a href="<?php echo e(route('farmer.request.create')); ?>" class="workers-actions primary-action d-inline-flex mt-3">إنشاء طلب عمالة</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views/farmer/workers.blade.php ENDPATH**/ ?>