"use strict";

// Class definition

var KTWizard3 = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v3', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function (wizardObj) {
            /*if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }*/
        });

        wizard.on('beforePrev', function (wizardObj) {
            /*if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }*/
        });

        // Change event
        wizard.on('change', function (wizard) {
            KTUtil.scrollTop();
        });
    };

    var initValidation = function () {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                //= Step 1
                address1: {
                    required: true
                },
                postcode: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                country: {
                    required: true
                },

                //= Step 2
                package: {
                    required: true
                },
                weight: {
                    required: true
                },
                width: {
                    required: true
                },
                height: {
                    required: true
                },
                length: {
                    required: true
                },

                //= Step 3
                delivery: {
                    required: true
                },
                packaging: {
                    required: true
                },
                preferreddelivery: {
                    required: true
                },

                //= Step 4
                locaddress1: {
                    required: true
                },
                locpostcode: {
                    required: true
                },
                loccity: {
                    required: true
                },
                locstate: {
                    required: true
                },
                loccountry: {
                    required: true
                },
            },

            // Display error
            invalidHandler: function (event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function () {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function (e) {
            e.preventDefault();

            // if (validator.form()) {
            // See: src\js\framework\base\app.js
            KTApp.progress(btn);
            //KTApp.block(formEl);

            // See: http://malsup.com/jquery/form/#ajaxSubmit
            let thisForm = $('#kt_form');
            let formData = new FormData(thisForm[0]);
            let headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            $.ajax({
                type: 'POST',
                headers: headers,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                url: thisForm.attr('action'),
                data: formData,
                async: false,
                success: function (response) {
                    KTApp.unprogress(btn);
                    //KTApp.unblock(formEl);

                    let errors_messages = '';
                    if (response.errors) {
                        errors_messages += '<ul class="list-group">';
                        Object.keys(response.errors).forEach(error => {
                            errors_messages += '<li class="list-group-item text-danger">';
                            errors_messages += response.errors[error][0];
                            errors_messages += '</li>';
                        });
                        errors_messages += '</ul>';
                    }

                    swal.fire({
                        "title": "",
                        "text": response.message,
                        "html": errors_messages,
                        "type": response.type,
                        "confirmButtonClass": "btn btn-secondary"
                    });
                    if (thisForm.find('[name="_method"]').val() !== 'PUT') {
                        if (response.success === true) {
                            thisForm.each(function () {
                                this.reset();
                            });
                        }
                    }
                    setTimeout(() => {
                        if (response.success === true) {
                            //window.location.href = window.location.origin + "/customer";
                            window.location.href = window.base_url + "/customer";
                        }
                    }, 1000);
                }
            });
            // }
        });
    };

    return {
        // public functions
        init: function () {
            wizardEl = KTUtil.get('kt_wizard_v3');
            formEl = $('#kt_form');

            initWizard();
            // initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function () {
    KTWizard3.init();
});


