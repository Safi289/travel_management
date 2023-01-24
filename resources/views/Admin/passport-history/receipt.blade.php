<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- jQuery 3 -->
    <script src="{{ asset('/vendor/dashboard/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/vendor/dashboard/assets/plugins/jquery/jquery-migrate-1.0.0.js') }}"></script>

    <!-- Print JS -->
    <script src="{{ asset('/vendor/dashboard/assets/plugins/printJs/print.js') }}"></script>

    <style type="text/css">
        .line {
            width: 130px; height: 765px; border-bottom: 1px solid black;
        }
    </style>

</head>
<body style="margin: 0;">
<button onclick="prints()" style="float:right;">Print</button>
<div id="printBody">

    <div style="width: 21cm; height: 29.7cm; float:left; margin-right:10px;">
        <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:10px;">
            <tbody style="text-align: left;">
            <tr>
                <td style="border-left:none; text-align:left;">
                    <img alt="Brand" src="{{brandLogo()}}">
                </td>
                <td colspan="3" style="border-right:none;text-align:right;">
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:14px;">
            <thead>
            <tr>
                <td colspan="8" style="width: 75%;">
                    <h3>S.N. TRAVELS & TOURS</h3>
                    <p style="margin-top: 0px; margin-bottom: 0px"><b>Address:</b>
                        &nbsp;&nbsp;&nbsp;Chistia Tower, Jurain, Dhaka-1204
                    </p>
                    <b>Phone Number:</b>&nbsp;&nbsp;&nbsp;01847287740-49 02-47441616
                    <br><b>Email:</b>&nbsp;&nbsp;&nbsp;sntravelstour@gmail.com
                    <br><b>Fax:</b>
                </td>
                <td colspan="4" valign="top" style="border-right:none;text-align:left;">
                    <b>SL No:</b>&nbsp;&nbsp;&nbsp;{{$passport->id}}
                    <br><b>Date:</b>&nbsp;&nbsp;&nbsp;{{$passport->created_at->format('d-M-Y')}}
                </td>
            </tr>
            </thead>
            <tbody style="text-align: left;">
            <tr>
                <td colspan="12" style="border-left:none; text-align:left;">
                    <br>
                    <br>
                    <p><b>Travel Consultant:</b> Abdul Momin (Staff)</p>
                    <p><b>Address:</b> Jurain Ofc, 01813939784</p>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>

        <table style="width:100%; border-collapse: collapse; min-height: 680px;">
            <tbody>
            <tr>
                <td valign="top">
                    <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:10px;">
                        <tbody>
                        <tr>
                            <th style="border: 1px solid #000">Passport No.</th>
                            <th style="border: 1px solid #000">Full Name</th>
                            <th style="border: 1px solid #000">Passport Status</th>
                        </tr>
                        @if ($passport)
                            <tr>
                                <td style="border: 1px solid #000; text-align: center;">{{$passport->passport_no}}</td>
                                <td style="border: 1px solid #000; text-align: center;">{{$passport->full_name}}</td>
                                <td style="border: 1px solid #000; text-align: center;">{{$passport->passportStatuses->first()->status_name}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

        <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:10px; margin-top: 50px;">
            <tbody style="text-align: left;">
            <tr>
                <td valign="bottom" style="border-left:none; text-align:center;">
                    <div style="width: 130px; margin: auto; border-bottom: 1px solid black;"></div>
                    <br>
                    <b>Prepared By</b>
                </td>
                <td style="border-left:none; text-align:center;">
                    <div style="width: 130px; margin: auto; border-bottom: 1px solid black;"></div>
                    <br>
                    <b>Received By</b>
                </td>
                <td style="border-left:none; text-align:center;">
                    <div style="width: 130px; margin: auto; border-bottom: 1px solid black;"></div>
                    <br>
                    <b>Authorized By</b>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function () {
        $('#printBody').printElement({printMode: 'popup'});
    });

    function prints() {
        $('#printBody').printElement({printMode: 'popup'});
    }
</script>
</body>
</html>
