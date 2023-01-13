@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('news.index') }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('All news')}}</h3>
                </div>
                @can('news-create')
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('news.create') }}">{{__('Add news')}}</a>
                </div>
                @endcan
                <div class="col-md-12">
                    <ul class="nav nav-tabs news-tab" id="newsTab" role="tablist">
                        @foreach(\App\Models\Article::getTypeOptions() as $typeKey => $typeLabel)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($typeKey==$type) active @endif" id="tab{{$typeKey}}" href="{{route(request()->route()->getName(), ['type' => $typeKey])}}" aria-controls="content{{$typeKey}}" @if($typeKey==$type) aria-selected="true" @else aria-selected="false" @endif>{{$typeLabel}}</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content news-tab-content" id="newsTabContent">
                        <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="tab">
                            <div class="row news">
                                @foreach($articles as $article)
                                <div class="col-md-3">
                                    @include('layouts.article')
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pagination-content text-right mt-3">
                    {{ $articles->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
