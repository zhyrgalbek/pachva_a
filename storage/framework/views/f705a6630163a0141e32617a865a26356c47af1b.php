

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row row_login justify-content-center">
            <div class="login-block col-sm-8 col-md-6 col-lg-5 col-xl-4" style="min-width: 344px;">
                <div class="card">
                    <div class="card-header text-center bg-white border-b-0">
                        <h3 class="login-header"><?php echo e(__('Sign In')); ?></h3>
                    </div>

                    <div class="card-body">
                        <form class="login-form" method="POST" action="<?php echo e(route('login')); ?>"
                              onsubmit="return validateForm()">
                            <?php echo csrf_field(); ?>
                            <?php if(\Session::has('info')): ?>
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                    <?php echo e(\Session::get('info')); ?>

                                </div>
                            <?php endif; ?>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" id="identifier-label" for="identifier"><i
                                                        class="fas fa-user-tie"></i></label>
                                        </div>
                                        <input type="text" id="identifier"
                                               class="form-control <?php $__errorArgs = ['identifier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               placeholder="<?php echo e(__("INN/PIN")); ?>" aria-label="<?php echo e(__("INN/PIN")); ?>"
                                               aria-describedby="email-label" value="<?php echo e(old('email')); ?>" required
                                               name="identifier" autocomplete="identifier" autofocus>
                                        <?php $__errorArgs = ['identifier'];
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
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" id="password-label" for="password"><i
                                                        class="fas fa-lock"></i></label>
                                        </div>
                                        <input type="password" id="password"
                                               class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                               placeholder="<?php echo e(__('Password')); ?>" aria-label="<?php echo e(__('Password')); ?>"
                                               aria-describedby="password-label" value="<?php echo e(old('password')); ?>" required
                                               name="password" autocomplete="current-password">
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
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="remember" value="1"
                                               id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                        <label class="custom-control-label"
                                               for="remember"><?php echo e(__('Remember Me')); ?></label>
                                    </div>

                                    <?php if(Route::has('password.request')): ?>
                                        <a class="form-text mt-4 mb-2" href="<?php echo e(route('password.request')); ?>">
                                            <?php echo e(__("I don't know my password")); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            Разрешение на обработку персональных данных
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <?php if($errors->has('is_captcha') or $errors->has('g-recaptcha-response')): ?>
                                        <div id="captcha-container" class="w-100 d-flex justify-content-center <?php echo e($errors->has
                                            ('g-recaptcha-response')?'is-invalid':''); ?>">
                                            <?php echo NoCaptcha :: display (['data-callback'=>'captching']); ?>

                                        </div>

                                        <?php $__errorArgs = ['g-recaptcha-response'];
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
                                     <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <?php echo e(__('Login')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page-scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let is_captched = false;

        function captching() {
            is_captched = true;
        }

        function validateForm() {
            console.log('valid');
            $('#captcha-web-error').remove();
            
            
            
            
            
            
            
            
            
        }

    </script>
    <?php echo NoCaptcha::renderJs(); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/auth/login.blade.php ENDPATH**/ ?>