@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('posts.show', $post) }}

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
                            <h3 class="section-title">{{__('Post')}}</h3>
                        </div>
                        @can('post-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('posts.index', ['page'=>Session::get('page', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>{{__('Title')}}:</strong>
                        {{ $post->title }}
                    </div>
                    <div class="lead">
                        <strong>{{__('Description')}}:</strong>
                        {!! html_entity_decode( $post->description ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
