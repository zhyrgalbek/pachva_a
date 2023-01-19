<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm main-navbar navbar-guest">
    <div class="container" style="display: flex;align-items: center;">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0 0 10px !important;">
                    <img class="main-logo" src="{{ asset('/images/hand-grass.png') }}" alt="{{ config('app.name', 'Laravel') }}" />
                </a>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li @if (request()->routeIs('services.contact*')) class="active" @endif><a class="nav-link" href="{{ route('services.contact') }}">{{__('Open data')}}</a></li>
                <li @if (request()->routeIs('rpas')) class="active" @endif><a class="nav-link" href="{{ route('rpas') }}">{{__('RPAS')}}</a></li>
                <li @if (request()->routeIs('servicesPage')) class="active" @endif><a class="nav-link" href="{{ route('servicesPage') }}">{{__('Services')}}</a></li>
                <li @if (request()->routeIs('sampleReceivePage')) class="active" @endif><a class="nav-link" href="{{ route('sampleReceivePage') }}">{{__('Sampling points')}}</a></li>
                <li @if (request()->routeIs('request')) class="active" @endif><a class="nav-link" href="{{ route('request') }}">{{__('Request')}}</a></li>

                @if (!Auth::guest())
                    <li @if (request()->routeIs('ink')) class="active" @endif><a class="nav-link" href="{{ route('ink') }}">{{__('ink')}}</a></li>
                @endif

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lang-item" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}" title="{{ Config::get('languages')[App::getLocale()]['display'] }}"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
                        @endif
                        @endforeach
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle lang-item user-icon" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-user"></i>
                        <span>{{ __('Personal account') }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @if (Auth::guest())
                        <a class="dropdown-item" href="{{ route('login') }}">
                            <span class="fas fa-sign-in-alt"></span>
                            <span>{{ __('Sign in') }}</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('register') }}">
                            <span class="fa fa-user-plus"></span>
                            <span>{{ __('Register now') }}</span>
                        </a>
                        @else
                        <a class="nav-icon" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div data-tooltip="tooltip" data-placement="bottom" title="{{ __('Logout') }}">
                                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="sign-out" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out fa-w-16 fa-9x"><path fill="currentColor" d="M48 64h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48zm279 19.5l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l132 131.4H172c-6.6 0-12 5.4-12 12v10c0 6.6 5.4 12 12 12h279.9L320 404.4c-4.7 4.7-4.7 12.3 0 17l7.1 7.1c4.7 4.7 12.3 4.7 17 0l164.5-164c4.7-4.7 4.7-12.3 0-17L344 83.5c-4.7-4.7-12.3-4.7-17 0z" class=""></path></svg>
                                <span>{{ __('Sign out') }}</span>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @endif
                        
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>