<!--begin: Form Wizard Step 2-->
<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
    <div class="row">
        <div class="col-6">
            <div class="kt-heading kt-heading--md text-center">
                Present Address Information
            </div>
            <div class="form-group row">
                <label for="current_district"
                       class="col-4 col-form-label text-right">
                    Current District *</label>
                <div class="col-8">
                    <select class="form-control kt-selectpicker" data-size="7"
                            data-live-search="true"
                            name="current_district" id="current_district"
                            @change="getPresentPoliceStation($event)">
                        <option value="">Select Present District</option>
                        @foreach($districts as $district)
                            <option
                                value="{{ $district->id }}"
                                {{ old('current_district', $customer->current_district) == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="current_police_station"
                       class="col-4 col-form-label text-right">
                    Current Police Station *</label>
                <div class="col-8">
                    <select class="form-control kt-selectpicker" data-size="7"
                            data-live-search="true"
                            name="current_police_station"
                            id="current_police_station">
                        <option value="">Select Present Police Station</option>
                        <option
                            v-for="policeStation in current_police_stations"
                            :value="policeStation.id"
                            :selected="(policeStation.id === current_police_station) ? 'selected':''">
                            @{{ policeStation.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="current_postcode"
                       class="col-4 col-form-label text-right">
                    Current Postcode</label>
                <div class="col-8">
                    <input class="form-control" type="number" id="current_postcode"
                           name="current_postcode"
                           value="{{ old('current_postcode', $customer->current_postcode) }}"
                           placeholder="0000">
                </div>
            </div>
            <div class="form-group row">
                <label for="current_address"
                       class="col-4 col-form-label text-right">Current Address</label>
                <div class="col-8">
                    <textarea class="form-control" type="text" id="current_address"
                              name="current_address"
                              rows="5"
                              placeholder="Address">{{ old('current_address', $customer->current_address) }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="kt-heading kt-heading--md text-center">
                Permanent Address Information
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label text-right">

                </label>
                <div class="col-8">
                    <label class="kt-checkbox">
                        <input type="checkbox" @change="setSamePermanentAddress($event)"> Same as present address
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label for="permanent_district"
                       class="col-4 col-form-label text-right">
                    Permanent District *</label>
                <div class="col-8">
                    <select class="form-control kt-selectpicker" data-size="7"
                            data-live-search="true"
                            name="permanent_district" id="permanent_district"
                            @change="getPermanentPoliceStation($event)">
                        <option value="">Select Present District</option>
                        @foreach($districts as $district)
                            <option
                                value="{{ $district->id }}"
                                {{ old('permanent_district', $customer->permanent_district) == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="permanent_police_station"
                       class="col-4 col-form-label text-right">
                    Permanent Police Station *</label>
                <div class="col-8">
                    <select class="form-control kt-selectpicker" data-size="7"
                            data-live-search="true"
                            name="permanent_police_station"
                            id="permanent_police_station">
                        <option value="">Select Present Police Station</option>
                        <option
                            v-for="policeStation in permanent_police_stations"
                            :value="policeStation.id"
                            :selected="(policeStation.id === permanent_police_station) ? 'selected':''">
                            @{{ policeStation.name }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="permanent_postcode"
                       class="col-4 col-form-label text-right">
                    Permanent Postcode</label>
                <div class="col-8">
                    <input class="form-control" type="number"
                           id="permanent_postcode"
                           name="permanent_postcode"
                           value="{{ old('permanent_postcode', $customer->permanent_postcode) }}"
                           placeholder="0000">
                </div>
            </div>
            <div class="form-group row">
                <label for="permanent_address"
                       class="col-4 col-form-label text-right">Permanent
                    Address</label>
                <div class="col-8">
                    <textarea class="form-control" type="text" id="permanent_address"
                              name="permanent_address"
                              rows="5"
                              placeholder="Address">{{ old('permanent_address', $customer->permanent_address) }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end: Form Wizard Step 2-->
