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
                    {{ $controllerInfo->title }}
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
                    <label for="service_type_id" class="col-2 col-form-label">
                        Service Type *
                    </label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" name="service_type_id" id="service_type_id">
                                <option value="0" {{ old('service_type_id') == 0 ? 'selected' : '' }}>All</option>
                                <option value="1" {{ old('service_type_id') == 1 ? 'selected' : '' }}>Hajj</option>
                                <option value="2" {{ old('service_type_id') == 2 ? 'selected' : '' }}>Omra Hajj</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="group" class="col-2 col-form-label">
                        Group *
                    </label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" name="group" id="group">
                                <option value="">All</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ old('group') == $group->id ? 'selected' : '' }}>
                                        {{ $group->group_name }} &nbsp;&nbsp; -- &nbsp;&nbsp; {{ $group->group_type == 1 ? 'Hajj Group' : 'Omra Hajj Group' }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="year" class="col-2 col-form-label">Year *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="year" name="year" value="{{ old('year') }}" placeholder="2000">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message" class="col-2 col-form-label">Message *</label>
                    <div class="col-10">
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" maxlength="150" placeholder="Maximum 150 Characters"></textarea>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route($controllerInfo->routeNamePrefix . '.index') }}" class="btn btn-primary">Cancel</a>
                                {{--<input type="submit" class="btn btn-primary" value="Save">--}}
                                <button type="submit" class="btn btn-success">Send</button>
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
            $('#sms-sending-system-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            // $('#hotel-rate-list-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
