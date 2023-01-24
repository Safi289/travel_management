<!--begin::Update-Note-Modal-->
<div class="modal fade" id="update-note-modal" tabindex="-1" role="dialog" aria-labelledby="updateNoteModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateNoteModal">Update Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="update-note-form" action="{{ route('json.customer.update-note', $customer->id) }}" method="POST"
                  class="kt-form kt-form--label-right">
                <div class="modal-body">
                    <div class="kt-portlet__body">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <textarea class="form-control" name="notes" id="notes" rows="10" placeholder="Write Notes">{{ $customer->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="modal-change-status-button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Update-Note-Modal-->
