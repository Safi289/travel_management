<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>{{ config('app.name') }} | @yield('page_tagline')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <base href="{{ url('/') }}">

    <!--begin::Global Theme Styles(used by all pages) -->
    @include('layouts.partials.pdfcss')
    <!--end::Global Theme Styles -->

@stack('css')

<!-- Custom Theme Style -->
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body>

@yield('content')

<script>
    function printData(selected_id)
    {
        var divToPrint=document.getElementById(selected_id);
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},10);
    }
</script>
</body>
</html>