let vm = new Vue({
    el: "#customer_page",
    data: {
        type: customer_type,
        identity: customer_identity_type,
        gender: customer_gender,
        isSamePermanentAddress: false,
        current_district: current_district,
        current_police_station: current_police_station,
        permanent_district: permanent_district,
        permanent_police_station: permanent_police_station,
        current_police_stations: [],
        permanent_police_stations: [],
        isGroup: false,
        isNRB: false,
        current_maharam_id: maharam_id,
        mahramList: [],
        current_dependent_id: dependent_id,
        dependentList: [],
        hasMahram: false,
        documents: [{
            document: null,
            title: null,
        }],
        validateMobileData: {
            hasError: false,
            input: customer_mobile,
            message: 'Mobile Number Must not be 11 digits',
        },
        validatePassportNoData: {
            hasError: false,
            input: null,
            message: null,
        },
    },
    mounted() {
        let _this = this;
        this.calculateAge();
        this.calculatePassportExpiry();
        this.jquery();
        if (!isNaN(current_police_station)) {
            _this.setPresentPoliceStation(current_district);
        }
        if (!isNaN(permanent_police_station)) {
            _this.setPermanentPoliceStation(permanent_district);
        }
        if (!isNaN(group_id)) {
            _this.setMaharamList(group_id);
        }
        if (!isNaN(maharam_id)) {
            _this.setMahramId(maharam_id);
        }
        if (!isNaN(dependent_id)) {
            _this.setDependentId(dependent_id);
        }
        setTimeout(function () {
            KTBootstrapSelect.init();
        }, 1200);
    },
    updated() {
        KTBootstrapSelect.init();
    },
    methods: {
        jquery() {
            $('body').on('click', '.document-delete-button', function (event) {
                event.preventDefault();event.target.parentNode.parentNode.parentNode.remove();
            });
        },
        changeType(event) {
            this.type = event.target.value;
        },
        changeIdentityType(event) {
            this.identity = event.target.value;
        },
        calculateAge() {
            $('#date_of_birth').change(function () {
                let DOB = moment($(this).val(), 'DD-MMM-YYYY');
                let years = moment().diff(DOB, 'years');
                let months = moment().diff(DOB.add(years, 'years'), 'months');
                let days = moment().diff(DOB.add(months, 'months'), 'days');
                $('#calculated_age').text(`Age: ${years} years, ${months} months, ${days} days`);
            });
        },
        changeGender(event) {
            this.gender = event.target.value;
        },
        calculatePassportExpiry() {
            $('#expiry_date').change(function () {
                let PPExpDate = moment($(this).val(), 'DD-MM-YYYY');
                let years = moment().diff(PPExpDate, 'years');
                let months = moment().diff(PPExpDate.add(years, 'years'), 'months');
                let days = moment().diff(PPExpDate.add(months, 'months'), 'days');
                $('#calculated_passport_expiry').text(`Remaining: ${years} years, ${months} months, ${days} days`);
            });
        },
        changeResidentType(event) {
            this.isNRB = event.target.value === 'NRB';
        },
        loadFile(event) {
            let CSS = 'background-image: url(' + URL.createObjectURL(event.target.files[0]) + ')';
            CSS += '; background-size: contain; width: 150px; height: 200px;';
            document.getElementById("avatar__holder").style.cssText = CSS;
        },
        setPresentPoliceStation(id) {
            let _this = this;
            axios.get(api.getThanas + id)
                .then(res => {
                    if (res.data.success) {
                        _this.current_police_stations = res.data.data;
                    } else {
                        _this.current_police_stations = [];
                    }
                })
                .then(() => {
                    $('.kt-selectpicker').selectpicker('refresh');
                });
        },
        getPresentPoliceStation(event) {
            this.setPresentPoliceStation(event.target.value);
        },
        setPermanentPoliceStation(id) {
            let _this = this;
            axios.get(api.getThanas + id)
                .then(res => {
                    if (res.data.success) {
                        _this.permanent_police_stations = res.data.data;
                    } else {
                        _this.permanent_police_stations = [];
                    }
                })
                .then(() => {
                    $('.kt-selectpicker').selectpicker('refresh');
                });
        },
        getPermanentPoliceStation(event) {
            this.setPermanentPoliceStation(event.target.value);
        },
        setMaharamList(id) {
            let _this = this;
            if (id) {
                _this.isGroup = true;
                axios.get(api.getMahramList + id)
                    .then(res => {
                        if (res.data.success) {
                            _this.mahramList = res.data.data;
                            _this.dependentList = res.data.data;
                        } else {
                            _this.mahramList = [];
                            _this.dependentList = [];
                        }
                    })
                    .then(() => {
                        $('.kt-selectpicker').selectpicker('refresh');
                    });
            } else {
                _this.isGroup = false;
            }

        },
        getGrpupId(event) {
            this.setMaharamList(event.target.value);
        },
        setMahramId(id) {
            this.hasMahram = !!id;
        },
        getMahramId(event) {
            this.setMahramId(event.target.value);
        },
        setDependentId(id) {
            this.hasMahram = !!id;
        },
        addNewDocument() {
            let html = `
            <div class="row">
                <div class="col-5">
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-right">File</label>
                        <div class="col-9 custom-file">
                            <input type="file" class="form-control" name="document[]">
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group row">
                        <label for="document_title[]" class="col-3 col-form-label text-right">Document Title</label>
                        <div class="col-9">
                            <input class="form-control" type="text" name="document_title[]" placeholder="Document Title">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger document-delete-button"><i class="flaticon-delete"></i></button>
                </div>
            </div>
            `;
            let el = document.createElement('div');
            el.innerHTML = html;
            document.getElementById("document-upload").appendChild(el);
            /*this.documents.push({
                document: null,
                title: null,
            });*/
        },
        removeDocument(index) { // We are not using this method
            document.getElementById('document_' + index).value = '';
            setTimeout(() => {
                this.documents.splice(index, 1);
            }, 400);
        },
        validateMobile() {
            this.validateMobileData.hasError = this.validateMobileData.input == null || this.validateMobileData.input.length !== 11;
        },
        validatePassport() {
            let _this = this;
            if (this.validatePassportNoData.input == null || this.validatePassportNoData.input.length < 9) {
                this.validatePassportNoData.hasError = true;
                this.validatePassportNoData.message = 'Passport Number Must be minimum 9 digits';
            } else {
                axios.get(api.isRegisteredPassport, {
                    params: {
                        'passport_no': _this.validatePassportNoData.input
                    }
                }).then(res => {
                    if (res.data.success) {
                        _this.validatePassportNoData.hasError = false;
                        _this.validatePassportNoData.message = null;
                    } else {
                        _this.validatePassportNoData.hasError = true;
                        _this.validatePassportNoData.message = res.data.message;
                    }
                });
            }
        },
        setSamePermanentAddress(event){
            if (event.target.checked) {
                $('select[name="permanent_district"]').val($('select[name="current_district"]').val());
                $('select[name="permanent_district"]').selectpicker('refresh');
                this.permanent_police_stations = this.current_police_stations;
                setTimeout(() => {
                    $('select[name="permanent_police_station"]').val($('select[name="current_police_station"]').val());
                    $('select[name="permanent_police_station"]').selectpicker('refresh');
                }, 400);
                $('input[name="permanent_postcode"]').val($('input[name="current_postcode"]').val());
                $('textarea[name="permanent_address"]').val($('textarea[name="current_address"]').val());
            }
        }
    }
});
