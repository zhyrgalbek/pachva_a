@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('layouts.search')
    <div class="row">
        <div class="col-md-12">
            <h3 class="section-title">{{__('Popular services on the portal')}}</h3>
            <div class="row align-items-center">
                <div class="col-md">
                    <div class="service-list row">
                        @foreach($services as $service)
                            <div class="col-md-6 col-xl-3">
                                @include('layouts.serviceCard')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-auto">
                    <a class="btn btn-light service-all float-right mb-3" href="{{ route('services.index') }}">{{__('All services')}} <i class="fas fa-archive"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3 class="section-title">{{__('Long-term credits')}}</h3>
            <div class="shadow p-3 mb-5 bg-white rounded-lg">
                <p class="text-dark font-weight-bold text-lg">{{__('10 - Service Providers')}}</p>
                <div class="form-row align-items-center">
                    <div class="col" style="max-width: calc(100% - 56px)">
                        <ul class="nav nav-underlined mb-3" id="providers-tab" role="tablist">
                            @foreach($providers as $i => $provider)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if ($i == 0) active @endif" id="provider-{{$provider->id}}-tab" data-toggle="pill" href="#provider-{{$provider->id}}" role="tab" aria-controls="provider-{{$provider->id}}" @if ($i == 0) aria-selected="true" @else aria-selected="false" @endif>{{$provider->name}}</a>
                                </li>
                            @endforeach
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
                    @foreach($providers as $i => $provider)
                    <div class="tab-pane fade @if ($i == 0) show active @endif" id="provider-{{$provider->id}}" role="tabpanel" aria-labelledby="provider-{{$provider->id}}-tab">
                        <div class="row">
                            <div class="col-12 mb-3">
                            {!! $provider->description !!}
                            </div>
                            <div class="col-12">
                            <button class="btn btn-primary float-right"><i class="fas fa-plus"></i> {{__('Submit a new application')}}</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <h3 class="section-title">{{__('My applications')}}</h3>
            <div class="table-content shadow p-3 mb-5 bg-white rounded-lg">
                <p class="text-lg text-muted">{{__('The results of applications come within 24 hours')}}</p>
                @include('applications.table')
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="section-title">{{__('Exchange Rates')}}</h3>
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
                <iframe loading="lazy" id="exchange" width="100%" height="1057" src="https://www.tazabek.kg/valuta/exchange/?embed=1&date={{date('Y-m-d H:i')}}" frameborder="0" allowfullscreen></iframe>
                <div class="position-absolute rounded-lg" style="background-color: #fff;height: 70px;bottom: 0;left: 0;right: 0;z-index: 1;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
