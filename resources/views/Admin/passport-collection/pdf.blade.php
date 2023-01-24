@extends('layouts.pdf')

@section('page_title', $controllerInfo->title)
@section('page_tagline', $controllerInfo->title)

@push('css')
    <style>
        body {
            /*width: 21cm;*/
            height: 29.7cm;
            margin: 0 auto;
        }

        .page-break {
            page-break-after: always;
        }

        .no-break {
            page-break-inside: avoid;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .panel-heading h3 {
            font-weight: bold;
            font-size: 25px;
        }

        .inner-table > td > table > tbody > tr {
            /*width: 100%;*/
        }

        .inner-table > td > table > tbody > tr > td:first-child {
            /*width: 55%;*/
        }

        /*.main-table {
            background-color: #fff;
            border-collapse: unset;
            margin-bottom: 10px;
        }

        .main-table tbody {
        }

        .main-table > tbody > tr > td {
            padding: 5px 15px;
        }

        .main-table > tbody > tr > td p {
            margin: 0;
        }

        .main-table > tbody > tr:first-child > td:first-child {
            border-top: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-radius: 5px 0 0 0 !important;
        }

        .main-table > tbody > tr:last-child > td:first-child {
            border-bottom: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-radius: 0 0 0 5px !important;
        }

        .main-table > tbody > tr:first-child > td:last-child {
            border-top: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0 !important;
        }

        .main-table > tbody > tr:last-child > td:last-child {
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
            border-radius: 0 0 5px 0 !important;
        }*/
    </style>
@endpush

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">{{ $controllerInfo->title }}</h3>
        </div>
        <div class="panel-body">
            <table style="width:100%">
                <tbody>
                <tr class="inner-table">
                    <td width="50%">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Ref. Customer: </p>
                                </td>
                                <td>
                                    <p>{{ $passport_collection->full_name }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="50%">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Group: </p>
                                </td>
                                <td>
                                    <p>{{ $passport_collection->group ? $passport_collection->group->group_name : '' }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="inner-table">
                    <td width="50%">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Mobile No: </p>
                                </td>
                                <td>
                                    <p>{{ $passport_collection->mobile }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="50%">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Number of Passport: </p>
                                </td>
                                <td>
                                    <p>{{ $passport_collection->submitted_passports_count }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="inner-table">
                    <td width="100%" colspan="2">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Address: </p>
                                </td>
                                <td>
                                    <p>{{ $passport_collection->current_address }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        @if (isset($passport_collection->id))
            @foreach($passport_collection->submitted_passports as $key => $passport)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table style="width:100%" class="main-table">
                            <tbody>
                            <tr class="inner-table">
                                <td width="50%">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p class="font-weight-bold">Full Name: </p>
                                            </td>
                                            <td>
                                                <p>{{ $passport->full_name }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p class="font-weight-bold">Passport Number: </p>
                                            </td>
                                            <td>
                                                <p>{{ $passport->passport_no }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr class="inner-table">
                                <td width="50%">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p class="font-weight-bold">Date Of Birth: </p>
                                            </td>
                                            <td>
                                                <p>{{ \Carbon\Carbon::parse($passport->date_of_birth)->format('d-M-Y') }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td width="50%">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p class="font-weight-bold">Expiry Date: </p>
                                            </td>
                                            <td>
                                                <p>{{ \Carbon\Carbon::parse($passport->expiry_date)->format('d-M-Y') }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($key == 6)
                    <div class="page-break"></div>
                @endif
            @endforeach
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#passport-management-mm').addClass('kt-menu__item--submenu kt-menu__item--open kt-menu__item--here');
            $('#passport-collection-sm').addClass('kt-menu__item--active');
        });
    </script>
    <!--end::Page Scripts -->
@endpush
