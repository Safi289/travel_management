@extends('Admin.layouts.app')
@section('page_title', 'Country')
 @section('page_tagline', 'Add Country')

@section('content')
@include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
     @if(Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <!--begin::Portlet-->
    <div class="kt-portlet" id="passport_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Add New Country
                </h3>
            </div>
        </div>
<form id="passport-form" action="{{route('save-country')}}" method="POST"
              class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                <div class="form-group row">
                    <label for="full_name" class="col-2 col-form-label">
                        Country Name
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="country_name" name="country_name" placeholder="Ex. Bangladesh, England etc" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="passport_no" class="col-2 col-form-label">
                        Description
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="country_desc" name="country_desc"
                         placeholder="short introduction of the country" required>
                    </div>
                </div>


            <div class="form-group row">
                    <label for="status" class="col-2 ">
                        Publication Status
                    </label>
                    <div class="col-10">
                        <div class="radio">
                    <input type="radio" name="status" value="1"> Published 
                    &nbsp;&nbsp;&nbsp;<input type="radio" name="status" value="0"> Unpublished
                    </div>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" name="btn" class="btn btn-success pull-right">
                </div>
                
            </div>
                
        </form>
@endsection
