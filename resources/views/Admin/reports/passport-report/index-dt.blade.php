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
    <div class="kt-portlet kt-portlet--collapsed" data-ktportlet="true" id="customer_report_filter">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">
                    {{ $controllerInfo->title }} List
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-default btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form id="passport-report-form" action="{{ route('passport-report.store') }}" method="POST" class="kt-form kt-form--label-right">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="full_name" class="col-4 col-form-label">
                                {{ makeLabel('full_name') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" id="full_name" name="full_name" value="{{ old('full_name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="passport_no" class="col-4 col-form-label">
                                {{ makeLabel('passport_number') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" id="passport_no" name="passport_no" value="{{ old('passport_no') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="date_of_birth" class="col-4 col-form-label">
                                {{ makeLabel('date_of_birth') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control kt-datepicker" type="text" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="issue_date" class="col-4 col-form-label">
                                {{ makeLabel('issue_date') }} {{ old('issue_date') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control kt-datepicker" type="text" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="expiry_date" class="col-4 col-form-label">
                                {{ makeLabel('expiry_date') }} {{ old('expiry_date') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control kt-datepicker" type="text" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="issue_location" class="col-4 col-form-label">
                                {{ makeLabel('issue_location') }} {{ old('issue_location') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="text" id="issue_location" name="issue_location" value="{{ old('issue_location') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="form-group row">
                    <div class="col-1"></div>
                    <div class="col-11">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            {!! $dataTable->table(['class' => 'table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline'], true) !!}
            <!--end: Datatable -->
        </div>
    </div>
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')
    <!-- Datatables -->
    <script src="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/report-bootstrap-pickers.js') }}" type="text/javascript"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            $('#reports-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#passport-report-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
