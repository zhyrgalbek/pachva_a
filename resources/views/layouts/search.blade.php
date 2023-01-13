{{--<div class="search-layout">--}}
{{--    <div class="row">--}}
{{--        <div class="{{(isset($topLogin) and $topLogin)?'col-md-8':'col-12' }}">--}}
{{--            {!! Form::open(array('route' => Auth::check() ? 'services.index' : ( request()->routeIs('services.contact*') ? 'services.contact.all':'services.account.all' ), 'class'=>'for-dropdown-filter','method'=>'GET', 'data-form-nullable')) !!}--}}
{{--            @if((request()->routeIs('services.account.all')||--}}
{{--                 request()->routeIs('services.contact.all'))||--}}
{{--                 request()->routeIs('services.index') &&--}}
{{--                 $service_types)--}}
{{--                @php--}}
{{--                    $typeNames = ['type','category','kind']--}}
{{--                @endphp--}}
{{--                @foreach($filteredTypesArr as $key=>$type)--}}
{{--                    <input type="hidden" class="hidden-filter-inputs" name="{{$typeNames[$key]}}" value="{{ $type }}"/>--}}
{{--                @endforeach--}}
{{--                <div class="form-row">--}}
{{--                    <div id="dropdown-filter" class="col-md-3 col-12 mb-md-0 mb-3">--}}
{{--                        <div class="navbar-expand-lg">--}}
{{--                            <ul class="navbar-nav search-block">--}}
{{--                                <li class="dropdown-toggle nav-item dropdown form-control" data-toggle="dropdown"--}}
{{--                                    aria-haspopup="true"--}}
{{--                                    aria-expanded="false">--}}
{{--                                    <span class="d-none" id="hidden-translation">{{ __('All services') }}</span>--}}
{{--                                    <span--}}
{{--                                        id="dropdown-btn-text">--}}
{{--                                        {{count($filteredTypesArr)?trans('services.'.end($filteredTypesArr)):__('All services')}}--}}
{{--                                    </span>--}}
{{--                                    @if(count($filteredTypesArr))--}}
{{--                                        <span id="filter-clear" class="ml-auto">✕</span>--}}
{{--                                    @else--}}
{{--                                        <i class="ml-auto fas fa-caret-down"></i>--}}
{{--                                    @endif--}}
{{--                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                                        @foreach($service_types as $type_key=>$categories)--}}
{{--                                            <li class="dropdown-submenu">--}}
{{--                                                <div class="d-flex dropdown-item">--}}
{{--                                                    <span class="w-100 filter-event"--}}
{{--                                                          data-values='["{{$type_key}}"]'>{{trans('services.'.$type_key)}}</span>--}}
{{--                                                    <div class="right-carets d-flex align-items-center">--}}
{{--                                                        <span class="badge badge-primary">--}}
{{--                                                            {{ $service_types[$type_key]['count_services'] }}--}}
{{--                                                        </span>--}}
{{--                                                        <span class="ml-2 right-caret-size">--}}
{{--                                                            <i class="fas fa-caret-right"></i>--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <ul class="dropdown-menu">--}}
{{--                                                    @foreach($categories as $category_key=>$kinds)--}}
{{--                                                        @if($category_key=='count_services')--}}
{{--                                                            @continue--}}
{{--                                                        @endif--}}
{{--                                                        <li class="dropdown-submenu">--}}
{{--                                                            <div class="d-flex dropdown-item">--}}
{{--                                                                <span class="w-100  filter-event"--}}
{{--                                                                      data-values='["{{$type_key}}","{{$category_key}}"]'>{{ trans('services.'.$category_key) }}</span>--}}
{{--                                                                <div class="right-carets d-flex align-items-center">--}}
{{--                                                                    <span class="badge badge-primary">--}}
{{--                                                                        {{ $categories[$category_key]['count_services'] }}--}}
{{--                                                                    </span>--}}
{{--                                                                    <span class="ml-2 right-caret-size">--}}
{{--                                                                        <i class="fas fa-caret-right"></i>--}}
{{--                                                                    </span>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <ul class="dropdown-menu">--}}
{{--                                                                @foreach($kinds as $kind_key=>$kind)--}}
{{--                                                                    @if($kind_key=='count_services')--}}
{{--                                                                        @continue--}}
{{--                                                                    @endif--}}
{{--                                                                    <li>--}}
{{--                                                                        <div class="d-flex dropdown-item">--}}
{{--                                                                              <span class="w-100 filter-event"--}}
{{--                                                                                    data-values='["{{$type_key}}","{{$category_key}}","{{ $kind_key }}"]'>--}}
{{--                                                                                  {{ trans('services.'.$kind_key) }}--}}
{{--                                                                              </span>--}}
{{--                                                                            <span class="badge badge-primary">--}}
{{--                                                                                {{ $kinds[$kind_key]['count_services'] }}--}}
{{--                                                                            </span>--}}
{{--                                                                        </div>--}}
{{--                                                                    </li>--}}
{{--                                                                @endforeach--}}
{{--                                                            </ul>--}}
{{--                                                        </li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-8 col">--}}
{{--                        <div class="input-group mb-3 search-block">--}}
{{--                            @if (isset($search))--}}
{{--                                {!! Form::text('search', $search, array('data-param'=> 'search', 'placeholder' => __('Enter the name of the service or financial company'), 'aria-label'=>__('Enter the name of the service or financial company'), 'class' => 'form-control', 'aria-describedby'=>'button-addon2', 'style'=>'z-index:3;')) !!}--}}
{{--                            @else--}}
{{--                                {!! Form::text(null, null, array('data-param'=> 'search', 'placeholder' => __('Enter the name of the service or financial company'), 'aria-label'=>__('Enter the name of the service or financial company'), 'class' => 'form-control', 'aria-describedby'=>'button-addon2')) !!}--}}
{{--                            @endif--}}
{{--                            <div class="input-group-append">--}}
{{--                                <span class="search-clear">✕</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1 col-auto">--}}
{{--                        <button class="btn btn-primary btn-lg" type="submit" onclick="startPreloader()"--}}
{{--                                id="button-addon2"><i--}}
{{--                                class="fa fa-search"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <div class="input-group mb-3 search-block">--}}
{{--                    @if (isset($search))--}}
{{--                        {!! Form::text('search', $search, array('data-param'=> 'search', 'placeholder' => __('Enter the name of the service or financial company'), 'aria-label'=>__('Enter the name of the service or financial company'), 'class' => 'form-control', 'aria-describedby'=>'button-addon2', 'style'=>'z-index:3;')) !!}--}}
{{--                    @else--}}
{{--                        {!! Form::text(null, null, array('data-param'=> 'search', 'placeholder' => __('Enter the name of the service or financial company'), 'aria-label'=>__('Enter the name of the service or financial company'), 'class' => 'form-control', 'aria-describedby'=>'button-addon2')) !!}--}}
{{--                    @endif--}}
{{--                    <div class="input-group-append">--}}
{{--                        <span class="search-clear">✕</span>--}}
{{--                    </div>--}}
{{--                    <button class="btn btn-primary btn-lg" type="submit" onclick="startPreloader()" id="button-addon2"><i--}}
{{--                            class="fa fa-search"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            {!! Form::close() !!}--}}

{{--            @guest--}}
{{--                @if (isset($topBanner) and $topBanner)--}}
{{--                    @php($topBanners = App\Models\Other::where(['type'=>1, 'published'=>1])->orderBy('id','ASC')->paginate(10))--}}
{{--                    <div id="carouselMini" class="carousel slide carousel-light" data-ride="carousel">--}}
{{--                        <ol class="carousel-indicators">--}}
{{--                            @foreach($topBanners as $i => $banner)--}}
{{--                                <li data-target="#carouselMini" data-slide-to="{{$i}}"--}}
{{--                                    @if($i == 0) class="active" @endif></li>--}}
{{--                            @endforeach--}}
{{--                        </ol>--}}
{{--                        <div class="carousel-inner">--}}
{{--                            @foreach($topBanners as $i => $banner)--}}
{{--                                <div class="carousel-item @if ($i == 0) active @endif">--}}
{{--                                    <table class="carousel-item-table">--}}
{{--                                        <tr>--}}
{{--                                            <td class="carousel-item-left">--}}
{{--                                                <h1 class="carousel-logo d-block"><img--}}
{{--                                                        src="{{$banner->image}}"/></h1>--}}
{{--                                            </td>--}}
{{--                                            <td class="carousel-item-right">--}}
{{--                                                <div class="carousel-caption">--}}
{{--                                                    <h5 class="text-primary">{{Lang::has('other.title-'.$banner->id) ? trans('other.title-'.$banner->id) : $banner->title}}</h5>--}}
{{--                                                    <p class="text-secondary">{{Lang::has('other.description-'.$banner->id) ? trans('other.description-'.$banner->id) : $banner->description}}</p>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <a class="carousel-control-prev" href="#carouselMini" role="button" data-slide="prev">--}}
{{--                            <span class="fa fa-chevron-left" aria-hidden="true"></span>--}}
{{--                            <span class="sr-only">{{__('Previous')}}</span>--}}
{{--                        </a>--}}
{{--                        <a class="carousel-control-next" href="#carouselMini" role="button" data-slide="next"--}}
{{--                           style="left: {{count($topBanners)*15+40}}px;">--}}
{{--                            <span class="fa fa-chevron-right" aria-hidden="true"></span>--}}
{{--                            <span class="sr-only">{{__('Next')}}</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endguest--}}
{{--        </div>--}}
{{--        @guest--}}
{{--            @if (isset($topLogin) and $topLogin)--}}
{{--                <div class="col-md-4 login-block">--}}
{{--                    <h2 class="login-title">--}}
{{--                        {{__('Login to FinMarket')}}--}}
{{--                    </h2>--}}
{{--                    <div class="login-description">--}}
{{--                        {{__('Login or register and manage your finances online')}}--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-4 pr-2">--}}
{{--                            <a class="btn btn-primary btn-lg btn-block"--}}
{{--                               href="{{ route('login') }}">{{__('Sign in')}}</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-8 pl-2">--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <a class="btn btn-dark btn-lg btn-block"--}}
{{--                                   href="{{ route('register', [request()->routeIs('services.account') ? 'entity' : null]) }}">{{__('Register now')}}</a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="register-description-title"><a href="#">{{__('How to register?')}}</a></div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endguest--}}
{{--    </div>--}}
{{--</div>--}}
