<div class="card mb-3" data-toggle="modal" data-target="#serviceDetail{{$service->id}}">
    <div class="row no-gutters">
        <div class="col-3 card-left">
            <div class="card-logo"><i class="{{$service->icon}}"></i></div>
        </div>
        <div class="col-9">
            <div class="card-body">
                <h5 class="card-title">{{$service->name}}</h5>
                <p class="card-text">{!! $service->description !!}</p>
            </div>
        </div>
    </div>
</div>

@push('page-modals')
    <!-- Service detail -->
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade modal-service-detail" id="serviceDetail{{$service->id}}" tabindex="-1" aria-labelledby="serviceDetailTitle{{$service->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                                <div class="modal-logo"><i class="{{$service->icon}}"></i></div>
                            </div>
                            <div class=" col-9 col-md-10">
                                <h5 class="modal-title" id="serviceDetailTitle{{$service->id}}">{{$service->name}}</h5>
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
                            <div class="col-md-8 m-auto">
                                <p class="modal-text">{!! $service->description !!}</p>
                                <p class="modal-text">Описание услуги, давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона.</p>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-3 ml-auto">
                                <ul class="modal-list">
                                    <li>Поле для текста</li>
                                    <li>Поле для текста</li>
                                    <li>Поле для текста</li>
                                    <li>Поле для текста</li>
                                </ul>
                            </div>
                            <div class="col-md-12" id="members-{{$service->id}}"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @auth
                    <a class="btn btn-secondary" href="{{route('services.detail', [$service->id])}}">{{__('More details')}}</a>
                    @elseif (request()->routeIs('*account*'))
                    <a class="btn btn-secondary" href="{{route('services.detail', [$service->id, 'utype'=>'j'])}}">{{__('More details')}}</a>
                    @else
                    <a class="btn btn-secondary" href="{{route('services.detail', [$service->id, 'utype'=>'i'])}}">{{__('More details')}}</a>
                    @endauth
                    <button type="button" class="btn btn-primary">{{__('Subscribe')}}</button>
                </div>
                <i class="modal-background-icon {{$service->icon}}"></i>
            </div>
        </div>
    </div>
@endpush

@push('page-scripts')
    <script type="application/javascript">
        setTimeout(function(){
            $('#serviceDetail{{$service->id}}').on('show.bs.modal', function(event){
                if ($('#members-{{$service->id}}').is(':empty')) {
                    $.ajax({
                        type: 'GET', //THIS NEEDS TO BE GET
                        url: '{{route('services.members', $service->id)}}',
                        success: function (members) {
                            $('#members-{{$service->id}}').html(members);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });
        }, 0);
    </script>
@endpush
