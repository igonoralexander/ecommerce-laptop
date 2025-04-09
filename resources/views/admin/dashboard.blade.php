@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="tf-section-4 mb-30">
                                    <!-- chart-default -->
                                    <div class="wg-chart-default">
                                        <div class="top">
                                            <div class="flex items-center gap14">
                                                <div class="image type-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 48 52" fill="none">
                                                        <path d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z" fill="#FF5200"/>
                                                    </svg>
                                                    <span class="icon">
                                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99959 1.5C8.34273 1.5 6.99959 2.84315 6.99959 4.5V5.25H12.9996V4.5C12.9996 2.84315 11.6564 1.5 9.99959 1.5ZM14.4996 5.25V4.5C14.4996 2.01472 12.4849 0 9.99959 0C7.51431 0 5.49959 2.01472 5.49959 4.5V5.25H3.51238C2.55283 5.25 1.74813 5.97444 1.64768 6.92872L0.384527 18.9287C0.267993 20.0358 1.13603 21 2.24922 21H17.75C18.8631 21 19.7312 20.0358 19.6147 18.9287L18.3515 6.92872C18.251 5.97444 17.4463 5.25 16.4868 5.25H14.4996ZM12.9996 6.75H6.99959V8.16146C7.22974 8.36745 7.37459 8.66681 7.37459 9C7.37459 9.62132 6.87091 10.125 6.24959 10.125C5.62827 10.125 5.12459 9.62132 5.12459 9C5.12459 8.66681 5.26943 8.36745 5.49959 8.16146V6.75H3.51238C3.32047 6.75 3.15953 6.89489 3.13944 7.08574L1.87628 19.0857C1.85298 19.3072 2.02659 19.5 2.24922 19.5H17.75C17.9726 19.5 18.1462 19.3072 18.1229 19.0857L16.8597 7.08574C16.8396 6.89489 16.6787 6.75 16.4868 6.75H14.4996V8.16146C14.7297 8.36746 14.8746 8.66681 14.8746 9C14.8746 9.62132 14.3709 10.125 13.7496 10.125C13.1283 10.125 12.6246 9.62132 12.6246 9C12.6246 8.66681 12.7694 8.36745 12.9996 8.16146V6.75Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="flex gap15 items-center">
                                                        <div class="body-text mt-2 mb-4">Total Orders</div>
                                                        <div class="box-icon-trending down">
                                                            <i class="icon-trending-down"></i>
                                                            <div class="body-title number">1.56%</div>
                                                        </div>
                                                    </div>
                                                    <h4>2,802</h4>
                                                </div>
                                            </div>
                                            <div class="dropdown default">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="view-all">Monthly<i class="icon-chevron-down"></i></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>  
                                                        <a href="javascript:void(0);">Weekly</a>
                                                    </li>
                                                    <li>  
                                                        <a href="javascript:void(0);">Yearly</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="wrap-chart">
                                            <div class="wrap-line-chart" id="line-chart-2"></div>
                                        </div>
                                    </div>
                                    <!-- /chart-default -->
                                    <!-- chart-default -->
                                    <div class="wg-chart-default">
                                        <div class="top">
                                            <div class="flex items-center gap14">
                                                <div class="image type-white">
                                                    <svg width="52" height="52" viewBox="0 0 48 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M19.1084 2.12894C22.2024 0.34261 26.0144 0.342611 29.1084 2.12894L42.4911 9.85544C45.5851 11.6418 47.4911 14.943 47.4911 18.5157V33.9687C47.4911 37.5413 45.5851 40.8426 42.4911 42.6289L29.1084 50.3554C26.0144 52.1418 22.2024 52.1418 19.1084 50.3554L5.72571 42.6289C2.6317 40.8426 0.725712 37.5413 0.725712 33.9687V18.5157C0.725712 14.943 2.6317 11.6418 5.72571 9.85544L19.1084 2.12894Z" fill="#8F77F3"/>
                                                    </svg>
                                                    <span class="icon">
                                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.61976 16.1198C5.51618 15.2233 6.73199 14.7197 7.99973 14.7197H15.9997C17.2675 14.7197 18.4833 15.2233 19.3797 16.1198C20.2761 17.0162 20.7797 18.232 20.7797 19.4997V21.4997C20.7797 21.9305 20.4305 22.2797 19.9997 22.2797C19.5689 22.2797 19.2197 21.9305 19.2197 21.4997V19.4997C19.2197 18.6457 18.8805 17.8267 18.2766 17.2228C17.6727 16.619 16.8537 16.2797 15.9997 16.2797H7.99973C7.14573 16.2797 6.32671 16.619 5.72284 17.2228C5.11898 17.8267 4.77973 18.6457 4.77973 19.4997V21.4997C4.77973 21.9305 4.43051 22.2797 3.99973 22.2797C3.56894 22.2797 3.21973 21.9305 3.21973 21.4997V19.4997C3.21973 18.232 3.72333 17.0162 4.61976 16.1198Z" fill="white"/>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9997 4.27973C10.2214 4.27973 8.77973 5.72137 8.77973 7.49973C8.77973 9.27808 10.2214 10.7197 11.9997 10.7197C13.7781 10.7197 15.2197 9.27808 15.2197 7.49973C15.2197 5.72137 13.7781 4.27973 11.9997 4.27973ZM7.21973 7.49973C7.21973 4.85981 9.35981 2.71973 11.9997 2.71973C14.6396 2.71973 16.7797 4.85981 16.7797 7.49973C16.7797 10.1396 14.6396 12.2797 11.9997 12.2797C9.35981 12.2797 7.21973 10.1396 7.21973 7.49973Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="flex gap9 items-center">
                                                        <div class="body-text mt-2 mb-4">Customers</div>
                                                        <div class="box-icon-trending up color-violet">
                                                            <i class="icon-trending-up"></i>
                                                            <div class="body-title number">1.56%</div>
                                                        </div>
                                                    </div>
                                                    <h4>4,945</h4>
                                                </div>
                                            </div>
                                            <div class="dropdown default">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="view-all">Yearly<i class="icon-chevron-down"></i></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>  
                                                        <a href="javascript:void(0);">Monthly</a>
                                                    </li>
                                                    <li>  
                                                        <a href="javascript:void(0);">Weekly</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="wrap-chart">
                                            <div class="wrap-line-chart" id="line-chart-3"></div>
                                        </div>
                                    </div>
                                    <!-- /chart-default -->
                                </div>
                                <div class="tf-section-5">
                                    <div class="wg-box">
                                        <div class="flex items-center justify-between">
                                            <h5>Recent orders</h5>
                                        </div>
                                        <div class="wg-table table-recent-orders">
                                            <ul class="table-title flex gap20 mb-14">
                                                <li>
                                                    <div class="body-title text-main-dark">Product</div>
                                                </li>    
                                                <li>
                                                    <div class="body-title text-main-dark">Customer</div>
                                                </li>
                                                <li>
                                                    <div class="body-title text-main-dark">Product ID</div>
                                                </li>
                                                <li>
                                                    <div class="body-title text-main-dark">Quantity</div>
                                                </li>
                                                <li>
                                                    <div class="body-title text-main-dark">Price</div>
                                                </li>
                                                <li>
                                                    <div class="body-title text-main-dark">Status</div>
                                                </li>
                                            </ul>
                                            <div class="divider mb-14"></div>
                                            <ul class="flex flex-column has-divider-line has-line-bot">
                                                <li class="item wg-product gap20">
                                                    <div class="name">
                                                        <div class="image">
                                                            <img src="images/products/product-1.jpg" alt="">
                                                        </div>
                                                        <div class="title mb-0">
                                                            <a href="#" class="body-text">Oversized Motif T-shirt</a>
                                                        </div>
                                                    </div>
                                                    <div class="body-text text-main-dark mt-4">Leslie Alexander</div>
                                                    <div class="body-text text-main-dark mt-4">1452</div>
                                                    <div class="body-text text-main-dark mt-4">X1</div>
                                                    <div class="body-text text-main-dark mt-4">$138</div>
                                                    <div>
                                                        <div class="block-available fw-7">Paid</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="flex items-center justify-between flex-wrap gap10">
                                            <div class="text-tiny">Showing 1-5 of 15</div>
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

                                      <!-- top-countries -->
                                      <div class="wg-box">
                                            <div class="flex items-center justify-between">
                                                <h5>Top sale</h5>
                                                <div class="dropdown default style-box">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <a href="product-list.html" class="view-all">Weekly<i class="icon-chevron-down"></i></a>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>  
                                                            <a href="javascript:void(0);">Yearly</a>
                                                        </li>
                                                        <li>  
                                                            <a href="javascript:void(0);">Monthly</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <ul class="flex flex-column h-full has-divider-line">
                                                <li class="wg-product">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="images/products/product-1.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-text">Neptune Longsleeve</a>
                                                            </div>
                                                            <div class="price text-tiny">$138</div>
                                                        </div>
                                                    </div>
                                                    <div class="sale body-text">952 Sales</div>
                                                </li>
                                                <li class="wg-product">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="images/products/product-2.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-text">Ribbed Tank Top</a>
                                                            </div>
                                                            <div class="price text-tiny">$108</div>
                                                        </div>
                                                    </div>
                                                    <div class="sale body-text">952 Sales</div>
                                                </li>
                                                <li class="wg-product">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="images/products/product-3.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-text">Ribbed modal T-shirt</a>
                                                            </div>
                                                            <div class="price text-tiny">$125</div>
                                                        </div>
                                                    </div>
                                                    <div class="sale body-text">902 Sales</div>
                                                </li>
                                                <li class="wg-product">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="images/products/product-4.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-text">Oversized Motif T-shirt</a>
                                                            </div>
                                                            <div class="price text-tiny">$98</div>
                                                        </div>
                                                    </div>
                                                    <div class="sale body-text">882 Sales</div>
                                                </li>
                                                <li class="wg-product">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="images/products/product-5.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-text">V-neck linen T-shirt</a>
                                                            </div>
                                                            <div class="price text-tiny">$158</div>
                                                        </div>
                                                    </div>
                                                    <div class="sale body-text">869 Sales</div>
                                                </li>
                                                <li class="wg-product">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="images/products/product-6.jpg" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-text">Jersey thong body</a>
                                                            </div>
                                                            <div class="price text-tiny">$78</div>
                                                        </div>
                                                    </div>
                                                    <div class="sale body-text">833 Sales</div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /top-countries -->

                                </div>
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        <!-- bottom-page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
                        </div>
                        <!-- /bottom-page -->
                    </div>
                    <!-- /main-content -->
