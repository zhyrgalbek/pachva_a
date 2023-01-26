<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('images/hand-grass.png')); ?>">
    <link href="<?php echo config('assets.version') ? asset('css/app.css') . '?v=' . config('assets.version') : asset('css/app.css'); ?>" rel="stylesheet">
    <link href="<?php echo config('assets.version') ? asset('css/light.css') . '?v=' . config('assets.version') : asset('css/light.css'); ?>" rel="stylesheet">
    <link href="<?php echo config('assets.version') ? asset('css/custom.css') . '?v=' . config('assets.version') : asset('css/custom.css'); ?>" rel="stylesheet">
    <link href="<?php echo config('assets.version') ? asset('css/ink.css') . '?v=' . config('assets.version') : asset('css/ink.css'); ?>" rel="stylesheet">
    <link href="<?php echo config('assets.version') ? asset('css/document.css') . '?v=' . config('assets.version') : asset('css/document.css'); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('page-styles'); ?>
    <script src="<?php echo config('assets.version') ? asset('js/app.js') . '?v=' . config('assets.version') : asset('js/app.js'); ?>"></script>
    <script src="<?php echo config('assets.version') ? asset('ckeditor/ckeditor.js') . '?v=' . config('assets.version') : asset('ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo config('assets.version') ? asset('js/custom.js') . '?v=' . config('assets.version') : asset('js/custom.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="../../../lib/leaflet.browser.print.min.js"></script>
    <script src="es6-promise.auto.min.js"></script>
    <script src="jspdf.min.js"></script>
    <script src="html2canvas.min.js"></script>
    <script src="html2pdf.min.js"></script>
</head>

<body class="<?php echo e(str_replace('.', '-', Route::currentRouteName())); ?> <?php if(auth()->guard()->guest()): ?> guest <?php else: ?> logged-in <?php endif; ?>" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div id="app">
        
        <?php if(Auth::user() && Auth::user()->hasRole('admin')): ?>
        <div class="wrapper">
            <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="main">
                <?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <main class="content">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>
        <?php else: ?>
        <?php echo $__env->make('layouts.navbarGuest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php if(request()->routeIs('services.contact')): ?>
        <?php echo $__env->make('openData.openData', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- <?php echo $__env->yieldPushContent('page-modals'); ?> -->
        <!-- <?php echo $__env->make('layouts.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->
        <div id="layout-preloader" class="d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php echo $__env->yieldPushContent('page-scripts'); ?>
</body>

</html><?php /**PATH C:\OSPanel\domains\ga\resources\views/layouts/app.blade.php ENDPATH**/ ?>