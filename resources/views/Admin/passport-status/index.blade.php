@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

<?php
$pageName = 'Passports Status';
$pageResource = 'passport-status';
?>

@section('page_title', $pageName)
@section('page_tagline', $pageName . ' List')

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">
                    {{$pageName}} List
                </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route($pageResource.'.create') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New {{$pageName}}
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>SL. No</th>
                    <th>Status Name</th>
                    <th>Status Id</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr id="tr-{{ $record->id }}">
                        <td scope="row">{{ $record->serial_no }}</td>
                        <td>{{ $record->status_name }}</td>
                        <td>{{ $record->status_id }}</td>
                        <td>{{ $record->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->created_at)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->updated_at)->format('d-m-Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route($pageResource.'.edit', $record->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $record->id }}">
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
            $('#passport-status-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#passport-status-sm').addClass('kt-menu__item--active');
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
