<div class="modal fade" id="status-history-modal" tabindex="-1" role="dialog" aria-labelledby="StatusHistoryModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="StatusHistoryModal">Passport Status History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th>Status Title</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="passportStatusHistories.length > 0" v-for="history in passportStatusHistories">
                            <td>@{{ history.status_name }}</td>
                            <td>@{{ moment(history.pivot.date).format('DD-MM-YYYY hh:mm A') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
