<!--begin: Form Wizard Step 1-->
<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
    @csrf
    @if(isset($customer->id)) @method('PUT') @endif
    <div class="row">
        <div class="col-6">
            <div class="form-group row">
                <label for="sur_name"
                       class="col-3 col-form-label text-right text-right">
                    Surname *
                </label>
                <div class="col-9">
                    <input class="form-control" type="text" id="sur_name"
                           name="sur_name"
                           value="{{ old('sur_name', $customer->sur_name) }}"
                           onkeyup="this.value = this.value.toUpperCase();"
                           placeholder="Surname" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="given_name"
                       class="col-3 col-form-label text-right text-right">
                    Given Name *
                </label>
                <div class="col-9">
                    <input class="form-control" type="text" id="given_name"
                           name="given_name"
                           value="{{ old('given_name', $customer->given_name) }}"
                           onkeyup="this.value = this.value.toUpperCase();"
                           placeholder="Given Name" required>
                </div>
            </div>
            @if(isset($customer->id))
                <div class="form-group row">
                    <label for="tracking_no"
                           class="col-3 col-form-label text-right">
                        Tracking No.
                    </label>
                    <div class="col-9">
                        <div class="form-control">{{ $customer->tracking_no }}</div>
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label for="date_of_birth" class="col-3 col-form-label text-right">
                    Date of Birth *
                </label>
                <div class="col-9">
                    <input class="form-control" type="text" id="date_of_birth"
                           name="date_of_birth"
                           value="{{ \Carbon\Carbon::parse(old('date_of_birth', $customer->date_of_birth))->format('d-M-Y') }}"
                           placeholder="Date of Birth" required>
                    <span class="form-text text-danger" id="calculated_age"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-3 col-form-label text-right">Gender
                    *</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker" name="gender"
                            id="gender"
                            @change="changeGender($event)">
                        <option
                            value="1" {{ old('gender', $customer->gender) !== 2 ? 'selected' : '' }}>
                            Male
                        </option>
                        <option
                            value="2" {{ old('gender', $customer->gender) === 2 ? 'selected' : '' }}>
                            Female
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="marital_status" class="col-3 col-form-label text-right">
                    Marital Status *</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker"
                            name="marital_status"
                            id="marital_status" required>
                        <option
                            value="1" {{ old('marital_status', $customer->marital_status) !== 2 || old('marital_status', $customer->marital_status) !== 3 ? 'selected' : '' }}>
                            Single
                        </option>
                        <option
                            value="2" {{ old('marital_status', $customer->marital_status) === 2 ? 'selected' : '' }}>
                            Married
                        </option>
                        <option
                            value="3" {{ old('marital_status', $customer->marital_status) === 3 ? 'selected' : '' }}>
                            Others
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="type" class="col-3 col-form-label text-right">Type
                    *</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker" name="type"
                            id="type"
                            @change="changeType($event)">
                        <option
                            value="1" {{ old('type', $customer->type) !== 2 ? 'selected' : '' }}>
                            Individual
                        </option>
                        <option
                            value="2" {{ old('type', $customer->type) === 2 ? 'selected' : '' }}>
                            Group
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row" v-if="type == 2">
                <label for="group_id" class="col-3 col-form-label text-right">
                    Group *
                </label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker" data-size="7"
                            data-live-search="true"
                            name="group_id" id="group_id"
                            @change="getGrpupId($event)">
                        <option
                            value=""
                            {{ old('group_id', $customer->group_id) === null ? 'selected' : '' }}>
                            Select a Group
                        </option>
                        @foreach($groups as $group)
                            <option
                                value="{{ $group->id }}"
                                {{ old('group_id', $customer->group_id) === $group->id ? 'selected' : '' }}>
                                {{ $group->group_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="management"
                       class="col-3 col-form-label text-right">Management</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker" name="management"
                            id="management">
                        <option
                            value="1" {{ old('management', $customer->management) == 1 ? 'selected' : '' }}>
                            Jurain Office
                        </option>
                        <option
                            value="2" {{ old('management', $customer->management) == 2 ? 'selected' : '' }}>
                            Mohammadpur Office
                        </option>
                        <option
                            value="3" {{ old('management', $customer->management) == 3 ? 'selected' : '' }}>
                            Group Leader
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile"
                       class="col-3 col-form-label text-right">Mobile *</label>
                <div class="col-9">
                    <input class="form-control" type="number" id="mobile"
                           name="mobile"
                           value="{{ old('mobile', $customer->mobile) }}"
                           placeholder="017XXXXXXXX"
                           maxlength="11"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           @keyup="validateMobile()"
                           v-model="validateMobileData.input">
                    <span class="form-text text-danger" v-if="validateMobileData.hasError">@{{ validateMobileData.message }}</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label for="service_type_id"
                       class="col-4 col-form-label text-right">
                    Service Type *
                </label>
                <div class="col-8">
                    <select class="form-control kt-selectpicker"
                            name="service_type_id" id="service_type_id">
                        @foreach($service_types as $service_type)
                            <option
                                value="{{ $service_type->id }}"
                                {{ old('passport_id', $customer->service_type_id) == $service_type->id ? 'selected' : '' }}>
                                {{ $service_type->service_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if(!$customer->id)
                @php
                    if ($customer->passport){
                        $passport = $customer->passport;
                    }else {
                        $passport = new \App\CustomerPassport();
                    }
                @endphp
                <div class="form-group row">
                    <label for="passport_no" class="col-4 col-form-label text-right">
                        Passport No
                    </label>
                    <div class="col-8">
                        <input class="form-control" type="text"
                               id="passport_no" name="passport_no"
                               value="{{ old('passport_no', $passport->passport_no) }}"
                               placeholder=""
                               @keyup="validatePassport()"
                               v-model="validatePassportNoData.input">
                        <span class="form-text text-danger" v-if="validatePassportNoData.hasError">@{{ validatePassportNoData.message }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passport_type" class="col-4 col-form-label text-right">
                        Passport Type
                    </label>
                    <div class="col-8">
                        <select class="form-control kt-selectpicker"
                                name="passport_type" id="passport_type">
                            <option
                                value="1" {{ old('passport_type', $passport->passport_type) == 1 || old('passport_type', $passport->passport_type) == null ? 'selected' : '' }}>
                                General
                            </option>
                            <option
                                value="2" {{ old('passport_type', $passport->passport_type) == 2 ? 'selected' : '' }}>
                                Government
                            </option>
                            <option
                                value="3" {{ old('passport_type', $passport->passport_type) == 3 ? 'selected' : '' }}>
                                Others
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="issue_date"
                           class="col-4 col-form-label text-right">
                        Passport Issue Data
                    </label>
                    <div class="col-8">
                        <input class="form-control kt-datepicker" type="text"
                               id="issue_date" name="issue_date"
                               value="{{ \Carbon\Carbon::parse(old('issue_date', $passport->issue_date))->format('d-m-Y') }}"
                               placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiry_date"
                           class="col-4 col-form-label text-right">
                        Passport Expiry Data
                    </label>
                    <div class="col-8">
                        <input class="form-control kt-datepicker" type="text"
                               id="expiry_date" name="expiry_date"
                               value="{{ \Carbon\Carbon::parse(old('expiry_date', $passport->expiry_date))->format('d-m-Y') }}"
                               placeholder="">
                        <span class="form-text text-danger" id="calculated_passport_expiry"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="issue_location"
                           class="col-4 col-form-label text-right">
                        Issue Location
                    </label>
                    <div class="col-8">
                        <input class="form-control" type="text"
                               id="issue_location" name="issue_location"
                               value="{{ old('issue_location', $passport->issue_location) }}"
                               placeholder="">
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <label for="passport_id"
                           class="col-4 col-form-label text-right">
                        Select Passport
                    </label>
                    <div class="col-8">
                        <select class="form-control kt-selectpicker" data-size="7"
                                data-live-search="true"
                                name="passport_id"
                                id="passport_id">
                            <option
                                value=""
                                {{ old('passport_id', $customer->passport_id) === null ? 'selected' : '' }}>
                                Select a Passport
                            </option>
                            @foreach($passports as $passport)
                                <option
                                    value="{{ $passport->id }}"
                                    {{ old('passport_id', $customer->passport_id) == $passport->id ? 'selected' : '' }}>
                                    {{ $passport->passport_no }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!--end: Form Wizard Step 1-->
