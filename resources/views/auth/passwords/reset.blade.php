@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-block col-sm-8 col-md-6 col-lg-5 col-xl-4" style="min-width: 344px;">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <div class="input-group flex-nowrap">
                                    {{--                                <div class="input-group-prepend">--}}
                                    {{--                                    <label class="input-group-text" id="email-label" for="email"><i class="fas fa-user-tie"></i></label>--}}
                                    {{--                                </div>--}}
                                    <input type="hidden" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="{{__('E-Mail Address')}}" aria-label="{{__('E-Mail Address')}}"
                                           aria-describedby="email-label" value="{{ request()-> get('email') }}"
                                           required
                                           name="email"
                                           autocomplete="email" autofocus>
                                </div>
                                {{--                            @error('email')--}}
                                {{--                            <span class="invalid-feedback" role="alert">--}}
                                {{--                                        <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                            @enderror--}}
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label text-md-right">{{ __('Password')
                            }}:</label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm"
                                       class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
