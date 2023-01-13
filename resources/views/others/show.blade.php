@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('others.show', $other) }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="lead mb-3 text-center">
                        <img src="{{$other->image}}" class="other-image" alt="...">
                    </div>
                    <div class="form-row align-items-center mb-2">
                        <div class="col">
                            <h3 class="section-title">{{$other->title}}</h3>
                        </div>
                        @can('other-list')
                            <div class="col-auto text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('others.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                    @if ($other->description)
                    <div class="lead mb-3 bg-light p-3">
                        <strong>{{__('Description')}}:</strong>
                        {{ $other->description }}
                    </div>
                    @endif
                    @if ($other->link)
                        <div class="lead mb-3 bg-light p-3">
                            <strong>{{__('Link')}}:</strong>
                            <a href="{{$other->link}}">{{ $other->link }}</a>
                        </div>
                    @endif
                    <div class="lead mb-3">
                        <div class="form-row align-items-center">
                            <div class="col">
                                <div class="text-primary">{{ \App\Models\Other::getTypeOptions()[$other->type] }}</div>
                            </div>
                            <div class="col-auto">
                                @if ($other->published)
                                    <div class="text-muted" data-tooltip="tooltip" title="{{__('Published at')}}">{{date('d.m.Y', strtotime($other->published_at))}}</div>
                                @else
                                    <div class="text-muted" data-tooltip="tooltip" title="{{__('Created at')}}">{{date('d.m.Y', strtotime($other->created_at))}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
