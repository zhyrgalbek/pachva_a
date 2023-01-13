@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('permissions.index') }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('Permissions')}}</h3>
                </div>
                @can('role-create')
                <div class="col-6 text-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('permissions.create') }}">{{__('New Permission')}}</a>
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
                                @foreach ($data as $key => $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                                                <a class="btn btn-success" href="{{ route('permissions.show',$permission->id) }}" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                                                @can('permission-edit')
                                                    <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}" data-tooltip="tooltip" title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('permission-delete')
                                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#permission-delete-".$permission->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]) !!}
                                                @endcan
                                            </div>
                                            @can('permission-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'class'=>'d-none', 'id'=>'permission-delete-'.$permission->id]) !!}
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
