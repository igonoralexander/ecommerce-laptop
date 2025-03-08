@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle: $settings->site_name . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            @if (session()->has('message'))
                <div class="alert alert-success" style="font-size: 18px;">{{ session('message') }}</div>
            @endif

            <form class="form-add-product" method="POST" action="{{ route('admin.photo.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf

                <div class="wg-box mb-30">
                    <fieldset class="category">
                        <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                        <select id="category_id" name="category_id" tabindex="0" aria-required="true">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span id="category-error" class="text-danger" style="font-size: 17px;"></span>
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title mb-10">Clients <span class="tf-color-1">*</span></div>
                        <select id="user_id" name="user_id" tabindex="0" aria-required="true">
                            <option value="">Choose Client</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endforeach
                        </select>
                        <span id="user-error" class="text-danger" style="font-size: 17px;"></span>
                    </fieldset>
                </div>

                <div class="wg-box mb-30">
                    <fieldset class="name">
                        <div class="body-title mb-10">Title <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter title" name="title" id = "title" tabindex="0" value="" aria-required="true" required>
                        <div class="text-tiny text-surface-2">Do not exceed 50 characters when entering the image title.</div>
                    </fieldset>

                    <fieldset>
                        <div class="body-title mb-10">Upload images</div>
                        <div class="upload-image mb-16">
                            <div class="up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <div class="text-tiny">Drop your images here or select <span class="text-secondary">click to browse</span></div>
                                    <input type="file" id="myFile" name="images[]" multiple onchange="previewImages()">
                                    <span class="text-tiny" id="file-names"></span>
                                </label>
                            </div>
                            <span id="image-error" class="text-danger" style="font-size: 17px;"></span>
                            <div class="flex gap20 flex-wrap">
                                <div id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                            </div>
                        </div>
                        <div class="body-text">You can upload more than 1 image or at least 1 image.</div>
                    </fieldset>
                </div>

                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Add</button>
                    <a href="#" class="tf-button style-3 w380">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
    </div>
</div>
@endsection

@section('script')
<script>
    function previewImages() {
        let input = document.getElementById('myFile');
        let fileNamesContainer = document.getElementById('file-names');
        let previewContainer = document.getElementById('image-preview');
        let errorContainer = document.getElementById('image-error');

        previewContainer.innerHTML = '';
        errorContainer.innerHTML = '';

        if (input.files.length > 0) {
            let allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/svg+xml"];
            let fileNames = [];
            let invalidFiles = [];

            Array.from(input.files).forEach(file => {
                let fileType = file.type;
                if (!allowedTypes.includes(fileType)) {
                    invalidFiles.push(file.name);
                    return;
                }

                fileNames.push(file.name);

                let imgElement = document.createElement("img");
                imgElement.src = URL.createObjectURL(file);
                imgElement.style.width = "100px";
                imgElement.style.height = "100px";
                imgElement.style.borderRadius = "5px";
                imgElement.style.objectFit = "cover";
                previewContainer.appendChild(imgElement);
            });

            if (invalidFiles.length > 0) {
                errorContainer.innerHTML = `Invalid file(s): ${invalidFiles.join(", ")}. Only JPG, PNG, GIF, and WebP allowed.`;
                errorContainer.style.color = "red";
                errorContainer.style.fontWeight = "bold";
            }

            fileNamesContainer.innerText = `${fileNames.length} file(s) selected: ${fileNames.join(", ")}`;
        } else {
            fileNamesContainer.innerText = "";
        }
    }

    function validateCategory() {
        let category = document.getElementById("category_id").value;
        let errorCategory = document.getElementById("category-error");
        errorCategory.innerHTML = category === "" ? "Please select a category." : "";
    }

    function validateUser() {
        let user = document.getElementById("user_id").value;
        let errorUser = document.getElementById("user-error");
        errorUser.innerHTML = user === "" ? "Please select a client." : "";
    }

    function validateForm() {
        let category = document.getElementById("category_id").value;
        let user = document.getElementById("user_id").value;
        let files = document.getElementById("myFile").files;
        let errorContainer = document.getElementById('image-error');
        let isValid = true;

        validateCategory();
        validateUser();

        if (files.length === 0) {
            errorContainer.innerHTML = "Please upload at least one image.";
            errorContainer.style.color = "red";
            errorContainer.style.fontWeight = "bold";
            isValid = false;
        }

        return isValid;
    }
</script>
@endsection
