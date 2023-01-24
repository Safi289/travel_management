<div class="modal fade" id="change-status-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 v-if="payment.status === false" class="modal-title" id="deleteModalTitle">Warning</h5>
                <h5 v-else class="modal-title" id="deleteModalTitle">Change Payment Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div v-if="payment.status === false" class="modal-body">
                <div class="kt-scroll" data-scroll="true" data-height="200">
                    <p class="text-danger">Cannot update status because the due amount is: <b>@{{ payment.due }}</b></p>
                </div>
            </div>
            <div v-if="payment.status === false" class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
            <form v-else id="menu-form" action="{{ route('deposit-list.change-status') }}" method="POST"
                  class="kt-form kt-form--label-right">
                <div class="modal-body">
                    <div class="kt-portlet__body">
                        @csrf
                        <input type="hidden" name="id" v-model="payment.id">
                        <div class="form-group row">
                            <label for="payment_status" class="col-2 col-form-label">Payment Status *</label>
                            <div class="col-10">
                                <select class="form-control kt-selectpicker"
                                        v-model="payment.status"
                                        name="payment_status"
                                        id="payment_status">
                                    <option value="0">Partially Paid</option>
                                    <option value="1">Paid</option>
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
