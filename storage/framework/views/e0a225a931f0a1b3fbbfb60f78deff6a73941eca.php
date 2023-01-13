<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('news.index')); ?>


        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title"><?php echo e(__('All news')); ?></h3>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-create')): ?>
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('news.create')); ?>"><?php echo e(__('Add news')); ?></a>
                </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <ul class="nav nav-tabs news-tab" id="newsTab" role="tablist">
                        <?php $__currentLoopData = \App\Models\Article::getTypeOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeKey => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php if($typeKey==$type): ?> active <?php endif; ?>" id="tab<?php echo e($typeKey); ?>" href="<?php echo e(route(request()->route()->getName(), ['type' => $typeKey])); ?>" aria-controls="content<?php echo e($typeKey); ?>" <?php if($typeKey==$type): ?> aria-selected="true" <?php else: ?> aria-selected="false" <?php endif; ?>><?php echo e($typeLabel); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                    <div class="tab-content news-tab-content" id="newsTabContent">
                        <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="tab">
                            <div class="row news">
                                <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3">
                                    <?php echo $__env->make('layouts.article', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="pagination-content text-right mt-3">
                    <?php echo e($articles->appends($_GET)->links('pagination::bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sklads/resources/views/news/index.blade.php ENDPATH**/ ?>