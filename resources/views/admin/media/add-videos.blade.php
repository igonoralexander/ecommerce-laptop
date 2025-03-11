@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                
                                @include('layouts.backend.inc.breadcrumbs')

                                @if (session()->has('message'))
                                    <div class="alert alert-success" id="uploadForm" style = "font-size: 18px;">{{ session('message') }}</div>
                                @endif

                                <!-- form-add-product -->
                                <form id="upload-form" class="form-add-product" method = "POST" action = "{{ route('admin.video.store') }}" enctype = "multipart/form-data">
                                    @csrf
                                    
                                    <div class="wg-box mb-30">
                                        <fieldset class="category">
                                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                                            <select name="category_id" id="category_id" onchange="validateCategory()">
                                                <option value="">Choose Category </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="category" style = "font-size: 16px;" id="category-error"></div>
                                        </fieldset>

                                        <fieldset class="category">
                                            <div class="body-title mb-10">Clients <span class="tf-color-1">*</span></div>
                                            <select name="user_id" id="user_id" onchange="validateUser()">
                                                <option value="">Choose Client </option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="category" style = "font-size: 16px;" id="user-error"></div>
                                        </fieldset>
                                    </div>
                                    <div class="wg-box mb-30">
                                        <fieldset class="name">
                                            <div class="body-title mb-10">Title <span class="tf-color-1">*</span></div>
                                            <input class="mb-10" type="text" placeholder="Enter title" name="title" tabindex="0" value="" aria-required="true" required>
                                            <div class="text-tiny text-surface-2">Do not exceed 50 characters when entering the video title.</div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="body-title mb-10">Upload Videos</div>
                                            <div class="upload-image mb-16">
                                                <div class="up-load">
                                                    <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <div class="text-tiny">Drop your videos here or select <span class="text-secondary">click to browse</span></div>

                                                        <input type="file" id="myFile" name="videos[]" multiple onchange="previewVideos()">
                                                        
                                                        <!-- Show Selected File Names or Count -->
                                                        <span class="text-tiny" id="file-names"></span>

                                                    </label>
                                                </div>
                                                <div class="flex gap20 flex-wrap">
                                                    <!-- Video Preview Container -->
                                                    <div id="video-preview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                                                </div>
                                            </div>
                                            <div class="body-text">You can upload more than 1 video or at least 1 video.</div>
                                            <div class="body-text" style = "font-size: 16px;" id="video-error"></div>
                                        </fieldset>
                                    </div>
                                    <div class="cols gap10">
                                        <button class="tf-button w380" type="submit"  onclick="return validateForm()">Upload</button>
                                        <a href="#" class="tf-button style-3 w380">Cancel</a>
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

