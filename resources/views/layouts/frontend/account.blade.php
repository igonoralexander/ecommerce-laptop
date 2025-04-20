@extends('layouts.frontend.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')

@section('content')
        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">My Account</div>
            </div>
        </div>
        <!-- /page-title -->
        <!-- page-cart -->
        <section class="flat-spacing-11">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="wrap-sidebar-account">
                            <ul class="my-account-nav">
                                <li><span class="my-account-nav-item active">Dashboard</span></li>
                                <li><a href="{{ route('client.management') }}" class="my-account-nav-item">My Account</a></li>
                                <li><a href="my-account-address.html" class="my-account-nav-item">Address</a></li>
                                <li><a href="my-account-edit.html" class="my-account-nav-item">Account Details</a></li>
                                <li><a href="{{ route('client.change-password') }}" class="my-account-nav-item">Change Password</a></li>
                                <li><a href="my-account-wishlist.html" class="my-account-nav-item">Wishlist</a></li>


                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="route('logout')" class="my-account-nav-item"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">Logout</a>
                                    </form>
                                </li>


                            </ul>
                        </div>
                    </div>

                    @yield('account_content') 
                    
                </div>
            </div>
        </section>
        <!-- page-cart -->

        <!-- sidebar account-->
        <div class="offcanvas offcanvas-start canvas-filter canvas-sidebar canvas-sidebar-account" id="mbAccount">
            <div class="canvas-wrapper">
                <header class="canvas-header">
                    <span class="title">MY ACCOUNT</span>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                </header>
                <div class="canvas-body sidebar-mobile-append"> </div>
            </div>       
        </div>
        <!-- End sidebar account -->

        <div class="btn-sidebar-account">
            <button data-bs-toggle="offcanvas" data-bs-target="#mbAccount" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i></button>
        </div>
@endsection