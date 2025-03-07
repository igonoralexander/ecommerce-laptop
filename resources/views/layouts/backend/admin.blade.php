<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<html data-turbolinks-track="reload">
    
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>@yield('pageTitle')</title>

    <!-- Open Graph Meta Tags (Only if defined in the child view) -->
    @hasSection('og_title')
        <meta property="og:title" content="@yield('og_title')">
    @endif

    @hasSection('og_description')
        <meta property="og:description" content="@yield('og_description')">
    @endif

    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @endif

    @hasSection('og_url')
        <meta property="og:url" content="@yield('og_url')">
    @endif

    @hasSection('og_type')
        <meta property="og:type" content="@yield('og_type')">
    @endif

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/bootstrap-select.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/jquery.fancybox.min.css') }}" > -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset ('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('backend/js/bootstrap-select.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset ('backend/js/zoom.js') }}"></script>
    <script src="{{ asset ('backend/js/switcher.js') }}"></script>
    <script defer src="{{ asset ('backend/js/theme-settings.js') }}"></script>

    @stack('scripts')
  	@livewireScripts

    @yield('script')

    <script src="{{ asset ('backend/js/main.js') }}"></script>
    <script>
        // Global SweetAlert mixin for all alerts
        const SwalGlobal = Swal.mixin({
            customClass: {
                popup: 'swal-wide',
                title: 'swal-title',
                content: 'swal-text'
            }
        });
    </script>

</body>

</html>