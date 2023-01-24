<div class="modal fade" id="change-status-modal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModal">Change Passport Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-status-form" action="{{ route('passport-history.change-status') }}" method="POST"
                  class="kt-form kt-form--label-right">
                <div class="modal-body">
                    <div class="kt-portlet__body">
                        @csrf
                        <input type="hidden" name="passport_id" v-model="passport.id">
                        <div class="form-group row">
                            <label for="passport_status_id" class="col-4 col-form-label">Passport Status *</label>
                            <div class="col-8">
                                <select class="form-control kt-selectpicker"
                                        v-model="passport.currentStatus"
                                        name="passport_status_id"
                                        id="passport_status_id">
                                    <option value="0">Select Status</option>
                                    <option v-for="(status, index) in passportStatuses" :value="status.id">@{{ status.status_name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="modal-change-status-button">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
