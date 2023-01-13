@extends('layouts.app')
@section('content')
<div class="container">
    {{ Breadcrumbs::render('news.create') }}

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
                        <h3 class="section-title">{{__('Create news')}}</h3>
                    </div>
                    @can('news-list')
                    <div class="col-6 text-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('news.index', ['type'=>Session::get('type', 1)]) }}">{{__('News')}}</a>
                    </div>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'news.store','method'=>'POST')) !!}
                <div class="form-group">
                    <strong>{{__('Type')}}:</strong>
                    {!! Form::select('type', \App\Models\Article::getTypeOptions(), Session::get('type', 1), array('placeholder' => 'Type','class' => 'form-control')) !!}
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
                                {!! Form::text('photo', null, array('id' => 'thumbnail', 'placeholder' => 'url','class' => 'form-control', 'autocomplete' => 'off')) !!}
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
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="published" class="custom-control-input" value="1" id="published">
                        <label class="custom-control-label" for="published">{{__('Published')}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <strong>{{__('Summary')}}:</strong>
                    {!! Form::textarea('summary', null, array('placeholder' => __('Summary'), 'class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                    <strong>{{__('Body')}}:</strong>
                    {!! Form::textarea('body', null, array('id'=>'editor', 'placeholder' => __('Body'), 'class' => 'form-control')) !!}
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
    setTimeout(function() {
        {
            !!\File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!
        }

        var route_prefix = "/filemanager";
        $('#lfm').filemanager('image', {
            prefix: route_prefix
        });
    }, 0);
</script>
@endpush