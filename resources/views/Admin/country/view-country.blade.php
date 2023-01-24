@extends('Admin.layouts.app')

@push('css')
    <!-- Datatables -->
    <link href="{{asset('vendor/dashboard/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet">
@endpush

@section('page_title', 'Countries')
@section('page_tagline', 'Country List')

@section('content')
    
    @if(Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                        Country List
                    </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route('add-country') }}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-plus"></i> Add New Country
                </a>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table
                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Country's Description</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $countries)
                    <tr id="tr-{{ $countries->country_id }}">
                        <td scope="row">{{ $countries->country_name }}</td>
                        <td scope="row">{{ $countries->country_desc }}</td>
                       
                        <td class="text-center">
                            <!-- <a href="" class="btn btn-primary btn-sm btn-icon-sm btn-circle" data-toggle="modal" data-target="#edit{{$countries->country_id}}">
                                <i class="flaticon2-edit"></i>
                            </a> -->

                            <a href="{{route('edit-country',['id'=>$countries->country_id])}}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-edit"></i>
                            </a>


                            <a href="{{route('delete-country',['id'=>$countries->country_id])}}" class="btn btn-danger btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-trash"></i>
                            </a>

                             @if($countries->status==1)
                            <a href="{{route('published-country',['id'=>$countries->country_id])}}" type="button" class="btn btn-success btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-arrow-up"></i>
                            </a>
                        @else
                            <a href="{{route('unpublished-country',['id'=>$countries->country_id])}}" type="button" class="btn btn-warning btn-sm btn-icon-sm btn-circle">
                                <i class="flaticon2-arrow-down"></i>
                            </a>
                        @endif




                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

<!--modal-->
 <!-- <div class="modal fade" id="edit{{$countries->country_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Country</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('update-country')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Country Name</label>
                                        <input type="text" class="form-control" name="country_name" value="{{$countries->country_name}}">
                                        <input type="hidden" class="form-control" name="country_id" value="{{$countries->country_id}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Country Description</label>
                                        <input type="text" class="form-control" name="country_desc" value="{{$countries->country_desc}}">
                                        <input type="hidden" class="form-control" name="country_id" value="{{$countries->country_id}}">
                                    </div>

                                    <input type="submit" name="btn" class="btn btn-primary" value="update">
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->








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
