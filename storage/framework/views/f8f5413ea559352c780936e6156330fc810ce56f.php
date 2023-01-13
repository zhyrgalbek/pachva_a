<!-- News -->
<div class="col-md-12 mt-5">
    <h3 class="section-title"><?php echo e(__('News')); ?></h3>







    <div class="tab-content news-tab-content" id="newsTabContent">
        <?php $__currentLoopData = \App\Models\Article::getTypeOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeKey => $typeLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tab-pane fade <?php if($typeKey==1): ?> show active <?php endif; ?>" id="content<?php echo e($typeKey); ?>" role="tabpanel" aria-labelledby="tab<?php echo e($typeKey); ?>">
            <div class="row news">
            <?php ($articles = \App\Models\Article::latest()->paginate(4)); ?>
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <?php echo $__env->make('layouts.article', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div class="col-md-12 mt-3">
    <a href="<?php echo e(route('news.all')); ?>" class="btn btn-light service-all float-right"><?php echo e(__('All news')); ?> <i class="far fa-newspaper"></i></a>
</div>
<?php /**PATH /var/www/html/soil_analysis/resources/views/layouts/news.blade.php ENDPATH**/ ?>