@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

              <!-- all-faq -->
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
                                        <a class="tf-button style-1 w208" href="{{ route('admin.add-faqs') }}"><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-user">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Question</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Answer</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            @foreach($faqs as $faq)
                                                <li class="wg-product item-row">
                                                    <div class="body-text"> {{ $faq->question }}</div>
                                                    <div class="body-text">{{ $faq->answer }}</div>
                                                    <div class="list-icon-function">
                                                        <div class="item edit">
                                                            <a  class="item edit" href="{{ route ('admin.faq.edit', $faq->id) }}" ><i class="icon-edit-3"></i></a>
                                                        </div>
                                                        <div class="item trash">
                                                            <a class="item trash delete-faq-btn" href="#" data-id="{{ $faq->id }}"><i class="icon-trash-2"></i></a>
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
        $(document).on('click', '.delete-faq-btn', function(e) {
            e.preventDefault();

            var faqId = $(this).data('id'); // Get FAQ ID

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
                        url: '/admin/faq/delete/' + faqId, // Correct URL
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
