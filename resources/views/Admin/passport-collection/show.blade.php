@extends('Admin.layouts.app')

@section('page_title', $controllerInfo->title)
@if(isset($passport_collection->id))
    @section('page_tagline', 'Update ' . $controllerInfo->title)
@else
    @section('page_tagline', 'Create ' . $controllerInfo->title)
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    View {{ $controllerInfo->title }}
                </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route($controllerInfo->routeNamePrefix . '.pdf', $passport_collection->id) }}" class="btn btn-secondary btn-sm btn-upper" target="_blank">
                    <i class="flaticon2-printer"></i> Print
                </a>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="card" style="background: #20c9b81a">
              <div class="card-body">
                  <div class="row">
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
              </div>
            </div>

            @if (isset($passport_collection->id))
                @foreach($passport_collection->submitted_passports as $passport)
                    <div class="card mt-3" id="passport-{{ $passport->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">
                                            Full Name *
                                        </label>
                                        <div class="col-9">
                                            <p class="form-control">{{ $passport->full_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">
                                            Passport Number *
                                        </label>
                                        <div class="col-9">
                                            <p class="form-control">{{ $passport->passport_no }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Date Of Birth *</label>
                                        <div class="col-9">
                                            <p class="form-control">{{ \Carbon\Carbon::parse($passport->date_of_birth)->format('d-M-Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Expiry Date *</label>
                                        <div class="col-9">
                                            <p class="form-control">{{ \Carbon\Carbon::parse($passport->expiry_date)->format('d-M-Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
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
