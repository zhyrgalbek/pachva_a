
<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('permissions.index')); ?>


        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title"><?php echo e(__('Permissions')); ?></h3>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-create')): ?>
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('permissions.create')); ?>"><?php echo e(__('New Permission')); ?></a>
                </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <div class="table-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 60px;"><?php echo e(__('#')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th style="width: 110px;"><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($permission->id); ?></td>
                                        <td><?php echo e($permission->name); ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="<?php echo e(__('Action')); ?>">
                                                <a class="btn btn-success" href="<?php echo e(route('permissions.show',$permission->id)); ?>" data-tooltip="tooltip" title="<?php echo e(__('Show')); ?>"><i class="fas fa-search-plus"></i></a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-edit')): ?>
                                                    <a class="btn btn-primary" href="<?php echo e(route('permissions.edit',$permission->id)); ?>" data-tooltip="tooltip" title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-delete')): ?>
                                                    <?php echo Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#permission-delete-".$permission->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]); ?>

                                                <?php endif; ?>
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-delete')): ?>
                                            <?php echo Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'class'=>'d-none', 'id'=>'permission-delete-'.$permission->id]); ?>

                                            <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-content text-right mt-3">
                            <?php echo e($data->appends($_GET)->links('pagination::bootstrap-4')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/permissions/index.blade.php ENDPATH**/ ?>