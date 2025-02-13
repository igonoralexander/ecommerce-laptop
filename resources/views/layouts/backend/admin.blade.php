<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<html data-turbolinks-track="reload">
    
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>@yield('pageTitle')</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/bootstrap-select.min.css') }}">

    @stack('styles')

    @livewireStyles

    @yield('style')

    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/styles.css') }}">



    <!-- Font -->
    <link rel="stylesheet" href="{{ asset ('backend/font/fonts.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset ('backend/icon/style.css') }}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset ('backend/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset ('backend/images/favicon.png') }}">

</head>

<body>

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->
                @include('layouts.backend.inc.sidebar')
                <!-- section-content-right -->
                <div class="section-content-right">
                    
                    @include('layouts.backend.inc.header')

                    @yield('content')

                </div>
                <!-- /section-content-right -->
            </div>
            <!-- /layout-wrap -->
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="{{ asset ('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('backend/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset ('backend/js/zoom.js') }}"></script>
    <script src="{{ asset ('backend/js/morris.min.js') }}"></script>
    <script src="{{ asset ('backend/js/raphael.min.js') }}"></script>
    <script src="{{ asset ('backend/js/morris.js') }}"></script>
    <script src="{{ asset ('backend/js/jvectormap.min.js') }}"></script>
    <script src="{{ asset ('backend/js/jvectormap-us-lcc.js') }}"></script>
    <script src="{{ asset ('backend/js/jvectormap-data.js') }}"></script>
    <script src="{{ asset ('backend/js/jvectormap.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-1.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-2.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-3.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-4.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-5.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-6.js') }}"></script>
    <script src="{{ asset ('backend/js/apexcharts/line-chart-7.js') }}"></script>
    <script src="{{ asset ('backend/js/switcher.js') }}"></script>
    <script defer src="{{ asset ('backend/js/theme-settings.js') }}"></script>

    @stack('scripts')
  	@livewireScripts

    @yield('script')

    <script src="{{ asset ('backend/js/main.js') }}"></script>

</body>

</html>