@php
    $images = $laptop->images;
    $mainImage = $images->first();
    $hoverImage = $images->skip(1)->first();
@endphp

<div class="swiper-slide" lazy="true">
    <div class="card-product border-0 bg_grey-11" data-price="{{ $laptop->sale_price }}">
        <div class="card-product-wrapper">

            <a href="{{ route('product.detail', $laptop->slug) }}" class="product-img">
                <img class="lazyload img-product" data-src="{{ asset('storage/' . ($mainImage->image)) }}" src="{{ asset('storage/' . ($mainImage->image)) }}" alt="{{$laptop->name}}">
                <img class="lazyload img-hover" data-src="{{ asset('storage/' . ($hoverImage->image)) }}" src="{{ asset('storage/' . ($hoverImage->image)) }}" alt="{{$laptop->name}}">
            </a>
            <div class="list-product-btn absolute-2">
                <a href="#quick_view" data-bs-toggle="modal" 
                    class="box-icon bg_white quickview tf-btn-loading btn-open-quick-add" data-product-id="{{ $laptop->id }}">
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
            <a href="{{ route('product.detail', $laptop->slug) }}" class="title link">{{ Str::limit($laptop->name, 40) }}</a>
            <span class="price">₦{{ number_format($laptop->sale_price, 0) }}</span>
        </div>
    </div>
</div>