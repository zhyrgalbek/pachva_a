@extends('layouts.app')

@push('page-styles')
    <style rel="stylesheet">
        .content {
            padding: 0;
        }
    </style>
@endpush

@section('content')

<iframe id="languages" class="height-auto" width="100%" src="{{route('languages.index')}}"></iframe>

@endsection
