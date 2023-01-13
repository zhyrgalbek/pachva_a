@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('posts.index') }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('Posts')}}</h3>
                </div>
                @can('post-create')
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('posts.create') }}">{{__('New post')}}</a>
                </div>
                @endcan
                <div class="col-md-12">
                    <div class="table-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 60px;">{{__('#')}}</th>
                                <th>{{__('Title')}}</th>
                                <th>{{__('Description')}}</th>
                                <th style="width: 110px;">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td><a href="{{ route('posts.page', $post->title) }}">{{ $post->title }}</a></td>
                                    <td><div class="td-html">{!! html_entity_decode( Lang::has('post.'.$post->title) ? trans('post.'.$post->title) : $post->description ) !!}</div></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                                            <a class="btn btn-success" href="{{ route('posts.show',$post->id) }}" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                                            @can('post-edit')
                                                <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}" data-tooltip="tooltip" title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('post-delete')
                                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#post-delete-".$post->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]) !!}
                                            @endcan
                                        </div>
                                        @can('post-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'class'=>'d-none', 'id'=>'post-delete-'.$post->id]) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-content text-right mt-3">
                    {{ $data->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
