@extends('layouts.app')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('others.create') }}

        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{{__('Opps!')}}</strong> {{__('Something went wrong, please check below errors.')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="section-title">{{__('Create')}}</h3>
                        </div>
                        @can('other-list')
                            <div class="col-6 text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('others.index', ['type'=>Session::get('type', 1)]) }}">{{__('Back')}}</a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'others.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <strong>{{__('Type')}}:</strong>
                        {!! Form::select('type', \App\Models\Other::getTypeOptions(), Session::get('type', 1), array('placeholder' => 'Type','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>{{__('Image')}}:</strong>
                        <div class="form-row">
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-sm text-white">
                                        <i class="fa fa-picture-o"></i> {{__('Choose')}}
                                        </a>
                                    </span>
                                    {!! Form::text('image', null, array('id' => 'thumbnail', 'placeholder' => 'url','class' => 'form-control', 'autocomplete' => 'off')) !!}
                                </div>
                            </div>
                            <div class="col-auto">
                                <div id="holder" style="max-height:100px;">
                                    <h1 class="text-secondary text-center"><i class="fas fa-image"></i></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <strong>{{__('Title')}}:</strong>
                        {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>{{__('Description')}}:</strong>
                        {!! Form::textarea('description', null, array('placeholder' => __('Description'), 'class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>{{__('Link')}}:</strong>
                        {!! Form::url('link', null, array('placeholder' => 'url','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            {!! Form::checkbox('published', 1, null, array('id'=>'published', 'class'=>'custom-control-input')) !!}
                            <label class="custom-control-label" for="published">{{__('Published')}}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
    <script type="application/javascript">
        setTimeout(function(){
            {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}

            var route_prefix = "/filemanager";
            $('#lfm').filemanager('image', {prefix: route_prefix});
        }, 0);
    </script>
@endpush
