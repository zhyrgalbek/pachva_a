@extends('layouts.app')
@section('content')
    {{--    @dd($service)--}}
    <div class="container">
        {{ Breadcrumbs::render('services.create', $service) }}
        <div class="row">
            <div class="col-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
                <form action="{{ route('applications.store') }}" method="get">
                    <input type="hidden" name="member_id" value="{{ $member_id }}">
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <input type="hidden" name="service_name" value="{{ $service->name }}">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    {{--                                    <button type="button" class="btn btn-link" --}}{{--data-toggle="collapse"--}}
                                    {{--                                            data-target="#collapseOne"--}}
                                    {{--                                            aria-expanded="true" aria-controls="collapseOne">--}}
                                        {{ __('Basic information') }}
                                    {{--                                    </button>--}}
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($service->texts as $key=>$text)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="{{ $key.'_label' }}">{{ $text[0] }}</label>
                                                    <input type="text" required id="{{ $key.'_label' }}"
                                                           name="data[{{ $key }}][]"
                                                           class="form-control"
                                                           placeholder="{{ $text[1] }}">
                                                    <input type="hidden" name="data[{{ $key }}][]"
                                                           value="{{ $text[0] }}">
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($service->numbers as $key=>$number)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="{{ $key.'_label' }}">{{ $number[0] }}</label>
                                                    <input type="number" required id="{{ $key.'_label' }}"
                                                           name="data[{{ $key }}][]"
                                                           class="form-control"
                                                           placeholder="{{ $number[1] }}">
                                                    <input type="hidden" name="data[{{ $key }}][]" value="{{
                                                      $number[0] }}">
                                                </div>
                                            </div>
                                        @endforeach
                                        @foreach($service->dates as $key=>$date)
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="{{ $key.'_label' }}">{{ $date[0] }}</label>
                                                    <input type="datetime-local" required
                                                           id="{{ $key.'_label' }}" name="data[{{ $key }}][]"
                                                           class="form-control"
                                                           placeholder="{{ $date[1] }}">
                                                    <input type="hidden" name="data[{{ $key }}][]"
                                                           value="{{ $date[0] }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($service->nested_data))
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
{{--                                        <button type="button" class="btn btn-link collapsed"--}}
{{--                                                --}}{{--data-toggle="collapse"--}}
{{--                                                data-target="#collapseTwo"--}}
{{--                                                aria-expanded="false" aria-controls="collapseTwo">--}}
{{--                                            {{ __('Additional Information') }}--}}
{{--                                        </button>--}}
                                            {{ __('Additional Information') }}
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($service->nested_data as $nested_array_key =>$datum)
                                                @foreach($datum->texts as $key=>$text)
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="{{ $key.'_label' }}">{{ $text[0] }}</label>
                                                            <input id="{{ $key.'_label' }}" required
                                                                   name="details[{{ $nested_array_key }}][{{
                                                            $key
                                                            }}][]" type="text"
                                                                   class="form-control"
                                                                   placeholder="{{ $text[1] }}">
                                                            <input type="hidden" name="details[{{ $nested_array_key }}][{{
                                                            $key
                                                            }}][]" value="{{ $text[0] }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach($datum->numbers as $key=>$number)
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="{{ $key.'_label' }}">{{ $number[0] }}</label>
                                                            <input id="{{ $key.'_label' }}" required
                                                                   name="details[{{ $nested_array_key }}][{{
                                                            $key
                                                            }}][]" type="number"
                                                                   class="form-control"
                                                                   placeholder="{{ $number[1] }}">
                                                            <input type="hidden" name="details[{{ $nested_array_key }}][{{
                                                            $key
                                                            }}][]" value="{{ $number[0] }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach($datum->dates as $key=>$date)
                                                    <div class="col-lg-4 col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="{{ $key.'_label' }}">{{ $date[0] }}</label>
                                                            <input id="{{ $key.'_label' }}" required
                                                                   name="details[{{ $nested_array_key }}][{{
                                                            $key
                                                            }}][]"
                                                                   type="datetime-local"
                                                                   class="form-control"
                                                                   placeholder="{{ $date[1] }}">
                                                            <input type="hidden" name="details[{{ $nested_array_key }}][{{
                                                            $key
                                                            }}][]" value="{{ $date[0] }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 text-right">
                        <button class="btn btn-primary">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
