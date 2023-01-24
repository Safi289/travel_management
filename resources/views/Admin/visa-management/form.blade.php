@extends('Admin.layouts.app')

@php
    if (isset($customerVisa->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $customerVisa->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($customerVisa->id))
    @section('page_tagline', 'Update '.$controllerInfo->title)
@else
    @section('page_tagline', 'Create '.$controllerInfo->title)
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($customerVisa->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($customerVisa->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="customer_name" class="col-2 col-form-label">
                        Customer Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="customer_name" name="customer_name"
                               value="{{ old('customer_name', $customerVisa->customer_name) }}" placeholder="Customer Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="visa_fee" class="col-2 col-form-label">Visa Fee *</label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="visa_fee" name="visa_fee"
                               value="{{ old('visa_fee', $customerVisa->visa_fee) }}" placeholder="1000.00" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="service_charge" class="col-2 col-form-label">Service Charge *</label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="service_charge" name="service_charge"
                               value="{{ old('service_charge', $customerVisa->service_charge) }}" placeholder="100.00" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_visa_type_id" class="col-2 col-form-label">Visa Type *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                name="customer_visa_type_id"
                                id="customer_visa_type_id" required>
                            <option
                                value=""
                                {{ old('customer_visa_type_id', $customerVisa->customer_visa_type_id) === null ? 'selected' : '' }}>
                                Select Visa Type
                            </option>
                            @foreach($visaTypes as $visaType)
                                <option
                                    value="{{ $visaType->id }}"
                                    {{ old('customer_visa_type_id', $customerVisa->customer_visa_type_id) == $visaType->id ? 'selected' : '' }}>
                                    {{ $visaType->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="visa_for_country" class="col-2 col-form-label">
                        Visa for Country *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="visa_for_country" name="visa_for_country"
                               value="{{ old('visa_for_country', $customerVisa->visa_for_country) }}" placeholder="Visa for Country" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passport_number" class="col-2 col-form-label">
                        Passport Number *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="passport_number" name="passport_number"
                               value="{{ old('passport_number', $customerVisa->passport_number) }}" placeholder="Passport Number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="visa_collect_from" class="col-2 col-form-label">Visa Collect From</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" id="visa_collect_from"
                                  name="visa_collect_from"
                                  rows="5"
                                  placeholder="Visa Collect From">{{ old('visa_collect_from', $customerVisa->visa_collect_from) }}</textarea>
                    </div>
                </div>
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
    <script>
        $(document).ready(function () {
            $('#visa-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#visa-management-sm').addClass('kt-menu__item--active');

            $('.kt-selectpicker').selectpicker();
        });
    </script>
@endpush
