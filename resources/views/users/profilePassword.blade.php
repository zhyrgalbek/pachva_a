@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <strong>{{__('Opps!')}}</strong> {{__('Something went wrong, please check below errors.')}}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h3 class="section-title">{{__('Edit password')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::model($user, ['route' => 'profile.update.password', 'method'=>'PATCH']) !!}
                    <div class="form-row">
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="password">{{__('Password')}}:</label>
                            {!! Form::password('password', array('id'=>'password', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))) !!}
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <label for="password_confirmation">{{__('Confirm Password')}}:</label>
                            {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))) !!}
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
