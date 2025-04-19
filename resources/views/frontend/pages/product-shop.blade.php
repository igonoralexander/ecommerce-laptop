@extends('layouts.frontend.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')

@section('content')

        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">Shop Products</div>
            </div>
        </div>
        <!-- /page-title -->
        
        <section class="flat-spacing-1">
            <div class="container-full">
                <div class="wrapper-control-shop">
                    <div class="meta-filter-shop"></div>
                    <div class="grid-layout wrapper-shop" data-grid="grid-4">
                        @foreach($products as $product)
                            @php
                                $images = $product->images;
                                $mainImage = $images->first();
                                $hoverImage = $images->skip(1)->first();
                            @endphp
                            <!-- card product 1 -->
                            <div class="card-product" data-price="{{ $product->sale_price }}" data-color="orange black white">
                                <div class="card-product-wrapper">

                                    <a href="{{ route('product.detail', $product->slug) }}" class="product-img">
                                        <img class="lazyload img-product" data-src="{{ asset('storage/' . ($mainImage->image)) }}" src="{{ asset('storage/' . ($mainImage->image)) }}" alt="{{$product->name}}">
                                        
                                        <img class="lazyload img-hover" data-src="{{ asset('storage/' . ($hoverImage->image)) }}" src="{{ asset('storage/' . ($hoverImage->image)) }}" alt="{{$product->name}}">
                                    </a>

                                    <div class="list-product-btn absolute-2">
                                        <a href="#quick_view" data-bs-toggle="modal"
                                            class="box-icon bg_white quickview tf-btn-loading btn-open-quick-add" data-product-id="{{ $product->id }}">
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
                                <div class="card-product-info">
                                    <a href="{{ route('product.detail', $product->slug) }}" class="title link">{{ $product->name }}</a>
                                    <span class="price">NGN {{ $product->sale_price }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- pagination -->
                    <ul class="tf-pagination-wrap tf-pagination-list tf-pagination-btn">
                        <li class="active">
                            <a href="#" class="pagination-link">1</a>
                        </li>
                        <li>
                            <a href="#" class="pagination-link animate-hover-btn">2</a>
                        </li>
                        <li>
                            <a href="#" class="pagination-link animate-hover-btn">3</a>
                        </li>
                        <li>
                            <a href="#" class="pagination-link animate-hover-btn">4</a>
                        </li>
                        <li>
                            <a href="#" class="pagination-link animate-hover-btn">
                                <span class="icon icon-arrow-right"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

@endsection