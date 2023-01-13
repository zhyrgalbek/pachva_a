@extends('layouts.app')
@section('content')

    <div class="container">
        {{ Breadcrumbs::render('services.detail', $service) }}
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                <strong>{{__('Opps!')}}</strong> {{__('Something went wrong, please check below errors.')}}
            </div>
        @endif
        <div class="row">
            <div class="col-2 col-md-1">
                <div class="detail-logo"><i class="{{$service->icon}}"></i></div>
            </div>
            <div class="col-10 col-md-9">
                <h3 class="detail-title py-2">{{$service->name}}</h3>
                <p class="detail-description py-4">{!! $service->description !!}</p>
            </div>
            <div class="col-md-2 pb-3">
                @switch ($utype)
                    @case('j')
                    <a class="btn btn-light service-all float-right"
                       href="{{ route('services.account.all', ['search'=>Session::get('search', null), 'page'=>Session::get('page', 1)]) }}">{{__('All services')}}
                        <i class="fas fa-archive"></i></a>
                    @break
                    @case('i')
                    <a class="btn btn-light service-all float-right"
                       href="{{ route('services.contact.all', ['search'=>Session::get('search', null), 'page'=>Session::get('page', 1)]) }}">{{__('All services')}}
                        <i class="fas fa-archive"></i></a>
                    @break
                    @default
                    <a class="btn btn-light service-all float-right"
                       href="{{ route('services.index', ['search'=>Session::get('search', null), 'page'=>Session::get('page', 1)]) }}">{{__('All services')}}
                        <i class="fas fa-archive"></i></a>
                    @break
                @endswitch
            </div>
            <div class="col-md-12">
                <div class="detail-filter">
                    {{ Form::open(array('url' => 'services/detail/'.$service->id.'#more', 'method'=>'get', 'id'=>'detail-filter', 'novalidate', 'class'=>'needs-validation', 'data-form-nullable')) }}
                    {{ Form::hidden('page', $service->pagination->page) }}
                    {{ Form::hidden('per_page', $service->pagination->per_page) }}
                    <div class="row">
                        @foreach($service->filters as $fkey => $filter)
                            @foreach($service->fields as $field)
                                @if ($field->name == $fkey)
                                    @if ($field->name == 'date_start')
                    </div>
                    <div class="row">
                        @endif
                        <div class="col-md-4 mb-3">
                            @section('name')
                                {{$name = !empty($filter) ? $field->name : null}}
                            @endsection

                            @if ($field->type == 'select')
                                {{ Form::select($name, $field->options, $filter, ['data-param'=>$field->name, 'class' => 'form-control', 'placeholder' => $field->title, 'id' => $field->name.'-id']) }}
                            @elseif ($field->type == 'decimal')
                                {{ Form::text($name, $filter, ['data-param'=> $field->name, 'class' => 'form-control', 'pattern'=>'^\d{1,11}(\.\d{1,2})?$', 'placeholder' => $field->title, 'id' => $field->name.'-id']) }}
                            @elseif ($field->type == 'percent')
                                <div class="input-group">
                                    {{ Form::text($name, $filter, ['data-param'=> $field->name, 'class' => 'form-control', 'pattern'=>'^\d(\.\d{1,2})?|[1-9]\d(\.\d{1,2})?|100$', 'placeholder' => $field->title, 'id' => $field->name.'-id']) }}
                                    <div class="input-group-append">
                                        <label class="fas fa-percent" for="{{$field->name}}-id"></label>
                                    </div>
                                </div>
                            @elseif ($field->type == 'date')
                                <div class="input-group">
                                    {{ Form::text($name, $filter, ['data-param' => $field->name, 'class' => 'form-control datepicker', 'pattern'=>'^\d\d-\d\d-\d\d\d\d$', 'placeholder' => $field->title, 'id' => $field->name.'-id']) }}
                                    <div class="input-group-append">
                                        <label class="far fa-calendar-alt" for="{{$field->name}}-id"></label>
                                    </div>
                                </div>
                            @elseif ($field->type == 'datetime')
                                <div class="input-group">
                                    {{ Form::text($name, $filter, ['data-param' => $field->name, 'class' => 'form-control datetimepicker', 'pattern'=>'^\d\d-\d\d-\d\d\d\d \d\d:\d\d$', 'placeholder' => $field->title, 'id' => $field->name.'-id']) }}
                                    <div class="input-group-append">
                                        <label class="far fa-calendar-alt" for="{{$field->name}}-id">
                                            <i class="far fa-clock datetime-time" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            @else
                                {{ Form::text($name, $filter, ['data-param'=> $field->name, 'class' => 'form-control', 'placeholder' => $field->title, 'id' => $field->name.'-id']) }}
                            @endif
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                        <div class="col-md-4 mb-3 ml-auto text-right">
                            {{ Form::button(__('Search'), ['type'=>'submit', 'class'=>'btn btn-primary btn-sm']) }}
                            {{ Form::button(__('Clear'), ['type'=>'reset', 'class'=>'btn btn-secondary btn-sm']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="col-md-12 text-center p-4">
                <span
                        class="detail-more">{{trans_choice('{0} No records found|{1} :count record found by filter|[2,4] :count records found by filter|[5,*] :count records found by filter', $service->pagination->total, ['count'=>$service->pagination->total])}}</span>
            </div>
            <div class="col-md-12">
                <div class="service-detail">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                @foreach($service->titles as $name)
                                    @foreach($service->fields as $field)
                                        @if ($field->name == $name)
                                            <th class="{{$field->name}}">
                                                <div class="col-{{$field->type}}" title="{{$field->title}}">
                                                    {!! $field->title !!}
                                                </div>
                                            </th>
                                        @endif
                                    @endforeach
                                @endforeach
                                @if (count($service->actions) or count($service->nested_data))
                                    <th class="action">{{__('Action')}}</th>
                                @endif
                                <th style="width: 110px;">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($service->data as $data)
                                <tr class="data-row {{next($service->data)==false?'last-row':''}} {{count($data->nested_data)?'nested_data':''}}"
                                    data-id="{{$data->id}}">
                                    @foreach($service->titles as $name)
                                        @foreach($service->fields as $field)
                                            @if ($field->name == $name)
                                                @foreach($data as $key => $value)
                                                    @if ($field->name == $key)
                                                        <td class="{{$field->name}}">
                                                            <div class="col-{{$field->type}}">
                                                                @if ($field->type == 'select')
                                                                    @foreach($field->options as $val => $label)
                                                                        @if ($val == $value)
                                                                            {!! $label !!}
                                                                        @endif
                                                                    @endforeach
                                                                @elseif ($field->type == 'image')
                                                                    <img height="45px" src="{{$value}}">
                                                                @elseif ($field->type == 'percent')
                                                                    {{rtrim(rtrim(number_format($value, 2, ',', ' '),'0'),',').'%'}}
                                                                @elseif ($field->type == 'decimal')
                                                                    {{rtrim(rtrim(number_format($value, 2, ',', ' '),'0'),',')}}
                                                                @elseif ($field->type == 'date' or $field->type == 'datetime')
                                                                    <span>{{date('d-m-Y', strtotime($value))}}</span>
                                                                    <span>{{date('H:i', strtotime($value))}}</span>
                                                                @else
                                                                    {!! $value !!}
                                                                @endif
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @if (count($service->actions) or count($service->nested_data))
                                        <td class="action">
                                            @if(count($data->nested_data))
                                                <a data-toggle="collapse" href="#dropdown-data-{{$data->id}}"
                                                   role="button" aria-expanded="false"
                                                   aria-controls="dropdown-data-{{$data->id}}"
                                                   onclick="$(this).children().toggleClass('d-none');
                                                $(this).closest('tr').next().toggleClass('d-none');">
                                                    <span class="btn btn-sm btn-primary whitespace-no-wrap">{{__('Additionally')}} <i
                                                                class="fas fa-chevron-circle-down"></i></span>
                                                    <span class="btn btn-sm btn-primary whitespace-no-wrap d-none">{{__('Additionally')}} <i
                                                                class="fas fa-chevron-circle-up"></i></span>
                                                </a>
                                            @endif
                                            @foreach($data->__actions as $key)
                                                @foreach($service->actions as $action)
                                                    @if ($action->name == $key)
                                                        <button class="btn btn-primary"
                                                                data-href="{{$data->id}}">{{$action->title}}</button>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </td>
                                    @endif
                                    <td>
                                        <a class="btn btn-success"
                                           href="{{ route('services.create', [$service->id,
                                           'member_id'=>$data->member_id]) }}"
                                           data-tooltip="tooltip" title="{{__('Leave bid')}}"><i
                                                    class="fas fa-plus"></i></a>
                                    </td>
                                </tr>

                                @if(count($data->nested_data))
                                    <tr class="dropdown-data d-none">
                                        <td colspan="2"></td>
                                        <td colspan="1000">
                                            @php($types = array('texts', 'numbers', 'dates'))
                                            @foreach($data->nested_data as $index => $nested_data)
                                                <div class="table-responsive collapse" id="dropdown-data-{{$data->id}}">
                                                    <table class="table table-borderless"
                                                           data-id="{{$nested_data->id}}">
                                                        <thead>
                                                        <tr>
                                                            @foreach($types as $type)
                                                                @foreach($service->nested_data[$index]->{$type} as $key => $title)
                                                                    <th class="{{$key}}">
                                                                        <div class="col-{{$type}}">
                                                                            {!! $title !!}
                                                                        </div>
                                                                    </th>
                                                                @endforeach
                                                            @endforeach
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            @foreach($types as $type)
                                                                @foreach($nested_data->{$type} as $key => $value)
                                                                    <td class="{{$key}}">
                                                                        <div class="col-{{$type}}">
                                                                            @if($type == 'numbers')
                                                                                {{rtrim(rtrim(number_format($value, 2, ',', ' '),'0'),',')}}
                                                                            @elseif($type == 'dates')
                                                                                <span>{{date('d-m-Y', strtotime($value))}}</span>
                                                                                <span>{{date('H:i', strtotime($value))}}</span>
                                                                            @else
                                                                                {!! $value !!}
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                @endforeach
                                                            @endforeach
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="1000" class="text-center text-danger">{{__('No records')}}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($service->pagination->total > 10)
                <div class="col-md-12 p-3 text-center" id="detail-more">
                    @if ($service->pagination->per_page >= $service->pagination->total)
                        <a class="detail-more"
                           href="javascript:$('[name=\'per_page\']').val(10);$('form#detail-filter').submit();">{{__('Show less')}}
                            <i class="fas fa-angle-up"></i></a>
                    @else
                        <a class="detail-more"
                           href="javascript:$('[name=\'per_page\']').val(parseInt($('[name=\'per_page\']').val())+10);$('form#detail-filter').submit();">{{__('Show more')}}
                            <i class="fas fa-angle-down"></i></a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
