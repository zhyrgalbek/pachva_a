<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('posts.index')); ?>


        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title"><?php echo e(__('Posts')); ?></h3>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-create')): ?>
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('posts.create')); ?>"><?php echo e(__('New post')); ?></a>
                </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <div class="table-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 60px;"><?php echo e(__('#')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th style="width: 110px;"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($post->id); ?></td>
                                    <td><a href="<?php echo e(route('posts.page', $post->title)); ?>"><?php echo e($post->title); ?></a></td>
                                    <td><div class="td-html"><?php echo html_entity_decode( Lang::has('post.'.$post->title) ? trans('post.'.$post->title) : $post->description ); ?></div></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="<?php echo e(__('Action')); ?>">
                                            <a class="btn btn-success" href="<?php echo e(route('posts.show',$post->id)); ?>" data-tooltip="tooltip" title="<?php echo e(__('Show')); ?>"><i class="fas fa-search-plus"></i></a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-edit')): ?>
                                                <a class="btn btn-primary" href="<?php echo e(route('posts.edit',$post->id)); ?>" data-tooltip="tooltip" title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-delete')): ?>
                                                <?php echo Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#post-delete-".$post->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]); ?>

                                            <?php endif; ?>
                                        </div>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-delete')): ?>
                                        <?php echo Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'class'=>'d-none', 'id'=>'post-delete-'.$post->id]); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/posts/index.blade.php ENDPATH**/ ?>