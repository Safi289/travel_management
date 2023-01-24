@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', $package_type . ' Packages')
@section('page_tagline', $package_type . ' Package List')

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $package_type }} Package List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ $package_type == 'Hajj' ? route('hajj-package.create') : route('omra-hajj-package.create') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Create {{ $package_type }} Package
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Package Code</th>
                    <th>No. of Days</th>
                    <th>Total Price</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($packages as $package)
                    <tr id="tr-{{ $package->id }}">
                        <td scope="row">{{ $package->package_name }}</td>
                        <td>{{ $package->pack_code }}</td>
                        <td>{{ $package->no_of_days }}</td>
                        <td>{{ $package->total_price }}</td>
                        <td class="text-center">
                            @if($package->status === 1)
                                <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Active</span>
                            @else
                                <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ $package_type == 'Hajj' ? route('hajj-package.edit', $package->id) :  route('omra-hajj-package.edit', $package->id)  }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $package->id }}">
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
            $('#package-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            @if($package_type == 'Hajj')
            $('#all-hajj-package-sm').addClass('kt-menu__item--active');
            @else
            $('#all-omra-hajj-packages-sm').addClass('kt-menu__item--active');
            @endif
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
