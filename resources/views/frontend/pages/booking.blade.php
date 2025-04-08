@extends('layouts.frontend.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')

@section('content')

        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">Check Out</div>
            </div>
        </div>
        <!-- /page-title -->
        
        <!-- page-cart -->
        <section class="flat-spacing-11">
            <div class="container">
                <div class="tf-page-cart-wrap layout-2">
                    <div class="tf-page-cart-item">
                        <h5 class="fw-5 mb_20">Booking details</h5>
                        <form class="form-checkout" id="booking-form">
                            @csrf
                            <div class="box grid-2">
                                <fieldset class="fieldset">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" value="" required>
                                </fieldset>
                                <fieldset class="fieldset">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" value="" required>
                                </fieldset>
                            </div>
                            <fieldset class="box fieldset">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" value="" required>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="" required>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="package_id">Photography Package</label>
                                <div class="select-custom">
                                    <select class="tf-select w-100" id="package_id" name="package_id" required>
                                        <option value="">Select a Package</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }} - ${{ $package->price }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="date">Date</label>
                                <input type="date" id="date" name="date" required>
                            </fieldset>
                            <fieldset class="box fieldset">
                                <label for="time">Time</label>
                                <input type="time" id="time" name="time" required>
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" required>
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="note">Special Requests (optional)</label>
                                <textarea name="special_requests" id="note"></textarea>
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="location">Num of people</label>
                                <input  type="number" id="num_people" name="num_people" min="1" required>
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="payment_option">Payment Option</label>
                                <div class="select-custom">
                                    <select class="tf-select w-100" id="payment_option" name="payment_option">
                                        <option value="full">Full Payment</option>
                                        <option value="deposit">Deposit Payment</option>
                                    </select>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                    <div class="tf-page-cart-footer">
                        <div class="tf-cart-footer-inner">
                            <h5 class="fw-5 mb_20">Your Booking</h5>
                            <form class="tf-page-cart-checkout widget-wrap-checkout">
                                <ul class="wrap-checkout-product">
                                    <li class="checkout-product-item">
                                        <div class="content">
                                            <div class="info">
                                                <p class="name">Ribbed modal T-shirt</p>
                                                <span class="variant">Brown / M</span>
                                            </div>
                                            <span class="price">$25.00</span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="coupon-box">
                                    <input type="text" placeholder="Discount code">
                                    <a href="#" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Apply</a>
                                </div>
                                <div class="d-flex justify-content-between line pb_20">
                                    <h6 class="fw-5">Total</h6>
                                    <h6 class="total fw-5">$122.00</h6>
                                </div>
                                <div class="wd-check-payment">
                                    <div class="fieldset-radio mb_20">
                                        <input type="radio" name="payment" id="bank" class="tf-check" checked>
                                        <label for="bank">Bank transfer</label>
                                       
                                    </div>
                                    <div class="fieldset-radio mb_20">
                                        <input type="radio" name="payment" id="delivery" class="tf-check">
                                        <label for="delivery">Cash on delivery</label>
                                    </div>
                                    <p class="text_black-2 mb_20">Your personal data will be used to process your booking, support your experience throughout this website, and for other purposes described in our <a href="privacy-policy.html" class="text-decoration-underline">privacy policy</a>.</p>
                                    <div class="box-checkbox fieldset-radio mb_20">
                                        <input type="checkbox" id="check-agree" class="tf-check">
                                        <label for="check-agree" class="text_black-2">I have read and agree to the website <a href="terms-conditions.html" class="text-decoration-underline">terms and conditions</a>.</label>
                                    </div>
                                </div>
                                <button class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page-cart -->
@endsection