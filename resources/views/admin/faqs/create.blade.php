@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')
                            
                                <!-- add-new-user -->
                                <form class="form-style-2" id="faqForm">
                                    <div class="wg-box">
                                        <div class="left">
                                            <h5 class="mb-4">Frequently Asked Question</h5>
                                            <div class="body-text">Fill in the information below to add a new FAQ</div>
                                        </div>
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Question</div>
                                                <input class="flex-grow" type="text" placeholder="Question" id = "question" name="question" required autofocus>
                                            </fieldset>
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Answer</div>
                                                <textarea class="flex-grow" id =  "answer" name="answer" required rows="4"></textarea>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bot">
                                        <button type="submit" class="btn-success tf-button w180">Save</button>
                                        <a href = "{{route('admin.faqs') }}" class="btn-secondary tf-button w180">Back</a>
                                    </div>

                                </form>
                                <!-- /add-new-user -->
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
        // Handle form submission
        $('#faqForm').on('submit', function(e) {
            e.preventDefault(); // Prevent page reload

            // Gather form data
            var formData = {
                question: $('#question').val(),
                answer: $('#answer').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Send AJAX request
            $.ajax({
                url: '{{ route("admin.faq.store") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Show success message with SweetAlert
                    if (response.success) {
                        SwalGlobal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        });

                        // Optionally, reset the form
                        $('#faqForm')[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong. Please try again later.',
                    });
                }
            });
        });
    });
</script>
@endsection