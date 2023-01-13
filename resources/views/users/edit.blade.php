@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('users.edit', $user) }}

        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <strong>{{__('Opps!')}}</strong> {{__('Something went wrong, please check below errors.')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title">{{__('Edit user')}}</h3>
                        </div>
                        @can('user-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('users.index', ['page'=>Session::get('page', 1)]) }}">{{__('Users')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method'=>'PATCH']) !!}
                    <fieldset class="border p-2">
                        <legend  class="w-auto">{{__('User type')}}</legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                {!! Form::select('user_type', array('1' => __('Individual'), '2' => __('Legal entity')), null, array('id'=>'user_type','class' => 'form-control mt-2'.($errors->has('user_type')?' is-invalid':''), 'data-switcher')) !!}
                                @error('user_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2" data-user_type="1">
                        <legend  class="w-auto">{{__('User information')}}</legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="last_name2">{{__('Surname')}}:</label>
                                {!! Form::text('last_name', null, array('id'=>'last_name2', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))) !!}
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="name2">{{__('Name')}}:</label>
                                {!! Form::text('name', null, array('id'=>'name2', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))) !!}
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="middle_name2">{{__('Middle name')}}:</label>
                                {!! Form::text('middle_name', null, array('id'=>'middle_name2', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))) !!}
                                @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="phone22">{{__('Phone')}}:</label>
                                {!! Form::text('phone', null, array('id'=>'phone22', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) !!}
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="email2">{{__('Email')}}:</label>
                                {!! Form::text('email', null, array('id'=>'email2', 'placeholder' => __('Email'),'class' => 'form-control'.($errors->has('email')?' is-invalid':''))) !!}
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="identifier2">{{__('PIN')}}:</label>
                                {!! Form::text('identifier', null, array('id'=>'identifier2', 'placeholder' => __('PIN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))) !!}
                                @error('identifier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="password2">{{__('Password')}}:</label>
                                {!! Form::password('password', array('id'=>'password2', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))) !!}
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="password_confirmation2">{{__('Confirm Password')}}:</label>
                                {!! Form::password('password_confirmation', array('id'=>'password_confirmation2', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))) !!}
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="roles2">{{__('Role')}}:</label>
                                {!! Form::select('roles[]', $roles, $userRole, array('id'=>'roles2', 'class' => 'form-control'.($errors->has('role')?' is-invalid':''),'multiple')) !!}
                                @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2" data-user_type="2">
                        <legend  class="w-auto">{{__('Organization')}}</legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="organization_name">{{__('Organization name')}}:</label>
                                {!! Form::text('organization_name', null, array('id'=>'organization_name', 'placeholder'=>__('Organization name'), 'class' => 'form-control'.($errors->has('organization_name')?' is-invalid':''))) !!}
                                @error('organization_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="identifier">{{__('INN')}}:</label>
                                {!! Form::text('identifier', null, array('id'=>'identifier', 'placeholder' => __('INN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))) !!}
                                @error('identifier')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="phone">{{__('Phone')}}:</label>
                                {!! Form::text('phone2', null, array('id'=>'phone2', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone2')?' is-invalid':''))) !!}
                                @error('phone2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="address">{{__('Legal address')}}:</label>
                                {!! Form::textarea('address', null, array('id'=>'address', 'placeholder' => __('Legal address'),'class' => 'form-control'.($errors->has('address')?' is-invalid':''), 'rows'=>3)) !!}
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2" data-user_type="2">
                        <legend  class="w-auto">{{__('Head of the organization')}}</legend>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="last_name">{{__('Surname')}}:</label>
                                {!! Form::text('last_name', null, array('id'=>'last_name', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))) !!}
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="name">{{__('Name')}}:</label>
                                {!! Form::text('name', null, array('id'=>'name', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))) !!}
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="middle_name">{{__('Middle name')}}:</label>
                                {!! Form::text('middle_name', null, array('id'=>'middle_name', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))) !!}
                                @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 col-lg-8">
                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="phone">{{__('Phone')}}:</label>
                                        {!! Form::text('phone', null, array('id'=>'phone', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) !!}
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="email">{{__('Email')}}:</label>
                                        {!! Form::text('email', null, array('id'=>'email', 'placeholder' => __('Email'),'class' => 'form-control'.($errors->has('email')?' is-invalid':''))) !!}
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="password">{{__('Password')}}:</label>
                                        {!! Form::password('password', array('id'=>'password', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))) !!}
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="password_confirmation">{{__('Confirm Password')}}:</label>
                                        {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))) !!}
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4">
                                <div class="form-row">
                                    <div class="col-md-12 col-lg-12 mb-3">
                                        <label for="role">{{__('Role')}}:</label>
                                        {!! Form::select('roles[]', $roles, $userRole, array('id'=>'role', 'class' => 'form-control'.($errors->has('role')?' is-invalid':''),'multiple', 'size'=>5)) !!}
                                        @error('roles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
