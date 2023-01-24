@extends('Admin.layouts.app')
@section('page_title', 'Bank')
 @section('page_tagline', 'Add Bank')

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
    <div class="kt-portlet" id="passport_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Add New Expense Category
                </h3>
            </div>

            <div class="float-right mt-3">
                <a href="{{route('view-expense-category')}}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-eye"></i> View Expense Categories List
                </a>
            </div>
        </div>
<form id="passport-form" action="{{route('save-expense-category')}}" method="POST"
              class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                <div class="form-group row">
                    <label for="full_name" class="col-2 col-form-label">
                        Title
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="title" name="title" required="">
                    </div>
                </div>


            




                <div class="form-group row">
                    <label for="passport_no" class="col-2 col-form-label">
                        Description
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="description" name="description">
                    </div>
                </div>


            <div class="form-group row">
                    <label for="status" class="col-2 ">
                        Status
                    </label>
                    <div class="col-10">
                        <div class="radio">
                    <input type="radio" name="status" value="1"> Active 
                    &nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0"> Inactive
                    </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-2" style="color: white">
                        Status
                    </label>
                    <div class="col-10">
                    <input type="submit" name="btn" class=" btn btn-success left">
                </div> 
                </div>
               
                
            </div>
                
        </form>
@endsection
