<?php $__env->startSection('title', 'نموذج الدفع - قطاف القصيم'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .payment-container {
        max-width: 700px;
        margin: 40px auto;
        padding: 40px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #ffffff 0%, #f9f7f4 100%);
    }

    .payment-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .payment-header h1 {
        color: var(--primary-green);
        font-size: 28px;
        margin-bottom: 10px;
    }

    .payment-summary {
        background-color: #f9f7f4;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .summary-item {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        align-items: center;
        gap: 14px;
        margin-bottom: 10px;
        padding: 0;
        border-bottom: none;
    }

    .summary-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .summary-label {
        color: var(--light-text);
        font-weight: 600;
        text-align: right;
        white-space: normal;
    }

    .summary-value,
    .summary-total .value {
        color: var(--primary-green);
        font-weight: 700;
        direction: ltr;
        unicode-bidi: isolate;
        display: inline-block;
        text-align: left;
        white-space: nowrap;
    }

    .amount {
        direction: ltr;
        unicode-bidi: isolate-override;
        display: inline-block;
        white-space: nowrap;
    }

    .amount-number {
        direction: ltr;
        unicode-bidi: isolate;
        display: inline-block;
    }

    .amount-currency {
        direction: rtl;
        unicode-bidi: isolate;
        display: inline-block;
    }

    .summary-total {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        align-items: center;
        gap: 14px;
        margin-top: 14px;
        padding-top: 10px;
        border-top: none;
        font-size: 18px;
    }

    .summary-total .value {
        color: var(--primary-green);
        font-weight: 700;
        direction: ltr;
        unicode-bidi: isolate;
        display: inline-block;
        text-align: left;
        white-space: nowrap;
    }

    .commission-box {
        background: #fffdf9;
        border: 1px solid #ece4d7;
        border-radius: 10px;
        padding: 14px;
        margin-top: 12px;
    }

    .request-details {
        margin-top: 16px;
        padding: 14px;
        border-radius: 10px;
        background: #f9f7f4;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--dark-text);
        font-weight: 600;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .payment-method {
        padding: 15px;
        border: 2px solid var(--border-color);
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        transition: all 0.3s;
    }

    .payment-method:hover {
        border-color: var(--primary-green);
        background-color: #f9f7f4;
    }

    .payment-method input[type="radio"] {
        display: none;
    }

    .payment-method input[type="radio"]:checked + label {
        color: var(--primary-green);
        font-weight: 700;
    }

    .payment-method.selected {
        border-color: var(--primary-green);
        background-color: #fddba8;
    }

    .payment-method i {
        font-size: 28px;
        color: var(--primary-green);
        margin-bottom: 10px;
        display: block;
    }

    .payment-method label {
        margin: 0;
        cursor: pointer;
        color: var(--dark-text);
        font-weight: 600;
    }

    .terms {
        background-color: #f9f7f4;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .method-detail-block {
        display: none;
        margin-top: 15px;
        padding: 15px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background-color: #fcfcfa;
    }

    .method-detail-block.active {
        display: block;
    }

    .method-detail-block input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        margin-top: 8px;
    }

    .method-detail-block .row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .terms input[type="checkbox"] {
        margin-right: 10px;
    }

    .terms label {
        margin: 0;
        color: var(--light-text);
        font-size: 14px;
        cursor: pointer;
    }

    .submit-btn {
        width: 100%;
        padding: 15px;
        background-color: var(--primary-green);
        color: white;
        border: none;
        border-radius: 5px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: goldenrod;
    }

    .submit-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .cancel-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: var(--primary-green);
        text-decoration: none;
    }

    .cancel-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .payment-container {
            margin: 20px;
            padding: 20px;
        }

        .payment-methods {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="payment-container">
    <div class="payment-header">
        <h1>نموذج الدفع</h1>
        <p style="color: var(--light-text);">أكمل عملية الدفع لتأكيد طلب العمالة</p>
    </div>

    <div class="payment-summary">
        <div class="summary-item">
            <span class="summary-label">قيمة الفاتورة كاملة</span>
            <span class="summary-amount" dir="ltr"><?php echo e(number_format($amount, 2)); ?> ر.س</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">نسبة العمولة</span>
            <span class="summary-amount" dir="ltr"><?php echo e(number_format($commissionRate * 100, 1)); ?>%</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">العمولة</span>
            <span class="summary-amount" dir="ltr"><?php echo e(number_format($commissionAmount, 2)); ?> ر.س</span>
        </div>
        <div class="summary-total">
            <span class="summary-label">المبلغ النهائي</span>
            <span class="value summary-amount" dir="ltr"><?php echo e(number_format($finalAmount, 2)); ?> ر.س</span>
        </div>

        <div class="commission-box mt-3">
            <div class="fw-bold mb-2" style="color: #2d5a27;">تفاصيل الطلب</div>
            <div class="summary-item">
                <span class="summary-label">نوع الخدمة</span>
                <span class="summary-value"><?php echo e($laborRequest->service_type); ?></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">عدد العمال</span>
                <span class="summary-value"><?php echo e($laborRequest->number_of_workers); ?></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">الأجر اليومي</span>
                <span class="summary-amount" dir="ltr"><?php echo e($laborRequest->daily_wage); ?> ر.س</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">عدد الأيام</span>
                <span class="summary-value">
                    <?php
                        $days = 1;
                        if ($laborRequest->end_date) {
                            $start = $laborRequest->start_date;
                            $end = $laborRequest->end_date;
                            $days = max(1, abs($start->diffInDays($end)) + 1);
                        }
                    ?>
                    <?php echo e($days); ?>

                </span>
            </div>
        </div>
    </div>

    <?php if(session('payment_error')): ?>
        <div style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <?php echo e(session('payment_error')); ?>

        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('payment.process')); ?>" id="payment-form">
        <?php echo csrf_field(); ?>

        <input type="hidden" name="labor_request_id" value="<?php echo e($laborRequest->id); ?>">

        <div class="form-group">
            <label>طريقة الدفع</label>
            <div class="payment-methods">
                <div class="payment-method">
                    <input type="radio" id="credit_card" name="payment_method" value="credit_card" required>
                    <label for="credit_card">
                        <i class="fas fa-credit-card"></i>
                        بطاقة ائتمان
                    </label>
                </div>
                <div class="payment-method">
                    <input type="radio" id="debit_card" name="payment_method" value="debit_card">
                    <label for="debit_card">
                        <i class="fas fa-credit-card"></i>
                        بطاقة خصم
                    </label>
                </div>
                <div class="payment-method">
                    <input type="radio" id="apple_pay" name="payment_method" value="apple_pay">
                    <label for="apple_pay">
                        <i class="fab fa-apple"></i>
                        Apple Pay
                    </label>
                </div>
                <div class="payment-method">
                    <input type="radio" id="google_pay" name="payment_method" value="google_pay">
                    <label for="google_pay">
                        <i class="fab fa-google"></i>
                        Google Pay
                    </label>
                </div>
            </div>

            <div id="method-details">
                <div class="method-detail-block" data-method="credit_card">
                    <h6 class="fw-bold mb-3">بيانات البطاقة الائتمانية</h6>
                    <div class="row">
                        <div>
                            <label class="mb-2">رقم البطاقة</label>
                            <input type="text" placeholder="1234 5678 9012 3456">
                        </div>
                        <div>
                            <label class="mb-2">اسم حامل البطاقة</label>
                            <input type="text" placeholder="اسم حامل البطاقة">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div>
                            <label class="mb-2">تاريخ الانتهاء</label>
                            <input type="text" placeholder="MM/YY">
                        </div>
                        <div>
                            <label class="mb-2">CVV</label>
                            <input type="text" placeholder="123">
                        </div>
                    </div>
                </div>

                <div class="method-detail-block" data-method="debit_card">
                    <h6 class="fw-bold mb-3">بيانات البطاقة المخصومة</h6>
                    <div class="row">
                        <div>
                            <label class="mb-2">رقم البطاقة</label>
                            <input type="text" placeholder="1234 5678 9012 3456">
                        </div>
                        <div>
                            <label class="mb-2">الاسم على البطاقة</label>
                            <input type="text" placeholder="اسم البطاقة">
                        </div>
                    </div>
                </div>

                <div class="method-detail-block" data-method="apple_pay">
                    <h6 class="fw-bold mb-3">Apple Pay</h6>
                    <p class="mb-0 text-muted">سيتم فتح نافذة Apple Pay على جهازك لإتمام الدفع بشكل آمن.</p>
                </div>

                <div class="method-detail-block" data-method="google_pay">
                    <h6 class="fw-bold mb-3">Google Pay</h6>
                    <p class="mb-0 text-muted">سيتم استخدام Google Pay لإتمام الدفع عبر محفظتك الرقمية.</p>
                </div>
            </div>
        </div>

        <div class="terms">
            <input type="checkbox" id="agree_terms" name="agree_terms" required>
            <label for="agree_terms">
                أوافق على شروط الدفع وسياسة الخصوصية
            </label>
        </div>

        <button type="submit" class="submit-btn">متابعة الدفع</button>
        <a href="<?php echo e(route('farmer.requests')); ?>" class="cancel-link">← إلغاء</a>
    </form>
</div>

<script>
    // Add visual feedback for payment method selection
    const paymentRadios = document.querySelectorAll('.payment-method input[type="radio"]');
    const methodDetailBlocks = document.querySelectorAll('#method-details .method-detail-block');

    const updateMethodDetails = () => {
        const selected = document.querySelector('.payment-method input[type="radio"]:checked');
        document.querySelectorAll('.payment-method').forEach(method => {
            method.classList.remove('selected');
        });

        if (selected) {
            selected.parentElement.classList.add('selected');
            const methodName = selected.value;
            methodDetailBlocks.forEach(block => {
                block.classList.toggle('active', block.getAttribute('data-method') === methodName);
            });
        }
    };

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', updateMethodDetails);
    });

    updateMethodDetails();

    // Enable submit button only when terms are agreed
    const agreeCheckbox = document.getElementById('agree_terms');
    const submitBtn = document.querySelector('.submit-btn');

    agreeCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });

    submitBtn.disabled = !agreeCheckbox.checked;
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\payment\form.blade.php ENDPATH**/ ?>