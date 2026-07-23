<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4" style="background-color: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-white p-2 rounded-circle shadow-sm">
                    <i class="fas fa-user-circle fs-1 text-secondary"></i>
                </div>
                <h2 class="fw-bold m-0" style="color: #2d5a27;">أهلاً بك، مزارع القصيم</h2>
            </div>
            <div class="dropdown">
                <button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-cog ms-2"></i> الإعدادات
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(route('farmer.profile')); ?>">الملف الشخصي</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item text-danger">تسجيل الخروج</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row g-4">
            <!-- Sidebar / Stats Column -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mb-4 overflow-hidden" style="border-radius: 15px;">
                    <div class="card-body p-4 text-center">
                        <div class="bg-light p-4 rounded-circle mb-4 mx-auto" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-plus fs-1 text-success"></i>
                        </div>
                        <h5 class="fw-bold mb-3">طلب عمالة جديد</h5>
                        <p class="text-muted small mb-4">أنشئ طلباً جديداً لتوفير العمالة الزراعية لمزرعتك</p>
                        <a href="<?php echo e(route('farmer.request.create')); ?>" class="btn btn-primary-qitaf w-100 py-3">
                            <i class="fas fa-plus ms-2"></i> طلب عمالة جديد
                        </a>
                    </div>
                </div>

                <div class="bg-success p-4 rounded-4 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #2d5a27 0%, #4a7c2c 100%);">
                    <img src="<?php echo e(asset('logo.png')); ?>" class="position-absolute opacity-10" style="bottom: -20px; left: -20px; width: 150px; transform: rotate(-15deg); filter: brightness(0) invert(1);">
                    <h6 class="fw-bold mb-4">قطاف القصيم</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3"><a href="#" class="text-white text-decoration-none d-flex align-items-center gap-3"><i class="fas fa-th-large"></i> لوحة التحكم</a></li>
                        <li class="mb-3"><a href="<?php echo e(route('farmer.requests')); ?>" class="text-white text-decoration-none d-flex align-items-center gap-3 opacity-75"><i class="fas fa-clipboard-list"></i> طلباتي</a></li>
                        <li class="mb-3"><a href="<?php echo e(route('farmer.workers')); ?>" class="text-white text-decoration-none d-flex align-items-center gap-3 opacity-75"><i class="fas fa-users"></i> العمالة</a></li>
                        <li class="mb-3"><a href="<?php echo e(route('farmer.notifications')); ?>" class="text-white text-decoration-none d-flex align-items-center gap-3 opacity-75"><i class="fas fa-bell"></i> الإشعارات</a></li>
                        <li class="mb-3"><a href="<?php echo e(route('payment.history')); ?>" class="text-white text-decoration-none d-flex align-items-center gap-3 opacity-75"><i class="fas fa-receipt"></i> المدفوعات</a></li>
                        <li class="mb-0"><a href="<?php echo e(route('farmer.settings')); ?>" class="text-white text-decoration-none d-flex align-items-center gap-3 opacity-75"><i class="fas fa-cog"></i> الإعدادات</a></li>
                    </ul>
                </div>
            </div>

            <!-- Main Stats & Table Column -->
            <div class="col-lg-9">
                <!-- Top Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">إجمالي المصاريف</p>
                                    <h3 class="fw-bold mb-0"><?php echo e(number_format($totalSpent, 0)); ?> <small class="fs-6">ر.س</small></h3>
                                    <span class="text-success small fw-bold"><?php echo e($totalRequests > 0 ? '+' : ''); ?><?php echo e($totalRequests); ?> <span class="text-muted fw-normal">طلباً مسجلاً</span></span>
                                </div>
                                <div class="bg-light p-3 rounded-3 text-success">
                                    <i class="fas fa-wallet fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">العمالة الحالية</p>
                                    <h3 class="fw-bold mb-0"><?php echo e($activeWorkers); ?> <small class="fs-6">عامل</small></h3>
                                    <span class="text-success small fw-bold"><?php echo e($activeRequests); ?> <span class="text-muted fw-normal">طلباً نشطاً</span></span>
                                </div>
                                <div class="bg-light p-3 rounded-3 text-success">
                                    <i class="fas fa-users fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted small mb-1">الطلبات النشطة</p>
                                    <h3 class="fw-bold mb-0"><?php echo e($activeRequests); ?> <small class="fs-6">طلبات</small></h3>
                                    <span class="text-success small fw-bold"><?php echo e($completedRequests); ?> <span class="text-muted fw-normal">طلباً مكتملًا</span></span>
                                </div>
                                <div class="bg-light p-3 rounded-3 text-success">
                                    <i class="fas fa-tasks fs-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Requests Table -->
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold m-0"><i class="far fa-clock ms-2"></i> الطلبات الأخيرة</h5>
                        <a href="<?php echo e(route('farmer.requests')); ?>" class="text-decoration-none text-success fw-bold small">عرض جميع الطلبات ←</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3 border-0">الخدمة</th>
                                        <th class="px-4 py-3 border-0">التاريخ</th>
                                        <th class="px-4 py-3 border-0 text-center">عدد العمال</th>
                                        <th class="px-4 py-3 border-0">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="px-4 py-3 border-0 fw-bold"><?php echo e($request->service_type); ?></td>
                                            <td class="px-4 py-3 border-0 text-muted"><?php echo e($request->start_date?->format('Y/m/d') ?? '-'); ?></td>
                                            <td class="px-4 py-3 border-0 text-center"><?php echo e($request->number_of_workers); ?></td>
                                            <td class="px-4 py-3 border-0">
                                                <?php
                                                    $statusClass = match ($request->status) {
                                                        'pending' => 'bg-warning-subtle text-warning',
                                                        'approved' => 'bg-info-subtle text-info',
                                                        'in_progress' => 'bg-primary-subtle text-primary',
                                                        default => 'bg-success-subtle text-success',
                                                    };
                                                    $statusLabel = match ($request->status) {
                                                        'pending' => 'قيد الانتظار',
                                                        'approved' => 'موافق عليه',
                                                        'in_progress' => 'قيد التنفيذ',
                                                        'completed' => 'مكتمل',
                                                        default => 'انتظار الدفع',
                                                    };
                                                ?>
                                                <span class="badge rounded-pill <?php echo e($statusClass); ?> px-3 py-2">● <?php echo e($statusLabel); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="px-4 py-3 border-0 text-center text-muted">لا توجد طلبات بعد</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\farmer\dashboard.blade.php ENDPATH**/ ?>