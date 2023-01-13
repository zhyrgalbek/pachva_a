@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('others.index') }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('Other settings')}}</h3>
                </div>
                @can('other-create')
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('others.create') }}">{{__('Add')}}</a>
                </div>
                @endcan
                <div class="col-md-12">
                    <ul class="nav nav-tabs news-tab" id="newsTab" role="tablist">
                        @foreach(\App\Models\Other::getTypeOptions() as $typeKey => $typeLabel)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link @if($typeKey==$type) active @endif" id="tab{{$typeKey}}" href="{{route(request()->route()->getName(), ['type' => $typeKey])}}" aria-controls="content{{$typeKey}}" @if($typeKey==$type) aria-selected="true" @else aria-selected="false" @endif>{{$typeLabel}}</a>
                        </li>
                        @endforeach
                    </ul>

                    <div class="tab-content news-tab-content" id="newsTabContent">
                        <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="tab">
                            <div class="row news">
                                @foreach($others as $other)
                                <div class="col-md-3">
                                    <div class="card {{$other->published ? 'published' : 'not-published'}}">
                                        <img src="{{$other->image}}" class="card-img-top other-image" alt="...">
                                        <div class="card-body">
                                            @if($other->title)
                                            <h5 class="card-title">{{Lang::has('other.title-'.$other->id) ? trans('other.title-'.$other->id) : $other->title}}</h5>
                                            @endif
                                            @if($other->description)
                                            <p class="card-text">{{Lang::has('other.description-'.$other->id) ? trans('other.description-'.$other->id) : $other->description}}</p>
                                            @endif
                                            @if($other->link)
                                            <a href="{{$other->link}}" class="btn btn-link mb-3" target="_blank">{{$other->link}}</a>
                                            @endif
                                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                @if ($other->published)
                                                    <span class="text-sm text-success font-weight-bold">{{__('Published')}}</span>
                                                @else
                                                    <span class="text-sm text-danger font-weight-bold">{{__('Not published')}}</span>
                                                @endif
                                                <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                                                    <a href="{{route('others.show', $other->id)}}" class="btn btn-success" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                                                    @can('other-edit')
                                                        <a href="{{route('others.edit', $other->id)}}" class="btn btn-primary" data-tooltip="tooltip" title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                                    @endcan
                                                    @can('other-delete')
                                                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#other-delete-".$other->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]) !!}
                                                    @endcan
                                                </div>
                                            </div>
                                            @can('other-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['others.destroy', $other->id], 'class'=>'d-none', 'id'=>'other-delete-'.$other->id]) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="pagination-content text-right mt-3">
                    {{ $others->appends($_GET)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
