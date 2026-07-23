<?php $__env->startSection('title', 'سجل الدفع - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .history-container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: var(--primary-green);
        font-size: 28px;
        margin-bottom: 10px;
    }

    .payments-table {
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table thead {
        background-color: #f9f7f4;
        border-bottom: 2px solid var(--border-color);
    }

    .table th {
        padding: 15px;
        text-align: right;
        color: var(--primary-green);
        font-weight: 600;
    }

    .table td {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: #fddba8;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-failed {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-cancelled {
        background-color: #e2e3e5;
        color: #383d41;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .action-btn-view {
        background-color: var(--primary-green);
        color: white;
    }

    .action-btn-view:hover {
        background-color: goldenrod;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: var(--beige);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--light-text);
        margin-bottom: 10px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        text-decoration: none;
        color: var(--primary-green);
    }

    .pagination a:hover {
        background-color: goldenrod;
        color: white;
    }

    .pagination .active {
        background-color: var(--primary-green);
        color: white;
    }

    @media (max-width: 768px) {
        .table {
            font-size: 13px;
        }

        .table th, .table td {
            padding: 10px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="history-container">
    <div class="page-header">
        <h1>سجل الدفع</h1>
        <p style="color: var(--light-text);">عرض جميع عمليات الدفع السابقة</p>
    </div>

    <?php if($payments->count() > 0): ?>
        <div class="payments-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>نوع الخدمة</th>
                        <th>المبلغ</th>
                        <th>طريقة الدفع</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($payment->id); ?></td>
                            <td><?php echo e($payment->laborRequest->service_type); ?></td>
                            <td><?php echo e(number_format($payment->amount, 2)); ?> ر.س</td>
                            <td>
                                <?php if($payment->payment_method === 'credit_card'): ?>
                                    بطاقة ائتمان
                                <?php elseif($payment->payment_method === 'debit_card'): ?>
                                    بطاقة خصم
                                <?php elseif($payment->payment_method === 'apple_pay'): ?>
                                    Apple Pay
                                <?php elseif($payment->payment_method === 'google_pay'): ?>
                                    Google Pay
                                <?php else: ?>
                                    <?php echo e($payment->payment_method); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo e($payment->status); ?>">
                                    <?php if($payment->status === 'pending'): ?>
                                        قيد الانتظار
                                    <?php elseif($payment->status === 'completed'): ?>
                                        مكتمل
                                    <?php elseif($payment->status === 'failed'): ?>
                                        فشل
                                    <?php else: ?>
                                        ملغي
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td><?php echo e($payment->created_at->format('Y-m-d H:i')); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('payment.receipt', $payment->id)); ?>" class="action-btn action-btn-view">عرض الإيصال</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php echo e($payments->links()); ?>

        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-credit-card"></i>
            <h3>لا توجد عمليات دفع</h3>
            <p style="color: var(--light-text); margin-bottom: 20px;">لم تقم بأي عملية دفع حتى الآن</p>
            <a href="<?php echo e(route('farmer.requests')); ?>" style="display: inline-block; background-color: var(--primary-green); color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">العودة إلى الطلبات</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\payment\history.blade.php ENDPATH**/ ?>