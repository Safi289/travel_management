@extends('Admin.layouts.app')

@push('css')
    <style>
        .info-row {
            font-size: 120%;
            line-height: 1.9em;
        }
    </style>
@endpush

@section('page_title', 'Customer')
@section('page_tagline', $customer->full_name)

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon" onclick="printData()"><i class="kt-font-brand flaticon2-line-chart"></i></span>
                <h3 class="kt-portlet__head-title">
                    View Customer
                </h3>
            </div>
            <div class="float-right mt-3">
                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary btn-sm btn-icon-sm btn-circle">
                    <i class="flaticon2-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" data-toggle="modal" data-target="#delete-modal" data-id="{{ $customer->id }}">
                    <i class="flaticon-delete"></i> Delete
                </button>
                <a href="{{ route('customer.pdf', $customer->id) }}" class="btn btn-secondary btn-sm btn-icon-sm btn-circle">
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
                                    General Information
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
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="kt-portlet__content">
                                                <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar_1">
                                                    <div class="kt-avatar__holder" id="avatar__holder"
                                                         style="@if($customer->photo)background-image: url('{{ asset('uploads/customers/images').'/'. $customer->photo }}');@endif
                                                             background-size: contain; width: 150px; height: 200px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Full Name <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->full_name }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Father's Name <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->father_name }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Mother's Name <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->mother_name }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Date Of Birth <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div
                                                class="col-9 info-value">{{ $customer->date_of_birth ? \Carbon\Carbon::parse($customer->date_of_birth)->format('d F, Y') : '' }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Resident Type <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->resident_type }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Gender <span
                                                    class="float-right">:</span></div>
                                            <div
                                                class="col-9 info-value">{{ $customer->gender == 1 ? 'Male' : 'Female' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Type <span
                                                    class="float-right">:</span></div>
                                            <div
                                                class="col-9 info-value">{{ $customer->type == 1 ? 'Individual' : 'Group' }}</div>
                                        </div>
                                        @if($customer->type == 2)
                                            <div class="row info-row">
                                                <div class="col-3 info-key font-weight-bolder">Group <span
                                                        class="float-right">:</span>
                                                </div>
                                                <div class="col-9 info-value">
                                                    {{ $customer->group ? $customer->group->group_name : '' }}
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Management <span
                                                    class="float-right">:</span>
                                            </div>
                                           
                                            <div class="col-9 info-value">
                                                @if($customer->management == 1)
                                                        Jurain Office
                                                @elseif($customer->management == 2)
                                                        Mohammadpur Office
                                                @else 
                                                    Group Leader
                                                @endif
                                                
                                                
                                               

                                            </div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">NID <span
                                                    class="float-right">:</span></div>
                                            <div class="col-9 info-value">{{ $customer->nid_number }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Birth Certificate Number
                                                <span
                                                    class="float-right">:</span></div>
                                            <div
                                                class="col-9 info-value">{{ $customer->birth_certificate_number }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Occupation <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->occupation }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Passport ID <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">
                                                {{ $customer->passport ? $customer->passport->passport_no : '' }}
                                            </div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Mobile <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->mobile }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Email <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">{{ $customer->email }}</div>
                                        </div>
                                        <div class="row info-row">
                                            <div class="col-3 info-key font-weight-bolder">Marital Status <span
                                                    class="float-right">:</span>
                                            </div>
                                            <div class="col-9 info-value">
                                                {{ $customer->marital_status == 1 ? 'Single' : ($customer->marital_status ? 'Married' : 'Others') }}
                                            </div>
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
                                    Address
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
                                <div class="col-6">
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Current Address <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer->current_address }}</div>
                                    </div>
                                    @if($customer_address)
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Current Police Station <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer_address->name }}</div>
                                    </div>
                                    @endif
                                    @if($customer_district)
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Current District <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer_district->name }}</div>
                                    </div>
                                    @endif
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Current Postcode <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer->current_postcode }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Permanent Address <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer->permanent_address }}</div>
                                    </div>
                                    @if($permanent_upazila)
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Permanent Police Station <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $permanent_upazila->name }}</div>
                                    </div>
                                    @endif
                                    @if($permanent_district)
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Permanent District <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $permanent_district->name }}</div>
                                    </div>
                                    @endif
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Permanent Postcode <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer->permanent_postcode }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->


                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--head-sm" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-bg-light-dark kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Others Information
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
                                <div class="col-6">
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Spouse Name <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">{{ $customer->spouse_name }}</div>
                                    </div>
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Dependent Name <span class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">
                                            @if($customer->dependent)
                                                <a href="{{ route('customer.show', $customer->dependent->id) }}">{{ $customer->dependent->full_name }}
                                                    <i style="padding: 0.1rem 0.4rem;"
                                                       class="btn btn-brand btn-font-lg btn-pill btn-xs circle flaticon-information ml-4"
                                                       data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top"
                                                       title=""
                                                       data-original-title="Show the Customer Details"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row info-row">
                                        <div class="col-3 info-key font-weight-bolder">Maharam Name <span
                                                class="float-right">:</span>
                                        </div>
                                        <div class="col-9 info-value">
                                            @if($customer->maharam)
                                                <a href="{{ route('customer.show', $customer->maharam->id) }}">{{ $customer->maharam->full_name }}
                                                    <i style="padding: 0.1rem 0.4rem;"
                                                       class="btn btn-brand btn-font-lg btn-pill btn-xs circle flaticon-information ml-4"
                                                       data-offset="60px 0px" data-toggle="kt-tooltip" data-placement="top"
                                                       title=""
                                                       data-original-title="Show the Customer Details"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->


                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--head-sm" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-bg-light-dark kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Payment Information
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
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Hajj Type</th>
                                    <th>Payment Type</th>
                                    <th>Voucher Name</th>
                                    <th>Depositor Name</th>
                                    <th>Amount</th>
                                    <th class="text-center">Payment Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($customer->hajj && $customer->hajj->payments && $customer->hajj->payments->count() > 0)
                                    @php($total = 0)
                                    @foreach($customer->hajj->payments as $payment)
                                        @php($total += $payment->amount)
                                        <tr id="tr-{{ $payment->id }}">
                                            <td>{{ $payment->hajj->type_value }}</td>
                                            <td>{{ $payment->type_value }}</td>
                                            <td>{{ $payment->voucher_name }}</td>
                                            <td>{{ $payment->depositor_name }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td class="text-center">{{ $payment->status == 0 ? 'Pending' : 'Paid' }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-right"><b>Total:</b></td>
                                        <td colspan="2"><b>{{ $total }}</b></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No Payment Details Found!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Portlet-->


                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--head-sm" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-bg-light-dark kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Attached Documents
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
                            @if ($customer->documents)
                                <div class="row" id="document_table_section">
                                    <div class="col-12">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead class="thead-dark">
                                            <tr>
                                                <td width="80%">Document Title</td>
                                                <td width="20%" class="text-center">Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if ($customer->documents->count() > 0)
                                                @foreach($customer->documents as $document)
                                                    <tr id="tr-{{ $document->id }}">
                                                        <td>{{ $document->title }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-danger btn-sm btn-icon-sm btn-circle delete-button" href="{{ $document->document_download_url }}" target="_blank">
                                                                <i class="flaticon-download"></i> Download Document
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2" class="text-center">No Documents Attached!</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Portlet-->


                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--head-sm" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-bg-light-dark kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Notes
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
                            <div class="row" id="document_table_section">
                                <div class="col-10">
                                    <p>{!! $customer->notes !!}</p>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-primary btn-sm btn-icon-sm" data-toggle="modal" data-target="#update-note-modal" data-id="{{ $customer->id }}">
                                        <i class="flaticon-edit"></i> Update Note
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->

                    @include('Admin.customer.update-note-modal')
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
@endsection

@push('scripts')
    <script>
        function printData()
        {
            var divToPrint=document.getElementById('customer_info');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);
        }
        $(document).ready(function () {
            $('#Customer-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#all-customer-list-sm').addClass('kt-menu__item--active');

            $('.kt-portlet__head').on('click', '.delete-button', function () {
                $('#modal-delete-button').unbind().click(function () {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        url: "{{ url()->current() }}",
                        type: 'DELETE',
                        dataType: 'json',
                        data: {},
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.message);
                                setTimeout(function(){
                                    window.location.href = "{{ route('customer.index') }}";
                                }, 5000);
                            } else {
                                toastr.error("Whoops! Something Went Wrong!")
                            }
                        }
                    }).done(function () {

                    });
                });
            });

            $(document).on('submit', '#update-note-form', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: $(this).attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#update-note-modal').modal('hide');
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error("Whoops! Something Went Wrong!")
                        }
                    }
                }).done(function () {

                });
            });
        });
    </script>
@endpush
