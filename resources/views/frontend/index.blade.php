@extends('layouts.frontend.index')

@section('style')
	<style>
     
	</style>
@endsection

@section('content')

        <!-- Slider -->
        <section class="tf-slideshow slider-effect-fade slider-accessories">
            <div dir="ltr" class="swiper tf-sw-slideshow" data-preview="1.6" data-tablet="1" data-mobile="1" data-centered="true" data-space="30" data-loop="true" data-auto-play="false" data-delay="2000" data-speed="1000">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-slider">
                            <img src="{{ asset('frontend/images/slider/accessories2_slideshow1.jpg') }}" alt="fashion-slideshow">
                            <div class="box-content text-center">
                                <div class="container">
                                    <h2 class="fade-item fade-item-1 heading">Mix. Match. MagSafe</h2>
                                    <p class="fade-item fade-item-2">Snap on a case, wallet, wireless charger, or battery pack.</p>
                                    <div class="fade-item fade-item-3">
                                        <a href="/shop" class="tf-btn btn-outline-dark fw-5 btn-xl radius-60"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-slider">
                            <img src="{{ asset('frontend/images/slider/accessories2_slideshow2.jpg')}}" alt="fashion-slideshow">
                            <div class="box-content text-center">
                                <div class="container">
                                    <h2 class="fade-item fade-item-1 heading">Ecomus Docking</h2>
                                    <p class="fade-item fade-item-2">Fast wireless charging on-the-go.</p>
                                    <div class="fade-item fade-item-3">
                                        <a href="shop-default.html" class="tf-btn btn-outline-dark fw-5 btn-xl radius-60"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-slider">
                            <img src="{{ asset('frontend/images/slider/accessories2_slideshow3.jpg')}}" alt="fashion-slideshow">
                            <div class="box-content text-center">
                                <div class="container">
                                    <h2 class="fade-item fade-item-1 heading">Accessory Sale</h2>
                                    <p class="fade-item fade-item-2">Up to 40% off chargers, earbuds, and more.</p>
                                    <div class="fade-item fade-item-3">
                                        <a href="shop-default.html" class="tf-btn btn-outline-dark fw-5 btn-xl radius-60"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container wrap-navigation">
                <div class="nav-sw style-white nav-next-slider navigation-next-slider box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                <div class="nav-sw style-white nav-prev-slider navigation-prev-slider box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
            </div>
        </section>
        <!-- /Slider -->

        <!-- Icon box -->
        <section class="flat-spacing-1 flat-iconbox wow fadeInUp" data-wow-delay="0s">
            <div class="container">
                    <div class="wrap-carousel wrap-mobile">
                        <div dir="ltr" class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                            <div class="swiper-wrapper wrap-iconbox">
                                <div class="swiper-slide">
                                    <div class="tf-icon-box style-row">
                                        <div class="icon border-line-blue-1">
                                            <i class="text_blue-1 icon-shipping"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title fs-14 fw-6 text_blue-1">FREE SHIPPING</div>
                                            <p class="text_blue-1">You will love at great low prices</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tf-icon-box style-row">
                                        <div class="icon border-line-blue-1">
                                            <i class="text_blue-1 icon-payment fs-22"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title fs-14 fw-6 text_blue-1">FLEXIBLE PAYMENT</div>
                                            <p class="text_blue-1">Pay with Multiple Credit Cards</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tf-icon-box style-row">
                                        <div class="icon border-line-blue-1">
                                            <i class="text_blue-1 icon-return fs-20"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title fs-14 fw-6 text_blue-1">14 DAY RETURNS</div>
                                            <p class="text_blue-1">Within 30 days for an exchange</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="tf-icon-box style-row">
                                        <div class="icon border-line-blue-1">
                                            <i class="text_blue-1 icon-suport"></i>
                                        </div>
                                        <div class="content">
                                            <div class="title fs-14 fw-6 text_blue-1">PREMIUM SUPPORT</div>
                                            <p class="text_blue-1">Outstanding premium support</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                    </div>
            </div>
        </section>
        <!-- /Icon box -->

        <!-- Hot deals-->
        <section class="flat-spacing-2">
            <div class="container">
                <div class="flat-title flex-row justify-content-between gap-10 flex-wrap px-0">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Hot Deals</span>
                    <div class="tf-countdown-v3 wow fadeInUp" data-wow-delay="0s">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M13.5631 11.7661L10.7746 9.67465V5.41441C10.7746 4.98605 10.4283 4.6398 9.99996 4.6398C9.5716 4.6398 9.22535 4.98605 9.22535 5.41441V10.062C9.22535 10.306 9.34 10.5361 9.5352 10.6817L12.6336 13.0055C12.7673 13.1062 12.9302 13.1606 13.0975 13.1604C13.3338 13.1604 13.5662 13.0543 13.718 12.8498C13.9752 12.5081 13.9055 12.0225 13.5631 11.7661Z" fill="currentColor"></path>
                            <path d="M10 0C4.48566 0 0 4.48566 0 10C0 15.5143 4.48566 20 10 20C15.5143 20 20 15.5143 20 10C20 4.48566 15.5143 0 10 0ZM10 18.4508C5.34082 18.4508 1.54918 14.6592 1.54918 10C1.54918 5.34082 5.34082 1.54918 10 1.54918C14.66 1.54918 18.4508 5.34082 18.4508 10C18.4508 14.6592 14.6592 18.4508 10 18.4508Z" fill="currentColor"></path>
                        </svg>
                        <div class="js-countdown" data-timer="8007500" data-labels="D,H,M,S"></div>
                    </div>
                </div>
                <div class="wrap-carousel wrap-sw-3">
                    <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8 border-0 bg_grey-11">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src="{{ asset('frontend/images/products/bark-phone-blue.jpg') }}" src="{{ asset('frontend/images/products/bark-phone-blue.jpg') }}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('frontend/images/products/bark-phone-blue2.jpg') }}" src="{{ asset('frontend/images/products/bark-phone-blue2.jpg') }}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Case with MagSafe</a>
                                        <span class="price">$19.99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8 border-0 bg_grey-11">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src="{{ asset('frontend/images/products/cable-black.jpg')}}" src="{{ asset('frontend/images/products/cable-black.jpg')}}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('frontend/images/products/cable-black2.jpg')}}" src="{{ asset('frontend/images/products/cable-black2.jpg')}}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">MagSafe 3 Cable</a>
                                        <span class="price">$39.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8 border-0 bg_grey-11">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src="{{ asset('frontend/images/products/headphone-white.jpg')}}" src="{{ asset('frontend/images/products/headphone-white.jpg')}}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('frontend/images/products/headphone-red.jpg')}}" src="{{ asset('frontend/images/products/headphone-red.jpg')}}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Beats Studio Buds</a>
                                        <span class="price">$199.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8 border-0 bg_grey-11">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src="{{ asset('frontend/images/products/albert-black.jpg')}}" src="{{ asset('frontend/images/products/albert-black.jpg')}}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('frontend/images/products/albert-white.jpg')}}" src="{{ asset('frontend/images/products/albert-white.jpg')}}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Blue Ocean Band</a>
                                        <span class="price">$9.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8 border-0 bg_grey-11">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src="{{ asset('frontend/images/products/wireless-charging-white.jpg') }}" src="{{ asset('frontend/images/products/wireless-charging-white.jpg')}}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('frontend/images/products/wireless-charging-white.jpg')}}" src="{{ asset('frontend/images/products/wireless-charging-white.jpg')}}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">3-in-1 Wireless Charging</a>
                                        <span class="price">$199.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8 border-0 bg_grey-11">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product" data-src="images/products/cable-black3.jpg" src="images/products/cable-black3.jpg" alt="image-product">
                                            <img class="lazyload img-hover" data-src="images/products/cable-white2.jpg" src="images/products/cable-white2.jpg" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                            <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">USB-C Charge Cable</a>
                                        <span class="price">$69.99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-sw disable-line nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw disable-line nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Hot deals -->

        <!-- Categories -->
        <section>
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Shop by Brand</span>
                </div>
                <div class="flat-categories-bg wrap-carousel">
                    <div dir="ltr" class="swiper tf-sw-recent wow fadeInUp" data-preview="6" data-tablet="3" data-mobile="2" data-space-lg="70" data-space-md="30" data-space="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/cable.svg')}}" alt="collection-img" src="{{ asset('frontend/images/collections/cable.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Cables</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset ('frontend/images/collections/screen-protection.svg') }}" alt="collection-img" src="{{ asset('frontend/images/collections/screen-protection.svg')}}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Screen protection</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/chargers.svg')}}" alt="collection-img" src="{{ asset('frontend/images/collections/chargers.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Chargers</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/audio.svg') }}" alt="collection-img" src="{{ asset('frontend/images/collections/audio.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Audio</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/wireless-chargers.svg') }}" alt="collection-img" src="{{ asset('frontend/images/collections/wireless-chargers.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Wireless Chargers</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/magSafe.svg') }}" alt="collection-img" src="{{ asset('frontend/images/collections/magSafe.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">MagSafe</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/gaming.svg') }}" alt="collection-img" src="{{ asset('frontend/images/collections/gaming.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Gaming</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset('frontend/images/collections/storage.svg')}}" alt="collection-img" src="{{ asset('frontend/images/collections/storage.svg') }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">Storage</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                </div>
            </div>
        </section>
        <!-- /Categories -->

        <!-- Shoppable video -->
        <section class="flat-spacing-27 bg_light-grey-4">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title fw-6">Shoppable videos</span>
                </div>
                <div class="wrap-carousel">
                    <div dir="ltr" class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="collection-video wow fadeInUp">
                                    <div class="banner-video">
                                        <video autoplay playsinline muted loop>
                                            <source src="{{ asset('frontend/images/video/cosmetic1.mp4')}}" type="video/mp4">                                    
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-video wow fadeInUp">
                                    <div class="banner-video">
                                        <video autoplay playsinline muted loop>
                                            <source src="{{ asset('frontend/images/video/cosmetic2.mp4')}}" type="video/mp4">                                    
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-video wow fadeInUp">
                                    <div class="banner-video">
                                        <video autoplay playsinline muted loop>
                                            <source src="{{ asset('frontend/images/video/cosmetic3.mp4')}}" type="video/mp4">                                    
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="collection-video wow fadeInUp">
                                    <div class="banner-video">
                                        <video autoplay playsinline muted loop>
                                            <source src="{{ asset('frontend/images/video/cosmetic4.mp4') }}" type="video/mp4">                                    
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-sw style-white style-disabled-dark nav-next-slider nav-next-collection lg"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw style-white style-disabled-dark nav-prev-slider nav-prev-collection lg"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-collection justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Shoppable video -->

        <!-- Banner collection -->
        <section class="flat-spacing-28">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-collection" data-preview="2" data-tablet="2" data-mobile="1.4"
                    data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" lazy="true">
                            <div class="collection-item-v4 st-lg hover-img">
                                <div class="collection-inner">
                                    <a href="shop-collection-sub.html"
                                        class="collection-image img-style radius-10 o-hidden">
                                        <img class="lazyload" data-src="{{ asset('frontend/images/collections/accessories2_b1.jpg')}}"
                                            src="{{ asset('frontend/images/collections/accessories2_b1.jpg')}}" alt="collection-img">
                                    </a>
                                    <div class="collection-content text-start wow fadeInUp" data-wow-delay="0s">
                                        <h5 class="heading">UV charger</h5>
                                        <p class="subtext">Every piece is made to last beyond the season</p>
                                        <a href="shop-collection-sub.html"
                                            class="tf-btn btn-line collection-other-link fw-6"><span>Shop
                                                Collection</span><i class="icon icon-arrow1-top-left"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide" lazy="true">
                            <div class="collection-item-v4 st-lg hover-img">
                                <div class="collection-inner">
                                    <a href="shop-collection-sub.html"
                                        class="collection-image img-style radius-10 o-hidden">
                                        <img class="lazyload" data-src="{{ asset('frontend/images/collections/accessories2_b2.jpg') }}"
                                            src="{{ asset('frontend/images/collections/accessories2_b2.jpg')}}" alt="collection-img">
                                    </a>
                                    <div class="collection-content text-start wow fadeInUp" data-wow-delay="0s">
                                        <h5 class="heading">Ness Headphone</h5>
                                        <p class="subtext">Every piece is made to last beyond the season</p>
                                        <a href="shop-collection-sub.html"
                                            class="tf-btn btn-line  collection-other-link fw-6"><span>Shop
                                                Collection</span><i class="icon icon-arrow1-top-left"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Banner collection -->

        <!-- Seller -->
        <section class="flat-spacing-25 pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Best Seller</span>
                </div>
                <div class="wrap-carousel">
                    <div dir="ltr" class="swiper tf-sw-product-sell-1" data-preview="4" data-tablet="3" data-mobile="2"
                        data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3"
                        data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('frontend/images/products/headphone-red2.jpg') }}"
                                                src="{{ asset('frontend/images/products/headphone-red2.jpg')}}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('images/products/headphone-red.jpg') }}"
                                                src="{{ asset('images/products/headphone-red.jpg') }}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="javascript:void(0);"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                        <div class="on-sale-wrap text-end">
                                            <div class="on-sale-item pre-order">Pre-Order</div>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Beats Studio Buds</a>
                                        <span class="price">$199.00</span>
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn tf-btn-loading">
                                            ADD TO CART
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('frontend/images/products/bark-phone-blue.jpg') }}"
                                                src="{{ asset('frontend/images/products/bark-phone-blue.jpg') }}" alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('images/products/bark-phone-blue2.jpg') }}"
                                                src="{{ asset('images/products/bark-phone-blue2.jpg') }}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="javascript:void(0);"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Case with MagSafe</a>
                                        <span class="price">$19.99</span>
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn tf-btn-loading">
                                            ADD TO CART
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('frontend/images/products/wireless-charging-black2.jpg') }}"
                                                src="{{ asset('frontend/images/products/wireless-charging-black2.jpg') }}" alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('frontend/images/products/wireless-charging-white3.jpg') }}"
                                                src="{{ asset('frontend/images/products/wireless-charging-white3.jpg') }}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="javascript:void(0);"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Wireless Charger MagSafe</a>
                                        <span class="price">$159.99</span>
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn tf-btn-loading">
                                            ADD TO CART
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('frontend/images/products/wireless-charging-black.jpg')}}"
                                                src="{{ asset ('frontend/images/products/wireless-charging-black.jpg') }}" alt="image-product">
                                            <img class="lazyload img-hover"
                                                data-src="{{ asset('frontend/images/products/wireless-charging-white.jpg') }}"
                                                src="{{ asset('frontend/images/products/wireless-charging-white.jpg') }}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="javascript:void(0);"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">3-in-1 Wireless Charging</a>
                                        <span class="price">$199.00</span>
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn tf-btn-loading">
                                            ADD TO CART
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('frontend/images/products/albert-black.jpg') }}"
                                                src="{{ asset('frontend/images/products/albert-black.jpg') }}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('frontend/images/products/albert-white.jpg') }}"
                                                src="{{ asset('frontend/images/products/albert-white.jpg')}}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="javascript:void(0);"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">Blue Ocean Band</a>
                                        <span class="price">$9.00</span>
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn tf-btn-loading">
                                            ADD TO CART
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="card-product style-8">
                                    <div class="card-product-wrapper">
                                        <a href="product-detail.html" class="product-img">
                                            <img class="lazyload img-product"
                                                data-src="{{ asset('images/products/cable-black3.jpg') }}"
                                                src="{{ asset('images/products/cable-black3.jpg') }}" alt="image-product">
                                            <img class="lazyload img-hover" data-src="{{ asset('images/products/cable-white2.jpg') }}"
                                                src="{{ asset('images/products/cable-white2.jpg') }}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn absolute-2">
                                            <a href="javascript:void(0);"
                                                class="box-icon bg_white wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Add to Wishlist</span>
                                                <span class="icon icon-delete"></span>
                                            </a>
                                            <a href="#quick_view" data-bs-toggle="modal"
                                                class="box-icon bg_white quickview tf-btn-loading">
                                                <span class="icon icon-view"></span>
                                                <span class="tooltip">Quick View</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info text-center">
                                        <a href="product-detail.html" class="title link">USB-C Charge Cable</a>
                                        <span class="price">$69.99</span>
                                        <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn tf-btn-loading">
                                            ADD TO CART
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-sw disable-line nav-next-slider nav-next-sell-1 box-icon w_46 round"><span
                            class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw disable-line nav-prev-slider nav-prev-sell-1 box-icon w_46 round"><span
                            class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-sell-1 justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Seller -->
        <!-- Testimonial -->
        <section>
            <div class="container">
                <div
                    class="wrapper-thumbs-testimonial-v2 flat-thumbs-testimonial flat-thumbs-testimonial-v2 bg-gradient-3">
                    <div class="box-left">
                        <div dir="ltr" class="swiper tf-sw-tes-2" data-preview="1" data-space-lg="40"
                            data-space-md="30">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="46" height="31"
                                                viewBox="0 0 46 31" fill="none">
                                                <path
                                                    d="M32.4413 30.5L37.8204 19.9545L38.1913 19.2273H37.375H26.375V0.5H45.5V19.6071L39.9438 30.5H32.4413ZM6.56633 30.5L11.9454 19.9545L12.3163 19.2273H11.5H0.5V0.5H19.625V19.6071L14.0688 30.5H6.56633Z"
                                                    stroke="#B5B5B5"></path>
                                            </svg>
                                        </div>
                                        <div class="heading fs-14 mb_18 text-white">OUR CUSTOMER’S REVIEWS</div>
                                        <div class="rating">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </div>
                                        <p class="text text-white">
                                            Consider if the headphones support any advanced audio technologies, such as
                                            noise cancellation or surround sound, depending on your preferences. Comfort
                                            is crucial for long listening sessions
                                        </p>
                                        <div class="author box-author">
                                            <div class="box-img d-md-none">
                                                <img class="lazyload img-product"
                                                    data-src="{{ asset('frontend/images/slider/accessories-tes1.png')}}"
                                                    src="{{ asset('frontend/images/slider/accessories-tes1.png')}}" alt="image-product">
                                            </div>
                                            <div class="content">
                                                <div class="name text-white fw-6">Robert Smith</div>
                                                <a href="product-detail.html" class="metas link text-white">Purchase
                                                    item : <span class="fw-6">3-in-1 Wireless Charging</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="46" height="31"
                                                viewBox="0 0 46 31" fill="none">
                                                <path
                                                    d="M32.4413 30.5L37.8204 19.9545L38.1913 19.2273H37.375H26.375V0.5H45.5V19.6071L39.9438 30.5H32.4413ZM6.56633 30.5L11.9454 19.9545L12.3163 19.2273H11.5H0.5V0.5H19.625V19.6071L14.0688 30.5H6.56633Z"
                                                    stroke="#B5B5B5"></path>
                                            </svg>
                                        </div>
                                        <div class="heading fs-14 mb_18 text-white">OUR CUSTOMER’S REVIEWS</div>
                                        <div class="rating">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </div>
                                        <p class="text text-white">
                                            Love love love! This product is so easy to use! I absolutely love the this
                                            product. High-quality headphones deliver a balanced and clear sound. Look
                                            for headphones with good bass, clear mids, and crisp highs.
                                        </p>
                                        <div class="author box-author">
                                            <div class="box-img d-md-none">
                                                <img class="lazyload img-product"
                                                    data-src="{{ asset('frontend/images/slider/accessories-tes2.png') }}"
                                                    src="{{ asset('frontend/images/slider/accessories-tes2.png') }}" alt="image-product">
                                            </div>
                                            <div class="content">
                                                <div class="name text-white fw-6">Robert Smith</div>
                                                <a href="product-detail.html" class="metas link text-white">Purchase
                                                    item : <span class="fw-6">Beats Studio Buds</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex d-none box-sw-navigation">
                            <div class="nav-sw nav-next-slider line-white nav-next-tes-2"><span
                                    class="icon icon-arrow-left"></span></div>
                            <div class="nav-sw nav-prev-slider line-white nav-prev-tes-2"><span
                                    class="icon icon-arrow-right"></span></div>
                        </div>
                        <div class="d-md-none sw-dots style-2 dots-white sw-pagination-tes-2"></div>
                    </div>
                    <div class="box-right">
                        <div dir="ltr" class="swiper tf-thumb-tes" data-preview="1" data-space="30">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="box-img item-2 hover-img radius-10 o-hidden">
                                        <div class="img-style">
                                            <img class="lazyload" data-src="{{ asset('frontend/images/slider/accessories-tes1.png')}}"
                                                src="{{ asset('frontend/images/slider/accessories-tes1.png')}}" alt="img-slider">
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="box-img item-2 hover-img radius-10 o-hidden">
                                        <div class="img-style">
                                            <img class="lazyload" data-src="{{ asset('frontend/images/slider/accessories-tes2.png') }}"
                                                src="{{ asset('frontend/images/slider/accessories-tes2.png')}}" alt="img-slider">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Testimonial -->

        <!-- Shop Collection -->
        <section class="flat-spacing-19">
            <div class="container">
                <div class="tf-grid-layout md-col-2 tf-img-with-text style-1">
                    <div class="tf-image-wrap wow fadeInUp" data-wow-delay="0s">
                        <img class="lazyload" data-src="{{ asset('frontend/images/collections/collection-58.jpg')}}" src="images/collections/collection-58.jpg" alt="collection-img">
                    </div>
                    <div class="tf-content-wrap wow fadeInUp" data-wow-delay="0s">
                        <div class="heading">Redefining Fashion <br> Excellence</div>
                        <p class="description">Here is your chance to upgrade your wardrobe with a variation of styles</p>
                        <a href="shop-collection-list.html" class="tf-btn style-2 btn-fill rounded-full animate-hover-btn">Read our stories</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Shop Collection -->

        <!-- Faqs section -->
        <section class="flat-spacing-5 pt_0">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <h4>Frequently asked questions </h4>
                    </div>
                    <div class="col-xl-8">
                        <div class="flat-accordion style-default has-btns-arrow">
                            <div class="flat-toggle active">
                                <div class="toggle-title active">How do I choose the perfect stroller for my family?</div>
                                <div class="toggle-content">
                                    <p class="text_black-2">
                                        Cestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat
                                        euismod orci, ac placerat dolor lectus quis orci. Aenean ut eros et nisl sagittis vestibulum. Phasellus dolor. Sed libero. Phasellus ullamcorper ipsum rutrum nunc.Curabitur ullamcorper ultricies nisi. Suspendisse potenti. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor.
                                    </p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title">How much is shipping and how long will it take?</div>
                                <div class="toggle-content">
                                    <p class="text_black-2">To provide specific details about shipping costs and delivery times, I would need more information such as the origin and destination locations, the shipping method, and the item being shipped. Once I have those details, I can accurately estimate the shipping cost and delivery time for you.</p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title">How long will it take to get my package?</div>
                                <div class="toggle-content">
                                    <p class="text_black-2">The delivery time for a package depends on the shipping method, origin and destination, carrier workload, and whether it's a domestic or international shipment. Generally, domestic packages can take 3-7 business days, while international can range from 10-20 days. For the most accurate estimate, it's best to consult the carrier with your tracking number.</p>
                                </div>
                            </div>
                            <div class="flat-toggle">
                                <div class="toggle-title">Branding is simply a more efficient way to sell things?</div>
                                <div class="toggle-content">
                                    <p class="text_black-2">randing is about building trust, loyalty, and emotional connection with customers. It helps companies stand out, establish a reputation, and create a lasting legacy. While it can make it easier to sell products, it's important to recognize the broader benefits of building a strong brand.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Faqs section -->

@endsection