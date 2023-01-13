@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('posts.edit', $post) }}

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
                            <h3 class="section-title">{{__('Edit post')}}</h3>
                        </div>
                        @can('post-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('posts.index', ['page'=>Session::get('page', 1)]) }}">{{__('Posts')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method'=>'PATCH']) !!}
                    <div class="form-group">
                        <strong>{{__('Title')}}:</strong>
                        {!! Form::text('title', null, array('placeholder' => __('Title'),'class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>{{__('Description')}}:</strong>
                        {!! Form::textarea('description', null, array('id' => 'editor', 'placeholder' => __('Description'), 'class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
