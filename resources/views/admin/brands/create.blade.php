@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')
                            
                                <!-- add-new-user -->
                                <form class="form-style-2" id="brandForm">
                                    <div class="wg-box">
                                        <div class="right flex-grow">
                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Name</div>
                                                <input class="flex-grow" type="text" placeholder="Brand Name" id = "name" name="name" required autofocus>
                                            </fieldset>

                                            <fieldset class="name mb-24">
                                                <div class="body-title mb-10">Description</div>
                                                <textarea class="flex-grow" id="description" name="description"></textarea>
                                            </fieldset>

                                            <fieldset>
                                                <div class="body-title mb-24">Upload images <span class="tf-color-1">*</span></div>
                                                <div class="upload-image flex-grow">
                                                    <div class="item up-load">
                                                        <label class="uploadfile h250" for="myFile">
                                                            <span class="icon">
                                                                <i class="icon-upload-cloud"></i>
                                                            </span>
                                                            <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                                            <img id="myFile-input" src="" alt="">
                                                            <input type="file" id="myFile" name="image">
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="bot">
                                        <button type="submit" class="btn-success tf-button w180">Save</button>
                                        <a href = "{{route('admin.brand.index') }}" class="btn-secondary tf-button w180">Back</a>
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
        $('#brandForm').on('submit', function(e) {
            e.preventDefault(); // Prevent page reload

            var formData = new FormData(this);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));


            // Send AJAX request
            $.ajax({
                url: '{{ route("admin.brand.store") }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Show success message with SweetAlert
                    if (response.success) {
                        SwalGlobal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        });

                        // Optionally, reset the form
                        $('#brandForm')[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseJSON?.message || 'Something went wrong. Please try again later.',
                    });
                }
            });
        });
    });
</script>
@endsection