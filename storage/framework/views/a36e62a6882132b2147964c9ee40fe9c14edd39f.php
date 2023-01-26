<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php echo $__env->make('layouts.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-12">
            <h3 class="section-title"><?php echo e(__('Popular services on the portal')); ?></h3>
            <div class="row align-items-center">
                <div class="col-md">
                    <div class="service-list row">
                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-xl-3">
                                <?php echo $__env->make('layouts.serviceCard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-auto">
                    <a class="btn btn-light service-all float-right mb-3" href="<?php echo e(route('services.index')); ?>"><?php echo e(__('All services')); ?> <i class="fas fa-archive"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3 class="section-title"><?php echo e(__('Long-term credits')); ?></h3>
            <div class="shadow p-3 mb-5 bg-white rounded-lg">
                <p class="text-dark font-weight-bold text-lg"><?php echo e(__('10 - Service Providers')); ?></p>
                <div class="form-row align-items-center">
                    <div class="col" style="max-width: calc(100% - 56px)">
                        <ul class="nav nav-underlined mb-3" id="providers-tab" role="tablist">
                            <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?php if($i == 0): ?> active <?php endif; ?>" id="provider-<?php echo e($provider->id); ?>-tab" data-toggle="pill" href="#provider-<?php echo e($provider->id); ?>" role="tab" aria-controls="provider-<?php echo e($provider->id); ?>" <?php if($i == 0): ?> aria-selected="true" <?php else: ?> aria-selected="false" <?php endif; ?>><?php echo e($provider->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <div class="btn-group mb-3" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm bg-light text-dark border px-2 py-0" onclick="document.getElementById('providers-tab').scrollBy(-500,0)"><i class="fas fa-caret-left"></i></button>
                            <button type="button" class="btn btn-sm bg-light text-dark border px-2 py-0" onclick="document.getElementById('providers-tab').scrollBy(+500,0)"><i class="fas fa-caret-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="providers-tabContent">
                    <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade <?php if($i == 0): ?> show active <?php endif; ?>" id="provider-<?php echo e($provider->id); ?>" role="tabpanel" aria-labelledby="provider-<?php echo e($provider->id); ?>-tab">
                        <div class="row">
                            <div class="col-12 mb-3">
                            <?php echo $provider->description; ?>

                            </div>
                            <div class="col-12">
                            <button class="btn btn-primary float-right"><i class="fas fa-plus"></i> <?php echo e(__('Submit a new application')); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <h3 class="section-title"><?php echo e(__('My applications')); ?></h3>
            <div class="table-content shadow p-3 mb-5 bg-white rounded-lg">
                <p class="text-lg text-muted"><?php echo e(__('The results of applications come within 24 hours')); ?></p>
                <?php echo $__env->make('applications.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="section-title"><?php echo e(__('Exchange Rates')); ?></h3>
            <div class="shadow p-3 mb-5 bg-white rounded-lg position-relative">
                <div class="preloader p-5 text-center" data-target="#exchange">
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <iframe loading="lazy" id="exchange" width="100%" height="1057" src="https://www.tazabek.kg/valuta/exchange/?embed=1&date=<?php echo e(date('Y-m-d H:i')); ?>" frameborder="0" allowfullscreen></iframe>
                <div class="position-absolute rounded-lg" style="background-color: #fff;height: 70px;bottom: 0;left: 0;right: 0;z-index: 1;"></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\ga\resources\views/home.blade.php ENDPATH**/ ?>