@extends('Admin.layouts.app')

@php
    if (isset($hotel->id)){
        $route = route($controllerInfo->routeNamePrefix . '.update', $hotel->id);
    } else {
        $route = route($controllerInfo->routeNamePrefix . '.store');
        $hotel = new \App\Hotel();
    }
@endphp

@section('page_title', $controllerInfo->title)
@if(isset($hotel->id))
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
                    @if(isset($hotel->id)) Update @else Create @endif {{ $controllerInfo->title }}
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($hotel->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="hotel_name" class="col-2 col-form-label">
                        Hotel Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="hotel_name" name="hotel_name"
                               value="{{ old('hotel_name', $hotel->hotel_name) }}" placeholder="Hotel Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hotel_area" class="col-2 col-form-label">Hotel Area</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" data-size="5"
                                data-live-search="false"
                                name="hotel_area"
                                id="hotel_area">
                            <option
                                value=""
                                {{ !old('hotel_area', $hotel->hotel_area) ? 'selected' : '' }}>
                                Select a Hotel Area
                            </option>
                            <option value="Makka"
                                {{ old('hotel_area', $hotel->hotel_area) == 'Makka' ? 'selected' : '' }}>
                                Makka
                            </option>
                            <option value="Madina"
                                {{ old('hotel_area', $hotel->hotel_area) == 'Madina' ? 'selected' : '' }}>
                                Madina
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_of_rooms" class="col-2 col-form-label">
                        No of Rooms
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="no_of_rooms" name="no_of_rooms"
                               value="{{ old('no_of_rooms', $hotel->no_of_rooms) }}" placeholder="No of Rooms">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_of_hajis" class="col-2 col-form-label">
                        No of Hajis
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="no_of_hajis" name="no_of_hajis"
                               value="{{ old('no_of_hajis', $hotel->no_of_hajis) }}" placeholder="No of Hajis">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staying_start_date" class="col-2 col-form-label">Staying Start Date</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="staying_start_date" name="staying_start_date"
                               value="{{ \Carbon\Carbon::parse(old('staying_start_date', $hotel->staying_start_date))->format('d-m-Y') }}" placeholder="Staying Start Date" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staying_end_date" class="col-2 col-form-label">Staying End Date</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="staying_end_date" name="staying_end_date"
                               value="{{ \Carbon\Carbon::parse(old('staying_end_date', $hotel->staying_end_date))->format('d-m-Y') }}" placeholder="Staying End Date" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cost" class="col-2 col-form-label">Hotel Cost *</label>
                    <div class="col-10">
                        <input class="form-control" type="number" id="cost" name="cost"
                               value="{{ old('cost', $hotel->cost) }}" placeholder="1000.00" required>
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
            $('#makka-madina-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#hotel-rate-list-sm').addClass('kt-menu__item--active');
        });
    </script>

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/hotel-rate/hotel-rate.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
