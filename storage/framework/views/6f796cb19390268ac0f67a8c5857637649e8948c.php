<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title"><?php echo e(__('Profile')); ?></h3>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile-edit')): ?>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('profile.edit')); ?>"><?php echo e(__('Edit')); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo Form::model($user, ['route' => 'profile.update']); ?>

                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto"><?php echo e(__('User type')); ?></legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <?php echo Form::select('user_type', array('1' => __('Individual'), '2' => __('Legal entity')), null, array('id'=>'user_type','class' => 'form-control mt-2')); ?>

                                </div>
                            </div>
                        </fieldset>
                        <?php if($user->user_type == 2): ?>
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto"><?php echo e(__('Organization')); ?></legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="organization_name"><?php echo e(__('Organization name')); ?>:</label>
                                    <?php echo Form::text('organization_name', null, array('id'=>'organization_name', 'class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="identifier"><?php echo e(__('INN')); ?>:</label>
                                    <?php echo Form::text('identifier', null, array('id'=>'identifier','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="phone2"><?php echo e(__('Phone')); ?>:</label>
                                    <?php echo Form::text('phone2', null, array('id'=>'phone2','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="address"><?php echo e(__('Legal address')); ?>:</label>
                                    <?php echo Form::textarea('address', null, array('id'=>'address','class' => 'form-control', 'rows'=>3)); ?>

                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto"><?php echo e(__('Head of the organization')); ?></legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="last_name"><?php echo e(__('Surname')); ?>:</label>
                                    <?php echo Form::text('last_name', null, array('id'=>'last_name','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="name"><?php echo e(__('Name')); ?>:</label>
                                    <?php echo Form::text('name', null, array('id'=>'name','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="middle_name"><?php echo e(__('Middle name')); ?>:</label>
                                    <?php echo Form::text('middle_name', null, array('id'=>'middle_name','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="phone"><?php echo e(__('Phone')); ?>:</label>
                                    <?php echo Form::text('phone', null, array('id'=>'phone','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="email"><?php echo e(__('Email')); ?>:</label>
                                    <?php echo Form::text('email', null, array('id'=>'email','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="password"><?php echo e(__('Password')); ?>:</label>
                                    <?php echo Form::password('password', array('id'=>'password', 'placeholder' => '******','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="role"><?php echo e(__('Role')); ?>:</label>
                                    <div class="form-control-plaintext">
                                    <?php $__currentLoopData = $userRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="badge badge-success"><?php echo e(__($r)); ?></label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <?php else: ?>
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto"><?php echo e(__('User information')); ?></legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="last_name"><?php echo e(__('Surname')); ?>:</label>
                                    <?php echo Form::text('last_name', null, array('id'=>'last_name','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="name"><?php echo e(__('Name')); ?>:</label>
                                    <?php echo Form::text('name', null, array('id'=>'name','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="middle_name"><?php echo e(__('Middle name')); ?>:</label>
                                    <?php echo Form::text('middle_name', null, array('id'=>'middle_name','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="phone"><?php echo e(__('Phone')); ?>:</label>
                                    <?php echo Form::text('phone', null, array('id'=>'phone','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="email"><?php echo e(__('Email')); ?>:</label>
                                    <?php echo Form::text('email', null, array('id'=>'email','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="identifier"><?php echo e(__('PIN')); ?>:</label>
                                    <?php echo Form::text('identifier', null, array('id'=>'identifier','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="password"><?php echo e(__('Password')); ?>:</label>
                                    <?php echo Form::password('password', array('id'=>'password', 'placeholder' => '******','class' => 'form-control')); ?>

                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="role"><?php echo e(__('Role')); ?>:</label>
                                    <div class="form-control-plaintext">
                                        <?php $__currentLoopData = $userRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="badge badge-success"><?php echo e(__($r)); ?></label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <?php endif; ?>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/users/profile.blade.php ENDPATH**/ ?>