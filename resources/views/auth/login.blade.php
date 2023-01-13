@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-block col-sm-8 col-md-6 col-lg-5 col-xl-4" style="min-width: 344px;">
                <div class="card">
                    <div class="card-header text-center bg-white border-b-0">
                        <h3 class="login-header">{{ __('Sign In') }}</h3>
                    </div>

                    <div class="card-body">
                        <form class="login-form" method="POST" action="{{ route('login') }}"
                              onsubmit="return validateForm()">
                            @csrf
                            @if (\Session::has('info'))
                                <div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                    {{ \Session::get('info') }}
                                </div>
                            @endif
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" id="identifier-label" for="identifier"><i
                                                        class="fas fa-user-tie"></i></label>
                                        </div>
                                        <input type="text" id="identifier"
                                               class="form-control @error('identifier') is-invalid @enderror"
                                               placeholder="{{__("INN/PIN")}}" aria-label="{{__("INN/PIN")}}"
                                               aria-describedby="email-label" value="{{ old('email') }}" required
                                               name="identifier" autocomplete="identifier" autofocus>
                                        @error('identifier')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" id="password-label" for="password"><i
                                                        class="fas fa-lock"></i></label>
                                        </div>
                                        <input type="password" id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="{{__('Password')}}" aria-label="{{__('Password')}}"
                                               aria-describedby="password-label" value="{{ old('password') }}" required
                                               name="password" autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="remember" value="1"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                               for="remember">{{ __('Remember Me') }}</label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="form-text mt-4 mb-2" href="{{ route('password.request') }}">
                                            {{ __("I don't know my password") }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            Разрешение на обработку персональных данных
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    @if($errors->has('is_captcha') or $errors->has('g-recaptcha-response'))
                                        <div id="captcha-container" class="w-100 d-flex justify-content-center {{$errors->has
                                            ('g-recaptcha-response')?'is-invalid':''}}">
                                            {!! NoCaptcha :: display (['data-callback'=>'captching']) !!}
                                        </div>

                                        @error('g-recaptcha-response')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                     @endif
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let is_captched = false;

        function captching() {
            is_captched = true;
        }

        function validateForm() {
            console.log('valid');
            $('#captcha-web-error').remove();
            {{--if (!is_captched&&$('#captcha-container').length) {--}}
            {{--    $('#captcha-container').after(`--}}
            {{--    <div id="captcha-web-error" class="w-100 text-center">--}}
            {{--        <span class="text-danger">--}}
            {{--            {{__('captcha required')}}--}}
            {{--    </span>--}}
            {{--</div>`)--}}
            {{--    return false;--}}
            {{--}--}}
        }

    </script>
    {!! NoCaptcha::renderJs() !!}
@endpush
