<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">
        <a class="sidebar-brand" href="<?php echo e(route('main')); ?>">
            <div class="sidebar-header-logo">
                <img src="<?php echo e(asset('images/logo.png')); ?>" style="width: 230px; margin: -20px; background: currentColor;" alt="" >
            </div>
            <p class="sidebar-header-text pt-2" style="color: black; margin-left: -15px;"><?php echo e(__('User\'s personal account')); ?></p>
        </a>
        <!-- Bootstrap List Group -->
        <ul class="list-group" data-simplebar>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small><?php echo e(__('MAIN MENU')); ?></small>
            </li>
            <!-- /END Separator -->
            <a href="<?php echo e(route('main')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('main')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Main')); ?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-tachometer-alt fa-fw"></span>
                    </span>
                    <span class="menu-collapsed"><?php echo e(__('Main')); ?></span>
                </div>
            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('service-list')): ?>
            <a href="<?php echo e(route('services.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('services.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Services')); ?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-th-list"></span>
                    </span>
                    <span class="menu-collapsed"><?php echo e(__('Services')); ?></span>
                </div>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('applications')): ?>
            <a href="<?php echo e(route('applications.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('applications.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Applications')); ?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="bi bi-pencil-square"></span>
                    </span>
                    <span class="menu-collapsed"><?php echo e(__('Applications')); ?></span>
                </div>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile')): ?>
            <a href="#profile" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action flex-column align-items-start <?php if(request()->routeIs('profile*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Profile')); ?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fa fa-user fa-fw"></span>
                    </span>
                    <span class="menu-collapsed"><?php echo e(__('Profile')); ?></span>
                    <span class="fas fa-caret-down ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='profile' class="collapse sidebar-submenu">
                <a href="<?php echo e(route('profile')); ?>" class="list-group-item list-group-item-action text-white <?php if(request()->routeIs(['profile', 'profile.edit'])): ?> active <?php endif; ?>">
                    <span class="menu-collapsed"><?php echo e(__('Settings')); ?></span>
                </a>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('profile-password')): ?>
                <a href="<?php echo e(route('profile.password')); ?>" class="list-group-item list-group-item-action text-white <?php if(request()->routeIs('profile.password')): ?> active <?php endif; ?>">
                    <span class="menu-collapsed"><?php echo e(__('Password')); ?></span>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <!-- Separator with title -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user-list', 'role-list', 'permission-list', 'post-list', 'news-list', 'file-manager', 'language-list'])): ?>
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small><?php echo e(__('ADMINISTRATION')); ?></small>
            </li>
            <?php endif; ?>
            <!-- /END Separator -->

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
                <a href="<?php echo e(route('users.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('users.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Users')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-users"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Users')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
                <a href="<?php echo e(route('roles.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('roles.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Roles')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-users-cog"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Roles')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission-list')): ?>
                <a href="<?php echo e(route('permissions.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('permissions.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Permissions')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-user-check"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Permissions')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-list')): ?>
                <a href="<?php echo e(route('posts.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('posts.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Posts')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="far fa-file"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Posts')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-list')): ?>
                <a href="<?php echo e(route('news.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('news.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('News')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-rss"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('News')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('other-list')): ?>
                <a href="<?php echo e(route('others.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('others.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Other settings')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-images"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Other settings')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('file-manager')): ?>
                <a href="<?php echo e(route('files')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('files')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('File manager')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="bi bi-card-image"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('File manager')); ?></span>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('log-list')): ?>
                <a href="<?php echo e(route('logs.index')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('logs.*')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Logs')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-file-medical-alt"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Logs')); ?></span>
                    </div>
                </a>
            <?php endif; ?>

                <a href="<?php echo e(route('languages')); ?>" class="list-group-item list-group-item-action <?php if(request()->routeIs('languages')): ?> active <?php endif; ?>" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Languages')); ?>">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="bi bi-translate"></span>
                    </span>
                        <span class="menu-collapsed"><?php echo e(__('Languages')); ?></span>
                    </div>
                </a>

            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="<?php echo e(route('posts.page', 'help')); ?>" class="list-group-item list-group-item-action" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Help')); ?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fa fa-question fa-fw"></span>
                    </span>
                    <span class="menu-collapsed"><?php echo e(__('Help')); ?></span>
                </div>
            </a>
            <a href="#" data-toggle="sidebar-colapse" class="list-group-item list-group-item-action d-flex d-none d-sm-block align-items-center" data-tooltip="collapsed" data-placement="right" title="<?php echo e(__('Expand')); ?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span id="collapse-icon" class="fa fas fa-angle-double-left"></span>
                    </span>
                    <span id="collapse-text" class="menu-collapsed"><?php echo e(__('Collapse')); ?></span>
                </div>
            </a>
        </ul>
        <!-- List Group END-->
    </div>
</nav>
<?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>