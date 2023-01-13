@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $header }}</div>

                <div class="card-body">
                    @if($message != '')
                        <h5>{{ $message }}</h5>
                        <h6>{{ $message2 }}</h6>
                    @endif
                    @if($button == 'back')
                        <a href="{{ route('register') }}" class="btn btn-light float-right pt-2 mt-2">Вернутся назад</a>
                    @else
                        <a href="https://in.sklads.kg/" class="btn btn-light float-right pt-2 mt-2">Войти в личный кабинет</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
