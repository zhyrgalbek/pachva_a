@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('logs.index') }}

        <div class="justify-content-center">
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('Logs')}}</h3>
                </div>
                <div class="col-md-12">
                    <div class="table-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 60px;">{{__('#')}}</th>
                                    <th>{{__('client_url')}}</th>
                                    <th>{{__('client_method')}}</th>
                                    <th>{{__('client_ip')}}</th>
                                    <th>{{__('client_agent')}}</th>
                                    <th>{{__('client_name')}}</th>
                                    <th>{{__('date')}}</th>
                                    <th style="width: 110px;">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td><div class="text-ellipsis-hidden-w200" title="{{ $log->url }}">{{ $log->url }}</div></td>
                                        <td>{{ $log->method }}</td>
                                        <td>{{ $log->ip }}</td>
                                        <td ><div class="text-ellipsis-hidden-w200" title="{{ $log->agent }}">{{ $log->agent }}</div></td>
                                        <td>{{ $log->user?$log->user->last_name .' '. $log->user->name:'' }}</td>
                                        <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                                                <a class="btn btn-success" href="{{ route('logs.show', $log->id) }}" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                                            </div>
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
