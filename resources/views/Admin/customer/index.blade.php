@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', 'Customers')
@section('page_tagline', 'Customer List')

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        Customer List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route('customer.create') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New Customer
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
                    <th>Father's Name</th>
                    <th>Gender</th>
                    <th>Passport ID</th>
                    <th>Customer Contact No.</th>
                    <th>Customer Email</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr id="tr-{{ $customer->id }}">
                        <td scope="row">{{ $customer->full_name }}</td>
                        <td>{{ $customer->father_name }}</td>
                        <td>{{ $customer->gender == 1 ? 'Male' : 'Female' }}</td>
                        <td>{{ $customer->passport ? $customer->passport->passport_no : '' }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>{{ $customer->email }}</td>
                        <td class="text-center">
                            <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-success btn-sm btn-icon-sm btn-circle"
                               data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="View Customer Details">
                                <i class="flaticon-eye"></i>
                            </a>
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
            $('#Customer-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#all-customer-list-sm').addClass('kt-menu__item--active');
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
