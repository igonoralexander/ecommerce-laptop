@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

              <!-- all-laptop -->
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
                                        <a class="tf-button style-1 w208" href="{{ route('admin.laptop.create') }}"><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-user">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Name</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Brand</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Price</div>
                                            </li>        
                                            <li>
                                                <div class="body-title">Selling Price</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Stock</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            @foreach($laptops as $laptop)
                                                <li class="wg-product item- g20">
                                                    <div class="name">
                                                        @if($laptop->images->isNotEmpty())
                                                            <div class="image">
                                                                <img src="{{ asset('storage/' . $laptop->images->first()->image) }}" alt="{{ $laptop->name }}">
                                                            </div>
                                                        @endif
                                                        <div class="title line-clamp-2 mb-0">
                                                            <a href="#" class="body-title-2">{{ $laptop->name }} </a>
                                                        </div>
                                                    </div>
                                                    <div class="body-text">{{ $laptop->brand->name }}</div>
                                                    <div class="body-text">{{ $laptop->price }}</div>
                                                    <div class="body-text">{{ $laptop->sale_price }}</div>
                                                    <div class="body-text">{{ $laptop->stock_quantity }}</div>
                                                    <div class="list-icon-function">
                                                        <div class="item edit">
                                                            <a  class="item edit" href="{{ route ('admin.laptop.edit', $laptop->id) }}" ><i class="icon-edit-3"></i></a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a class="item trash delete-laptop-btn" href="#" data-id="{{ $laptop->id }}"><i class="icon-trash-2"></i></a>
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
        $(document).on('click', '.delete-laptop-btn', function(e) {
            e.preventDefault();

            var laptopId = $(this).data('id');
            var deleteUrl = "{{ url('admin/laptop') }}/" + laptopId;

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
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            SwalGlobal.fire('Deleted!', response.message, 'success').then(() => {
                                location.reload(); // Reload to update UI
                            });
                        },
                        error: function(xhr) {
                            SwalGlobal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
