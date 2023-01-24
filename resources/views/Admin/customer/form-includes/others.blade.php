<!--begin: Form Wizard Step 3-->
<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
    <div class="row">
        <div class="col-6">
            <div class="col-9 offset-3 mb-4">
                <div class="row">
                    <div class="col-6">
                        <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                            <div class="kt-avatar__holder" id="avatar__holder"
                                 style="@if($customer->photo)background-image: url('{{ asset('uploads/customers/images').'/'. $customer->photo }}');@endif
                                     background-size: contain; width: 150px; height: 200px;"></div>
                            <label class="kt-avatar__upload" data-toggle="kt-tooltip"
                                   title=""
                                   data-original-title="Photo">
                                <i class="fa fa-pen"></i>
                                <input type="file" name="photo" accept=".png, .jpg, .jpeg"
                                       id="photo" @change="loadFile($event)">
                            </label>
                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip"
                                  title=""
                                  data-original-title="Cancel avatar">
                                                                    <i class="fa fa-times"></i>
                                                                </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <p>
                            <b>Image Resolution: </b> 300 x 400 px <br/>
                            <b>Max Size: </b> 500KB
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="father_name" class="col-3 col-form-label text-right">Father's
                    Name
                    *</label>
                <div class="col-9">
                    <input class="form-control" type="text" id="father_name"
                           name="father_name"
                           value="{{ old('father_name', $customer->father_name) }}"
                           placeholder="Father's Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="mother_name" class="col-3 col-form-label text-right">Mother's
                    Name
                    *</label>
                <div class="col-9">
                    <input class="form-control" type="text" id="mother_name"
                           name="mother_name"
                           value="{{ old('mother_name', $customer->mother_name) }}"
                           placeholder="Mother's Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="resident_type" class="col-3 col-form-label text-right">Resident
                    Type</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker"
                            name="resident_type"
                            id="resident_type"
                            @change="changeResidentType($event)">
                        <option
                            value="Bangladeshi" {{ old('resident_type', $customer->resident_type) !== 'NRB' ? 'selected' : '' }}>
                            Bangladeshi
                        </option>
                        <option
                            value="NRB" {{ old('resident_type', $customer->resident_type) === 'NRB' ? 'selected' : '' }}>
                            NRB
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row" v-if="isNRB">
                <label for="nrb_residence_country" class="col-3 col-form-label text-right">
                    Residence Country *
                </label>
                <div class="col-9">
                    <input class="form-control" type="text" id="nrb_residence_country"
                           name="nrb_residence_country"
                           value="{{ old('nrb_residence_country', $customer->nrb_residence_country) }}"
                           placeholder="Country" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="identity" class="col-3 col-form-label text-right">Identity
                    Type</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker" name="identity"
                            id="identity"
                            @change="changeIdentityType($event)">
                        <option
                            value="1" {{ old('identity', $customer->identity) !== 2 ? 'selected' : '' }}>
                            NID
                        </option>
                        <option
                            value="2" {{ old('identity', $customer->identity) === 2 ? 'selected' : '' }}>
                            Birth Certificate
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row" v-if="identity == 1">
                <label for="nid_number" class="col-3 col-form-label text-right">NID
                    Number
                    *</label>
                <div class="col-9">
                    <input class="form-control" type="text" id="nid_number"
                           name="nid_number"
                           value="{{ old('nid_number', $customer->nid_number) }}"
                           placeholder="" required>
                </div>
            </div>
            <div class="form-group row" v-if="identity == 2">
                <label for="birth_certificate_number"
                       class="col-3 col-form-label text-right">Birth
                    Certificate Number *</label>
                <div class="col-9">
                    <input class="form-control" type="text"
                           id="birth_certificate_number"
                           name="birth_certificate_number"
                           value="{{ old('birth_certificate_number', $customer->birth_certificate_number) }}"
                           placeholder="" required>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label for="occupation"
                       class="col-3 col-form-label text-right">Occupation</label>
                <div class="col-9">
                    <select class="form-control kt-selectpicker" name="occupation"
                            id="occupation">
                        
                      
                         <option
                            value="Businessman" {{ old('occupation', $customer->occupation) === 'Businessman' || !old('occupation', $customer->occupation) ? 'selected' : '' }}>
                            Businessman
                        </option>
                         <option
                            value="Govt. Service" {{ old('occupation', $customer->occupation) === 'Govt. Service' || !old('occupation', $customer->occupation) ? 'selected' : '' }}>
                            Govt. Service
                        </option>
                        <option
                            value="Job Holder" {{ old('occupation', $customer->occupation) === 'Job Holde' ? 'selected' : '' }}>
                            Job Holder
                        </option>
                        <option
                            value="Self Employed" {{ old('occupation', $customer->occupation) === 'Self Employed' ? 'selected' : '' }}>
                            Self Employed
                        </option>
                        <option
                            value="Service Holder" {{ old('occupation', $customer->occupation) === 'Service Holder' ? 'selected' : '' }}>
                            Service Holder
                        </option>
                        <option
                            value="Housewife" {{ old('occupation', $customer->occupation) === 'Housewife' ? 'selected' : '' }}>
                            Housewife
                        </option>
                        <option
                            value="Student" {{ old('occupation', $customer->occupation) === 'Student' ? 'selected' : '' }}>
                            Student
                        </option>
                         <option
                            value="Unemployed" {{ old('occupation', $customer->occupation) === 'Unemployed' ? 'selected' : '' }}>
                            Unemployed
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="company_name"
                       class="col-3 col-form-label text-right">Company Name </label>
                <div class="col-9">
                    <input class="form-control" type="company_name"
                           id="company_name" name="company_name"
                           value="{{ old('company_name', $customer->company_name) }}"
                           placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="email"
                       class="col-3 col-form-label text-right">Email *</label>
                <div class="col-9">
                    <input class="form-control" type="email" id="email" name="email"
                           value="{{ old('email', $customer->email) }}"
                           placeholder="@">
                </div>
            </div>
            <div class="form-group row">
                <label for="spouse_name" class="col-3 col-form-label text-right">
                    Spouse Name
                </label>
                <div class="col-9">
                    <input class="form-control" type="text"
                           id="spouse_name" name="spouse_name"
                           value="{{ old('spouse_name', $customer->spouse_name) }}"
                           placeholder="Spouse Name">
                </div>
            </div>
            <section v-if="isGroup && (parseInt(type) === 2)">
                <div class="form-group row" v-if="gender == 2">
                    <label for="maharam_id" class="col-3 col-form-label text-right">
                        Maharam ID
                    </label>
                    <div class="col-9">
                        <select class="form-control kt-selectpicker" data-size="7"
                                data-live-search="true"
                                name="maharam_id"
                                id="maharam_id"
                                @change="getMahramId($event)">
                            <option value="">Select Maharam</option>
                            <option
                                v-for="mahram in mahramList"
                                :value="mahram.id"
                                :selected="(mahram.id === current_maharam_id) ? 'selected':''">
                                @{{ mahram.full_name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" v-if="hasMahram">
                    <label for="mahram_relation_id"
                           class="col-3 col-form-label text-right">
                        Maharam Relationship *
                    </label>
                    <div class="col-9">
                        <select class="form-control kt-selectpicker"
                                name="mahram_relation_id" id="mahram_relation_id">
                            @foreach($mahram_relationships as $mahram_relationship)
                                <option
                                    value="{{ $mahram_relationship->id }}"
                                    {{ old('passport_id', $customer->mahram_relation_id) == $mahram_relationship->id ? 'selected' : '' }}>
                                    {{ $mahram_relationship->relation_title }}
                                </option>1 
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dependent_id" class="col-3 col-form-label text-right">
                        Dependent ID
                    </label>
                    <div class="col-9">
                        <select class="form-control kt-selectpicker" data-size="7"
                                data-live-search="true"
                                name="dependent_id"
                                id="dependent_id">
                            <option value="">Select Dependent</option>
                            <option
                                v-for="dependent in dependentList"
                                :value="dependent.id"
                                :selected="(dependent.id === current_dependent_id) ? 'selected':''">
                                @{{ dependent.full_name }}
                            </option>
                        </select>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!--end: Form Wizard Step 3-->
