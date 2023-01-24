@extends('Admin.layouts.app')

@push('css')
    <style>
        .info-row {
            font-size: 120%;
            line-height: 1.9em;
        }
    </style>
@endpush

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
@endphp

@section('page_title', $group_type . 'Group')
@section('page_tagline', $group->group_name)

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon" onclick="printData()"><i
                        class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">
                    View {{ $group_type }} Group
                </h3>
            </div>
            <div class="float-right mt-3 display-none">
                <a href="{{ route('customer.pdf', $group->id) }}">
                    <i class="flaticon2-printer"></i>
                </a>
            </div>
        </div>
        <div class="kt-portlet__body" id="customer_info">
            <div class="row">
                <div class="col-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--head-sm" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-bg-light-dark kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{ $group_type }} Group Information
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle"
                                       class="btn btn-sm btn-icon btn-clean btn-icon-md"><i
                                            class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">{{ $group_type }} Group Name <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $group->group_name }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Leaders's Name <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $group->leader_name }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Management Type <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $group->management_type_value }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Address <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $group->address }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Mobile <span
                                                    class="float-right">:</span></div>
                                            <div class="col-9 info-value">{{ $group->contact_no }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Email
                                                <span
                                                    class="float-right">:</span></div>
                                            <div
                                                class="col-9 info-value">{{ $group->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->

                </div>

                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                <div class="col-12">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--head-sm" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-bg-light-dark kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Engaged Customers with <b>{{ $group->group_name }}</b>
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle"
                                       class="btn btn-sm btn-icon btn-clean btn-icon-md"><i
                                            class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                @foreach($group->customers as $customer)
                                    <div class="col-3">
                                        <div class="kt-portlet">
                                            <div class="kt-portlet__head  kt-portlet__head--noborder">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body kt-portlet__body--fit-y">

                                                <!--begin::Widget -->
                                                <div class="kt-widget kt-widget--user-profile-1">
                                                    <div class="kt-widget__head">
                                                        <div class="kt-widget__media">
                                                            <img src="{{ asset('uploads/customers/images') }}/{{ $customer->photo }}"
                                                                 height="120px" alt="image">
                                                        </div>
                                                        <div class="kt-widget__content">
                                                            <div class="kt-widget__section">
                                                                <a href="{{ route('customer.show', $customer->id) }}" class="kt-widget__username">
                                                                    {{ $customer->full_name }}
                                                                </a>
                                                                <span class="kt-widget__subtitle">
																<b>Passport No: </b> {{ $customer->passport ? $customer->passport->passport_no : '' }}
															</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__body">
                                                        <div class="kt-widget__content">
                                                            <div class="kt-widget__info">
                                                                <span class="kt-widget__label">Email:</span>
                                                                <a href="#"
                                                                   class="kt-widget__data">{{ $customer->email }}</a>
                                                            </div>
                                                            <div class="kt-widget__info">
                                                                <span class="kt-widget__label">Phone:</span>
                                                                <a href="#" class="kt-widget__data">{{ $customer->mobile }}</a>
                                                            </div>
                                                            <div class="kt-widget__info">
                                                                <span class="kt-widget__label">Location:</span>
                                                                <span class="kt-widget__data">{{ $customer->current_police_station }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end::Widget -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->

                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
@endsection

@push('scripts')
    @include('dashboard::scripts.delete')
    <script>
        $(document).ready(function () {
            $('#accounts-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#expense-list-sm').addClass('kt-menu__item--active');
        });
    </script>
@endpush
