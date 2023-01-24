@extends('Admin.layouts.app')

@php
    if (isset($data->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $data->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
        $data = new \App\TicketRefund();
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($data->id))
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
                    @if(isset($data->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($data->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="ticket_sale_id" class="col-2 col-form-label text-right">
                        Ticket Sales *
                    </label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" data-size="10"
                                data-live-search="true"
                                name="ticket_sale_id" id="ticket_sale_id"
                                @change="getPresentPoliceStation($event)">
                            <option value="">Select Ticket Sales</option>
                            @foreach($ticketSales as $airlines)
                                <option
                                    value="{{ $airlines->id }}"
                                    {{ old('ticket_sale_id', $data->ticket_sale_id) == $airlines->id ? 'selected' : '' }}>
                                    {{ $airlines->ticket_no }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="refund_amount" class="col-2 col-form-label">
                        Refund Amount *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="refund_amount" name="refund_amount"
                               value="{{ old('refund_amount', $data->refund_amount) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="refund_user_id" class="col-2 col-form-label text-right">
                        Refund By *
                    </label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" data-size="10"
                                data-live-search="true"
                                name="refund_user_id" id="refund_user_id"
                                @change="getPresentPoliceStation($event)">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option
                                    value="{{ $customer->id }}"
                                    {{ old('refund_user_id', $data->refund_user_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="refund_date" class="col-2 col-form-label">Refund Date *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="refund_date" name="refund_date"
                               value="{{ old('refund_date', $data->refund_date) }}" autocomplete="off" required>
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
            $('#ticket-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#ticket-refund-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
