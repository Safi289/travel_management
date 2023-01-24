$(document).ready(function () {
    $('#expiry_date').change(function () {
        let PPExpDate = moment($(this).val(), 'DD-MM-YYYY');
        let years = moment().diff(PPExpDate, 'years');
        let months = moment().diff(PPExpDate.add(years, 'years'), 'months');
        let days = moment().diff(PPExpDate.add(months, 'months'), 'days');
        $('#calculated_passport_expiry').text(`Remaining: ${years} years, ${months} months, ${days} days`);
    });
    $('body').on('change', '#reference_id', function(event) {
        let loader = Vue.$loading.show();
        axios.get(window.base_url + '/json/get-customers-by-id/' + event.target.value)
            .then(res => {
                let data = res.data.data;
                $('#ref_group').text(data.group.group_name);
                $('#ref_mobile').text(data.mobile);
                $('#ref_address').text(data.current_address);
            })
            .then(() => {
                loader.hide();
            });
            setTimeout(function () {
                loader.hide();
            }, 5000);
    });

    $('#number_of_passport').bind("keyup change", function(event) {
        let loader = Vue.$loading.show();
        let number = event.target.value;
        let html = `
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">
                                        Full Name *
                                    </label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" id="full_name[]" name="passport[full_name][]"
                                               value="" placeholder="Full Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">
                                        Passport Number *
                                    </label>
                                    <div class="col-9">
                                        <input class="form-control" type="text" id="passport_no[]" name="passport[passport_no][]"
                                               value="" placeholder="Passport Number" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Date Of Birth *</label>
                                    <div class="col-9">
                                        <input class="form-control kt-datepicker" type="text" id="date_of_birth[]" name="passport[date_of_birth][]"
                                            autocomplete="off"
                                            value="" placeholder="Date Of Birth" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">Expiry Date *</label>
                                    <div class="col-9">
                                        <input class="form-control kt-datepicker" type="text" id="expiry_date[]" name="passport[expiry_date][]"
                                            autocomplete="off"
                                            value="" placeholder="" required>
                                        <span class="form-text text-danger" id="calculated_passport_expiry"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
        document.getElementById("list_of_passports").innerHTML = '';
        for (let i = 0; i < number; i++) {
            let el = document.createElement('div');
            el.classList.add('card', 'mt-3');
            el.innerHTML = html;
            document.getElementById("list_of_passports").appendChild(el);
        }
        KTBootstrapDatepicker.init();
        setTimeout(function () {
            loader.hide();
        }, 400);
    });
});
