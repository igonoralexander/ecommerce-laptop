@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')


@section('style')
    <style>
            .item {
                position: relative;
                width: 200px;
                height: 200px;
                overflow: hidden;
            }

            .item img, .item video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 8px;
            }

            .delete-btn {
                position: absolute;
                bottom: 10px;
                right: 10px;
                background: red;
                color: white;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                border-radius: 5px;
            }
    </style>
@endsection
@section('content')
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                @include('layouts.backend.inc.breadcrumbs')
                                <livewire:admin.manage-gallery />
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

<!-- Video Preview & Live Validation -->
@section('script')

@endsection