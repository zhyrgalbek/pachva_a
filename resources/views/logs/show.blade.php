@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('logs.show', $log) }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title">{{__('Log')}}</h3>
                        </div>
                        @can('log-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm"
                                   href="{{ route('logs.index', ['page'=>Session::get('page', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>id:</strong>
                        {{ $log->id }}
                    </div>
                    <div class="lead">
                        <strong>{{__('client_url')}}:</strong>
                        {{ $log->url }}
                    </div>
                    <div class="lead">
                        <strong>{{__('client_method')}}:</strong>
                        {{ $log->method }}
                    </div>
                    <div class="lead">
                        <strong>{{__('client_ip')}}:</strong>
                        {{ $log->ip }}
                    </div>
                    <div class="lead">
                        <strong>{{__('client_agent')}}:</strong>
                        {{ $log->agent }}
                    </div>
                    @if($log->user)
                        <div class="lead">
                            <strong>{{__('client_name')}}:</strong>
                            {{ $log->user->name }}
                        </div>
                    @endif
                    <div class="lead">
                        <strong>{{__('Form data')}}:</strong>
                        <br>
                        <div class="bg-light p-2">
                            @if($log->body)
                                @foreach($log->body as $param_key =>$param)
                                    <code>{{ $param_key .': '.$param }}</code>
                                    <br>
                                @endforeach
                            @else
                                <code>{{ __('No parameters') }}</code>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
