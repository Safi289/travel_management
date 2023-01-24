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
                    {{ ($haji->customer ? $haji->customer->full_name : '') . '\'s ' .$controllerInfo->title }} List
                </h3>
            </div>
            <div class="float-right mt-3 display-none">
                <a href="{{ $controllerInfo->title == 'Haji' ? route('haji.create') : route('omra-haji.create') }}"
                   class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New {{ $controllerInfo->title }}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Payment Type</th>
                    <th>Voucher Name</th>
                    <th>Depositor Name</th>
                    <th>Amount</th>
                    <th class="text-center">Payment Status</th>
                    @if ($controllerInfo->actionButtons)
                        <th class="text-center">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($haji->payments as $payment)
                    <tr id="tr-{{ $payment->id }}">
                        <td scope="row">{{ $payment->type_value }}</td>
                        <td>{{ $payment->voucher_name }}</td>
                        <td>{{ $payment->depositor_name }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td class="text-center">{{ $payment->status == 0 ? 'Pending' : 'Paid' }}</td>
                        @if ($controllerInfo->actionButtons)
                            <td class="text-center">
                                <a href="{{ route($controllerInfo->routeNamePrefix . '.edit', $payment->id) }}"
                                   class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                    <i class="flaticon2-edit"></i>
                                </a>
                                {{--<button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $payment->id }}">
                                    <i class="flaticon-delete"></i>
                                </button>--}}
                            </td>
                        @endif
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
            @if(!isset($controllerInfo->activeMenu))
            $('#accounts-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#deposit-list-sm').addClass('kt-menu__item--active');
            @endif
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
