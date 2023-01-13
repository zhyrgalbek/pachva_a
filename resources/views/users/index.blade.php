@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('users.index') }}

        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="section-title">{{__('Users')}}</h3>
                </div>
                @can('user-create')
                    <div class="col-6 text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">{{__('New User')}}</a>
                    </div>
                @endcan
                <div class="col-md-12">
                    <div class="table-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 60px;">{{__('#')}}</th>
                                    <th>{{__('User type')}}</th>
                                    <th>{{__('PIN/INN')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Roles')}}</th>
                                    <th style="width: 110px;">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->user_type == 1 ? __('Individual') : __('Legal entity') }}</td>
                                        <td>{{ $user->identifier }}</td>
                                        <td>{{ $user->last_name }} {{ $user->name }} {{ $user->middle_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $val)
                                                    <label class="badge badge-dark">{{ $val }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="{{__('Action')}}">
                                                <a class="btn btn-success" href="{{ route('users.show',$user->id) }}" data-tooltip="tooltip" title="{{__('Show')}}"><i class="fas fa-search-plus"></i></a>
                                                @can('user-edit')
                                                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}" data-tooltip="tooltip" title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('user-delete')
                                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#user-delete-".$user->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]) !!}
                                                @endcan
                                            </div>
                                            @can('user-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'class'=>'d-none', 'id'=>'user-delete-'.$user->id]) !!}
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
