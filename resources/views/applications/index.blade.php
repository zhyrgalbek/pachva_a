@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('applications.index') }}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="section-title">{{__('My applications')}}</h3>
                <div class="table-content shadow p-3 mb-5 bg-white rounded-lg">
                    <p class="text-lg text-muted">{{__('The results of applications come within 24 hours')}}</p>
                    @include('applications.table')
                </div>
            </div>
        </div>
    </div>
@endsection
