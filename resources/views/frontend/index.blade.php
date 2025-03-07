@extends('layouts.frontend.index')

@section('style')
	<style>
     
	</style>
@endsection

@section('content')

        <!-- Slider -->    
        <section class="tf-slideshow slider-effect-fade slider-video position-relative">
            <div class="wrap-slider">
                <video src="{{ asset ('frontend/images/slider/slider-video.mp4') }}" autoplay muted playsinline loop></video>
                <div class="box-content">
                    <div class="container">
                        <p class="fade-item fade-item-1 subheading text-white fw-7">SPRING COLLECTION</p>
                        <h1 class="fade-item fade-item-2 heading text-white">End of<br> Season Sale</h1>
                        <a href="shop-collection-sub.html" class="fade-item fade-item-3 tf-btn fill-outline-light btn-icon radius-3"><span>Shop collection</span><i class="icon icon-arrow-right"></i></a>
                    </div>
                </div>
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
        <!-- Categories -->
        <section class="flat-spacing-14">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title">View by categories</span>
                </div>
                <div class="hover-sw-nav">
                    <div dir="ltr" class="swiper tf-sw-collection" data-preview="4" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style rounded-0">
                                            <img class="lazyload" data-src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="shop-collection-sub.html" class="tf-btn collection-title hover-icon fs-15"><span>Accessories</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style rounded-0">
                                            <img class="lazyload" data-src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="shop-collection-sub.html" class="tf-btn collection-title hover-icon fs-15"><span>Accessories</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style rounded-0">
                                            <img class="lazyload" data-src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="shop-collection-sub.html" class="tf-btn collection-title hover-icon fs-15"><span>Accessories</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style rounded-0">
                                            <img class="lazyload" data-src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="shop-collection-sub.html" class="tf-btn collection-title hover-icon fs-15"><span>Accessories</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style rounded-0">
                                            <img class="lazyload" data-src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="shop-collection-sub.html" class="tf-btn collection-title hover-icon fs-15"><span>Accessories</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" lazy="true">
                                <div class="collection-item style-2 hover-img">
                                    <div class="collection-inner">
                                        <a href="shop-collection-sub.html" class="collection-image img-style rounded-0">
                                            <img class="lazyload" data-src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" src="{{asset('frontend/images/collections/cls-electric-bike-1.jpg')}}" alt="collection-img">
                                        </a>
                                        <div class="collection-content">
                                            <a href="shop-collection-sub.html" class="tf-btn collection-title hover-icon fs-15"><span>Accessories</span><i class="icon icon-arrow1-top-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-collection box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-collection box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-collection justify-content-center"></div>
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

        <!-- Shop Collection -->
        <section class="flat-spacing-19">
            <div class="container">
                <div class="tf-grid-layout md-col-2 tf-img-with-text style-1">
                    <div class="tf-image-wrap wow fadeInUp" data-wow-delay="0s">
                        <img class="lazyload" data-src="images/collections/collection-58.jpg" src="images/collections/collection-58.jpg" alt="collection-img">
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
       
        <!-- Testimonial -->
        <section class="flat-spacing-12 line">
            <div class="container">
                <div class="wrap-carousel wrapper-thumbs-testimonial flat-thumbs-testimonial">
                    <div class="box-left wow fadeInUp" data-wow-delay="0s">
                        <div dir="ltr" class="swiper tf-thumb-tes" data-preview="1" data-space="30">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="img-sw-thumb">
                                        <img class="lazyload img-product" data-src="images/item/tets1.jpg" src="images/item/tets1.jpg" alt="image-product">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="img-sw-thumb">
                                        <img class="lazyload img-product" data-src="images/item/tets2.jpg" src="images/item/tets2.jpg" alt="image-product">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="box-right wow fadeInUp" data-wow-delay="0s">
                        <div dir="ltr" class="swiper tf-sw-tes-2" data-preview="1" data-space-lg="40" data-space-md="30">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial-item lg">
                                        <div class="icon icon-quote"></div>
                                        <div class="rating">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </div>
                                        <p class="text fw-5">
                                            I have been shopping with this web fashion site for over a year nowand I can confidently say it is the best online fashion site out there.
                                        </p>
                                        <div class="divider"></div>
                                        <div class="author box-author">
                                            <div class="box-img d-md-none">
                                                <img class="lazyload img-product" data-src="images/item/tets1.jpg" src="images/item/tets1.jpg" alt="image-product">
                                            </div>
                                            <div class="content">
                                                <div class="name">Jenifer Unix</div>
                                                <a href="product-detail.html" class="metas link">Purchase item : <span>Oversized Printed T-shirt</span></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-item lg">
                                        <div class="icon icon-quote"></div>
                                        <div class="rating">
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                            <i class="icon-star"></i>
                                        </div>
                                        <p class="text fw-5">
                                            Fashion website is impressive! The user-friendly interface and excellent customer service make shopping a breeze.
                                        </p>
                                        <div class="divider"></div>
                                        <div class="author box-author">
                                            <div class="box-img d-md-none">
                                                <img class="lazyload img-product" data-src="images/item/tets2.jpg" src="images/item/tets2.jpg" alt="image-product">
                                            </div>
                                            <div class="content">
                                                <div class="name">Robert smith</div>
                                                <a href="product-detail.html" class="metas link">Purchase item : <span> The Scot Collar Mint</span></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nav-sw nav-next-slider nav-next-tes-2 lg"><span class="icon icon-arrow-left"></span></div>
                        <div class="nav-sw nav-prev-slider nav-prev-tes-2 lg"><span class="icon icon-arrow-right"></span></div>
                        <div class="sw-dots style-2 sw-pagination-tes-2"></div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- /Testimonial -->

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
         
        <!-- Store -->
        <section class="flat-spacing-3 pb_0">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title fw-6">Visit our store</span>
                </div>
                <div class="flat-tab-store flat-animate-tab">
                    <ul class="widget-tab-2" role="tablist">
                        <li class="nav-tab-item" role="presentation">   
                            <a href="#hongkong" class="active" data-bs-toggle="tab">Hongkong</a>
                        </li>
                        <li class="nav-tab-item" role="presentation">
                            <a href="#london"  data-bs-toggle="tab">London</a>
                        </li>
                        <li class="nav-tab-item" role="presentation">
                            <a href="#paris" data-bs-toggle="tab">Paris</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="hongkong" role="tabpanel">
                            <div class="widget-card-store align-items-center tf-grid-layout md-col-2">
                                <div class="store-item-info">
                                    <h5 class="store-heading">Hongkong Store</h5>
                                    <div class="description">
                                        <p>301 Front St WToronto,<br>Ecomus@support.com <br>(08) 8942 1299</p>
                                        <p>Mon - Fri, 8:30am - 10:30pm<br>Saturday, 8:30am - 10:30pm <br>Sunday Closed</p>
                                    </div>
                                </div>
                                <div class="store-img">
                                    <img class="lazyload" data-src="images/shop/store/ourstore-map-1.png" src="images/shop/store/ourstore-map-1.png" alt="store-img">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="london" role="tabpanel">
                            <div class="widget-card-store align-items-center tf-grid-layout md-col-2">
                                <div class="store-item-info">
                                    <h5 class="store-heading">London Store</h5>
                                    <div class="description">
                                        <p>301 Front St WToronto,<br>Ecomus@support.com <br>(08) 8942 1299</p>
                                        <p>Mon - Fri, 8:30am - 10:30pm<br>Saturday, 8:30am - 10:30pm <br>Sunday Closed</p>
                                    </div>
                                </div>
                                <div class="store-img">
                                    <img class="lazyload" data-src="images/shop/store/ourstore-map-2.png" src="images/shop/store/ourstore-map-2.png" alt="store-img">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="paris" role="tabpanel">
                            <div class="widget-card-store align-items-center tf-grid-layout md-col-2">
                                <div class="store-item-info">
                                    <h5 class="store-heading">Paris Store</h5>
                                    <div class="description">
                                        <p>301 Front St WToronto,<br>Ecomus@support.com <br>(08) 8942 1299</p>
                                        <p>Mon - Fri, 8:30am - 10:30pm<br>Saturday, 8:30am - 10:30pm <br>Sunday Closed</p>
                                    </div>
                                </div>
                                <div class="store-img">
                                    <img class="lazyload" data-src="images/shop/store/ourstore-map-3.png" src="images/shop/store/ourstore-map-3.png" alt="store-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Store -->

        <!-- Subscribe -->
        <section class="flat-spacing-3">
            <div class="container-full">
                <div class="flat-title mb_1 wow fadeInUp" data-wow-delay="0s">
                    <span class="title fw-6">Fancy our gear?</span>
                    <p class="sub-title text_black">Sign up for our newsletter and receive new product releases, deals and exclusive sales.</p>
                </div>
                <div class="flat-subscrite-wrap">
                    <form class="form-newsletter" id="subscribe-form" action="#" method="post" accept-charset="utf-8" data-mailchimp="true">
                        <div id="subscribe-content" class="subscribe-content">
                            <fieldset class="email">
                                <input type="email" name="email-form" id="subscribe-email" placeholder="Enter email address" tabindex="0" aria-required="true">
                            </fieldset>
                            <div class="button-submit">
                                <button id="subscribe-button" class="tf-btn btn-sm h-46 rounded-0 btn-fill rounded-0 animate-hover-btn text-uppercase letter-2 fw-6" type="button">Subscribe</button>
                            </div>
                        </div>
                        <div id="subscribe-msg"></div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /Subscribe -->
@endsection