
<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('others.index')); ?>


        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title"><?php echo e(__('Other settings')); ?></h3>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('other-create')): ?>
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('others.create')); ?>"><?php echo e(__('Add')); ?></a>
                </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <ul class="nav nav-tabs news-tab" id="newsTab" role="tablist">
                        <?php $__currentLoopData = \App\Models\Other::getTypeOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeKey => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if($typeKey==$type): ?> active <?php endif; ?>" id="tab<?php echo e($typeKey); ?>" href="<?php echo e(route(request()->route()->getName(), ['type' => $typeKey])); ?>" aria-controls="content<?php echo e($typeKey); ?>" <?php if($typeKey==$type): ?> aria-selected="true" <?php else: ?> aria-selected="false" <?php endif; ?>><?php echo e($typeLabel); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    <div class="tab-content news-tab-content" id="newsTabContent">
                        <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="tab">
                            <div class="row news">
                                <?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <div class="card <?php echo e($other->published ? 'published' : 'not-published'); ?>">
                                        <img src="<?php echo e($other->image); ?>" class="card-img-top other-image" alt="...">
                                        <div class="card-body">
                                            <?php if($other->title): ?>
                                            <h5 class="card-title"><?php echo e(Lang::has('other.title-'.$other->id) ? trans('other.title-'.$other->id) : $other->title); ?></h5>
                                            <?php endif; ?>
                                            <?php if($other->description): ?>
                                            <p class="card-text"><?php echo e(Lang::has('other.description-'.$other->id) ? trans('other.description-'.$other->id) : $other->description); ?></p>
                                            <?php endif; ?>
                                            <?php if($other->link): ?>
                                            <a href="<?php echo e($other->link); ?>" class="btn btn-link mb-3" target="_blank"><?php echo e($other->link); ?></a>
                                            <?php endif; ?>
                                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                <?php if($other->published): ?>
                                                    <span class="text-sm text-success font-weight-bold"><?php echo e(__('Published')); ?></span>
                                                <?php else: ?>
                                                    <span class="text-sm text-danger font-weight-bold"><?php echo e(__('Not published')); ?></span>
                                                <?php endif; ?>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="<?php echo e(__('Action')); ?>">
                                                    <a href="<?php echo e(route('others.show', $other->id)); ?>" class="btn btn-success" data-tooltip="tooltip" title="<?php echo e(__('Show')); ?>"><i class="fas fa-search-plus"></i></a>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('other-edit')): ?>
                                                        <a href="<?php echo e(route('others.edit', $other->id)); ?>" class="btn btn-primary" data-tooltip="tooltip" title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('other-delete')): ?>
                                                        <?php echo Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#other-delete-".$other->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('other-delete')): ?>
                                            <?php echo Form::open(['method' => 'DELETE','route' => ['others.destroy', $other->id], 'class'=>'d-none', 'id'=>'other-delete-'.$other->id]); ?>

                                            <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-content text-right mt-3">
                    <?php echo e($others->appends($_GET)->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/others/index.blade.php ENDPATH**/ ?>