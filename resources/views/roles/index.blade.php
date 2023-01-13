@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('roles.index') }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('Roles')}}</h3>
                </div>
                @can('role-create')
                    <div class="col-6 text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">{{__('New Role')}}</a>
                    </div>
                @endcan
                <div class="col-md-12">
                    <div class="table-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 60px;">{{__('#')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th style="width: 110px;">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                                                <a class="btn btn-success" href="{{ route('roles.show',$role->id) }}" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                                                @can('role-edit')
                                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}" data-tooltip="tooltip" title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('role-delete')
                                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#role-delete-".$role->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]) !!}
                                                @endcan
                                            </div>
                                            @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'class'=>'d-none', 'id'=>'role-delete-'.$role->id]) !!}
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
