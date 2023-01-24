@extends('layouts.pdf')

@push('css')
    @include('Admin.customer.customer-pdf-css')
@endpush

@section('page_title', 'Customer')
@section('page_tagline', $customer->full_name)

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title content-center">Customer Details</h3>
        </div>
        <div class="panel-body">
        </div>
    </div>

    <div class="panel panel-default no-break">
        <div class="panel-heading">
            <h3 class="panel-title">General Information</h3>
        </div>
        <div class="panel-body">
            <table style="width:100%">
                <tr>
                    <td width="50%">
                        <table class="pdf-table">
                            <tr>
                                <td colspan="2">
                                    @if($customer->photo)
                                        <img src="{{ str_replace(' ', '%20', asset('/') . 'uploads/customers/images/'. $customer->photo) }}"
                                            style="width: 150px; height: 180px;">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="info-key">Full Name <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->full_name }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Father's Name <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->father_name }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Mother's Name <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->mother_name }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Date Of Birth <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->date_of_birth ? \Carbon\Carbon::parse($customer->date_of_birth)->format('d F, Y') : '' }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Resident Type <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->resident_type }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Gender <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->gender == 1 ? 'Male' : 'Female' }}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <table class="pdf-table">
                            <tr>
                                <td class="info-key">Type <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->type == 1 ? 'Individual' : 'Group' }}</td>
                            </tr>
                            @if($customer->type == 2)
                                <tr>
                                    <td class="info-key">Group <span class="text-right">:</span></td>
                                    <td class="info-value">{{ $customer->group ? $customer->group->group_name : '' }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="info-key">Management <span class="text-right">:</span></td>
                                <td class="info-value">{{ ($customer->management == 1 ? 'Jurain Office' : $customer->management == 1) ? 'Mohammadpur Office' : 'Group Leader' }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">NID <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->nid_number }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Birth Certificate Number <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->birth_certificate_number }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Occupation <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->occupation }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Passport ID <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->passport ? $customer->passport->passport_no : '' }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Mobile <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->mobile }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Email <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Marital Status <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->marital_status == 1 ? 'Single' : ($customer->marital_status ? 'Married' : 'Others') }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-default no-break">
        <div class="panel-heading">
            <h3 class="panel-title">Address</h3>
        </div>
        <div class="panel-body">
            <table style="width:100%">
                <tr>
                    <td width="50%">
                        <table class="pdf-table">
                            <tr>
                                <td class="info-key">Current Address <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->current_address }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Current Police Station <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->current_police_station }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Current District <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->current_district }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Current Postcode <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->current_postcode }}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <table class="pdf-table">
                            <tr>
                                <td class="info-key">Permanent Address <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->permanent_address }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Permanent Police Station <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->permanent_police_station }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Permanent District <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->permanent_district }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Permanent Postcode <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->permanent_postcode }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-default no-break">
        <div class="panel-heading">
            <h3 class="panel-title">Others Information</h3>
        </div>
        <div class="panel-body">
            <table style="width:100%">
                <tr>
                    <td width="50%">
                        <table class="pdf-table">
                            <tr>
                                <td class="info-key">Spouse Name <span class="text-right">:</span></td>
                                <td class="info-value">{{ $customer->spouse_name }}</td>
                            </tr>
                            <tr>
                                <td class="info-key">Dependent Name <span class="text-right">:</span></td>
                                <td class="info-value">
                                    @if($customer->dependent){{ $customer->dependent->full_name }}@endif
                                </td>
                            </tr>
                            <tr>
                                <td class="info-key">Maharam Name <span class="text-right">:</span></td>
                                <td class="info-value">
                                    @if($customer->dependent){{ $customer->maharam->full_name }}@endif
                                </td>
                            </tr>
                            <tr>
                                <td class="info-key">Permanent Postcode <span class="text-right">:</span></td>
                                <td class="info-value">
                                    @if($customer->dependent){{ $customer->permanent_postcode }}@endif
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
