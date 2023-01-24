@extends('Admin.layouts.app')

@section('page_title', $controllerInfo->title)
@if(isset($passport_collection->id))
    @section('page_tagline', 'Update ' . $controllerInfo->title)
@else
    @section('page_tagline', 'Create ' . $controllerInfo->title)
@endif

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($passport_collection->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    @php
        if (isset($passport_collection->id)){
            $route = route($controllerInfo->routeNamePrefix . '.update', $passport_collection->id);
        }else {
            $route = route($controllerInfo->routeNamePrefix . '.store');
            $passport_collection = new \App\CustomerPassport();
        }
    @endphp
    <!--begin::Form-->
        <form id="menu-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($passport_collection->id)) @method('PUT') @endif
                <div class="card" style="background: #20c9b81a">
                  <div class="card-body">
                      <div class="row">
                          @if (isset($passport_collection->id))
                              <div class="col-6">
                                  <div class="form-group row">
                                      <label for="full_name" class="col-3 col-form-label">
                                          Ref. Customer
                                      </label>
                                      <div class="col-9">
                                          <p class="form-control" style="background: #f7f8fa">{{ $passport_collection->full_name }}</p>
                                      </div>
                                  </div>
                              </div>
                          @else
                              <div class="col-6">
                                  <div class="form-group row">
                                      <label for="reference_id" class="col-3 col-form-label">
                                          Ref. Customer *
                                      </label>
                                      <div class="col-9">
                                          <select class="form-control kt-selectpicker" data-size="10"
                                                  data-live-search="true"
                                                  name="reference_id" id="reference_id">
                                              <option value="">Select A Reference</option>
                                              @foreach($customers as $customer)
                                                  <option
                                                      value="{{ $customer->id }}"
                                                      {{ old('reference_id', $passport_collection->reference_id) == $customer->id ? 'selected' : '' }}>
                                                      {{ $customer->full_name }}
                                                  </option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          @endif
                          <div class="col-6">
                              <div class="form-group row">
                                  <label class="col-3 col-form-label">
                                      Group
                                  </label>
                                  <div class="col-9">
                                      <p class="form-control" style="background: #f7f8fa" id="ref_group">{{ $passport_collection->group ? $passport_collection->group->group_name : '' }}</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group row">
                                  <label class="col-3 col-form-label">
                                      Mobile No
                                  </label>
                                  <div class="col-9">
                                      <p class="form-control" style="background: #f7f8fa" id="ref_mobile">{{ $passport_collection->mobile }}</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group row">
                                  <label class="col-3 col-form-label">
                                      Address
                                  </label>
                                  <div class="col-9">
                                      <p class="form-control" style="background: #f7f8fa" id="ref_address">{{ $passport_collection->current_address }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-6">
                              <div class="form-group row">
                                  <label for="box_no" class="col-3 col-form-label">Box Number</label>
                                  <div class="col-9">
                                      <input class="form-control" type="text" id="box_no" name="box_no"
                                      value="{{ $passport_collection->submitted_passports ? $passport_collection->submitted_passports()->first()->box_no : '' }}">
                                  </div>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group row">
                                  <label for="number_of_passport" class="col-3 col-form-label">Add Number of Passports</label>
                                  <div class="col-9">
                                      <input class="form-control" type="number" min="1" max="10" id="number_of_passport" name="number_of_passport">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

                @if (isset($passport_collection->id))
                    @foreach($passport_collection->submitted_passports as $passport)
                        <div class="card mt-3" id="passport-{{ $passport->id }}">
                            <input type="hidden" name="passport_id[]" value="{{ $passport->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="full_name[]" class="col-3 col-form-label">
                                                        Full Name *
                                                    </label>
                                                    <div class="col-9">
                                                        <input class="form-control" type="text" id="full_name[]" name="passport[full_name][]"
                                                               value="{{ old('full_name[]', $passport->full_name) }}" placeholder="Full Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="passport_no[]" class="col-3 col-form-label">
                                                        Passport Number *
                                                    </label>
                                                    <div class="col-9">
                                                        <input class="form-control" type="text" id="passport_no[]" name="passport[passport_no][]"
                                                               value="{{ old('passport_no[]', $passport->passport_no) }}" placeholder="Passport Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="date_of_birth[]" class="col-3 col-form-label">Date Of Birth *</label>
                                                    <div class="col-9">
                                                        <input class="form-control kt-datepicker" type="text" id="date_of_birth[]" name="passport[date_of_birth][]"
                                                               value="{{ \Carbon\Carbon::parse(old('date_of_birth[]', $passport->date_of_birth))->format('d-m-Y') }}" placeholder="Date Of Birth" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="expiry_date[]" class="col-3 col-form-label">Expiry Date *</label>
                                                    <div class="col-9">
                                                        <input class="form-control kt-datepicker" type="text" id="expiry_date[]" name="passport[expiry_date][]"
                                                               value="{{ \Carbon\Carbon::parse(old('expiry_date[]', $passport->expiry_date))->format('d-m-Y') }}" placeholder="" required>
                                                        <span class="form-text text-danger" id="calculated_passport_expiry"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $passport->id }}">
                                            <i class="flaticon-delete"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                @endif
                <section id="list_of_passports"></section>


                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route($controllerInfo->routeNamePrefix . '.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    @include('Admin.passport-collection.delete')
    <script>
        $(document).ready(function () {
            $('#passport-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#passport-collection-sm').addClass('kt-menu__item--active');
        });
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/common/common.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/passport-collection.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
