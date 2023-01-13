<h5 class="modal-body-title">{{__('The service is provided by')}}</h5>
<div class="form-row align-items-center">
    @forelse($members as $member)
    <div class="col-md-3">
        <div class="form-row align-items-center" style="opacity: {{$member->active?'1':'0.3'}}">
            <div class="col-auto">
                <img class="company-logo" src="{{$member->image}}" alt="..."/>
            </div>
            <div class="col">
                <span class="modal-company-text">{!! $member->name !!}</span>
            </div>
        </div>
    </div>
    @empty
        <span class="badge badge-warning">{{__('No members')}}</span>
    @endforelse
</div>
