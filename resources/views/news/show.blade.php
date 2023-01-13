@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('news.show', $article) }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="lead mb-3 text-center">
                        <img src="{{$article->photo}}" class="news-img-top" alt="...">
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col">
                            <h3 class="section-title">{{$article->title}}</h3>
                        </div>
                        @can('news-list')
                            <div class="col-auto text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('news.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                    <div class="lead mb-3 bg-light p-3">
                        <strong>{{__('Summary')}}:</strong>
                        {{ $article->summary }}
                    </div>
                    <div class="lead mb-3">
                        {!! html_entity_decode( $article->body ) !!}
                    </div>
                    <div class="lead mb-3">
                        <div class="form-row align-items-center">
                            <div class="col">
                                <div class="text-primary">{{ \App\Models\Article::getTypeOptions()[$article->type] }}</div>
                            </div>
                            <div class="col-auto">
                                @if ($article->published)
                                    <div class="text-muted" data-tooltip="tooltip" title="{{__('Published at')}}">{{date('d.m.Y', strtotime($article->published_at))}}</div>
                                @else
                                    <div class="text-muted" data-tooltip="tooltip" title="{{__('Created at')}}">{{date('d.m.Y', strtotime($article->created_at))}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
