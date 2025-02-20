<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
    <link rel="stylesheet" type="text/css" href="{{ asset ('backend/css/styles.css') }}">



    <!-- Font -->
    <link rel="stylesheet" href="{{ asset ('backend/font/fonts.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset ('backend/icon/style.css') }}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset ('backend/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset ('backend/images/favicon.png') }}">

</head>

<body class="body">

    @yield('content')

    <!-- Javascript -->
    <script src="{{ asset ('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset ('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('backend/js/bootstrap-select.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')

    <script defer src="{{ asset ('backend/js/main.js') }}"></script>

</body>

</html>