@extends('Admin.layouts.app')

@php
    if (isset($group_type)){
        $group_type = $group_type . ' ';
        if ($group_type == 'Hajj ') {
            $routeNamePrefix = 'hajj-groups';
        } elseif ($group_type == 'Omra Hajj ') {
            $routeNamePrefix = 'omra-hajj-groups';
        }
    } else {
        $group_type  = '';
        $routeNamePrefix = 'groups';
    }

    if (isset($group->id)){
        $route = route($routeNamePrefix . '.update', $group->id);
    }else {
        $route = route($routeNamePrefix . '.store');
        $group = new \App\Group();
    }
@endphp

@section('page_title', $group_type . 'Groups')
@if(isset($group->id))
    @section('page_tagline', 'Update '.$group_type.'Group')
@else
    @section('page_tagline', 'Create '.$group_type.' Group')
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($group->id)) Update @else Create @endif {{ $group_type }} Group
                </h3>
            </div>
        </div>

    <!--begin::Form-->
        <form id="group-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($group->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="group_name" class="col-2 col-form-label">
                        Group Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="group_name" name="group_name"
                               value="{{ old('group_name', $group->group_name) }}" placeholder="Group Name" required>
                    </div>
                </div>
                @if ($group_type == '')
                    <div class="form-group row">
                        <label for="group_type" class="col-2 col-form-label">Group Type *</label>
                        <div class="col-10">
                            <select class="form-control" name="group_type" id="group_type" required>
                                <option value="1" {{ old('group_type', $group->group_type) == 1 ? 'selected' : '' }}>
                                    Hajj Group
                                </option>
                                <option value="2" {{ old('group_type', $group->group_type) == 2 ? 'selected' : '' }}>
                                    Omra Hajj
                                </option>
                            </select>
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <label for="leader_name" class="col-2 col-form-label">Leader Name *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="leader_name" name="leader_name"
                               value="{{ old('leader_name', $group->leader_name) }}" placeholder="Leader Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="management_type" class="col-2 col-form-label">Management Type *</label>
                    <div class="col-10">
                        <select class="form-control" name="management_type" id="management_type">
                            <option value="0" {{ old('management_type', $group->management_type) !== 1 ? 'selected' : '' }}>
                                Group Leader
                            </option>
                            <option value="1" {{ old('management_type', $group->management_type) === 1 ? 'selected' : '' }}>
                                Office
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="management_name" class="col-2 col-form-label">Management Name *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="management_name" name="management_name"
                               value="{{ old('management_name', $group->management_name) }}" placeholder="Leader Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contact_no" class="col-2 col-form-label">Contact No. *</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="contact_no" name="contact_no"
                               value="{{ old('contact_no', $group->contact_no) }}" placeholder="017XXXXXXXX" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="email" name="email"
                               value="{{ old('email', $group->email) }}" placeholder="@">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-2 col-form-label">Address</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" id="address" name="address"
                                  rows="5"
                                  placeholder="Address">{{ old('address', $group->address) }}</textarea>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route('groups.index') }}" class="btn btn-primary">Cancel</a>
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
            @if($group_type == 'Hajj ')
            $('#hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#hajj-groups-sm').addClass('kt-menu__item--active');
            @elseif($group_type == 'Omra Hajj ')
            $('#omra-hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#omra-hajj-groups-sm').addClass('kt-menu__item--active');
            @else
            $('#groups-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#create-groups-sm').addClass('kt-menu__item--active');
            @endif
        });
    </script>
@endpush
