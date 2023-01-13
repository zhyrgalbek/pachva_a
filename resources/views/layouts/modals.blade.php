<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="confirmModalLabel">{{__('Confirm your action')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="confirm-text" class="text-center"></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm">{{__('Yes')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('No')}}</button>
            </div>
        </div>
    </div>
</div>
