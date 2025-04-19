@php
    $mainImage = $product->images->first();
@endphp
                
                    <div class="header">
                        <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="wrap">
                        <div class="tf-product-media-wrap">
                            <div dir="ltr" class="swiper tf-single-slide">
                                <div class="swiper-wrapper">
                                    @foreach($product->images as $image)
                                        <div class="swiper-slide">
                                            <div class="item">
                                                <img src="{{ asset('storage/' . ($image->image ?? 'default.jpg')) }}" alt="{{ $product->name }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next button-style-arrow single-slide-prev"></div>
                                <div class="swiper-button-prev button-style-arrow single-slide-next"></div>
                            </div>
                        </div>

                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-product-info-list">
                                <div class="tf-product-info-title">
                                    <h5><a class="link" href="product-detail.html">{{ $product->name }}</a></h5>
                                </div>
                                <div class="tf-product-info-badges">
                                    <div class="badges text-uppercase">Best seller</div>
                                    <div class="product-status-content">
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6">Selling fast! 48 people have this in their carts.</p>
                                    </div>
                                </div>
                                <div class="tf-product-info-price">
                                    <div class="price">₦{{ $product->sale_price }}</div>
                                </div>
                                <div class="tf-product-description">
                                    <p>Nunc arcu faucibus a et lorem eu a mauris adipiscing conubia ac aptent ligula
                                        facilisis a auctor habitant parturient a a.Interdum fermentum.</p>
                                </div>
                                <div class="tf-product-info-quantity">
                                    <div class="quantity-title fw-6">Quantity</div>
                                    <div class="wg-quantity">
                                        <span class="btn-quantity minus-btn">-</span>
                                        <input type="text" name="quantity" value="1">
                                        <span class="btn-quantity plus-btn">+</span>
                                    </div>
                                </div>
                                <div class="tf-product-info-buy-button">
                                    <form class="">
                                        <a href="#" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"
                                            data-product-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-price="{{ $product->price }}"
                                            data-sale-price="{{ $product->sale_price }}"
                                            data-image="{{ asset('storage/' . ($mainImage->image ?? 'default.jpg')) }}">
                                            <span>Add to cart</span>
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                            <span class="icon icon-delete"></span>
                                        </a>
                                        <div class="w-100">
                                            <a href="#" class="btns-full">Buy Now </a>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <a href="product-detail.html" class="tf-btn fw-6 btn-line">View full details<i
                                            class="icon icon-arrow1-top-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>