let vm = new Vue({
    el: "#deposit_page",
    data: {
        isLoading: false,
        fullPage: false,
        payment: {
            id: null,
            status: 0,
            due: 0
        },
        paymentType: paymentType,
        paymentDetails: {}
    },
    mounted() {
        setTimeout(function () {
        }, 1000);
    },
    updated() {
    },
    methods: {
        getPaymentStatus(id) {
            let _this = this;
            let loader = this.$loading.show();
            if (id) {
                axios.get(api.getHajjPaymentStatus + id)
                    .then(res => {
                        if (res.data.success) {
                            _this.payment.id = id;
                            _this.payment.status = res.data.data;
                            _this.payment.due = res.data.due;
                        } else {
                            _this.payment.status = 0;
                        }
                    })
                    .then(() => {
                        $('#change-status-modal').modal('show');
                        loader.hide();
                        $('.kt-selectpicker').selectpicker('refresh');
                    });
            } else {
                console.log('Hajj ID Not Found!');
            }
        },
        getPaymentDetails(id){
            let _this = this;
            let loader = this.$loading.show();
            if (id) {
                axios.post(api.getHajjPaymentDetails, { hajj_id: id })
                    .then(res => {
                        if (res.data.success) {
                            _this.paymentDetails= res.data.data;
                        } else {
                            _this.paymentDetails = {};
                        }
                    })
                    .then(() => {
                        $('#payment-list-modal').modal('show');
                        loader.hide();
                        $('.kt-selectpicker').selectpicker('refresh');
                        if ( ! $.fn.DataTable.isDataTable( '#payment_list_table' ) ) {
                            $('#payment_list_table').DataTable({
                                responsive: {
                                    details: false
                                }
                            });
                        }
                    });
            } else {
                console.log('Hajj ID Not Found!');
            }
        },
        printReceipt(id) {
            window.open(base_url + '/deposit-list/receipt/print/'+id, "_blank", "toolbar=yes,scrollbars=yes,width=815,height=1100");
        }
    }
});
