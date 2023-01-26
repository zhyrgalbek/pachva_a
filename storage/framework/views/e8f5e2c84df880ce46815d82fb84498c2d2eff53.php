
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger" role="alert">
                    <strong><?php echo e(__('Opps!')); ?></strong> <?php echo e(__('Something went wrong, please check below errors.')); ?>

                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="section-title"><?php echo e(__('Edit password')); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php echo Form::model($user, ['route' => 'profile.update.password', 'method'=>'PATCH']); ?>

                    <div class="form-row">
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="password"><?php echo e(__('Password')); ?>:</label>
                            <?php echo Form::password('password', array('id'=>'password', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))); ?>

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?>:</label>
                            <?php echo Form::password('password_confirmation', array('id'=>'password_confirmation', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))); ?>

                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/users/profilePassword.blade.php ENDPATH**/ ?>