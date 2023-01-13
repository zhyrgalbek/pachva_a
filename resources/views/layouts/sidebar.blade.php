<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">
        <a class="sidebar-brand" href="{{route('main')}}">
            <div class="sidebar-header-logo">
                <img src="{{ asset('images/logo.png') }}" style="width: 230px; margin: -20px; background: currentColor;" alt="" >
            </div>
            <p class="sidebar-header-text pt-2" style="color: black; margin-left: -15px;">{{__('User\'s personal account')}}</p>
        </a>
        <!-- Bootstrap List Group -->
        <ul class="list-group" data-simplebar>
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>{{__('MAIN MENU')}}</small>
            </li>
            <!-- /END Separator -->
            <a href="{{route('main')}}" class="list-group-item list-group-item-action @if (request()->routeIs('main')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Main')}}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-tachometer-alt fa-fw"></span>
                    </span>
                    <span class="menu-collapsed">{{__('Main')}}</span>
                </div>
            </a>
            @can('service-list')
            <a href="{{route('services.index')}}" class="list-group-item list-group-item-action @if (request()->routeIs('services.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Services')}}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-th-list"></span>
                    </span>
                    <span class="menu-collapsed">{{__('Services')}}</span>
                </div>
            </a>
            @endcan
            @can('applications')
            <a href="{{route('applications.index')}}" class="list-group-item list-group-item-action @if (request()->routeIs('applications.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Applications')}}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="bi bi-pencil-square"></span>
                    </span>
                    <span class="menu-collapsed">{{__('Applications')}}</span>
                </div>
            </a>
            @endcan
            @can('profile')
            <a href="#profile" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action flex-column align-items-start @if (request()->routeIs('profile*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Profile')}}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fa fa-user fa-fw"></span>
                    </span>
                    <span class="menu-collapsed">{{__('Profile')}}</span>
                    <span class="fas fa-caret-down ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='profile' class="collapse sidebar-submenu">
                <a href="{{route('profile')}}" class="list-group-item list-group-item-action text-white @if (request()->routeIs(['profile', 'profile.edit'])) active @endif">
                    <span class="menu-collapsed">{{__('Settings')}}</span>
                </a>
                @can('profile-password')
                <a href="{{route('profile.password')}}" class="list-group-item list-group-item-action text-white @if (request()->routeIs('profile.password')) active @endif">
                    <span class="menu-collapsed">{{__('Password')}}</span>
                </a>
                @endcan
            </div>
            @endcan
            <!-- Separator with title -->
            @canany(['user-list', 'role-list', 'permission-list', 'post-list', 'news-list', 'file-manager', 'language-list'])
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>{{__('ADMINISTRATION')}}</small>
            </li>
            @endcanany
            <!-- /END Separator -->

            @can('user-list')
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('users.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Users')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-users"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Users')}}</span>
                    </div>
                </a>
            @endcan
            @can('role-list')
                <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('roles.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Roles')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-users-cog"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Roles')}}</span>
                    </div>
                </a>
            @endcan
            @can('permission-list')
                <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('permissions.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Permissions')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-user-check"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Permissions')}}</span>
                    </div>
                </a>
            @endcan
            @can('post-list')
                <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('posts.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Posts')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="far fa-file"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Posts')}}</span>
                    </div>
                </a>
            @endcan
            @can('news-list')
                <a href="{{ route('news.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('news.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('News')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-rss"></span>
                    </span>
                        <span class="menu-collapsed">{{__('News')}}</span>
                    </div>
                </a>
            @endcan
            @can('other-list')
                <a href="{{ route('others.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('others.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Other settings')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-images"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Other settings')}}</span>
                    </div>
                </a>
            @endcan
            @can('file-manager')
                <a href="{{ route('files') }}" class="list-group-item list-group-item-action @if (request()->routeIs('files')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('File manager')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="bi bi-card-image"></span>
                    </span>
                        <span class="menu-collapsed">{{__('File manager')}}</span>
                    </div>
                </a>
            @endcan
            @can('log-list')
                <a href="{{ route('logs.index') }}" class="list-group-item list-group-item-action @if (request()->routeIs('logs.*')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Logs')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fas fa-file-medical-alt"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Logs')}}</span>
                    </div>
                </a>
            @endcan
{{--            @can('language-list')--}}
                <a href="{{ route('languages') }}" class="list-group-item list-group-item-action @if (request()->routeIs('languages')) active @endif" data-tooltip="collapsed" data-placement="right" title="{{__('Languages')}}">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="bi bi-translate"></span>
                    </span>
                        <span class="menu-collapsed">{{__('Languages')}}</span>
                    </div>
                </a>
{{--            @endcan--}}
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="{{route('posts.page', 'help')}}" class="list-group-item list-group-item-action" data-tooltip="collapsed" data-placement="right" title="{{__('Help')}}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span class="fa fa-question fa-fw"></span>
                    </span>
                    <span class="menu-collapsed">{{__('Help')}}</span>
                </div>
            </a>
            <a href="#" data-toggle="sidebar-colapse" class="list-group-item list-group-item-action d-flex d-none d-sm-block align-items-center" data-tooltip="collapsed" data-placement="right" title="{{__('Expand')}}">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="list-group-icon mr-2">
                        <span id="collapse-icon" class="fa fas fa-angle-double-left"></span>
                    </span>
                    <span id="collapse-text" class="menu-collapsed">{{__('Collapse')}}</span>
                </div>
            </a>
        </ul>
        <!-- List Group END-->
    </div>
</nav>
