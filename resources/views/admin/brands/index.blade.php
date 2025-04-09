@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

              <!-- all-brand -->
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
                                        <a class="tf-button style-1 w208" href="{{ route('admin.brand.create') }}"><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-user">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Name</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            @foreach($brands as $brand)
                                                <li class="wg-product item- g20">
                                                    <div class="name">
                                                        @if($brand->image)
                                                            <div class="image">
                                                                <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}">
                                                            </div>
                                                        @endif
                                                        <div class="title line-clamp-2 mb-0">
                                                            <a href="#" class="body-title-2">{{ $brand->name }} </a>
                                                        </div>
                                                    </div>
                                                    <div class="list-icon-function">
                                                        <div class="item edit">
                                                            <a  class="item edit" href="{{ route ('admin.brand.edit', $brand->id) }}" ><i class="icon-edit-3"></i></a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a class="item trash delete-brand-btn" href="#" data-id="{{ $brand->id }}"><i class="icon-trash-2"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    
                                </div>
                                <!-- /all-user -->   
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-brand-btn', function(e) {
            e.preventDefault();

            var brandId = $(this).data('id'); // Get brand ID

            SwalGlobal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/brand/delete/' + brandId, // Correct URL
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            SwalGlobal.fire('Deleted!', response.message, 'success');
                        },
                        error: function(xhr) {
                            SwalGlobal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });

</script>
@endsection
