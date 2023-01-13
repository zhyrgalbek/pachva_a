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
                <li @if (request()->routeIs('ink')) class="active" @endif><a class="nav-link" href="{{ route('ink') }}">{{__('ink')}}</a></li>
                
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
                        <a class="dropdown-item" href="https://pochva.24mycrm.com/index.php">
                            <span class="fas fa-sign-in-alt"></span>
                            <span>{{ __('Sign in') }}</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('register') }}">
                            <span class="fa fa-user-plus"></span>
                            <span>{{ __('Register now') }}</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>