<!-- Trending Laptops-->
<section class="flat-spacing-2">
            <div class="container">
                <div class="flat-title flex-row justify-content-between gap-10 flex-wrap px-0">
                    <span class="title wow fadeInUp" data-wow-delay="0s">Trending Laptops</span>
                </div>
                <div class="wrap-carousel wrap-sw-3">
                    <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30"
                        data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            @foreach($trendingLaptops as $laptop)
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
<!-- /Trending Laptops -->