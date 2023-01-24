@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">

   
@endpush

@section('page_title', 'Cash In Deposit')
@section('page_tagline', 'Customer List')

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
     @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 2rem">
            <i class="fas fa-check fa-2x"></i>&nbsp;&nbsp;&nbsp;
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top: 2rem">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <!--begin::Portlet-->
  
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                    <h3 class="kt-portlet__head-title">
                        Cash In Deposit List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route('add-cash-in-deposit') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New Cash In Deposit
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Vouchar Name</th>
                    <th>Payment Type</th>
                    <th>Bank Name</th>
                    <th>Depositor Name/Purpose</th>
                    <th>Deposit Date</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                    
                    @foreach($payments as $payment)
                    <tr id="tr-{{ $payment->id }}">
                       
                        
                        
                        <td>{{ sprintf("VOU-%04d", $payment->id) }}</td>
                        <td>{{ $payment->type_value }}</td>
                        <td>{{ $payment->bank_name }}</td>
                        <td>{{ $payment->depositor_name }}</td>
                        <td>{{ $payment->deposit_date }}</td>

                        <td>{{ $payment->amount }}</td>
                        <td class="text-center">{{ $payment->status == 0 ? 'Pending' : 'Paid' }}</td>
                        <td class="text-center">
                            <a href="{{ $hajj_type == 'Haji' ? route('deposit-edit', $payment->id) :  route('deposit-edit', $payment->id)  }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal{{  $payment->id }}">
                                <i class="flaticon-delete"></i>
                            </button>

                        </td>
                    </tr>

                       <!-- delete modal -->
    <div class="modal fade" id="delete-modal{{  $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <br>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('delete-deposit',['id'=>$payment->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h6>Are you sure you want to delete?</h6>
                                    <hr>
                                     <div class="pull-right">
                                        <input type="submit" name="btn" class="btn btn-danger" value="Yes">

                                    <a href="" type="button" class="btn btn-danger">No</a>
                                    </div>

                                    <!-- <input type="submit" name="btn" class="btn btn-danger pull-right" value="delete"> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




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
                responsive: {
                    details: false
                }
            });
        });
    </script>
   
@endpush
