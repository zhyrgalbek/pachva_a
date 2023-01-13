<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th style="width: 60px;">{{__('#')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Organization')}}</th>
            <th>{{__('Status')}}</th>
            <th style="width: 180px;">{{__('Action')}}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($applications as $application)
            <tr>
                <td>{{$application->id}}</td>
                <td>{{$application->service_name}}</td>
                <td>{{$application->member_name}}</td>
                <td>
                    @switch($application->status_str)
                        @case('sent')
                        <span class="text-info font-weight-bold text-nowrap"><i class="fas fa-paper-plane"></i> {{__('Sent')}}</span>
                        @break
                        @case('canceled')
                        <span class="text-secondary font-weight-bold text-nowrap"><i class="far fa-times-circle"></i> {{__('Cancelled')}}</span>
                        @break
                        @case('approved')
                        <span class="text-success font-weight-bold text-nowrap"><i class="fas fa-check"></i> {{__('Approved')}}</span>
                        @break
                        @case('rejected')
                        <span class="text-danger font-weight-bold text-nowrap"><i class="fas fa-times"></i> {{__('Rejected')}}</span>
                        @break
                    @endswitch
                </td>
                <td>
                    @include('applications.detail')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100%">
                    <div class="alert alert-info" role="alert">
                        {{__('No applications!')}}
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="pagination-content text-right mt-3">
    {{ $applications->appends($_GET)->links('pagination::bootstrap-4') }}
</div>
