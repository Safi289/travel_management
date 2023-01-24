@extends('Admin.layouts.app')

<?php
$pageName = 'Passports Status';
$pageResource = 'passport-status';
?>

@section('page_title', $pageName)
@if(isset($data->id))
    @section('page_tagline', 'Update '.$pageName)
@else
    @section('page_tagline', 'Create '.$pageName)
@endif

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet" id="passport_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($data->id)) Update @else Create @endif {{$pageName}}
                </h3>
            </div>
        </div>

    @php
        if (isset($data->id)){
            $route = route($pageResource.'.update', $data->id);
        }else {
            $route = route($pageResource.'.store');
            $data = new \App\CustomerPassport();
        }
    @endphp
    <!--begin::Form-->
        <form id="passport-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($data->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="status_name" class="col-2 col-form-label">
                        Status Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="status_name" name="status_name"
                               value="{{ old('status_name', $data->status_name) }}" placeholder="Status Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_id" class="col-2 col-form-label">
                        Status Id *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="status_id" name="status_id"
                               value="{{ old('status_id', $data->status_id) }}" placeholder="Status Id" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="serial_no" class="col-2 col-form-label">
                        Serial No *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="serial_no" name="serial_no"
                               value="{{ old('serial_no', $data->serial_no) }}" placeholder="Serial No" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-2 col-form-label">Description</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" id="description" name="description"
                                  rows="5"
                                  placeholder="Description">{{ old('description', $data->description) }}</textarea>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route($pageResource.'.index') }}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#passport-status-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#passport-status-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
