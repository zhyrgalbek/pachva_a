<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('posts.create')); ?>


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
                            <h3 class="section-title"><?php echo e(__('Create post')); ?></h3>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-list')): ?>
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('posts.index')); ?>"><?php echo e(__('Posts')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo Form::open(array('route' => 'posts.store','method'=>'POST')); ?>

                    <div class="form-group">
                        <strong><?php echo e(__('Title')); ?>:</strong>
                        <?php echo Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')); ?>

                    </div>
                    <div class="form-group">
                        <strong><?php echo e(__('Description')); ?>:</strong>
                        <?php echo Form::textarea('description', null, array('id' => 'editor', 'placeholder' => __('Description'), 'class' => 'form-control')); ?>

                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Submit')); ?></button>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/posts/create.blade.php ENDPATH**/ ?>