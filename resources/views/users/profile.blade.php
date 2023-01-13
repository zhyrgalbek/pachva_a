@extends('layouts.app')
@section('content')
    <div class="container">
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
                            <h3 class="section-title">{{__('Profile')}}</h3>
                        </div>
                        @can('profile-edit')
                        <div class="col-6 text-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('profile.edit') }}">{{__('Edit')}}</a>
                        </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($user, ['route' => 'profile.update']) !!}
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto">{{__('User type')}}</legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    {!! Form::select('user_type', array('1' => __('Individual'), '2' => __('Legal entity')), null, array('id'=>'user_type','class' => 'form-control mt-2')) !!}
                                </div>
                            </div>
                        </fieldset>
                        @if ($user->user_type == 2)
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto">{{__('Organization')}}</legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="organization_name">{{__('Organization name')}}:</label>
                                    {!! Form::text('organization_name', null, array('id'=>'organization_name', 'class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="identifier">{{__('INN')}}:</label>
                                    {!! Form::text('identifier', null, array('id'=>'identifier','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="phone2">{{__('Phone')}}:</label>
                                    {!! Form::text('phone2', null, array('id'=>'phone2','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="address">{{__('Legal address')}}:</label>
                                    {!! Form::textarea('address', null, array('id'=>'address','class' => 'form-control', 'rows'=>3)) !!}
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto">{{__('Head of the organization')}}</legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="last_name">{{__('Surname')}}:</label>
                                    {!! Form::text('last_name', null, array('id'=>'last_name','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="name">{{__('Name')}}:</label>
                                    {!! Form::text('name', null, array('id'=>'name','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="middle_name">{{__('Middle name')}}:</label>
                                    {!! Form::text('middle_name', null, array('id'=>'middle_name','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="phone">{{__('Phone')}}:</label>
                                    {!! Form::text('phone', null, array('id'=>'phone','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="email">{{__('Email')}}:</label>
                                    {!! Form::text('email', null, array('id'=>'email','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="password">{{__('Password')}}:</label>
                                    {!! Form::password('password', array('id'=>'password', 'placeholder' => '******','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="role">{{__('Role')}}:</label>
                                    <div class="form-control-plaintext">
                                    @foreach($userRole as $r)
                                        <label class="badge badge-success">{{__($r)}}</label>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        @else
                        <fieldset class="border p-2" disabled>
                            <legend  class="w-auto">{{__('User information')}}</legend>
                            <div class="form-row">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="last_name">{{__('Surname')}}:</label>
                                    {!! Form::text('last_name', null, array('id'=>'last_name','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="name">{{__('Name')}}:</label>
                                    {!! Form::text('name', null, array('id'=>'name','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="middle_name">{{__('Middle name')}}:</label>
                                    {!! Form::text('middle_name', null, array('id'=>'middle_name','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="phone">{{__('Phone')}}:</label>
                                    {!! Form::text('phone', null, array('id'=>'phone','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="email">{{__('Email')}}:</label>
                                    {!! Form::text('email', null, array('id'=>'email','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="identifier">{{__('PIN')}}:</label>
                                    {!! Form::text('identifier', null, array('id'=>'identifier','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="password">{{__('Password')}}:</label>
                                    {!! Form::password('password', array('id'=>'password', 'placeholder' => '******','class' => 'form-control')) !!}
                                </div>
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label for="role">{{__('Role')}}:</label>
                                    <div class="form-control-plaintext">
                                        @foreach($userRole as $r)
                                            <label class="badge badge-success">{{__($r)}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
