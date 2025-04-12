@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Edit Laptop')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')
            
            <form id="productForm" class="form-add-product" onsubmit="return validateForm(event)" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="laptop_id" value="{{ $laptop->id }}">
                <div class="wg-box mb-30">
                    <fieldset class="name">
                        <div class="body-title mb-10">Laptop Name <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" value="{{ $laptop->name }}" placeholder="Enter laptop name" id="name" name="name" tabindex="0" required>
                        <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the product name.</div>
                    </fieldset>

                    <div class="cols-lg gap22">
                        <fieldset class="choose-brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                            <select id="brand_id" name="brand_id" required>
                                <option value="">Choose brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $laptop->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>

                        <fieldset class="price">
                            <div class="body-title mb-10">Price <span class="tf-color-1">*</span></div>
                            <input type="number" value="{{ old('price', $laptop->price) }}" placeholder="Price" id="price" name="price" required>
                        </fieldset>

                        <fieldset class="sale-price">
                            <div class="body-title mb-10">Sale Price</div>
                            <input type="number" value="{{ old('sale_price', $laptop->sale_price) }}" placeholder="Sale Price" id = "sale_price" name="sale_price" required>
                        </fieldset>
                    </div>

                    <div class="cols-lg gap22">
                        <fieldset class="category">
                            <div class="body-title mb-10">Stock <span class="tf-color-1">*</span></div>
                            <input type="text" value="{{ $laptop->stock_quantity }}" placeholder="Enter Stock" name="stock_quantity" required>
                        </fieldset>
                    </div>

                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                        <textarea id="description" name="description" required>{{ $laptop->description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters.</div>
                    </fieldset>

                    <fieldset class="specifications">
                        <div class="body-title mb-10">Specifications</div>
                        <textarea name="specifications" id="specifications">{{ $laptop->specifications }}</textarea>
                    </fieldset>
                </div>

                <div class="wg-box mb-30">
                    <fieldset>
                        <div class="body-title mb-10">Upload New Images (optional)</div>
                        <div class="upload-image mb-16">
                            <div class="up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <div class="text-tiny">Drop your images here or <span class="text-secondary">click to browse</span></div>
                                    <input type="file" id="myFile" name="images[]" multiple onchange="previewImages()">
                                    <span class="text-tiny" id="file-names"></span>
                                </label>
                            </div>
                            <span id="image-error" class="text-danger" style="font-size: 17px;"></span>
                            <div class="flex gap20 flex-wrap">
                                <div id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    @foreach($laptop->images as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" style="width: 100px; height: 100px; border-radius: 5px; object-fit: cover;">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="body-text">Images already uploaded are shown above. You can optionally add new ones.</div>
                    </fieldset>
                </div>

                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Update Laptop</button>
                    <a href="{{ route('admin.laptop.index') }}" class="tf-button style-3 w380">Cancel</a>
                </div>
            </form>
        </div>
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
                if (!allowedTypes.includes(file.type)) {
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
                errorContainer.innerHTML = `Invalid file(s): ${invalidFiles.join(", ")}`;
                errorContainer.style.color = "red";
                errorContainer.style.fontWeight = "bold";
            }

            fileNamesContainer.innerText = `${fileNames.length} file(s) selected: ${fileNames.join(", ")}`;
        }
    }

    function validateForm(event) {
        event.preventDefault();

        let form = document.getElementById('productForm');
        let formData = new FormData(form);
        const laptopId = document.getElementById('laptop_id').value;

        SwalGlobal.fire({
            title: 'Updating Product...',
            text: 'Please wait while we update your product.',
            icon: 'info',
            showConfirmButton: false,
            allowOutsideClick: false,
            didOpen: () => {
                SwalGlobal.showLoading();
            }
        });

        fetch("{{ route('admin.laptop.update', $laptop->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'X-HTTP-Method-Override': 'PUT',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            SwalGlobal.close();
            if (data.success) {
                SwalGlobal.fire({
                    title: 'Success!',
                    text: data.message || 'Laptop updated successfully.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = "{{ route('admin.laptop.index') }}";
                });
            } else {
                SwalGlobal.fire('Failed!', data.message || 'Update failed.', 'error');
            }
        })
        .catch(error => {
            console.error(error);
            SwalGlobal.fire('Error!', 'An error occurred. Please try again.', 'error');
        });

        return false;
    }
</script>
@endsection