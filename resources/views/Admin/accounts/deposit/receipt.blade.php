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
            width: 130px;
            height: 765px;
            border-bottom: 1px solid black;
        }
    </style>

</head>
<body style="margin: 0;">
<button onclick="prints()" style="float:right;">Print</button>
<div id="printBody">

    <div style="width: 21cm; height: 29.7cm; float:left; margin-right:10px;">
        @for($i=0;$i<2;$i++)
            @if ($i>0)
                <div style="width: 100%; margin: 20px 0; border-bottom: 1px dashed black;"></div>
            @endif
            <div style="border: 1px solid #000; padding: 5px;">
                <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:14px;">
                    <tbody style="text-align: left;">
                    <tr>
                        <td colspan="3" style="border-left:none; text-align:left;width: 59%;">
                            <img alt="Brand" src="{{brandLogo()}}">
                        </td>
                        <td colspan="1" style="border-right:none;">
                            <h1 style="text-align:right;font-size: 3.5em;">Money Receipt</h1>
                            <div style="margin-left: 20px;margin-top: -25px;">
                                <b>Receipt No:</b>&nbsp;&nbsp;&nbsp;{{$payment->id}}
                                <br><b>Date:</b>&nbsp;&nbsp;&nbsp;{{$payment->created_at->format('d F Y')}}
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
                        <td colspan="4" valign="middle" style="border-right:none;text-align:left;">
                            @if ($i==0)
                                <b>** Customer Copy **</b>
                            @else
                                <b>** Office Copy **</b>
                            @endif
                        </td>
                    </tr>
                    </thead>
                    <tbody style="text-align: left;">
                    </tbody>
                </table>
                <br>
                <br>

                <table style="width:100%; border-collapse: collapse;">
                    <tbody>
                    <tr>
                        <td valign="top">
                            <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:18px;">
                                <tbody>
                                <tr>
                                    <td style="width: 20%"></td>
                                    <td style="width: 20%; text-align: right;">Received From</td>
                                    <td style="width: 60%">
                                        &nbsp; <b>{{$payment->depositor_name}}</b>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"></td>
                                    <td style="width: 20%; text-align: right;">The Sum of Total</td>
                                    <td style="">
                                        &nbsp; <b>{{number_format($payment->amount, 2)}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%"></td>
                                    <td style="width: 20%; text-align: right;">By</td>
                                    <td style="">
                                        &nbsp; <b>{{$payment->type_value}}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 80%; padding-left: 40px;">
                                        <b>Total Amount In Words: </b> {{numberToWord($payment->amount)}} BDT Only
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width: 80%; padding-left: 100px;">Remarks:</td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table cellpadding="3" cellspacing="0" border="0" style="width:100%; border-collapse: collapse; font-size:14px; margin-top: 50px;">
                    <tbody style="text-align: left;">
                    <tr>

                        <td colspan="4" valign="bottom" style="border-left:none; text-align:center;width: 0%;"></td>
                        <td style="border-left:none; text-align:center;">
                            <div style="width: 140px; margin: auto; border-bottom: 1px solid black;"></div>
                            <br>
                            <b>Accounts Officer</b>
                        </td>



                        <td colspan="4" valign="bottom" style="border-left:none; text-align:center;width: 70%;"></td>
                        <td style="border-left:none; text-align:center;">
                            <div style="width: 140px; margin: auto; border-bottom: 1px solid black;"></div>
                            <br>
                            <b>Receiving Officer</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endfor
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
