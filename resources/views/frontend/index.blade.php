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

        @include('components.icon-box')

        <!--Brands -->
        <section>
            <div class="container">
                <div class="flat-title">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Shop by Brand</span>
                </div>
                <div class="flat-categories-bg wrap-carousel">
                    <div dir="ltr" class="swiper tf-sw-recent wow fadeInUp" data-preview="6" data-tablet="3" data-mobile="2" data-space-lg="70" data-space-md="30" data-space="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                        @foreach($brands as $item)
                            <div class="swiper-slide">
                                <div class="collection-item-circle hover-img">
                                    <a href="shop-collection-sub.html" class="collection-image img-style">
                                        <img class=" lazyloaded" data-src="{{ asset($item->image) }}" alt="{{$item->name}}" src="{{ asset($item->image) }}">
                                    </a>
                                    <div class="collection-content text-center">
                                        <a href="shop-collection-sub.html" class="link title fw-5 text-line-clamp-1">{{$item->name}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        </div>
                        <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                </div>
            </div>
        </section>
        <!-- /Brands -->

        <!-- Latest Product -->
        <section class="flat-spacing-1">
            <div class="container">
                <div class="flat-title">
                    <span class="title"> Latest Laptops</span>
                    <div class="d-flex gap-16 align-items-center box-pagi-arr">
                        <div class="nav-sw-arrow nav-next-slider nav-next-product"><span
                                    class="icon icon-arrow1-left"></span></div>
                            <a href="{{route ('shop') }}" class="tf-btn btn-line fs-12 fw-6">VIEW ALL</a>
                            <div class="nav-sw-arrow nav-prev-slider nav-prev-product"><span
                                    class="icon icon-arrow1-right"></span></div>
                    </div>
                </div>
                <div class="grid-layout wrapper-shop" data-grid="grid-4">
                    @foreach($latestLaptops as $laptop)

                        @php
                            $images = $laptop->images;
                            $mainImage = $images->first();
                            $hoverImage = $images->skip(1)->first();
                        @endphp

                        <div class="card-product" data-price="{{ $laptop->sale_price }}">
                            <div class="card-product-wrapper">

                                <a href="{{ route('product.detail', $laptop->slug) }}" class="product-img">
                                    <img class="lazyload img-product" data-src="{{ asset('storage/' . ($mainImage->image)) }}"
                                        src="{{ asset('storage/' . ($mainImage->image)) }}" alt="{{ $laptop->name }}">
                                    <img class="lazyload img-hover" data-src="{{ asset('storage/' . ($hoverImage->image)) }}"
                                        src="{{ asset('storage/' . ($hoverImage->image)) }}" alt="{{ $laptop->name }}">
                                </a>

                                <div class="list-product-btn absolute-2">
                                    <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="#quick_view" data-bs-toggle="modal"
                                        class="box-icon bg_white quickview tf-btn-loading btn-open-quick-add" data-product-id="{{ $laptop->id }}">
                                        <span class="icon icon-view"></span>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>

                                <!-- <div class="on-sale-wrap text-end">
                                    <div class="on-sale-item bg_red-2">-29%</div>
                                </div> -->
                            </div>
                            <div class="card-product-info text-center">
                                <a href="{{ route('product.detail', $laptop->slug) }}" class="title link">{{ $laptop->name }}</a>
                                <div class="price"><span class="old-price">₦{{ number_format($laptop->price, 0) }}</span> <span class="new-price">₦{{ number_format($laptop->sale_price, 0) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /Latest Product -->

        <!-- Best Sellers-->
        <section class="flat-spacing-1">
            <div class="container">
                <div class="flat-title flex-row justify-content-between gap-10 flex-wrap px-0">
                    <span class="title wow fadeInUp" data-wow-delay="0s"> Best Sellers</span>
                </div>
                <div class="wrap-carousel wrap-sw-3">
                    <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30"
                        data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            @foreach($bestSellers as $laptop)
                                @include('components.laptop-card', ['laptop' => $laptop])
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-sw disable-line nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw disable-line nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Best Sellers -->

        @include('layouts.frontend.inc.about')

        @include('components.featured-product')

        @include('layouts.frontend.inc.testimonial')

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
                    </div>
                </div>
            </div>
        </section>
        <!-- /Banner collection -->

@endsection