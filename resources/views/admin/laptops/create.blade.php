@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')
                            
                                <!-- form-add-product -->
                                <form id="productForm" class="form-add-product" onsubmit="return validateForm(event)" enctype="multipart/form-data">
                                    <div class="wg-box mb-30">
                                        <fieldset class="name">
                                            <div class="body-title mb-10">Laptop Name <span class="tf-color-1">*</span></div>
                                            <input class="mb-10" type="text" placeholder="Enter laptop name" id = "name" name="name" tabindex="0" required>
                                            <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the product name.</div>
                                        </fieldset>
    
                                        <div class="cols-lg gap22">
                                            <fieldset class="choose-brand">
                                                <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                                                <select id = "brand_id" name="brand_id" required>
                                                    <option value="">Choose brand</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>

                                            <fieldset class="price">
                                                <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
                                                <input class="" type="number" placeholder="Price" id = "price" name="price" required>
                                            </fieldset>
                                            <fieldset class="sale-price">
                                                <div class="body-title mb-10">Sale Price </div>
                                                <input class="" type="number" placeholder="Sale Price" name="sale_price" required>
                                            </fieldset>
                                        </div>
                                        <div class="cols-lg gap22">
                                            <fieldset class="category">
                                                <div class="body-title mb-10">Stock <span class="tf-color-1">*</span></div>
                                                <input class="" type="text" placeholder="Enter Stock" name="stock_quantity" required>
                                            </fieldset>
                                        </div>
                                        <fieldset class="description">
                                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                                            <textarea class="mb-10" id = "description" name="description" placeholder="Short description about product" tabindex="0" required></textarea>
                                            <div class="text-tiny">Do not exceed 100 characters when entering the product name.</div>
                                        </fieldset>

                                        <fieldset class="specifications">
                                            <div class="body-title mb-10">Specifications</div>
                                            <textarea name="specifications" id="specifications"></textarea>
                                        </fieldset>

                                    </div>
                                    <div class="wg-box mb-30">
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
                                            <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details.</div>
                                        </fieldset>
                                    </div>
                                
                                    <div class="cols gap10">
                                        <button class="tf-button w380" type="submit">Add laptop</button>
                                        <a href="{{ route('admin.laptop.index') }}" class="tf-button style-3 w380">Cancel</a>

                                    </div>
                                </form>
                                <!-- /form-add-product -->  
        </div>
    </div>
    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
    </div>
</div>
@endsection

@section('script')
<script>

    tinymce.init({
            selector: '#description, #specifications',
            plugins: 'lists link image preview code',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code',
            height: 300,
            setup: function (editor) {
            editor.on('change', function () {
                editor.save();
                });
            }
        });

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

    function validateForm(event) {
        event.preventDefault();

        let files = document.getElementById("myFile").files;
        let errorContainer = document.getElementById('image-error');

        errorContainer.innerHTML = '';

        if (files.length < 4) {
            errorContainer.innerHTML = "Please upload at least 4 images.";
            errorContainer.style.color = "red";
            errorContainer.style.fontWeight = "bold";
            return false;
        }

        let form = document.getElementById('productForm');
        let formData = new FormData(form);

        SwalGlobal.fire({
            title: 'Adding Product...',
            text: 'Please wait while we save your product.',
            icon: 'info',
            showConfirmButton: false,
            allowOutsideClick: false,
            didOpen: () => {
                SwalGlobal.showLoading();
            }
        });

        fetch("{{ route('admin.laptop.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            SwalGlobal.close();
            if (data.success) {
                SwalGlobal.fire({
                    title: 'Success!',
                    text: data.message || 'Laptop added successfully.',
                    icon: 'success'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                SwalGlobal.fire({
                    title: 'Failed!',
                    text: data.message || 'Something went wrong.',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error(error);
            SwalGlobal.fire({
                title: 'Error!',
                text: 'An error occurred. Please try again later.',
                icon: 'error'
            });
        });

        return false;
    }
</script>
@endsection