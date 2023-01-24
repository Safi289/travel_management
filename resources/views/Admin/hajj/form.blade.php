@extends('Admin.layouts.app')

@section('page_title', $hajj_type . ' Information')
@if(isset($haji->id))
    @section('page_tagline', 'Update '.$hajj_type.' Information')
@else
    @section('page_tagline', 'Add '.$hajj_type.' Information')
@endif

@section('content')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($haji->id)) Update @else Add @endif {{$hajj_type}} Information
                </h3>
            </div>
        </div>

    @php
        if (isset($haji->id)){
            $route = $hajj_type == 'Haji' ? route('haji.update', $haji->id) : route('omra-haji.update', $haji->id);
        }else {
            $route = $hajj_type == 'Haji' ? route('haji.store') : route('omra-haji.store');
            $haji = new \App\Hajj();
        }
    @endphp
    <!--begin::Form-->
        <form id="menu-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($haji->id)) @method('PUT') @endif
                @if(isset($haji->id))
                    <div class="form-group row">
                        <label for="payment_status" class="col-2 col-form-label">Customer *</label>
                        <div class="col-10">
                            <div class="form-control">{{ $haji->customer ? $haji->customer->full_name : '' }}</div>
                        </div>
                    </div>
                @else
                    <div class="form-group row">
                        <label for="customer_id" class="col-2 col-form-label">Customer {{ old('customer_id', $haji->customer_id) }} *</label>
                        <div class="col-10">
                            <select class="form-control kt-selectpicker" data-size="5"
                                    data-live-search="true"
                                    name="customer_id"
                                    id="customer_id">
                                <option
                                    value=""
                                    {{ old('customer_id', $haji->customer_id) === null ? 'selected' : '' }}>
                                    Select a Customer
                                </option>
                                @foreach($customers as $customer)
                                    <option
                                        value="{{ $customer->id }}"
                                        {{ old('customer_id', $haji->customer_id) == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->full_name }} - {{ $customer->serial_no }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <label for="package_id" class="col-2 col-form-label">Package *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" data-size="5"
                                data-live-search="true"
                                name="package_id"
                                id="package_id">
                            <option
                                value=""
                                {{ old('package_id', $haji->package_id) === null ? 'selected' : '' }}>
                                Select a Package
                            </option>
                            @foreach($packages as $package)
                                <option
                                    value="{{ $package->id }}"
                                    {{ old('package_id', $haji->package_id) == $package->id ? 'selected' : '' }}>
                                    {{ $package->package_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="year" class="col-2 col-form-label">
                        Year
                    </label>
                    <div class="col-10">
                        <p id="year" class="form-control">{{ $haji->package ? $haji->package->year : '' }}</p>
                    </div>
                </div>
                @if($hajj_type == 'Haji')
                    <div class="form-group row">
                        <label for="hijri" class="col-2 col-form-label">Hijri </label>
                        <div class="col-10">
                            <p id="hijri" class="form-control">{{ $haji->package ? $haji->package->hijri : '' }}</p>
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <label for="start_date" class="col-2 col-form-label">Start Date </label>
                    <div class="col-10">
                        <p id="start_date" class="form-control">{{ $haji->package ? \Carbon\Carbon::parse($haji->package->start_date)->format('d-M-Y') : '' }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="end_date" class="col-2 col-form-label">End Date </label>
                    <div class="col-10">
                        <p id="end_date" class="form-control">{{ $haji->package ? \Carbon\Carbon::parse($haji->package->end_date)->format('d-M-Y') : '' }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="departure_status" class="col-2 col-form-label">Departure Status *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                name="departure_status"
                                id="departure_status">
                            <option
                                value="0"
                                {{ old('departure_status', $haji->departure_status) == 0 ? 'selected' : '' }}>
                                None
                            </option>
                            <option
                                value="1"
                                {{ old('departure_status', $haji->departure_status) == 1 ? 'selected' : '' }}>
                                Flight Take Off
                            </option>
                            <option
                                value="2"
                                {{ old('departure_status', $haji->departure_status) == 2 ? 'selected' : '' }}>
                                Flight Arrived
                            </option>
                            <option
                                value="3"
                                {{ old('departure_status', $haji->departure_status) == 3 ? 'selected' : '' }}>
                                Staying
                            </option>
                            <option
                                value="4"
                                {{ old('departure_status', $haji->departure_status) == 4 ? 'selected' : '' }}>
                                Return Flight Take Off
                            </option>
                            <option
                                value="5"
                                {{ old('departure_status', $haji->departure_status) == 5 ? 'selected' : '' }}>
                                Return Flight Arrived
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="payment_status" class="col-2 col-form-label">Payment Status *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker"
                                name="payment_status"
                                id="payment_status">
                            <option
                                value="0"
                                {{ old('payment_status', $haji->payment_status) == 0 ? 'selected' : '' }}>
                                Partially Paid
                            </option>
                            <option
                                value="1"
                                {{ old('payment_status', $haji->payment_status) == 1 ? 'selected' : '' }}>
                                Paid
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-2 col-form-label">Description</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" id="description"
                                  name="description"
                                  rows="5"
                                  placeholder="Description">{{ old('description', $haji->description) }}</textarea>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ $hajj_type == 'Haji' ? route('haji.index') : route('omra-haji.index') }}"
                                   class="btn btn-primary">Cancel</a>
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
            @if($hajj_type == 'Haji')
            $('#hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#add-haji-information-sm').addClass('kt-menu__item--active');
            @else
            $('#omra-hajj-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#add-new-omra-haji-information-sm').addClass('kt-menu__item--active');
            @endif

            $('body').on('change', '#package_id', function(event) {
                if (event.target.value) {
                    axios.get(`${window.base_url}/json/package/get-info/${event.target.value}`).then(res => {
                        let data = res.data.data;
                        $('#year').text(data.year);
                        $('#hijri').text(data.hijri);
                        $('#start_date').text(moment(data.start_date).format('DD-MMM-YYYY'));
                        $('#end_date').text(moment(data.end_date).format('DD-MMM-YYYY'));
                    });
                } else {
                    $('#year').text('');
                    $('#hijri').text('');
                    $('#start_date').text('');
                    $('#end_date').text('');
                }
            });
        });
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/haji.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
