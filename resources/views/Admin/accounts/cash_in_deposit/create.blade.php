@extends('Admin.layouts.app')

@php
    if (isset($hajj_payment->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $hajj_payment->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
        $hajj_payment = new \App\HajjPayment();
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($hajj_payment->id))
    @section('page_tagline', 'Update '.$controllerInfo->title)
@else
    @section('page_tagline', 'Add '.$controllerInfo->title)
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet" id="deposit_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($hajj_payment->id)) Update @else Add @endif {{$controllerInfo->title}}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="menu-form" action="{{ route('save-cash-deposit') }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                
               
               
               
                
                <div class="form-group row">
                    <label for="type" class="col-2 col-form-label">Payment Type *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                v-model="paymentType"
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
                        Depositor Name/Purpose *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="depositor_name" name="depositor_name"
                               value="{{ old('depositor_name', $hajj_payment->depositor_name) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row" v-if="paymentType == 2">
                    <label for="bank_name" class="col-2 col-form-label">
                        Bank Name *
                    </label>
                    <div class="col-10">

                         
                         <select class="form-control"  name="bank" required="" >
                        <option value="">--Select Bank--</option>
                        @foreach($banks as $bank)
                            <option value="{{$bank->b_id}}">{{$bank->bank_name}}</option>
                        @endforeach
                    </select>




                       <!--  <input class="form-control" type="text" id="bank_name" name="bank_name"
                               value="{{ old('bank_name', $hajj_payment->bank_name) }}" placeholder="" required> -->
                    </div>
                </div>
                <div class="form-group row" v-if="paymentType == 2">
                    <label for="bank_branch_name" class="col-2 col-form-label">
                        Bank Branch Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="bank_branch_name" name="bank_branch_name"
                               value="{{ old('bank_branch_name', $hajj_payment->bank_branch_name) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row" v-if="paymentType == 2">
                    <label for="cheque_number" class="col-2 col-form-label">
                        Cheque Number
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="cheque_number" name="cheque_number"
                               value="{{ old('cheque_number', $hajj_payment->cheque_number) }}" placeholder="">
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
                        Amount *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="amount" name="amount"
                               value="{{ old('amount', $hajj_payment->amount) }}" placeholder="" required>
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
                                <a href="{{ route('cash-in-deposit') }}"
                                   class="btn btn-primary">Back To Cash Deposit List</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <input type="reset" class="btn btn-secondary" value="Reset">
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
            $('#accounts-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#deposit-list-sm').addClass('kt-menu__item--active');
        });

        var paymentType = '{{ old('type', $hajj_payment->type) ? old('type', $hajj_payment->type) : 1 }}';
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/accounts/deposit.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
