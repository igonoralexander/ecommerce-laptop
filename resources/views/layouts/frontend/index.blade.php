<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Ecomus - Ultimate HTML</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- font -->
    <link rel="stylesheet" href="{{ asset ('frontend/fonts/fonts.css') }}">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset ('frontend/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset ('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('frontend/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('frontend/css/animate.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset ('frontend/css/styles.css') }}"/>

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/logo/favicon.png')}}">

</head>

<body class="preload-wrapper">
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        
        @if (!in_array(Route::currentRouteName(), [
            'shop', 'checkout', 'cart', 'product.detail', 'contact', 'thank.you'
            ]))

                @include('layouts.frontend.inc.top-bar')
        @endif

        @include('layouts.frontend.inc.header')

        @yield('content')

        @include('layouts.frontend.inc.ask-question')

        @include('layouts.frontend.inc.footer')
        
    </div>

    <!-- gotop -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>
    <!-- /gotop -->
    
    @include('layouts.frontend.inc.toolbar-bottom')

    @include('layouts.frontend.inc.mobile-menu')

    @include('layouts.frontend.inc.login')

    @include('layouts.frontend.inc.search')
    
    @include('layouts.frontend.inc.add-to-cart')

    @include('layouts.frontend.inc.quick-view')

    @include('layouts.frontend.inc.shopping-cart')

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/multiple-modal.js') }}"></script>

    @yield('scripts')

    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>

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

    <script>
        $(document).ready(function () {

            // Open Quick Add Modal with Dynamic Product Data
            $('.btn-open-quick-add').on('click', function (e) {
                e.preventDefault();
                let button = $(this);

                $.ajax({
                    url: '{{ route("modal.quick.add") }}', // You’ll create this route
                    method: 'GET',
                    data: {
                        product_id: button.data('product-id')
                    },
                    success: function (html) {
                        $('#quickAddContent').html(html);
                        $('#quickAddContent input[name="quantity"]').val(1); // reset quantity
                        $('#quick_add').modal('show');

                        // Re-initializing Swiper here
                        new Swiper('.tf-single-slide', {
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                            loop: true,
                            slidesPerView: 1,
                        });
            
                    }
                });
            });

            // Use event delegation on a stable parent like #quickAddContent
            $('#quickAddContent').on('click', '.btn-quantity', function () {
                let input = $(this).siblings('input[name="quantity"]');
                let currentVal = parseInt(input.val());

                if ($(this).hasClass('plus-btn')) {
                    input.val(currentVal + 1);
                } else if ($(this).hasClass('minus-btn')) {
                    if (currentVal > 1) {
                        input.val(currentVal - 1);
                    }
                }
            });

            // Add to Cart (delegated since modal content is dynamic)
            $(document).on('click', '.btn-add-to-cart', function (e) {
                e.preventDefault();

                let button = $(this);
                let modal = button.closest('.modal');
                let quantity = parseInt(modal.find('input[name="quantity"]').val()) || 1;

                let productData = {
                    laptop_id: button.data('product-id'),
                    name: button.data('name'),
                    price: button.data('price'),
                    sale_price: button.data('sale-price'),
                    image: button.data('image'),
                    quantity: quantity
                };

                $.ajax({
                    url: '{{ route("cart.add") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product: productData
                    },
                    success: function (response) {
                        SwalGlobal.fire({
                            icon: 'success',
                            title: 'Added to Cart!',
                            text: response.message ?? 'Item added successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#shoppingCart').modal('show');

                        if ($('.tf-mini-cart-items').length === 0) {
                            $('body').append('<div class="tf-mini-cart-items"></div>');
                        }

                        $('.tf-mini-cart-items').html(response.cart_html);
                        $('.tf-totals-total-value').text(`₦${response.cart_subtotal}`);
                        $('#cartItemCount').text(response.cart_count);
                        $('#cartCountSpan').text(`(${response.cart_count})`);
                    },
                    error: function (xhr) {
                        SwalGlobal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: xhr.status === 409
                                ? 'Product already in cart.'
                                : (xhr.responseJSON?.message ?? 'Failed to add item to cart.'),
                            showConfirmButton: true,
                        });
                    }
                });
            });

            // Quantity Increase/Decrease in Cart Modal
            $(document).on('click', '.plusbtn, .minusbtn', function () {
                let index = $(this).data('index'); // product id (laptop_id)
                let input = $(this).siblings('input.quantity-input');
                let currentQty = parseInt(input.val()) || 1;
                let newQty = currentQty;

                if ($(this).hasClass('plusbtn')) {
                    newQty = currentQty + 1;
                } else if ($(this).hasClass('minusbtn') && currentQty > 1) {
                    newQty = currentQty - 1;
                }

                input.val(newQty).trigger('change'); // trigger change event to update quantity in session
            });

            // --- Update Quantity in Cart---
            $(document).on('change', '.tf-mini-cart-item .quantity-input', function () {
                let index = $(this).data('index'); // product id
                let newQuantity = parseInt($(this).val()) || 1;

                $.ajax({
                    url: '{{ route("cart.update.quantity") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        index: index,
                        quantity: newQuantity
                    },
                    success: function (response) {
                        // Update cart items, subtotal, and header count
                        $('.tf-mini-cart-items').html(response.cart_html);
                        $('.tf-totals-total-value').text(`₦${response.cart_subtotal}`);
                        $('#cartItemCount').text(response.cart_count);
                    },
                    error: function () {
                        alert('Failed to update quantity.');
                    }
                });
            });

            // --- Remove Item from Cart ---
            $(document).on('click', '.tf-mini-cart-remove', function () {
                let index = $(this).data('index'); // product id
                $.ajax({
                    url: '{{ route("cart.remove") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        index: index
                    },
                    success: function (response) {
                        // Update cart items, subtotal, and header count
                        $('.tf-mini-cart-items').html(response.cart_html);
                        $('.tf-totals-total-value').text(`₦${response.cart_subtotal}`);
                        $('#cartItemCount').text(response.cart_count);
                    },
                    error: function (xhr) {
                        SwalGlobal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message ?? 'Failed to add item to cart.'
                        });
                    }
                });

            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const salePrice = parseFloat(document.getElementById('sale-price').dataset.price);
            const quantityInput = document.getElementById('quantity-input');
            const totalPriceDisplay = document.getElementById('total-price');
            const increaseBtn = document.querySelector('.btn-increase');
            const decreaseBtn = document.querySelector('.btn-decrease');

            function updateTotalPrice() {
                let quantity = parseInt(quantityInput.value);
                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                    quantityInput.value = 1;
                }
                const total = salePrice * quantity;
                totalPriceDisplay.textContent = `₦${total.toLocaleString()}`;
            }

            quantityInput.addEventListener('input', updateTotalPrice);
            increaseBtn.addEventListener('click', () => {
                quantityInput.value = parseInt(quantityInput.value) + 1;
                updateTotalPrice();
            });
            decreaseBtn.addEventListener('click', () => {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                    updateTotalPrice();
                }
            });

            updateTotalPrice(); // initial calculation
        });
    </script>

</body>

</html>