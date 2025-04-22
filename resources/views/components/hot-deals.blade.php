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
                    <div dir="ltr" class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30"
                        data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            @foreach($hotDeals as $laptop)
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
<!-- /Hot deals -->