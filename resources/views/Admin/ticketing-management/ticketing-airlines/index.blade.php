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
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        {{ $controllerInfo->title }}
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
                    <th>Airlines Code</th>
                    <th>Ticketing Serial</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Information Update</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ticketingAirlines as $airline)
                    <tr id="tr-{{ $airline->id }}">
                        <td scope="row">{{ $airline->airlines_name }}</td>
                        <td class="text-center">{{ $airline->airlines_code }}</td>
                        <td class="text-center">{{ $airline->ticketing_serial }}</td>
                        <td>{{ $airline->type }}</td>
                        <td>{{ $airline->status_title }}</td>
                        <td>{{ $airline->updated_at }}</td>
                        <td class="text-center">
                            {{--<a href="{{ route($controllerInfo->routeNamePrefix . '.show', $airline->id) }}" class="btn btn-success btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon-eye"></i>
                            </a>--}}
                            <a href="{{ route($controllerInfo->routeNamePrefix . '.edit', $airline->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $airline->id }}">
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
            $('#ticketing-airlines-sm').addClass('kt-menu__item--active');
            $('.dataTable').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
