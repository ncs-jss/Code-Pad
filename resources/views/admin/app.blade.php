<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>Free HTML5 Bootstrap Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <link id="bs-css" href="{{ URL::asset('public/admin/css/bootstrap-cerulean.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/css/bootstrap-cerulean.min.css')}}" rel="stylesheet">


    <link href="{{ URL::asset('public/admin/css/charisma-app.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('public/admin/bower_components/fullcalendar/dist/fullcalendar.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/bower_components/fullcalendar/dist/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <link href="{{ URL::asset('public/admin/bower_components/chosen/chosen.min.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/bower_components/colorbox/example3/colorbox.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/bower_components/responsive-tables/responsive-tables.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/jquery.noty.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/noty_theme_default.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/elfinder.min.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/elfinder.theme.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/jquery.iphone.toggle.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/uploadify.css')}}" rel='stylesheet'>
    <link href="{{ URL::asset('public/admin/css/animate.min.css')}}" rel='stylesheet'>

    <!-- jQuery -->
    <!-- <script src="{{ URL::asset('public/admin/bower_components/jquery/jquery.min.js')}}"></script> -->

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js')}}"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="{{ URL::asset('public/admin/img/favicon.ico')}}"">
    @yield('head')
</head>

<body>
    @yield('content')

    @yield('footer')

  <!-- external javascript -->

<script src="{{ URL::asset('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- library for cookie management -->
<script src="{{ URL::asset('public/admin/js/jquery.cookie.js')}}"></script>
<!-- calender plugin -->
<script src="{{ URL::asset('public/admin/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ URL::asset('public/admin/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<!-- data table plugin -->
<script src="{{ URL::asset('public/admin/js/jquery.dataTables.min.js')}}"></script>

<!-- select or dropdown enhancer -->
<script src="{{ URL::asset('public/admin/bower_components/chosen/chosen.jquery.min.js')}}"></script>
<!-- plugin for gallery image view -->
<script src="{{ URL::asset('public/admin/bower_components/colorbox/jquery.colorbox-min.js')}}"></script>
<!-- notification plugin -->
<script src="{{ URL::asset('public/admin/js/jquery.noty.js')}}"></script>
<!-- library for making tables responsive -->
<script src="{{ URL::asset('public/admin/bower_components/responsive-tables/responsive-tables.js')}}"></script>
<!-- tour plugin -->
<script src="{{ URL::asset('public/admin/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js')}}"></script>
<!-- star rating plugin -->
<script src="{{ URL::asset('public/admin/js/jquery.raty.min.js')}}"></script>
<!-- for iOS style toggle switch -->
<script src="{{ URL::asset('public/admin/js/jquery.iphone.toggle.js')}}"></script>
<!-- autogrowing textarea plugin -->
<script src="{{ URL::asset('public/admin/js/jquery.autogrow-textarea.js')}}"></script>
<!-- multiple file upload plugin -->
<script src="{{ URL::asset('public/admin/js/jquery.uploadify-3.1.min.js')}}"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="{{ URL::asset('public/admin/js/jquery.history.js')}}"></script>
<!-- application script for Charisma demo -->
<script src="{{ URL::asset('public/admin/js/charisma.js')}}"></script>

    @yield('script')

</body>
</html>
