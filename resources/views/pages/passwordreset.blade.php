<!DOCTYPE html>
<html lang="en">
<head>
    
	<meta charset="UTF-8">
    <meta name="description" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> 3Core Technology Ltd</title>

    <link rel="icon" href="{{ asset('fancyTem/img/core-img/favicon.ico' ) }} ">
    <link href="{{ asset('fancyTem/style.css') }} " rel="stylesheet">
    <link href="{{ asset('fancyTem/css/responsive/responsive.css' ) }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('regForm/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <link rel="stylesheet" href="{{ asset('regForm/css/main.css')}}">

</head>
<body>

 <div id="preloader">
        <div class="loader">
            <span class="inner1"></span>
            <span class="inner2"></span>
            <span class="inner3"></span>
        </div>
    </div>

@extends('layouts.search') 

<header class="header_area" id="header">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg align-items-center">
                        <a class="navbar-brand" href="index.html">3Core Technology</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fancyNav" aria-controls="fancyNav" aria-expanded="false" aria-label="Toggle navigation"><span class="ti-menu"></span></button>
                        <div class="collapse navbar-collapse" id="fancyNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login/Register</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @if (Route::has('login'))
                                        @auth
                                        <a class="dropdown-item" href="{{ url('/home') }}">Profile</a>
                                        @else
                                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                        @if (Route::has('register'))
                                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                        @endif
                                        @endauth
                                        @endif
                                    </div>
                                </li>
                            </ul>                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

	<div class="main fancy-footer-area fancy-bg-dark">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('regForm/images/signin-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Reset Password</h2>

                        <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input id = "email" type="email" class=" @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Enter Email" required autocomplete="email" autofocus/>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input id= "password" type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Enter Password" required autocomplete="current-password"/>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="form-group">
                            	<input class="agree-term" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="form-submit">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                                    <a class="form-group" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('regForm/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{ asset('regForm/js/main.js')}}"></script>


	<script src="{{asset('fancyTem/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('fancyTem/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('fancyTem/js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('fancyTem/js/others/plugins.js')}}"></script>
    <script src="{{asset('fancyTem/js/active.js') }}"></script>

</body>

</html>