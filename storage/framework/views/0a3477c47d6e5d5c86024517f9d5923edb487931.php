<!-- Banners -->
<div class="col-md-12 mt-2">
    <?php ($mainBanners = App\Models\Other::where(['type'=>2, 'published'=>1])->orderBy('id','ASC')->paginate(100)); ?>
    <div id="carouselMain" class="carousel slide carousel-light" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php $__currentLoopData = $mainBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li data-target="#carouselMain" data-slide-to="<?php echo e($i); ?>" <?php if($i == 0): ?> class="active" <?php endif; ?>></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
        <div class="carousel-inner">
            <?php $__currentLoopData = $mainBanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-item p-3 <?php if($i == 0): ?> active <?php endif; ?>">
                    <a href="<?php echo e($banner->link??'#'); ?>">
                        <img src="<?php echo e($banner->image); ?>" class="d-block w-100 shadow-custom rounded-3 bg-white"
                             alt="<?php echo e($banner->title); ?>">
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only"><?php echo e(__('Previous')); ?></span>
        </a>
        <a class="carousel-control-next" href="#carouselMain" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only"><?php echo e(__('Next')); ?></span>
        </a>
    </div>
</div>
<?php /**PATH /var/www/html/soil_analysis/resources/views/layouts/banners.blade.php ENDPATH**/ ?>