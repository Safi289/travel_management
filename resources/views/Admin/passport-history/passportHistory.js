let vm = new Vue({
    el: "#passport_history_page",
    data: {
        isLoading: false,
        fullPage: false,
        passportStatuses: [],
        passport: {
            id: null,
            currentStatus: null,
        },
        passportStatusHistories: [],
    },
    mounted() {
    },
    updated() {
    },
    methods: {
        moment(dateTime){
            return moment(dateTime);
        },
        getPassportStatus(id) {
            let _this = this;
            let loader = this.$loading.show();
            if (id) {
                axios.get(api.getPassportStatus, { params: { passport_id: id } })
                    .then(res => {
                        if (res.data.success) {
                            _this.passport.id = id;
                            _this.passport.currentStatus = res.data.currentStatus;
                            _this.passportStatuses = res.data.passportStatuses;
                        } else {
                            _this.passport.currentStatus = null;
                        }
                    })
                    .then(() => {
                        $('#change-status-modal').modal('show');
                        loader.hide();
                        $('.kt-selectpicker').selectpicker('refresh');
                    });
            } else {
                console.log('Passport ID Not Found!');
            }
        },
        getPassportStatusHistories(id) {
            let _this = this;
            let loader = this.$loading.show();
            if (id) {
                axios.get(api.getPassportStatusHistories, { params: { passport_id: id } })
                    .then(res => {
                        if (res.data.success) {
                            _this.passportStatusHistories = res.data.passportStatusHistory.passport_statuses;
                        } else {
                            _this.passport.currentStatus = null;
                        }
                    })
                    .then(() => {
                        $('#status-history-modal').modal('show');
                        loader.hide();
                        $('.kt-selectpicker').selectpicker('refresh');
                    });
            } else {
                console.log('Passport ID Not Found!');
            }
        },
    }
});
