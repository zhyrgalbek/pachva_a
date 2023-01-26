<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('users.create')); ?>


        <div class="justify-content-center">
            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong><?php echo e(__('Opps!')); ?></strong> <?php echo e(__('Something went wrong, please check below errors.')); ?>

                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title"><?php echo e(__('Create user')); ?></h3>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-body">
                    <?php echo Form::open(array('route' => 'users.store','method'=>'POST')); ?>

                    <fieldset class="border p-2">
                        <legend  class="w-auto"><?php echo e(__('User type')); ?></legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <?php echo Form::select('user_type', array('1' => __('Individual'), '2' => __('Legal entity')), null, array('id'=>'user_type','class' => 'form-control mt-2'.($errors->has('user_type')?' is-invalid':''), 'data-switcher')); ?>

                                <?php $__errorArgs = ['user_type'];
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
                    </fieldset>
                    <fieldset class="border p-2" data-user_type="1">
                        <legend  class="w-auto"><?php echo e(__('User information')); ?></legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="last_name2"><?php echo e(__('Surname')); ?>:</label>
                                <?php echo Form::text('last_name', null, array('id'=>'last_name2', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['last_name'];
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
                                <label for="name2"><?php echo e(__('Name')); ?>:</label>
                                <?php echo Form::text('name', null, array('id'=>'name2', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['name'];
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
                                <label for="middle_name2"><?php echo e(__('Middle name')); ?>:</label>
                                <?php echo Form::text('middle_name', null, array('id'=>'middle_name2', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['middle_name'];
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
                                <label for="phone22"><?php echo e(__('Phone')); ?>:</label>
                                <?php echo Form::text('phone', null, array('id'=>'phone22', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['phone'];
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
                                <label for="email2"><?php echo e(__('Email')); ?>:</label>
                                <?php echo Form::text('email', null, array('id'=>'email2', 'placeholder' => __('Email'),'class' => 'form-control'.($errors->has('email')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['email'];
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
                                <label for="identifier2"><?php echo e(__('PIN')); ?>:</label>
                                <?php echo Form::text('identifier', null, array('id'=>'identifier2', 'placeholder' => __('PIN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))); ?>

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
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="password2"><?php echo e(__('Password')); ?>:</label>
                                <?php echo Form::password('password', array('id'=>'password2', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))); ?>

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
                                <label for="password_confirmation2"><?php echo e(__('Confirm Password')); ?>:</label>
                                <?php echo Form::password('password_confirmation', array('id'=>'password_confirmation2', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))); ?>

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
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="roles2"><?php echo e(__('Role')); ?>:</label>
                                <?php echo Form::select('roles[]', $roles, [], array('id'=>'roles2', 'class' => 'form-control'.($errors->has('role')?' is-invalid':''),'multiple')); ?>

                                <?php $__errorArgs = ['roles'];
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
                    </fieldset>
                    <fieldset class="border p-2" data-user_type="2">
                        <legend  class="w-auto"><?php echo e(__('Organization')); ?></legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="organization_name"><?php echo e(__('Organization name')); ?>:</label>
                                <?php echo Form::text('organization_name', null, array('id'=>'organization_name', 'placeholder'=>__('Organization name'), 'class' => 'form-control'.($errors->has('organization_name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['organization_name'];
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
                                <label for="identifier"><?php echo e(__('INN')); ?>:</label>
                                <?php echo Form::text('identifier', null, array('id'=>'identifier', 'placeholder' => __('INN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))); ?>

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
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="phone"><?php echo e(__('Phone')); ?>:</label>
                                <?php echo Form::text('phone2', null, array('id'=>'phone2', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone2')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['phone2'];
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
                                <label for="address"><?php echo e(__('Legal address')); ?>:</label>
                                <?php echo Form::textarea('address', null, array('id'=>'address', 'placeholder' => __('Legal address'),'class' => 'form-control'.($errors->has('address')?' is-invalid':''), 'rows'=>3)); ?>

                                <?php $__errorArgs = ['address'];
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
                    </fieldset>
                    <fieldset class="border p-2" data-user_type="2">
                        <legend  class="w-auto"><?php echo e(__('Head of the organization')); ?></legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="last_name"><?php echo e(__('Surname')); ?>:</label>
                                <?php echo Form::text('last_name', null, array('id'=>'last_name', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['last_name'];
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
                                <label for="name"><?php echo e(__('Name')); ?>:</label>
                                <?php echo Form::text('name', null, array('id'=>'name', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['name'];
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
                                <label for="middle_name"><?php echo e(__('Middle name')); ?>:</label>
                                <?php echo Form::text('middle_name', null, array('id'=>'middle_name', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))); ?>

                                <?php $__errorArgs = ['middle_name'];
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
                            <div class="col-md-12 col-lg-8">
                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="phone"><?php echo e(__('Phone')); ?>:</label>
                                        <?php echo Form::text('phone', null, array('id'=>'phone', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))); ?>

                                        <?php $__errorArgs = ['phone'];
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
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="email"><?php echo e(__('Email')); ?>:</label>
                                        <?php echo Form::text('email', null, array('id'=>'email', 'placeholder' => __('Email'),'class' => 'form-control'.($errors->has('email')?' is-invalid':''))); ?>

                                        <?php $__errorArgs = ['email'];
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
                                    <div class="col-md-6 col-lg-6 mb-3">
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
                                    <div class="col-md-6 col-lg-6 mb-3">
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
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-row">
                                    <div class="col-md-12 col-lg-12 mb-3">
                                        <label for="role"><?php echo e(__('Role')); ?>:</label>
                                        <?php echo Form::select('roles[]', $roles, [], array('id'=>'role', 'class' => 'form-control'.($errors->has('role')?' is-invalid':''),'multiple', 'size'=>5)); ?>

                                        <?php $__errorArgs = ['roles'];
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

                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/users/create.blade.php ENDPATH**/ ?>