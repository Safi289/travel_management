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
    <div class="kt-portlet kt-portlet--mobile" id="passport_history_page">
        @include('Admin.passport-history.change-status-modal')
        @include('Admin.passport-history.status-history-modal')
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
            <table id="passport-history-table" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Passport Number</th>
                    <th>Passport Current Status</th>
                    <th>Last Status Updated</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($passports as $passport)
                    <tr id="tr-{{ $passport->id }}">
                        <td scope="row">{{ $passport->full_name }}</td>
                        <td>{{ $passport->passport_no }}</td>
                        <td>{{ $passport->passportStatuses->count() > 0 ? $passport->passportStatuses->first()->status_name : '' }}</td>
                        <td>{{ $passport->passportStatuses->count() > 0 ? \Carbon\Carbon::parse($passport->passportStatuses->first()->date)->format('d-m-Y h:i:A') : '' }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-youtube btn-sm btn-icon-sm btn-circle"
                                    data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="Change Passport Status"
                                    @click="getPassportStatus({{$passport->id}})">
                                <i class="fas fa-sync"></i>
                            </button>
                            <button type="button" class="btn btn-brand btn-sm btn-icon-sm btn-circle"
                                    data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="View Passport History"
                                    @click="getPassportStatusHistories({{$passport->id}})">
                                <i class="fas fa-history"></i>
                            </button>
                            @php
                                $currentStatus = $passport->passportStatuses->count() > 0 ? $passport->passportStatuses->first()->status_name:null;
                            @endphp
                            @if (in_array($currentStatus, ['Passport Received', 'Passport Delivered to Client']))
                                <button type="button" class="btn btn-label-success btn-sm btn-icon-sm btn-circle"
                                        data-skin="brand" data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top" title="Print"
                                        onclick="prints({{$passport->id}})">
                                    <i class="fas fa-print"></i>
                                </button>
                            @endif
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
        function prints(id) {
            window.open(base_url + '/passport-history/receipt/print/'+id, "_blank", "toolbar=yes,scrollbars=yes,width=815,height=1100");
        }
        $(document).ready(function () {
            $('#passport-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#check-passport-history-sm').addClass('kt-menu__item--active');
            $('#passport-history-table').DataTable({
                responsive: true
            });
        });
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/passportHistory.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
