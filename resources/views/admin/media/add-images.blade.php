@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')

@section('content')

                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                
                                @include('layouts.backend.inc.breadcrumbs')

                                @if (session()->has('message'))
                                    <div class="alert alert-success" style = "font-size: 18px;">{{ session('message') }}</div>
                                @endif

                                <!-- form-add-product -->
                                <form class="form-add-product" method = "POST" action = "{{ route('admin.photo.store') }}" enctype = "multipart/form-data">
                                    @csrf
                                    
                                    <div class="wg-box mb-30">
                                        <fieldset class="category">
                                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                                            <select name="category_id" class="" tabindex="0" aria-required="true">
                                                <option value="">Choose Category </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        @error('category_id') <span class="text-danger" style = "font-size: 18px;">{{ $message }}</span> @enderror

                                        <fieldset class="category">
                                            <div class="body-title mb-10">Clients <span class="tf-color-1">*</span></div>
                                            <select name="user_id" class="" tabindex="0" aria-required="true">
                                                <option value="">Choose Client </option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                        @error('user_id') <span class="text-danger" style = "font-size: 18px;">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="wg-box mb-30">
                                        <fieldset>
                                            <div class="body-title mb-10">Upload images</div>
                                            <div class="upload-image mb-16">
                                                <div class="up-load">
                                                    <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <div class="text-tiny">Drop your images here or select <span class="text-secondary">click to browse</span></div>

                                                        <input type="file" id="myFile" name="images[]" multiple onchange="previewImages()">
                                                        
                                                        <!-- Show Selected File Names or Count -->
                                                        <span class="text-tiny" id="file-names"></span>

                                                    </label>
                                                </div>
                                                <div class="flex gap20 flex-wrap">
                                                    <!-- Image Preview Container -->
                                                    <div id="image-preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                                                </div>
                                            </div>
                                            <div class="body-text">You can upload more than 1 image or at least 1 image.</div>
                                        </fieldset>
                                        
                                    </div>
                                    <div class="cols gap10">
                                        <button class="tf-button w380" type="submit">Add</button>
                                        <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
                                    </div>
                                </form>
                                <!-- /form-add-product -->

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

@section('script')
    <script>
        function previewImages() {
            let input = document.getElementById('myFile');
            let fileNamesContainer = document.getElementById('file-names');
            let previewContainer = document.getElementById('image-preview');

            // Clear previous previews
            previewContainer.innerHTML = '';

            if (input.files.length > 0) {
                let fileNames = Array.from(input.files).map(file => file.name).join(", ");
                fileNamesContainer.innerText = `${input.files.length} file(s) selected: ${fileNames}`;

                // Display selected images
                Array.from(input.files).forEach(file => {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        let imgElement = document.createElement("img");
                        imgElement.src = event.target.result;
                        imgElement.style.width = "100px";  // Adjust preview size
                        imgElement.style.height = "100px";
                        imgElement.style.borderRadius = "5px";
                        imgElement.style.objectFit = "cover";
                        previewContainer.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                });
            } else {
                fileNamesContainer.innerText = "";
            }
        }
    </script>
@endsection