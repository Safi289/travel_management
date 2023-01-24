@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@php
if (isset($group_type)){
    $group_type = $group_type . ' ';
    if ($group_type == 'Hajj ') {
        $routeNamePrefix = 'hajj-groups';
    } elseif ($group_type == 'Omra Hajj ') {
        $routeNamePrefix = 'omra-hajj-groups';
    }
} else {
    $group_type  = '';
    $routeNamePrefix = 'groups';
}
@endphp

@section('page_title', $group_type . 'Groups')
@section('page_tagline', $group_type . 'Group List')

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $group_type }} Group List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route($routeNamePrefix . '.create') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New {{ $group_type }} Group
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Group Name</th>
                    <th>Leader Name</th>
                    <th>Group Type</th>
                    <th>No Of Pilgrims</th>
                    <th>Management Type</th>
                    <th>Group Address</th>
                    <th>Group Contact No.</th>
                    <th>Group Email</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr id="tr-{{ $group->id }}">
                        <td scope="row">{{ $group->group_name }}</td>
                        <td>{{ $group->leader_name }}</td>
                        <td>{{ $group->group_type == 1 ? 'Hajj' : 'Omra Hajj' }}</td>
                        <td class="text-center">{{ $group->customers_count }}</td>
                        <td>{{ $group->management_type == 0 ? 'Group Leader' : 'Office' }}</td>
                        <td>{{ $group->address }}</td>
                        <td>{{ $group->contact_no }}</td>
                        <td>{{ $group->email }}</td>
                        <td class="text-center">
                            <a href="{{ route($routeNamePrefix . '.show', $group->id) }}" class="btn btn-success btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon-eye"></i>
                            </a>
                            <a href="{{ route($routeNamePrefix . '.edit', $group->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $group->id }}">
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
            @if($group_type == 'Hajj ')
            $('#hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#hajj-groups-sm').addClass('kt-menu__item--active');
            @elseif($group_type == 'Omra Hajj ')
            $('#omra-hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#omra-hajj-groups-sm').addClass('kt-menu__item--active');
            @else
            $('#groups-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#groups-sm').addClass('kt-menu__item--active');
            @endif
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
