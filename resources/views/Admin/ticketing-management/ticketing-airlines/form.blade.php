@extends('Admin.layouts.app')

@php
    if (isset($airline->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $airline->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
        $airline = new \App\TicketingAirline();
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($airline->id))
    @section('page_tagline', 'Update '.$controllerInfo->title)
@else
    @section('page_tagline', 'Create '.$controllerInfo->title)
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($airline->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($airline->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="airlines_name" class="col-2 col-form-label">
                        Airlines Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="airlines_name" name="airlines_name"
                               value="{{ old('airlines_name', $airline->airlines_name) }}" placeholder="Airlines Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="airlines_code" class="col-2 col-form-label">Airlines Code *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="airlines_code" name="airlines_code"
                               value="{{ old('airlines_code', $airline->airlines_code) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ticketing_serial" class="col-2 col-form-label">Ticketing Serial *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="ticketing_serial" name="ticketing_serial"
                               value="{{ old('ticketing_serial', $airline->ticketing_serial) }}" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-2 col-form-label text-right">Type *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" name="type" id="type">
                            <option
                                value="IATA" {{ old('type', $airline->type) !== 'IATA' ? 'selected' : '' }}>
                                IATA
                            </option>
                            <option
                                value="NON IATA" {{ old('type', $airline->type) === 'NON IATA' ? 'selected' : '' }}>
                                NON IATA
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-2 col-form-label">Status *</label>
                    <div class="col-10">
                        <div class="kt-radio-inline">
                            <label class="kt-radio">
                                <input type="radio" name="status" value="1"
                                    {{(old('status', $airline->status) !== 0) ? 'checked' : ''}}>
                                Active
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="status" value="0"
                                    {{(old('status', $airline->status) === 0) ? 'checked' : ''}}>
                                Inactive
                                <span></span>
                            </label>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route($controllerInfo->routeNamePrefix . '.index') }}" class="btn btn-primary">Cancel</a>
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
            $('#ticket-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#ticketing-airlines-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
