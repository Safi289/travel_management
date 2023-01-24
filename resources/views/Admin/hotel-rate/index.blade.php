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
                    <th>Hotel Name</th>
                    <th>Hotel Area</th>
                    <th>No of Rooms</th>
                    <th>No of Hajis</th>
                    <th>Staying Start Date</th>
                    <th>Staying End Date</th>
                    <th>Hotel Cost</th>
                    <th>Information Update</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hotels as $hotel)
                    <tr id="tr-{{ $hotel->id }}">
                        <td scope="row">{{ $hotel->hotel_name }}</td>
                        <td>{{ $hotel->hotel_area }}</td>
                        <td class="text-center">{{ $hotel->no_of_rooms }}</td>
                        <td class="text-center">{{ $hotel->no_of_hajis }}</td>
                        <td>{{ $hotel->staying_start_date }}</td>
                        <td>{{ $hotel->staying_end_date }}</td>
                        <td class="text-right">{{ $hotel->cost }}</td>
                        <td>{{ $hotel->updated_at }}</td>
                        <td class="text-center">
                            {{--<a href="{{ route($controllerInfo->routeNamePrefix . '.show', $hotel->id) }}" class="btn btn-success btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon-eye"></i>
                            </a>--}}
                            <a href="{{ route($controllerInfo->routeNamePrefix . '.edit', $hotel->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $hotel->id }}">
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
            $('#makka-madina-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#hotel-rate-list-sm').addClass('kt-menu__item--active');
            $('.table').DataTable({
                responsive: true
            });
        });
    </script>
@endpush