@endsection


@section('script')
    @if (session('success')) 
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: 'success',
                    title: `{!! session('success') !!}`,
                    toast: true,  
                    position: 'top',  // Keeps it at the top
                    showConfirmButton: false,  
                    timer: 7000, 
                    timerProgressBar: true,  
                    background: 'white',  
                    color: 'black',  
                    width: '200px', 
                    padding: '5px', 
                    backdrop: false,
                    customClass: {
                        popup: 'swal-custom-popup',  
                        title: 'swal-title-custom'
                    }
                });

                // Removing SweetAlert's overlay 
                setTimeout(() => {
                    document.querySelector('.swal2-container').style.background = 'transparent';
                }, 10);
            });
        </script>

        <style>

                /* Forcefully remove the dark overlay */
                .swal2-container {
                background: transparent !important; /* Prevents the dark background */
                pointer-events: none !important; /* Ensures clicks go through */
            }

            /* Reduce height, fix alignment */
            .swal-custom-popup {
                font-size: 14px !important;
                width: 200px !important; /* Set smaller width */
                height: 40px !important; /* Reduce height */
                padding: 5px !important;
                border-radius: 8px !important; /* Rounded corners */
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important; /* Softer shadow instead of overlay */
                /* Center at the top */
                position: fixed !important;
                top: 15px !important; /* Adjust spacing from top */
                left: 50% !important;
                transform: translateX(-50%) !important; /* Center horizontally */
            }
            
            .swal-title-custom {
                font-size: 13px !important;
                line-height: 1.2 !important; /* Reduce spacing inside */
            }
        </style>
    @endif

@endsection