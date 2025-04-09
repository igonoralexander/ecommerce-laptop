@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            <!-- edit-brand -->
            <form class="form-style-2" id="brandEditForm" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{ $brand->id }}">

                <div class="wg-box">
                    <div class="right flex-grow">
                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Name</div>
                            <input class="flex-grow" type="text" placeholder="Brand Name" id="name" name="name"
                                value="{{ $brand->name }}" required autofocus>
                        </fieldset>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Description</div>
                            <textarea class="flex-grow" id="description" name="description">{{ $brand->description }}</textarea>
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
                                        @if($brand->image)
                                            <img id="myFile-input" src="{{ asset($brand->image) }}" alt="" width="120">
                                        @endif
                                        <input type="file" id="myFile" name="image">
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="bot">
                    <button type="submit" class="btn-success tf-button w180">Update</button>
                    <a href="{{ route('admin.brand.index') }}" class="btn-secondary tf-button w180">Back</a>
                </div>
            </form>
            <!-- /edit-brand -->
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="#">Ecomus</a>. Design by Themesflat All rights reserved</div>
    </div>
</div>
@endsection

@section('script')
<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#brandEditForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('_method', 'PUT'); // Laravel spoofing for PUT

        $.ajax({
            url: '{{ route("admin.brand.update", $brand->id) }}',
            method: 'POST', // Use POST since we are spoofing PUT
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    SwalGlobal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message,
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';

                    Object.values(errors).forEach(function (messages) {
                        errorMessages += messages.join('<br>') + '<br>';
                    });

                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessages
                    });
                } else {
                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseJSON?.message || 'Something went wrong!',
                    });
                }
            }
        });
    });
});

</script>
@endsection