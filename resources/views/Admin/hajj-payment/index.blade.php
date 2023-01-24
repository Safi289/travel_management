@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', $hajj_type)
@section('page_tagline', $hajj_type . ' Payment List')

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $hajj_type }} Payment List
                    </h3>
            </div>
            <div class="float-right mt-3 display-none">
                <a href="{{ $hajj_type == 'Haji' ? route('haji.create') : route('omra-haji.create') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New {{ $hajj_type }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Payment Type</th>
                    <th>Voucher Name</th>
                    <th>Depositor Name</th>
                    <th>Amount</th>
                    <th class="text-center">Payment Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr id="tr-{{ $payment->id }}">
                        <td scope="row">{{ $payment->hajj->customer ? $payment->hajj->customer->full_name : '' }}</td>
                        <td>{{ $payment->type_value }}</td>
                        <td>{{ $payment->voucher_name }}</td>
                        <td>{{ $payment->depositor_name }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td class="text-center">{{ $payment->status == 0 ? 'Pending' : 'Paid' }}</td>
                        <td class="text-center">
                            <a href="{{ $hajj_type == 'Haji' ? route('hajj-payment.edit', $payment->id) :  route('omra-hajj-payment.edit', $payment->id)  }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $payment->id }}">
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
            @if($hajj_type == 'Haji')
            $('#hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#haji-payment-details-sm').addClass('kt-menu__item--active');
            @else
            $('#omra-hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#omra-haji-payment-details-sm').addClass('kt-menu__item--active');
            @endif
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
