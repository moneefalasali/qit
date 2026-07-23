<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 fw-bold" style="color: #2d5a27;">الملف الشخصي</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('worker.profile.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" class="form-control" value="<?php echo e(auth()->user()->name); ?>" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" value="<?php echo e(auth()->user()->email); ?>" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="national_id" class="form-label">رقم الهوية / الإقامة</label>
                            <input type="text" name="national_id" id="national_id" class="form-control <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('national_id', $worker->national_id)); ?>" required>
                            <?php $__errorArgs = ['national_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="specialization" class="form-label">التخصص</label>
                            <input type="text" name="specialization" id="specialization" class="form-control" value="<?php echo e(old('specialization', $worker->specialization)); ?>" placeholder="مثال: جني التمور، تقليم النخيل">
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">المهارات</label>
                            <textarea name="skills" id="skills" class="form-control" rows="3"><?php echo e(old('skills', $worker->skills)); ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="years_experience" class="form-label">سنوات الخبرة</label>
                            <input type="number" name="years_experience" id="years_experience" class="form-control" value="<?php echo e(old('years_experience', $worker->years_experience)); ?>">
                        </div>

                        <button type="submit" class="btn btn-primary px-5" style="background-color: #2d5a27; border-color: #2d5a27;">تحديث البيانات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qitaf_alqseem\resources\views\worker\profile.blade.php ENDPATH**/ ?>