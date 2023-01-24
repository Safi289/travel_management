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
    <div class="kt-portlet kt-portlet--mobile" id="deposit_page">
        @include('Admin.accounts.deposit.change-status-modal')
        @include('Admin.accounts.deposit.payment-list-modal')
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $controllerInfo->title }} List
                    </h3>
            </div>
            <div class="float-right mt-3">

            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table id="deposits-list-table" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Serial No.</th>
                    <th>Year</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Departure Status</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Payment Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hajis as $haji)
                    <tr id="tr-{{ $haji->id }}">
                        <td scope="row">{{ $haji->customer ? $haji->customer->full_name : '' }}</td>
                        <td>{{ $haji->serial_no }}</td>
                        <td>{{ $haji->year }}</td>
                        <td>{{ $haji->start_date }}</td>
                        <td>{{ $haji->end_date }}</td>
                        <td>{{ $haji->departure_status_title }}</td>
                        <td>{{ $haji->paid_amount }}</td>
                        <td>{{ $haji->due_amount }}</td>
                        <td>{{ $haji->payment_status_title }}</td>
                        <td class="text-center">
                            <a href="{{ route($controllerInfo->routeNamePrefix . '.add-payment', $haji->id) }}" class="btn btn-success btn-sm btn-icon-sm btn-circle"
                               data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="Add Payment">
                                <i class="fab fa-cc-amazon-pay"></i>
                            </a>
                            {{--<a href="{{ route($controllerInfo->routeNamePrefix . '.show', $haji->id) }}" class="btn btn-warning btn-sm btn-icon-sm btn-circle"
                               data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="View Payments">
                                <i class="fas fa-money-bill"></i>
                            </a>--}}
                            <button type="button" class="btn btn-warning btn-sm btn-icon-sm btn-circle"
                                    data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="View Payments"
                                    @click="getPaymentDetails({{$haji->id}})">
                                <i class="fas fa-money-bill"></i>
                            </button>
                            <button type="button" class="btn btn-skype btn-sm btn-icon-sm btn-circle change-status-button" data-id="{{ $haji->id }}"
                                    data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="Change Status"
                                    @click="getPaymentStatus({{$haji->id}})">
                                <i class="fas fa-toggle-on"></i>
                            </button>
                            {{--<a href="{{ route($controllerInfo->routeNamePrefix . '.edit', $haji->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>--}}
                            {{--<button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $haji->id }}">
                                <i class="flaticon-delete"></i>
                            </button>--}}
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
            $('#accounts-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#deposit-list-sm').addClass('kt-menu__item--active');
            $('#deposits-list-table').DataTable({
                responsive: true
            });
        });
        var paymentType = '1';
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/accounts/deposit.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
