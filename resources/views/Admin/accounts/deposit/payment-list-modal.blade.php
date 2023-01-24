<div class="modal fade" id="payment-list-modal" tabindex="-1" role="dialog" aria-labelledby="paymentListModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentListModalTitle">Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div v-if="Object.keys(paymentDetails).length !== 0 && paymentDetails.constructor === Object" class="modal-body">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                        <h3 class="kt-portlet__head-title">
                            <b>Customer Name:</b> @{{ paymentDetails.customer.full_name }} (@{{ paymentDetails.serial_no }})
                        </h3>
                    </div>
                    <div class="float-right mt-3">

                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table id="payment_list_table" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th>Payment Type</th>
                            <th>Voucher Name</th>
                            <th>Depositor Name</th>
                            <th>Amount</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="payment in paymentDetails.payments">
                                <td scope="row">@{{ payment.type_value }}</td>
                                <td>@{{ payment.id }}</td>
                                <td>@{{ payment.depositor_name }}</td>
                                <td>@{{ payment.amount }}</td>
                                <td class="text-center">@{{ payment.status == 0 ? 'Pending' : 'Paid' }}</td>
                                <td class="text-center">
                                    <a :href="'{{ route("deposit-list.index") . "/" }}'+payment.id+'/edit'"
                                       class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                        <i class="flaticon2-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-label-success btn-sm btn-icon-sm btn-circle"
                                            data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="Print"
                                            @click="printReceipt(payment.id)">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
