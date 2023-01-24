@extends('Admin.layouts.app')

@section('page_title', $hajj_type . ' Payment')
@if(isset($hajj_payment->id))
    @section('page_tagline', 'Update '.$hajj_type.' Payment')
@else
    @section('page_tagline', 'Add '.$hajj_type.' Payment')
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($hajj_payment->id)) Update @else Add @endif {{$hajj_type}} Payment
                </h3>
            </div>
        </div>

    @php
        if (isset($hajj_payment->id)){
            $route = $hajj_type == 'Haji' ? route('hajj-payment.update', $hajj_payment->id) : route('omra-hajj-payment.update', $hajj_payment->id);
        }else {
            $route = $hajj_type == 'Haji' ? route('hajj-payment.store') : route('omra-hajj-payment.store');
            $hajj_payment = new \App\HajjPayment();
        }
    @endphp
    <!--begin::Form-->
        <form id="menu-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($hajj_payment->id)) @method('PUT') @endif
                <input type="hidden" name="hajj_id" value="{{ $haji->id }}">
                <div class="form-group row">
                    <label for="full_name" class="col-2 col-form-label">Customer </label>
                    <div class="col-10">
                        <div class="form-control">{{ $haji->customer ? $haji->customer->full_name : '' }}</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="package_name" class="col-2 col-form-label">Chosen Package </label>
                    <div class="col-10">
                        <div class="form-control">{{ $haji->package_id ? $haji->package->package_name : '' }}</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="voucher_name" class="col-2 col-form-label">
                        Voucher Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="voucher_name" name="voucher_name"
                               value="{{ old('voucher_name', $hajj_payment->voucher_name) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-2 col-form-label">Payment Type *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                name="type"
                                id="type">
                                <option
                                    value="1"
                                    {{ old('type', $hajj_payment->type) == 1 ? 'selected' : '' }}>
                                    Cash
                                </option>
                                <option
                                    value="2"
                                    {{ old('type', $hajj_payment->type) == 2 ? 'selected' : '' }}>
                                    Bank/Cheque
                                </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="depositor_name" class="col-2 col-form-label">
                        Depositor Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="depositor_name" name="depositor_name"
                               value="{{ old('depositor_name', $hajj_payment->depositor_name) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bank_name" class="col-2 col-form-label">
                        Bank Name
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="bank_name" name="bank_name"
                               value="{{ old('bank_name', $hajj_payment->bank_name) }}" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bank_branch_name" class="col-2 col-form-label">
                        Bank Branch Name
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="bank_branch_name" name="bank_branch_name"
                               value="{{ old('bank_branch_name', $hajj_payment->bank_branch_name) }}" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deposit_date" class="col-2 col-form-label">Deposit Date *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="deposit_date" name="deposit_date"
                               value="{{ old('deposit_date', $hajj_payment->deposit_date) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-2 col-form-label">
                        Amount
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="amount" name="amount"
                               value="{{ old('amount', $hajj_payment->amount) }}" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-2 col-form-label">Payment Status *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                name="status"
                                id="status">
                            <option
                                value="0"
                                {{ old('status', $hajj_payment->status) == 0 ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option
                                value="1"
                                {{ old('status', $hajj_payment->status) == 1 ? 'selected' : '' }}>
                                Paid
                            </option>
                        </select>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ $hajj_type == 'Haji' ? route('hajj-payment.index') : route('omra-hajj-payment.index') }}"
                                   class="btn btn-primary">Cancel</a>
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
            @if($hajj_type == 'Haji')
            $('#hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#all-haji-information-sm').addClass('kt-menu__item--active');
            @else
            $('#omra-hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#all-omra-haji-information-sm').addClass('kt-menu__item--active');
            @endif
        });
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/hajj-payment.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
