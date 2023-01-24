@extends('Admin.layouts.app')

@section('page_title', 'Dashboard')
@section('page_tagline', 'Admin Dashboard')

@push('css')
    <style>
        .kt-widget17 .kt-widget17__stats {
            margin: 0 auto 0;
            width: 90%;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
            <!--begin:: Widgets/Activity-->
            <div
                class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                </div>
                <div class="kt-portlet__body" style="padding-bottom: 20px; background-color: #f1f2f7;">
                    <div class="kt-widget17">
                        <div
                            class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides"
                            style="background-color: #f1f2f7;">
                            <div class="kt-widget17__chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand"></div>
                                    <div class="chartjs-size-monitor-shrink">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="kt-widget17__stats">
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <i class="fa fa-pray" style='font-size: 40px; color: #e73930;'></i>
                                    <span class="kt-widget17__subtitle">
    							Number of Listed Haji
    						</span>
                                    <span class="kt-widget17__desc" style='font-size: 2rem; font-weight: 700;'>
    							{{ $totalCounts->haji_count }}
    						</span>
                                </div>
                                <div class="kt-widget17__item">
                                    <i class="fa fa-portrait" style='font-size: 40px; color: #e73930;'></i>
                                    <span class="kt-widget17__subtitle">
    							Number of Listed Omra Haji
    						</span>
                                    <span class="kt-widget17__desc" style='font-size: 2rem; font-weight: 700;'>
    							{{ $totalCounts->omra_haji_count }}
    						</span>
                                </div>
                                <div class="kt-widget17__item">
                                    <i class="fa fa-user-tie" style='font-size: 40px; color: #e73930;'></i>
                                    <span class="kt-widget17__subtitle">
    							Number of Listed Agent Group
    						</span>
                                    <span class="kt-widget17__desc" style='font-size: 2rem; font-weight: 700;'>
    							{{ $totalCounts->agent_group_count }}
    						</span>
                                </div>
                            </div>
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <i class="fa fa-mosque" style='font-size: 40px; color: #e73930;'></i>
                                    <span class="kt-widget17__subtitle">
    							Number of Saudi Staying Listed Haji
    						</span>
                                    <span class="kt-widget17__desc" style='font-size: 2rem; font-weight: 700;'>
    							3
    						</span>
                                </div>
                                <div class="kt-widget17__item">
                                    <i class="fa fa-registered" style='font-size: 40px; color: #e73930;'></i>
                                    <span class="kt-widget17__subtitle">
    							Number of Pre-registerd Listed Haji
    						</span>
                                    <span class="kt-widget17__desc" style='font-size: 2rem; font-weight: 700;'>
    							{{ $totalCounts->customer_count }}
    						</span>
                                </div>
                                <div class="kt-widget17__item">
                                    <i class="fa fa-money-bill-wave" style='font-size: 40px; color: #e73930;'></i>
                                    <span class="kt-widget17__subtitle">
    							Number of Listed Payment Due Agent Group
    						</span>
                                    <span class="kt-widget17__desc" style='font-size: 2rem; font-weight: 700;'>
    							15
    						</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Activity-->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#dashboard-mm').addClass('kt-menu__item--active');
    </script>
@endpush
