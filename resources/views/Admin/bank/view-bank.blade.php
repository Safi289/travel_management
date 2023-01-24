@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', 'Banks')
@section('page_tagline', 'Bank List')

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
                        Bank List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{route('add-bank')}}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New Bank
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banks as $bank)
                    <tr id="tr-{{ $bank->b_id }}">
                        <td scope="row">{{ $bank->bank_name }}</td>
                        <td scope="row">{{ $bank->branch }}</td>
                        <td scope="row">{{ $bank->description }}</td>
                        <td scope="row">{{ $bank->bank_status }}</td>
                       
                        <td class="text-center">
                            <a href="" class="btn btn-primary btn-sm btn-icon-sm btn-circle" data-toggle="modal" data-target="#edit{{$bank->b_id}}">
                                <i class="flaticon2-edit"></i>
                            </a>

                            <a href="" class="btn btn-danger btn-sm btn-icon-sm btn-circle" data-toggle="modal" data-target="#delete{{$bank->b_id}}">
                                <i class="flaticon2-trash" title="delete"></i>
                            </a>


                            

                            



                        </td>
                    </tr>



<!--modal for delete -->
<div class="modal fade" id="delete{{$bank->b_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <br>
                            </div>

                            <div class="modal-body">
                                <form action="{{route('delete-bank',['id'=>$bank->b_id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h6>Are you sure you want to delete?</h6>
                                    <hr>
                                     <div class="pull-right">
                                        <input type="submit" name="btn" class="btn btn-danger" value="Yes">

                                    <a href="{{route('view-bank')}}" type="button" class="btn btn-danger">No</a>
                                    </div>

                                    <!-- <input type="submit" name="btn" class="btn btn-danger pull-right" value="delete"> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>









<!--modal for update-->
                    
                    <div class="modal fade" id="edit{{$bank->b_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Bank</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('update-bank')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" value="{{$bank->bank_name}}">
                                        <input type="hidden" class="form-control" name="b_id" value="{{$bank->b_id}}">
                                    </div>



                                    <div class="form-group">
                                        <label>Branch</label>
                                        <input type="text" class="form-control" name="branch" value="{{$bank->branch}}">
                                        <input type="hidden" class="form-control" name="b_id" value="{{$bank->b_id}}">
                                    </div>



                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" name="description" value="{{$bank->description}}">
                                    </div>





                                     <div class="form-group">
                                        <label>Status</label>

                                        <select class="form-control" name="bank_st">
                        <option value="{{$bank->bank_status}}">{{$bank->bank_status}}</option>
                         <option value="Yes">Yes</option>
                         <option value="No">No</option>
                       
                    </select>

                                    </div>






                                    <input type="submit" name="btn" class="btn btn-primary" value="update">
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
            $('#passport-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#all-passport-list-sm').addClass('kt-menu__item--active');
            $('.table').DataTable({
                responsive: {
                    details: false
                }
            });
        });
    </script>
@endpush
