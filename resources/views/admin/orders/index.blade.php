@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">

            @include('layouts.backend.inc.breadcrumbs')
            <!-- order-list -->
            <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="wg-table table-all-category">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Product</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Order ID</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Price</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Quantity</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Total</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Status</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            @foreach($orders as $order)
                                                @foreach($order->items as $item)
                                                <li class="wg-product item-row gap20">
                                                    <div class="name">
                                                        <div class="image">
                                                            @if($item->laptop->images->isNotEmpty())
                                                                <img src="{{ asset('storage/' . $item->laptop->images->first()->image) }}" alt="">
                                                            @else
                                                                <img src="{{ asset('images/default-laptop.jpg') }}" alt="No Image">
                                                            @endif
                                                        </div>
                                                        <div class="title line-clamp-2 mb-0">
                                                            <a href="#" class="body-text fw-6">{{ $item->laptop->name ?? 'Product Not Found' }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="body-text text-main-dark mt-4">
                                                        #ORD{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                                    </div>
                                                    <div class="body-text text-main-dark mt-4">₦{{ number_format($item->price, 2) }}</div>
                                                    <div class="body-text text-main-dark mt-4">{{ $item->quantity }}</div>
                                                    <div class="body-text text-main-dark mt-4">₦{{ number_format($item->subtotal, 2) }}</div>
                                                    <div>
                                                        @if($order->status === 'pending')
                                                            <div class="block-pending bg-1 fw-7">{{ ucfirst($order->status) }}</div>
                                                        @else
                                                            <div class="block-available bg-1 fw-7">{{ ucfirst($order->status) }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="list-icon-function">
                                                        <div class="item eye">
                                                            <i class="icon-eye"></i>
                                                        </div>
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                        <div class="item trash">
                                                            <i class="icon-trash-2"></i>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10">
                                        <div class="text-tiny">Showing 10 entries</div>
                                        <ul class="wg-pagination">
                                            <li>
                                                <a href="#"><i class="icon-chevron-left"></i></a>
                                            </li>
                                            <li>
                                                <a href="#">1</a>
                                            </li>
                                            <li class="active">
                                                <a href="#">2</a>
                                            </li>
                                            <li>
                                                <a href="#">3</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /order-list -->
                                
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
    </div>
</div>
@endsection

@section('script')
<script>
   
</script>
@endsection
