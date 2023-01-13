@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('permissions.create') }}

        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{{__('Opps!')}}</strong> {{__('Something went wrong, please check below errors.')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title">{{__('Create permission')}}</h3>
                        </div>
                        @can('permission-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions.index') }}">{{__('Permissions')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => __('Name'), 'class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
