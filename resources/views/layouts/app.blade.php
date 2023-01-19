<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/hand-grass.png') }}">
    <link href="@asset_version('css/app.css')" rel="stylesheet">
    <link href="@asset_version('css/light.css')" rel="stylesheet">
    <link href="@asset_version('css/custom.css')" rel="stylesheet">
    <!-- <link href="@assets_version('css/document.css')" rel="stylesheet"> -->

    @stack('page-styles')

    <script src="@asset_version('js/app.js')"></script>
    <script src="@asset_version('ckeditor/ckeditor.js')"></script>
    <script src="@asset_version('js/custom.js')"></script>
    <!-- <script src="@asset_version('js/custom.js')"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="lib/leaflet.browser.print.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
</head>

<body class="{{str_replace('.', '-', Route::currentRouteName())}} @guest guest @else logged-in @endguest" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div id="app">
        {{-- @guest --}}
        @if(Auth::user() && Auth::user()->hasRole('contact'))
        <div class="wrapper">
            @include('layouts.sidebar')
            <div class="main">
                @include('layouts.topbar')
                <main class="content">
                    @yield('content')
                </main>
                @include('layouts.footer')
            </div>
        </div>
        @else
        @include('layouts.navbarGuest')
        @yield('content')
        @if(request()->routeIs('services.contact'))
        @include('openData.openData')
        @endif
        @include('layouts.footer')
        @endguest
        @stack('page-modals')
        @include('layouts.modals')
        <div id="layout-preloader" class="d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    @stack('page-scripts')
</body>

</html>