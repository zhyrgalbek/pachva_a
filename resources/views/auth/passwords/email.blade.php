@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="login-block col-sm-8 col-md-6 col-lg-5 col-xl-4" style="min-width: 344px;">
            <div class="card">
                <div class="card-header text-center bg-white border-b-0">
                    <h3 class="login-header">{{ __('Reset Password') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row mb-4">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" id="email-label" for="email"><i class="fas fa-at"></i></label>
                                    </div>
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('E-Mail Address')}}" aria-label="{{__('E-Mail Address')}}" aria-describedby="email-label" value="{{ old('email') }}" required name="email" autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <a class="form-text mt-3" href="{{ route('login') }}">
                                    {{ __('I know my password') }}
                                </a>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <p class="text-secondary">
                                    {{__('If you don\'t have email, please contact support')}}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
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
