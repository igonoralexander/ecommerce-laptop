@php
    $mainImage = $product->images->first();
@endphp
                
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-info-item">
                        <div class="image">
                            <img src="{{ asset('storage/' . ($mainImage->image ?? 'default.jpg')) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="content">
                            <a href="">{{ $product->name }}</a>
                            <div class="tf-product-info-price">
                                <div class="price-on-sale">₦{{ $product->sale_price }}</div>
                                <div class="compare-at-price">₦{{ $product->price }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-quantity mb_15">
                        <div class="quantity-title fw-6">Quantity</div>
                        <div class="wg-quantity">
                            <span class="btn-quantity minus-btn">-</span>
                            <input type="text" name="quantity" value="1">
                            <span class="btn-quantity plus-btn">+</span>
                        </div>
                    </div>
                    <div class="tf-product-info-buy-button">
                        <form>
                            <a href="#" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"
                                data-product-id="{{ $product->id }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                data-sale-price="{{ $product->sale_price }}"
                                data-image="{{ asset('storage/' . ($mainImage->image ?? 'default.jpg')) }}">
                                <span>Add to cart</span>
                            </a>
                            <div class="tf-product-btn-wishlist btn-icon-action">
                                <i class="icon-heart"></i>
                                <i class="icon-delete"></i>
                            </div>
                            <div class="w-100">
                                <a href="#" class="btns-full">Buy Now</a>
                            </div>
                        </form>
                    </div>
                </div>