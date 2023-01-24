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
                    Add New Bank
                </h3>
            </div>

            <div class="float-right mt-3">
                <a href="{{route('view-bank')}}" class="btn btn-label-success btn-sm btn-upper">
                    <i class="fa fa-eye"></i> View Bank List
                </a>
            </div>
        </div>
<form id="passport-form" action="{{route('save-bank')}}" method="POST"
              class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                <div class="form-group row">
                    <label for="full_name" class="col-2 col-form-label">
                        Bank Name
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="bank_name" name="bank_name" placeholder="Ex. Rupali Bank, UCB Bank etc">
                    </div>
                </div>


            
            <div class="form-group row">
                    <label for="full_name" class="col-2 col-form-label">
                        Branch
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="branch" name="branch" placeholder="Ex. NayaBazar Branch, Paltan Branch etc">
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
                        Activation Status
                    </label>
                    <div class="col-10">
                        <div class="radio">
                    <input type="radio" name="bank_status" value="Yes"> Active 
                    &nbsp;&nbsp;&nbsp;<input type="radio" name="bank_status" value="No"> Inactive
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" name="btn" class="btn btn-success pull-right">
                </div>
                
            </div>
                
        </form>
@endsection
