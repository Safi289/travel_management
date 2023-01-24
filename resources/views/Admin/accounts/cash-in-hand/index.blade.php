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
    <div class="kt-portlet" data-ktportlet="true" id="customer_report_filter">
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
            <form id="cash-in-hand-filter-form" action="{{ route('cash-in-hand.store') }}" method="POST" class="kt-form kt-form--label-right">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="start_date" class="col-4 col-form-label">
                                {{ makeLabel('start_date') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control kt-datepicker" type="text" id="start_date" name="start_date" value="{{ $input['start_date'] }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="end_date" class="col-4 col-form-label">
                                {{ makeLabel('end_date') }}
                            </label>
                            <div class="col-8">
                                <input class="form-control kt-datepicker" type="text" id="end_date" name="end_date" value="{{ $input['end_date'] }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="form-group row">
                    <div class="col-1"></div>
                    <div class="col-11">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-secondary" onclick="resetForm(event)">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Portlet-->

    @if ($show_table)

    <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                    <thead>
                    <tr>
                        <th>{{ makeLabel('date') }}</th>
                        <th>{{ makeLabel('total_deposit') }}</th>
                        <th>{{ makeLabel('total_expenses') }}</th>
                        <th>{{ makeLabel('cash_in_hand') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($balances as $balances)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($balances->date)->format('d-m-Y') }}</td>
                            <td class="text-right">{{ $balances->total_deposit }}</td>
                            <td class="text-right">{{ $balances->total_expenses }}</td>
                            <td class="text-right">{{ $balances->cash_in_hand }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="border-right-0"></td>
                        <td class="border-right-0"></td>
                        <td class="border-right-0"></td>
                        <td class="text-right"><b>Sum Of Totals: &nbsp;&nbsp;&nbsp;&nbsp;</b>{{ $total->total }}</td>
                    </tr>
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
        <!--end::Portlet-->
       
       

        


        
    @endif
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')
    <!-- Datatables -->
    <script src="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/accounts/bootstrap-pickers.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#accounts-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#cash-in-hand-sm').addClass('kt-menu__item--active');
            /*$('.table').DataTable({
                responsive: true
            });*/
        });
        function resetForm(e){
            e.preventDefault();
            $('.form-control').val(null);
        }
    </script>
@endpush
