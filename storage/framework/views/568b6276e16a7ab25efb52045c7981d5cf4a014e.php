
<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('roles.show', $role)); ?>


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
                            <h3 class="section-title"><?php echo e(__('Role')); ?></h3>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('roles.index', ['page'=>Session::get('page', 1)])); ?>"><?php echo e(__('Back')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong><?php echo e(__('Name')); ?>:</strong>
                        <?php echo e($role->name); ?>

                    </div>
                    <div class="lead">
                        <strong><?php echo e(__('Permissions')); ?>:</strong>
                        <?php if(!empty($rolePermissions)): ?>
                            <?php $__currentLoopData = $rolePermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="badge badge-success"><?php echo e($permission->name); ?></label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/roles/show.blade.php ENDPATH**/ ?>