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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
        
        @include('layouts.frontend.inc.top-bar')

        @include('layouts.frontend.inc.header')

        @yield('content')

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
                    }
                });
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
                        $('#shoppingCart').modal('show');
                        $('.tf-mini-cart-items').html(response.cart_html);
                        $('.tf-totals-total-value').text(`₦${response.cart_subtotal}`);
                        $('#cartItemCount').text(response.cart_count); // cart badge update
                    },
                    error: function () {
                        alert('Something went wrong while adding the item.');
                    }
                });
            });

            // Quantity Increase/Decrease in Cart Modal
            $(document).on('click', '.plus-btn, .minus-btn', function () {
                let index = $(this).data('index'); // product id (laptop_id)
                let input = $(this).siblings('input.quantity-input');
                let currentQty = parseInt(input.val()) || 1;
                let newQty = currentQty;

                if ($(this).hasClass('plus-btn')) {
                    newQty = currentQty + 1;
                } else if ($(this).hasClass('minus-btn') && currentQty > 1) {
                    newQty = currentQty - 1;
                }

                input.val(newQty).trigger('change'); // trigger change event to update quantity in session
            });

            // --- Update Quantity in Cart via AJAX ---
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
                    error: function () {
                        alert('Failed to remove item.');
                    }
                });

            });
        });
    </script>

</body>

</html>