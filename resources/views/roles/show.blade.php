@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('roles.show', $role) }}

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
                            <h3 class="section-title">{{__('Role')}}</h3>
                        </div>
                        @can('role-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.index', ['page'=>Session::get('page', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>{{__('Name')}}:</strong>
                        {{ $role->name }}
                    </div>
                    <div class="lead">
                        <strong>{{__('Permissions')}}:</strong>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $permission)
                                <label class="badge badge-success">{{ $permission->name }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
