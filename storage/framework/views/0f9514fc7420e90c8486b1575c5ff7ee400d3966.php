
<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('permissions.edit', $permission)); ?>


        <div class="justify-content-center">
            <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <strong><?php echo e(__('Opps!')); ?></strong> <?php echo e(__('Something went wrong, please check below errors.')); ?><br><br>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title"><?php echo e(__('Edit permission')); ?></h3>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-list')): ?>
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('permissions.index', ['page'=>Session::get('page', 1)])); ?>"><?php echo e(__('Permissions')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method'=>'PATCH']); ?>

                    <div class="form-group">
                        <strong>Name:</strong>
                        <?php echo Form::text('name', null, array('placeholder' => __('Name'),'class' => 'form-control')); ?>

                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/permissions/edit.blade.php ENDPATH**/ ?>