<!-- Video Preview & Live Validation -->
@section('script')
<script>
    const CHUNK_SIZE = 5 * 1024 * 1024; // 5MB per chunk
    let uploadedFiles = [];

    async function uploadFileInChunks(file, index, totalFiles) {
        const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
        const fileId = `${Date.now()}-${index}-${Math.random().toString(36).substring(7)}`;
        let uploadedSize = 0;

        // Display Swal.fire Progress
        Swal.fire({
            title: `Uploading ${file.name}`,
            html: `<b>Uploading...</b> <br><div id="upload-progress" style="width: 100%; background: #ddd; height: 10px;">
                        <div id="progress-bar" style="width: 0%; height: 100%; background: green;"></div>
                   </div>
                   <p id="progress-text">0%</p>`,
            allowOutsideClick: false,
            showConfirmButton: false
        });


        for (let chunkIndex = 0; chunkIndex < totalChunks; chunkIndex++) {
            const start = chunkIndex * CHUNK_SIZE;
            const end = Math.min(start + CHUNK_SIZE, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append("file", chunk);
            formData.append("file_name", file.name);
            formData.append("chunk_index", chunkIndex);
            formData.append("total_chunks", totalChunks);
            formData.append("file_id", fileId);
            formData.append("_token", document.querySelector('input[name="_token"]').value);

            try {
                const response = await fetch("{{ route('admin.video.upload.chunk') }}", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();
                if (!result.success) {
                    console.error(`Chunk ${chunkIndex + 1} failed for ${file.name}`);
                    return;
                }

                uploadedSize += chunk.size;
                let percentComplete = Math.round((uploadedSize / file.size) * 100);
                document.getElementById("progress-bar").style.width = percentComplete + "%";
                document.getElementById("progress-text").innerText = percentComplete + "%";
            } catch (error) {
                Swal.fire("Upload Error", `Error uploading file: ${error}`, "error");
                return;
            }
        }

        uploadedFiles.push(fileId);
        console.log(`File "${file.name}" uploaded successfully.`);

        if (uploadedFiles.length === totalFiles) {
           Swal.fire({
                icon: "success",
                title: "Upload Completed!",
                text: "Your videos have been successfully uploaded.",
                confirmButtonText: "OK"
            });
        }
    }

    function handleFileSelection(event) {
        const input = event.target;
        const files = input.files;

        if (files.length === 0) {
            Swal.fire("No Files Selected", "Please select at least one video.", "warning");
            return;
        }

        uploadedFiles = []; // Reset uploaded files list

        for (let i = 0; i < files.length; i++) {
            uploadFileInChunks(files[i], i, files.length);
        }
    }

    document.getElementById("myFile").addEventListener("change", handleFileSelection);


    function previewVideos() {
        let input = document.getElementById('myFile');
        let fileNamesContainer = document.getElementById('file-names');
        let previewContainer = document.getElementById('video-preview');
        let errorContainer = document.getElementById('video-error');

        // Clear previous previews & errors
        previewContainer.innerHTML = '';
        errorContainer.innerHTML = '';

        if (input.files.length > 0) {
            let allowedTypes = [
                "video/mp4",             // MP4
                "video/mpeg",            // MPEG
                "video/quicktime",       // MOV (QuickTime)
                "video/x-msvideo",       // AVI
                "video/x-matroska",      // MKV
                "video/webm",            // WebM
                "video/ogg",             // OGG
                "video/x-flv",           // FLV (Flash Video)
                "video/3gpp",           // 3GP (Mobile Videos)
                "video/3gpp2",          // 3G2 (Mobile Videos)
                "video/x-ms-wmv",        // WMV (Windows Media Video)
                "video/x-m4v",          // M4V (Apple's video format)
                "application/vnd.rn-realmedia", // RM (RealMedia)
                "video/x-ms-asf"        // ASF (Advanced Systems Format)
            ];

            let fileNames = [];
            
            Array.from(input.files).forEach(file => {
                let fileType = file.type;
                if (!allowedTypes.includes(fileType)) {
                    // Create a new error message element
                    let errorMessage = document.createElement("p");
                    errorMessage.style.color = "red";        // Apply red color
                    errorMessage.textContent = `${file.name} is not a valid video format.`;
                    
                    // Append the error message to the error container
                    errorContainer.appendChild(errorMessage);
                    
                    return;
                }

                fileNames.push(file.name);

                // Create video preview
                let videoElement = document.createElement("video");
                videoElement.src = URL.createObjectURL(file);
                videoElement.controls = true;
                videoElement.style.width = "150px";
                previewContainer.appendChild(videoElement);
            });

            fileNamesContainer.innerText = `${fileNames.length} file(s) selected: ${fileNames.join(", ")}`;
        } else {
            fileNamesContainer.innerText = "";
        }
    }

    function validateCategory() {
        let category = document.getElementById("category_id").value;
        let errorCategory = document.getElementById("category-error");

        if (category === "") {
            errorCategory.innerHTML = "Please select a category.";
            errorCategory.style.color = "red";
        } else {
            errorCategory.innerHTML = "";
        }
    }

    function validateUser() {
        let user = document.getElementById("user_id").value;
        let errorUser = document.getElementById("user-error");

        if (user === "") {
            errorUser.innerHTML = "Please select a client.";
            errorUser.style.color = "red";
        } else {
            errorUser.innerHTML = "";
        }
    }

    function validateForm() {
        let category = document.getElementById("category_id").value;
        let user = document.getElementById("user_id").value;
        let files = document.getElementById("myFile").files;
        let errorCategory = document.getElementById("category-error");
        let errorUser = document.getElementById("user-error");
        let errorVideo = document.getElementById("video-error");

        // Clear previous errors
        errorCategory.innerHTML = "";
        errorUser.innerHTML = "";
        errorVideo.innerHTML = "";

        let isValid = true;

        if (category === "") {
            errorCategory.innerHTML = "Please select a category.";
            errorCategory.style.color = "red";
            isValid = false;
        }
        if (user === "") {
            errorUser.innerHTML = "Please select a client.";
            errorUser.style.color = "red";
            isValid = false;
        }
        if (files.length === 0) {
            errorVideo.innerHTML = "Please select at least one video.";
            errorVideo.style.color = "red";
            isValid = false;
        }

        return isValid; // Return false prevents form submission
    }
</script>
@endsection