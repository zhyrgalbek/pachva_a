<button class="btn btn-sm btn-secondary" data-toggle="modal"
        data-target="#applicationDetail{{$application->id}}">{{__('More details')}}</button>

@push('page-modals')
    <!-- Application detail -->
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade modal-service-detail" id="applicationDetail{{$application->id}}" tabindex="-1"
         aria-labelledby="applicationDetailTitle{{$application->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                                <div class="modal-logo"><i class="fas fa-edit"></i></div>
                            </div>
                            <div class=" col-9 col-md-10">
                                <h5 class="modal-title"
                                    id="applicationDetailTitle{{$application->id}}">{{$application->service_name }}</h5>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <p>Получатель заявки: {{$application->member_name}}</p>
                                <p>Статус: {{ trans(ucfirst($application->status_str)) }}</p>
                            </div>
                            @if($application->status_str=='approved')
                                <div class="col-md-4 col-12 text-right">
                                    <img src="{{ asset('storage/' . $application->path_to_QR) }}" width="200"
                                         alt="qr-code">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($application->status_str=='approved')
                        <a class="btn btn-link" target="_blank" href="{{ route('applications.showByQrcode', $application->code)
                        }}">{{ 'Show document' }}</a>
                    @endif
                    {{--                    @foreach($application->action as $action)--}}
                    {{--                        @switch ($action)--}}
                    {{--                            @case('cancel')--}}
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Close')}}</button>
                    {{--                            @break--}}
                    {{--                        @endswitch--}}
                    {{--                    @endforeach--}}
                </div>
                <i class="modal-background-icon fas fa-paper-plane"></i>
            </div>
        </div>
    </div>
@endpush
