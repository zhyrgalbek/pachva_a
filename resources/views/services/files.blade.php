@extends('layouts.app')
@section('content')
<div class="container">
    {{ Breadcrumbs::render('files') }}

    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">{{__('Select a file')}}</h2>
            <div class="input-group">
              <span class="input-group-btn input-group-prepend">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary btn-sm">
                  <i class="fa fa-picture-o"></i> {{__('Choose')}}
                </a>
              </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
        </div>
    </div>
</div>
<script type="application/javascript">
    setTimeout(function(){
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}

     var route_prefix = "/filemanager";
     $('#lfm').filemanager('image', {prefix: route_prefix});
     }, 0);
</script>
@endsection
