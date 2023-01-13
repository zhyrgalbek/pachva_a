@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-block col-sm-8 col-md-8 col-lg-6 col-xl-6" style="min-width: 375px;">
                <div class="card">
                    <div class="card-header text-center bg-white border-b-0">
                        <h3 class="login-header">{{ __('Register') }}</h3>
{{--                        <h5 class="login-subject">{{ __('to FinMarket portal') }}</h5>--}}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
                            @csrf
                            <fieldset class="border p-2">
                                <legend class="w-auto">{{__('User type')}}</legend>
                                <div class="input-group">
                                    {!! Form::select('user_type', array('1' => __('Individual'), '2' => __('Stock')), old('user_type') ?: (in_array('entity', array_keys($_GET)) ? 2 : 1), array('id'=>'user_type', 'required', 'class' => 'form-control'.($errors->has('user_type')?' is-invalid':''), 'data-switcher')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" id="user_type-label" for="user_type"><i
                                                    class="fas fa-user-tag"></i></label>
                                    </div>
                                    @error('user_type')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </fieldset>
                            <fieldset class="border p-2" data-user_type="1">
                                <legend class="w-auto">{{__('User information')}}</legend>
                                <div class="form-row">
                                    <div class="col-12 mb-3">
                                        {!! Form::text('last_name', old('last_name'), array('id'=>'last_name2', 'required', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))) !!}
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::text('name', old('name'), array('id'=>'name2', 'required', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))) !!}
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::text('middle_name', old('middle_name'), array('id'=>'middle_name2', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))) !!}
                                        @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::text('identifier', old('identifier'), array('id'=>'identifier2', 'required', 'maxlength' => 14, 'placeholder' => __('PIN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))) !!}
                                        @error('identifier')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <small id="pinHelp" class="form-text text-muted text-right">{{__('PIN will be your login')}}</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::text('organization_name', old('organization_name'), array('id'=>'organization_name', 'placeholder'=>__('Organization name'), 'class' => 'form-control'.($errors->has('organization_name')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            </div>
                                            @error('organization_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::text('phone', old('phone'), array('id'=>'phone22', 'required', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" id="phone22-label" for="phone22"><i class="fas fa-phone"></i></label>
                                            </div>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::password('password', array('value'=> old('password'), 'id'=>'password2', 'required', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" id="password2-label" for="password2"><i class="fas fa-lock"></i></label>
                                            </div>
                                            @error('password')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::password('password_confirmation', array('value'=> old('password_confirmation'), 'id'=>'password_confirmation2', 'required', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" id="password_confirmation2-label"
                                                       for="password_confirmation2"><i
                                                            class="fas fa-unlock"></i></label>
                                            </div>
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            <div id="captcha-container" class="w-100 d-flex justify-content-center
                                            {{$errors->has('g-recaptcha-response')?'is-invalid':''}}">
                                                {!! NoCaptcha::display(['data-callback'=>'captching']) !!}
                                            </div>
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="border p-2" data-user_type="2">
                                <legend class="w-auto">{{__('User information')}}</legend>
                                <div class="form-row">
                                    <div class="col-12 mb-3">
                                        {!! Form::text('last_name', old('last_name'), array('id'=>'last_name2', 'required', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))) !!}
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::text('name', old('name'), array('id'=>'name2', 'required', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))) !!}
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::text('middle_name', old('middle_name'), array('id'=>'middle_name2', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))) !!}
                                        @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        {!! Form::text('identifier', old('identifier'), array('id'=>'identifier2', 'required', 'placeholder' => __('PIN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))) !!}
                                        @error('identifier')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <small id="pinHelp" class="form-text text-muted text-right">{{__('PIN will be your login')}}</small>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::text('organization_name', old('organization_name'), array('id'=>'organization_name', 'placeholder'=>__('Organization name'), 'class' => 'form-control'.($errors->has('organization_name')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                                            </div>
                                            @error('organization_name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::text('phone', old('phone'), array('id'=>'phone22', 'required', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" id="phone22-label" for="phone22"><i class="fas fa-phone"></i></label>
                                            </div>
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::password('password', array('value'=> old('password'), 'id'=>'password2', 'required', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" id="password2-label" for="password2"><i class="fas fa-lock"></i></label>
                                            </div>
                                            @error('password')
                                            <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            {!! Form::password('password_confirmation', array('value'=> old('password_confirmation'), 'id'=>'password_confirmation2', 'required', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" id="password_confirmation2-label"
                                                       for="password_confirmation2"><i
                                                            class="fas fa-unlock"></i></label>
                                            </div>
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="input-group">
                                            <div id="captcha-container" class="w-100 d-flex justify-content-center
                                            {{$errors->has('g-recaptcha-response')?'is-invalid':''}}">
                                                {!! NoCaptcha::display(['data-callback'=>'captching']) !!}
                                            </div>
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
{{--                            <fieldset class="border p-2" data-user_type="2">--}}
{{--                                <legend class="w-auto">{{__('Organization')}}</legend>--}}
{{--                                <div class="form-row">--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::text('organization_name', old('organization_name'), array('id'=>'organization_name', 'required', 'placeholder'=>__('Organization name'), 'class' => 'form-control'.($errors->has('organization_name')?' is-invalid':''))) !!}--}}
{{--                                            <div class="input-group-append">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-building"></i></span>--}}
{{--                                            </div>--}}
{{--                                            @error('organization_name')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        {!! Form::text('identifier', old('identifier'), array('id'=>'identifier', 'required', 'placeholder' => __('INN'),'class' => 'form-control'.($errors->has('identifier')?' is-invalid':''))) !!}--}}
{{--                                        @error('identifier')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                        <small id="innHelp"--}}
{{--                                               class="form-text text-muted text-right">{{__('INN will be your login')}}</small>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::text('phone2', old('phone2'), array('id'=>'phone2', 'required', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) !!}--}}
{{--                                            <div class="input-group-append">--}}
{{--                                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>--}}
{{--                                            </div>--}}
{{--                                            @error('phone2')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        {!! Form::textarea('address', old('address'), array('id'=>'address', 'required', 'placeholder' => __('Legal address'),'class' => 'form-control'.($errors->has('address')?' is-invalid':''), 'rows'=>3)) !!}--}}
{{--                                        @error('address')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </fieldset>--}}
{{--                            <fieldset class="border p-2" data-user_type="2">--}}
{{--                                <legend class="w-auto">{{__('Head of the organization')}}</legend>--}}
{{--                                <div class="form-row">--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        {!! Form::text('last_name', old('last_name'), array('id'=>'last_name', 'required', 'placeholder' => __('Surname'),'class' => 'form-control'.($errors->has('last_name')?' is-invalid':''))) !!}--}}
{{--                                        @error('last_name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        {!! Form::text('name', old('name'), array('id'=>'name', 'required', 'placeholder' => __('Name'),'class' => 'form-control'.($errors->has('name')?' is-invalid':''))) !!}--}}
{{--                                        @error('name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12 mb-3">--}}
{{--                                        {!! Form::text('middle_name', old('middle_name'), array('id'=>'middle_name', 'placeholder' => __('Middle name'),'class' => 'form-control'.($errors->has('middle_name')?' is-invalid':''))) !!}--}}
{{--                                        @error('middle_name')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::email('email', old('email'), array('id'=>'email', 'required', 'placeholder' => __('E-Mail Address'),'class' => 'form-control'.($errors->has('email')?' is-invalid':''))) !!}--}}
{{--                                            <div class="input-group-append">--}}
{{--                                                <label class="input-group-text" id="email-label" for="email"><i--}}
{{--                                                            class="fas fa-envelope"></i></label>--}}
{{--                                            </div>--}}
{{--                                            @error('email')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::text('phone', old('phone'), array('id'=>'phone', 'required', 'placeholder' => __('Phone'),'class' => 'form-control'.($errors->has('phone')?' is-invalid':''))) !!}--}}
{{--                                            <div class="input-group-append">--}}
{{--                                                <label class="input-group-text" id="phone-label" for="phone"><i--}}
{{--                                                            class="fas fa-phone"></i></label>--}}
{{--                                            </div>--}}
{{--                                            @error('phone')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::password('password', array('id'=>'password', 'required', 'placeholder' => __('Password'),'class' => 'form-control'.($errors->has('password')?' is-invalid':''), 'autocomplete'=>'new-password')) !!}--}}
{{--                                            <div class="input-group-append">--}}
{{--                                                <label class="input-group-text" id="password-label" for="password"><i--}}
{{--                                                            class="fas fa-lock"></i></label>--}}
{{--                                            </div>--}}
{{--                                            @error('password')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            {!! Form::password('password_confirmation', array('id'=>'password_confirmation', 'required', 'placeholder' => __('Confirm Password'),'class' => 'form-control'.($errors->has('password_confirmation')?' is-invalid':''), 'autocomplete'=>'new-password')) !!}--}}
{{--                                            <div class="input-group-append">--}}
{{--                                                <label class="input-group-text" id="password_confirmation-label"--}}
{{--                                                       for="password_confirmation"><i class="fas fa-unlock"></i></label>--}}
{{--                                            </div>--}}
{{--                                            @error('password_confirmation')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                    <strong>{{ $message }}</strong>--}}
{{--                                                </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-12 mb-3">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <div id="captcha-container" class="w-100 d-flex justify-content-center {{$errors->has--}}
{{--                                            ('g-recaptcha-response')?'is-invalid':''}}">--}}
{{--                                                {!! NoCaptcha :: display (['data-callback'=>'captching']) !!}--}}
{{--                                            </div>--}}

{{--                                            @error('g-recaptcha-response')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                    <strong>{{ $message }}</strong>--}}
{{--                                                </span>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </fieldset>--}}
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <a class="form-text mb-3 mt-n2" href="https://in.sklads.kg/">
                                        {{ __('I am already registered') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Register') }}
                                    </button>
                                </div>
{{--                                <div class="col-md-12 mt-2 d-none">--}}
{{--                                    <a--}}
{{--                                            href="{{ route('register.with.esi') }}"--}}
{{--                                            class="btn btn-primary btn-block">--}}
{{--                                        {{ __('Register with ESI') }}--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@push('page-scripts')--}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"--}}
{{--            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
{{--    <script>--}}
{{--        let is_captched = false;--}}

{{--        function captching() {--}}
{{--            is_captched = true;--}}
{{--        }--}}

{{--        function validateForm() {--}}
{{--            $('#captcha-web-error').remove();--}}
{{--            if (!is_captched) {--}}
{{--                $('#captcha-container').after(`--}}
{{--                <div id="captcha-web-error" class="w-100 text-center">--}}
{{--                    <span class="text-danger">--}}
{{--                        {{__('captcha required')}}--}}
{{--                </span>--}}
{{--            </div>`)--}}
{{--                return false;--}}
{{--            }--}}
{{--        }--}}

{{--    </script>--}}
{{--    {!! NoCaptcha::renderJs() !!}--}}
{{--@endpush--}}
