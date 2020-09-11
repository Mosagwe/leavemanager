<div id="declineModal" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="declineModalForm" method="post" class="validate-form"
                  action="{{ route('leave-requests.destroy') }}">
                @csrf()
                @method('PUT')
                <input type="hidden" id="leaveRequestId" name="leaveRequest">
                <div class="modal-header">
                    <h5 class="modal-title">Decline Leave Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason" class="control-label">Reason</label>
                        <textarea name="reason" data-rule-max="1200" id="reason" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
