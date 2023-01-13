<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm main-navbar navbar-guest">
    <div class="container" style="display: flex;align-items: center;">
        <div class="row">
            <div>
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>" style="padding: 0 0 10px !important;">
                    <img class="main-logo"  src="<?php echo e(asset('/images/logo.png')); ?>" alt="<?php echo e(config('app.name', 'Laravel')); ?>"/>
                </a>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li <?php if(request()->routeIs('services.contact*')): ?> class="active" <?php endif; ?>><a class="nav-link" href="<?php echo e(route('services.contact')); ?>"><?php echo e(__('Citizens')); ?></a></li>
                <li <?php if(request()->routeIs('warehouse_data')): ?> class="active" <?php endif; ?>><a class="nav-link" href="<?php echo e(route('warehouse_data')); ?>"><?php echo e(__('Warehouse register')); ?></a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lang-item" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="flag-icon flag-icon-<?php echo e(Config::get('languages')[App::getLocale()]['flag-icon']); ?>" title="<?php echo e(Config::get('languages')[App::getLocale()]['display']); ?>"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php $__currentLoopData = Config::get('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($lang != App::getLocale()): ?>
                                <a class="dropdown-item" href="<?php echo e(route('lang.switch', $lang)); ?>"><span class="flag-icon flag-icon-<?php echo e($language['flag-icon']); ?>"></span> <?php echo e($language['display']); ?></a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lang-item user-icon" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user"></i>
                        <span><?php echo e(__('Personal account')); ?></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="https://in.sklads.kg/">
                            <span class="fas fa-sign-in-alt"></span>
                            <span><?php echo e(__('Sign in')); ?></span>
                        </a>
                        <a class="dropdown-item" href="<?php echo e(route('register')); ?>">
                            <span class="fa fa-user-plus"></span>
                            <span><?php echo e(__('Register now')); ?></span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH /var/www/html/soil_analysis/resources/views/layouts/navbarGuest.blade.php ENDPATH**/ ?>