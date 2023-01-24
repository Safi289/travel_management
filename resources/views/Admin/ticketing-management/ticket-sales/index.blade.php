@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', $controllerInfo->title)
@section('page_tagline', $controllerInfo->title . ' List')

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $controllerInfo->title }} List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route($controllerInfo->routeNamePrefix . '.create') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New {{ $controllerInfo->title }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Airlines Name</th>
                    <th>Ticket No</th>
                    <th>Passenger Name</th>
                    <th>Sector</th>
                    <th>Flight Date</th>
                    <th>Class</th>
                    <th>Pax Type</th>
                    <th>Amount Total</th>
                    <th>Invoice No</th>
                    <th>Sales Date</th>
                    <th>Sales By</th>
                    <th>Sales User Address</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ticketSales as $ticketSale)
                    <tr id="tr-{{ $ticketSale->id }}">
                        @if($ticketSale->airline)
                        <td scope="row">{{ $ticketSale->airline->airlines_name }}</td>
                        @else
                        <td scope="row"></td>
                        @endif
                        <!-- <td class="text-center">{{ sprintf("VOU-%04d", $ticketSale->ticket_no)  }}</td> -->
                        <td class="text-center">{{ $ticketSale->airline->ticketing_serial.'-'.$ticketSale->ticket_no }}</td>
                        <td class="text-center">{{ $ticketSale->passenger_name }}</td>
                        <td>{{ $ticketSale->sector }}</td>
                        <td>{{ $ticketSale->flight_date }}</td>
                        <td>{{ $ticketSale->class }}</td>
                        <td>{{ $ticketSale->pax_type }}</td>
                        <td>{{ $ticketSale->total }}</td>
                        <td>{{ $ticketSale->invoice_no }}</td>
                        <td>{{ $ticketSale->sales_date }}</td>
                        @if($ticketSale->user)
                        <td>{{ $ticketSale->user->name }}</td>
                        @else
                        <td></td>
                        @endif
                        <td>{{ $ticketSale->sales_user_address }}</td>
                        <td class="text-center">
                            {{--<a href="{{ route($controllerInfo->routeNamePrefix . '.show', $ticketSale->id) }}" class="btn btn-success btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon-eye"></i>
                            </a>--}}
                            <a href="{{ route($controllerInfo->routeNamePrefix . '.edit', $ticketSale->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $ticketSale->id }}">
                                <i class="flaticon-delete"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <!--end::Portlet-->
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')
    <!-- Datatables -->
    <script src="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#ticket-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#ticket-sales-sm').addClass('kt-menu__item--active');
            $('.dataTable').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
