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
    @if(count($cartItems) > 0)
        <!-- page-cart -->
        <section class="flat-spacing-11">
            <div class="container">
                <form id = "checkoutForm" class="form-checkout" enctype="multipart/form-data">
                    @csrf

                    <div class="tf-page-cart-wrap layout-2">
                        <div class="tf-page-cart-item">
                            <h5 class="fw-5 mb_20">Billing details</h5>

                            <div class="box grid-2">
                                @auth
                                    <input type="hidden" name="is_guest" value="0">
                                    <fieldset class="fieldset">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" name="first_name" value="{{ old('first_name', Auth::user()->first_name ?? '') }}" readonly>
                                    </fieldset>
                                    <fieldset class="fieldset">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" name="last_name" value="{{ old('last_name', Auth::user()->last_name ?? '') }}" readonly>
                                    </fieldset>
                                @else
                                    <input type="hidden" name="is_guest" value="1">
                                    <fieldset class="fieldset">
                                        <label for="first-name">First Name</label>
                                        <input type="text" id="first-name" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>
                                    </fieldset>
                                    <fieldset class="fieldset">
                                        <label for="last-name">Last Name</label>
                                        <input type="text" id="last-name" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
                                    </fieldset>
                                @endauth
                            </div>

                            <fieldset class="box fieldset">
                                <label for="phone">Phone Number</label>
                                @auth
                                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number ?? '') }}" readonly>
                                @else
                                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number" required>
                                @endauth
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="address">Address</label>
                                @auth
                                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                @else
                                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
                                @endauth
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="email">Email</label>
                                @auth
                                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" readonly>
                                @else
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                                @endauth
                            </fieldset>

                            <fieldset class="box fieldset">
                                <label for="note">Order notes (optional)</label>
                                <textarea name="order_notes" id="order_note">{{ old('order_notes') }}</textarea>
                            </fieldset>
                        </div>

                        <div class="tf-page-cart-footer">
                            <div class="tf-cart-footer-inner">
                                <h5 class="fw-5 mb_20">Your order</h5>

                                    <ul class="tf-page-cart-checkout widget-wrap-checkout wrap-checkout-product">

                                        @php $total = 0; @endphp

                                        @foreach($cartItems as $item)
                                            @php 
                                                $itemSubtotal = $item['subtotal'] ?? ($item['sale_price'] * $item['quantity']);
                                                $total += $itemSubtotal;
                                            @endphp

                                        <li class="checkout-product-item">
                                            <figure class="img-product">
                                                @auth
                                                    <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}">
                                                @else
                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                                                @endauth
                                                <span class="quantity">{{ $item['quantity'] }}</span>
                                            </figure>
                                            <div class="content">
                                                <div class="info">
                                                    <p class="name">{{ $item['name'] }}</p>
                                                </div>
                                                <input type="hidden" name="subtotal" value="{{ $itemSubtotal }}">
                                                <span class="price">₦{{ number_format($itemSubtotal, 2) }}</span>
                                            </div>
                                            <!-- Pass cart item data as hidden input (optional if needed for confirmation) -->
                                            <input type="hidden" name="cart_items[]" value="{{ json_encode($item) }}">

                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex justify-content-between line pb_20">
                                        <h6 class="fw-5">Total</h6>
                                        <input type="hidden" name="total_price" value="{{ number_format($total, 2) }}">
                                        <h6 class="total fw-5">₦{{ number_format($total, 2) }}</h6>
                                    </div>
                                    <div class="wd-check-payment">
                                        <div class="fieldset-radio mb_20">
                                            <input type="radio" name="payment_method" id="bank" class="tf-check" checked>
                                            <label for="bank">Direct bank transfer</label>
                                        
                                        </div>
                                        <div class="fieldset-radio mb_20">
                                            <input type="radio" name="payment_method" id="delivery" class="tf-check">
                                            <label for="delivery">Cash on delivery</label>
                                        </div>
                                        <p class="text_black-2 mb_20">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="privacy-policy.html" class="text-decoration-underline">privacy policy</a>.</p>
                                        <div class="box-checkbox fieldset-radio mb_20">
                                            <input type="checkbox" id="check-agree" class="tf-check">
                                            <label for="check-agree" class="text_black-2">I have read and agree to the website <a href="terms-conditions.html" class="text-decoration-underline">terms and conditions</a>.</label>
                                        </div>
                                    </div>
                                    <button id="placeOrderBtn" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Place order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- page-cart -->
    @else
        <!-- Optional: Empty cart message -->
        <section class="flat-spacing-11">
            <div class="container text-center py-5">
                <h4>Your cart is empty</h4>
                <a href="{{ route('shop') }}" class="tf-btn radius-3 btn-fill mt-3">Continue Shopping</a>
            </div>
        </section>
    @endif
@endsection


@section('scripts')
<script>
    $('#checkoutForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        SwalGlobal.fire({
            title: 'Placing order...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: "{{ route('checkout.placeOrder') }}", // Adjust to your correct route
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                SwalGlobal.fire({
                    icon: 'success',
                    title: 'Order placed!',
                    text: response.message || 'Your order was successfully submitted.',
                }).then(() => {
                    if (response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                        window.location.reload();
                    }
                });
            },
            error: function (xhr) {
                SwalGlobal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong. Please try again.'
                });
            }
        });
    });
</script>
@endsection