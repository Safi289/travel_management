@extends('Admin.layouts.app')

@php
    if (isset($ticketSale->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $ticketSale->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
        $ticketSale = new \App\TicketSale();
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($ticketSale->id))
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
                    @if(isset($ticketSale->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($ticketSale->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="ticketing_airline_id" class="col-2 col-form-label text-right">
                        Airlines Name *
                    </label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" data-size="10"
                                data-live-search="true"
                                name="ticketing_airline_id" id="ticketing_airline_id"
                                @change="getPresentPoliceStation($event)">
                            <option value="">Select Airlines</option>
                            @foreach($ticketingAirlines as $airlines)
                                <option
                                    value="{{ $airlines->id }}"
                                    {{ old('ticketing_airline_id', $ticketSale->ticketing_airline_id) == $airlines->id ? 'selected' : '' }}>
                                    {{ $airlines->airlines_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ticket_no" class="col-2 col-form-label">
                        Ticket No *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="ticket_no" name="ticket_no"
                               value="{{ old('ticket_no', $ticketSale->ticket_no) }}" placeholder="Airlines Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passenger_name" class="col-2 col-form-label">Passenger Name *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="passenger_name" name="passenger_name"
                               value="{{ old('passenger_name', $ticketSale->passenger_name) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sector" class="col-2 col-form-label">Sector *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="sector" name="sector"
                               value="{{ old('sector', $ticketSale->sector) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="flight_date" class="col-2 col-form-label">Flight Date *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="flight_date" name="flight_date"
                               value="{{ old('flight_date', $ticketSale->flight_date) }}" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="class" class="col-2 col-form-label">Class *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="class" name="class"
                               value="{{ old('class', $ticketSale->class) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pax_type" class="col-2 col-form-label">Pax Type *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="pax_type" name="pax_type"
                               value="{{ old('pax_type', $ticketSale->pax_type) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sales_date" class="col-2 col-form-label">Sales Date *</label>
                    <div class="col-10">
                        <input class="form-control " type="date" id="sales_date" name="sales_date"
                               value="{{ old('sales_date', $ticketSale->sales_date) }}" autocomplete="off" required>
                    </div>
                </div>
               <!--  <div class="form-group row">
                    <label for="amount_sales" class="col-2 col-form-label">Sales Amount *</label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="amount_sales" name="amount_sales"
                               value="{{ old('amount_sales', $ticketSale->amount_sales) }}" placeholder="" required>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="" class="col-2 col-form-label">Fare Amount *</label>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="fare_amount" name="fare_amount" value="{{ old('fare_amount', $ticketSale->fare_amount) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-2 col-form-label">Commission(%) *</label>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="commission" name="commission" value="{{ old('commission', $ticketSale->commission) }}">
                    </div>
                     <div class="col-5">
                        <input class="input form-control" type="number" id="farecommission" name="farecommission" value="{{ old('farecommission', $ticketSale->farecommission) }}">
                    </div>   
                </div>

                <div class="form-group row">
                    <label for="" class="col-2 col-form-label">Tax *</label>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="tax" name="tax" value="{{ old('tax', $ticketSale->tax) }}">
                    </div>
                </div>

                 <div class="form-group row">
                    <label for="" class="col-2 col-form-label">AIT(%) *</label>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="ait" name="ait" value="{{ old('ait', $ticketSale->ait) }}">
                    </div>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="fare_tax" name="fare_tax" value="{{ old('fare_tax', $ticketSale->fare_tax) }}">
                    </div>
                </div>

                 <div class="form-group row">
                    <label for="" class="col-2 col-form-label">Service Charge *</label>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="service_charge" name="service_charge" value="{{ old('service_charge', $ticketSale->service_charge) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-5">
                        
                    </div>
                     <label for="" class="col-2 col-form-label">Total</label>
                    <div class="col-5">
                        <input class="input form-control" type="number" id="total" name="total" readonly="" value="{{ old('total', $ticketSale->total) }}">
                    </div>
                </div>




                <div class="form-group row">
                    <label for="invoice_no" class="col-2 col-form-label">Invoice No *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="invoice_no" name="invoice_no"
                               value="{{ old('invoice_no', $ticketSale->invoice_no) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sales_user_address" class="col-2 col-form-label">Sales User Address</label>
                    <div class="col-10">
                        <textarea class="form-control" id="sales_user_address"
                                  name="sales_user_address"
                                  rows="5"
                                  placeholder="Address">{{ old('sales_user_address', $ticketSale->sales_user_address) }}</textarea>
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
            $('#ticket-sales-sm').addClass('kt-menu__item--active');
        });
    </script>

    <!-- calculate commission in fare amount -->
    <script>
        $(".input").on('input', function(){
            var fare = document.getElementById('fare_amount').value;
            fare = parseFloat(fare);

            var commission = document.getElementById('commission').value;
            commission = parseFloat(commission);

            document.getElementById('farecommission').value = ((fare * commission)/100);
        });
    </script>

    <!-- calculate ait in fare+tax amount -->
    <script>
        $(".input").on('input', function(){
            var ait = document.getElementById('ait').value;
            ait = parseFloat(ait);

            var fare = document.getElementById('fare_amount').value;
            fare = parseFloat(fare);

            var tax = document.getElementById('tax').value;
            tax = parseFloat(tax);

            var sum = (fare+tax);
            document.getElementById('fare_tax').value = ((ait * sum)/100);
        });
    </script>

    <!-- calculate total amount -->
    <script>
        $(".input").on('input', function(){
            var fare = document.getElementById('fare_amount').value;
            fare = parseFloat(fare);

            var tax = document.getElementById('tax').value;
            tax = parseFloat(tax);

            var service =  document.getElementById('service_charge').value;
            service = parseFloat(service);

            var fare_commission = document.getElementById('farecommission').value;
            fare_commission = parseFloat(fare_commission);

            var fare_tax = document.getElementById('fare_tax').value;
            fare_tax = parseFloat(fare_tax);

            document.getElementById('total').value = (fare + tax + service + fare_commission +fare_tax);
        });
    </script>

    
@endpush
