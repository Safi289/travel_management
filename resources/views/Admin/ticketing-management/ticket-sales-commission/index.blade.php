@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', $controllerInfo->title)
@section('page_tagline', $controllerInfo->title)

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <form id="filter_form" method="GET" style="display: contents;">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile kt-portlet--collapsed" data-ktportlet="true" id="kt_portlet_tools_6">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $controllerInfo->title }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-group">
                        <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-default btn-icon-md"><i class="la la-angle-down"></i></a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="start_date" class="col-12 col-form-label">Start Date</label>
                            <div class="col-12">
                                <input class="form-control kt-datepicker" type="text" id="start_date" name="start_date"
                                       value="{{ request('start_date') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="end_date" class="col-12 col-form-label">End Date</label>
                            <div class="col-12">
                                <input class="form-control kt-datepicker" type="text" id="end_date" name="end_date"
                                       value="{{ request('end_date') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile" data-ktportlet="true" id="kt_portlet_tools_6">
            <div class="kt-portlet__body">
                <div class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length">
                                <label>Show
                                    <select class="custom-select custom-select-sm form-control form-control-sm" name="perPage" onchange="submitForm()">
                                        <option value="10" {{ request('perPage') == '10' ? 'selected' : '' }}>10
                                        </option>
                                        <option value="25" {{ request('perPage') == '25' ? 'selected' : '' }}>25
                                        </option>
                                        <option value="50" {{ request('perPage') == '50' ? 'selected' : '' }}>50
                                        </option>
                                        <option value="100" {{ request('perPage') == '100' ? 'selected' : '' }}>100
                                        </option>
                                    </select> entries</label>
                            </div>
                        </div>
                        {{--<div class="col-sm-12 col-md-6">
                            <div class="dataTables_filter">
                                <label>Search:<input type="search" class="form-control form-control-sm" placeholder=""></label>
                            </div>
                        </div>--}}
                    </div>
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th>Ticket No</th>
                            <th>Passenger Name</th>
                            <!-- <th>Amount Sales</th>
                            <th>Tax (15%)</th>
                            <th>Sales Commission (7%)</th>
                            <th>AIT Charge (3%)</th> -->
                            <th>Fare Amount</th>
                            <th>Commission</th>
                            <th>Tax</th>
                            <th>AIT</th>
                            <th>Service Charge</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ticketSales as $ticketSale)
                            <tr id="tr-{{ $ticketSale->id }}">
                                <td class="text-center">{{ $ticketSale->ticket_no }}</td>
                                <td class="text-center">{{ $ticketSale->passenger_name }}</td>
                                <td>{{ $ticketSale->fare_amount }}</td>
                                <td>{{ $ticketSale->farecommission }}</td>
                                <td>{{ $ticketSale->tax }}</td>
                                <td>{{ $ticketSale->fare_tax }}</td>
                                <td>{{ $ticketSale->service_charge }}</td>
                                <td>{{ $ticketSale->total }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                       <!--  <tr class="font-weight-bold">
                            <td colspan="3" class="text-right">Total</td>
                            <td>{{ $ticketSalesSum->sum_tax_amount }}</td>
                            <td>{{ $ticketSalesSum->sum_sales_commission }}</td>
                            <td>{{ $ticketSalesSum->sum_ait_charge }}</td>
                        </tr> -->
                        </tfoot>
                    </table>
                    <!--end: Datatable -->

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                Showing {{$ticketSales->currentPage()*$ticketSales->perPage()-$ticketSales->perPage()+1}}
                                to {{ ($ticketSales->currentPage()*$ticketSales->perPage()>$ticketSales->total())?$ticketSales->total():$ticketSales->currentPage()*$ticketSales->perPage()}}
                                of {{$ticketSales->total()}} entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                {{ $ticketSales->appends(Request::except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')
    <!-- Datatables -->
    <script src="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}" type="text/javascript"></script>
    <script>
        function submitForm() {
            $('#filter_form').submit();
        }

        $(document).ready(function () {
            $('#ticket-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#ticket-sales-commission-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
