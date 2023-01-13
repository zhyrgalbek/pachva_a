@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('permissions.show', $permission) }}

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
                            <h3 class="section-title">{{__('Permission')}}</h3>
                        </div>
                        @can('permission-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions.index', ['page'=>Session::get('page', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>{{__('Name')}}:</strong>
                        {{ $permission->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
