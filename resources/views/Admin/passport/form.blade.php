@extends('Admin.layouts.app')

@section('page_title', 'Passport')
@if(isset($passport->id))
    @section('page_tagline', 'Update Passport')
@else
    @section('page_tagline', 'Create Passport')
@endif

@section('content')
    @include('dashboard::components.delete-modal')
    @include('dashboard::msg.message')
    <!--begin::Portlet-->
    <div class="kt-portlet" id="passport_page">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    @if(isset($passport->id)) Update @else Create @endif Passport
                </h3>
            </div>
        </div>

    @php
        if (isset($passport->id)){
            $route = route('passport-info.update', $passport->id);
        }else {
            $route = route('passport-info.store');
            $passport = new \App\CustomerPassport();
        }
    @endphp
    <!--begin::Form-->
        <form id="passport-form" action="{{ $route }}" method="POST"
              class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                @csrf
                @if(isset($passport->id)) @method('PUT') @endif
                <div class="form-group row">
                    <label for="full_name" class="col-2 col-form-label">
                        Full Name *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="full_name" name="full_name"
                               value="{{ old('full_name', $passport->full_name) }}" placeholder="Full Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passport_no" class="col-2 col-form-label">
                        Passport Number *
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="passport_no" name="passport_no"
                               value="{{ old('passport_no', $passport->passport_no) }}" placeholder="Passport Number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_of_birth" class="col-2 col-form-label">Date Of Birth *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="date_of_birth" name="date_of_birth"
                               value="{{ \Carbon\Carbon::parse(old('date_of_birth', $passport->date_of_birth))->format('d-m-Y') }}" placeholder="Date Of Birth" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="passport_type" class="col-2 col-form-label">Passport Type *</label>
                    <div class="col-10">
                        <select class="form-control kt-selectpicker" name="passport_type" id="passport_type">
                            <option value="1" {{ old('passport_type', $passport->passport_type) == 1 || old('passport_type', $passport->passport_type) == null ? 'selected' : '' }}>
                                General
                            </option>
                            <option value="2" {{ old('passport_type', $passport->passport_type) == 2 ? 'selected' : '' }}>
                                Government
                            </option>
                            <option value="3" {{ old('passport_type', $passport->passport_type) == 3 ? 'selected' : '' }}>
                                Others
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="issue_date" class="col-2 col-form-label">Issue Date *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="issue_date" name="issue_date"
                               value="{{ \Carbon\Carbon::parse(old('issue_date', $passport->issue_date))->format('d-m-Y') }}" placeholder="Issue Date" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expiry_date" class="col-2 col-form-label">Expiry Date *</label>
                    <div class="col-10">
                        <input class="form-control kt-datepicker" type="text" id="expiry_date" name="expiry_date"
                               value="{{ \Carbon\Carbon::parse(old('expiry_date', $passport->expiry_date))->format('d-m-Y') }}" placeholder="" required>
                        <span class="form-text text-danger" id="calculated_passport_expiry"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="emergency_contact_number" class="col-2 col-form-label">
                        Emergency Contact Number
                    </label>
                    <div class="col-10">
                        <input class="form-control" type="text" id="emergency_contact_number" name="emergency_contact_number"
                               value="{{ old('emergency_contact_number', $passport->emergency_contact_number) }}" placeholder="01XXXXXXXXXX">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="issue_location" class="col-2 col-form-label">Address</label>
                    <div class="col-10">
                        <textarea class="form-control" type="text" id="issue_location" name="issue_location"
                                  rows="5"
                                  placeholder="Address">{{ old('issue_location', $passport->issue_location) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">
                        Additional Documents
                    </label>
                    <div class="col-10" id="document_upload_div">
                        @if (isset($passport->id))
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th colspan="9">Document Title</th>
                                            <th colspan="1">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($passport->documents as $document)
                                        <tr row-id="{{$document->id}}">
                                            <td colspan="9">{{ $document->title }}</td>
                                            <td colspan="1">
                                                <button type="button" class="btn btn-danger btn-sm" @click="deleteDocument({{$document->id}})">
                                                    <i class="flaticon-delete"></i>
                                                </button>
                                                <a href="{{ Storage::disk('public')->url('uploads/customers/passport-documents/' . $document->document) }}"
                                                   target="_blank"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="flaticon-download-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-5">
                                <input class="form-control" type="file" id="document[]" name="document[]">
                            </div>
                            <div class="col-5">
                                <input class="form-control" type="text" id="document_title[]" name="document_title[]" placeholder="Document Title">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-success" @click="addNewDocument()">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-2">
                            </div>
                            <div class="col-10">
                                <a href="{{ route('passport-info.index') }}" class="btn btn-primary">Cancel</a>
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
            $('#passport-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#add-passport-information-sm').addClass('kt-menu__item--active');

            $('#expiry_date').change(function () {
                let PPExpDate = moment($(this).val(), 'DD-MM-YYYY');
                let years = moment().diff(PPExpDate, 'years');
                let months = moment().diff(PPExpDate.add(years, 'years'), 'months');
                let days = moment().diff(PPExpDate.add(months, 'months'), 'days');
                $('#calculated_passport_expiry').text(`Remaining: ${years} years, ${months} months, ${days} days`);
            });
        });
    </script>
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('js/pages/passport.js') }}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endpush
