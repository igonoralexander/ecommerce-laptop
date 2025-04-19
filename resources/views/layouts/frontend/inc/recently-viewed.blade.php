<!-- recent -->
<section class="flat-spacing-4 pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Recently Viewed</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div dir="ltr" class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3"
                        data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
                        data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            @foreach ($recentlyViewed as $product)
                                @php
                                    $images = $product->images;
                                    $mainImage = $images->first();
                                    $hoverImage = $images->skip(1)->first();
                                @endphp
                                
                                <div class="swiper-slide" lazy="true">
                                    <div class="card-product">
                                        <div class="card-product-wrapper">
                                            <a href="{{ route('product.detail', $product->slug) }}" class="product-img">
                                                <img class="lazyload img-product"
                                                    data-src="{{ asset('storage/' . ($mainImage->image)) }}"
                                                    src="{{ asset('storage/' . ($mainImage->image)) }}" alt="{{ $product->name }}">
                                                <img class="lazyload img-hover" data-src="{{ asset('storage/' . ($hoverImage->image)) }}"
                                                    src="{{ asset('storage/' . ($hoverImage->image)) }}" alt="{{ $product->name }}">
                                            </a>
                                            <div class="list-product-btn absolute-2">
                                                <a href="#quick_view" data-bs-toggle="modal" 
                                                    class="box-icon bg_white quickview tf-btn-loading btn-open-quick-add" data-product-id="{{ $product->id }}">
                                                    <span class="icon icon-view"></span>
                                                    <span class="tooltip">Quick View </span>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    class="box-icon bg_white wishlist btn-icon-action">
                                                    <span class="icon icon-heart"></span>
                                                    <span class="tooltip">Add to Wishlist</span>
                                                    <span class="icon icon-delete"></span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-product-info">
                                            <a href="{{ route('product.detail', $product->slug) }}" class="title link">{{ $product->name }}</a>
                                            <span class="price">₦{{ $product->sale_price }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span
                            class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span
                            class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /recent -->