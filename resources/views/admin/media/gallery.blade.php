@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('style')
    <style>
            
    </style>
@endsection
@section('content')
                    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                @include('layouts.backend.inc.breadcrumbs')
                                <!-- Search & Filter -->
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search">
                                                <fieldset class="name">
                                                    <input type="text" id = "search" placeholder="Search by name or category here..." name="search" />
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id = "gallery" class="gallery-grid">
                                    @foreach ($media as $item)
                                        <div class="gallery-item">
                                            @php
                                                $fileExtension = pathinfo($item->file_url, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                                $isVideo = in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg']);
                                            @endphp

                                            @if ($isImage)
                                            <!-- Image -->
                                            <img src="{{ $item->file_url }}" class="gallery-thumb"  loading="lazy">
                                           
                                            @elseif ($isVideo)
                                            <!-- Videos -->
                                            <video class="gallery-video" width="100%" height="auto" autoplay muted loop>
                                                <source src="{{ $item->file_url }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <a href="{{ $item->file_url }}" class="lightbox-video" data-fancybox="gallery" data-type="iframe" >    
                                                <div class="lightbox-trigger">    
                                                    <i class="icon fa fa-search-plus"></i>
                                                </div>
                                            </a>
                                            @endif

                                            <!-- Action buttons -->
                                            <div class="gallery-actions">
                                                <button type="button" class="action-btn download-btn">
                                                    <i class="fa fa-download"></i>
                                                </button>

                                                <button type="button" class="action-btn share-btn" data-id="{{ $item->id }}" data-url="{{ $item->file_url }}">
                                                    <i class="fa fa-share-alt"></i>
                                                </button>

                                                <button type="button" class="action-btn delete-btn" data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="shareModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close-btn">&times;</span>
                                        <h3>Share this media</h3>
                                        <div id="socialLinks" class="social-icons"></div>
                                    </div>
                                </div>

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
        document.addEventListener("DOMContentLoaded", function () {

            // --- Variables ---
            let searchInput = document.querySelector("input[name='search']");
            let gallery = document.getElementById("gallery");
            let shareModal = document.getElementById("shareModal");
            let socialLinks = document.getElementById("socialLinks");
            let closeBtn = document.querySelector(".close-btn");
            
            let currentPage = 1;
            let isSearching = false;
            let loading = false;
            let searchTimeout;

            // Function to render media items
            function renderMediaItems(mediaArray, clear = false) {
                if (clear) gallery.innerHTML = ""; // Clear gallery if needed

                if (mediaArray.length === 0 && clear) {
                    gallery.innerHTML = "<p>No results found</p>";
                } else {
                    mediaArray.forEach(item => {
                        let fileExtension = item.file_url.split('.').pop().toLowerCase();
                        let isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension);
                        let isVideo = ['mp4', 'webm', 'ogg'].includes(fileExtension);

                        let mediaHtml = `
                            <div class="gallery-item" id="media-${item.id}">
                                ${isImage ? `
                                    <!-- Image -->
                                    <img src="${item.file_url}" class="gallery-thumb" loading="lazy">
                                    <a href="${item.file_url}" class="lightbox-image" data-fancybox="gallery">
                                        <div class="lightbox-trigger">    
                                            <i class="icon fa fa-search-plus"></i>
                                        </div>
                                    </a>
                                ` : isVideo ? `
                                    <!-- Video -->
                                    <video class="gallery-video" width="100%" height="auto" autoplay muted loop>
                                        <source src="${item.file_url}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <a href="${item.file_url}" class="lightbox-video" data-fancybox="gallery" data-type="iframe">
                                        <div class="lightbox-trigger">    
                                            <i class="icon fa fa-search-plus"></i>
                                        </div>
                                    </a>
                                ` : ''}
                                
                                <!-- Actions -->
                                <div class="gallery-actions">
                                    <a href="${item.download_url}" class="action-btn" download>
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <button class="action-btn share-btn" data-url="${item.file_url}">
                                        <i class="fa fa-share-alt"></i>
                                    </button>
                                    <button type="button" class="action-btn delete-btn" data-id="${item.id}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `;

                        gallery.innerHTML += mediaHtml;
                    });

                }
            }

            // --- Search Functionality ---
            searchInput.addEventListener("input", function () {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    let searchValue = this.value.trim().toLowerCase();
                    currentPage = 1; 

                    if (searchValue === "") {
                        isSearching = false;
                        fetchMediaPage(1, true);
                    } else {
                        isSearching = true;
                        fetch(`/gallery/search?query=${encodeURIComponent(searchValue)}`)
                            .then(response => response.json())
                            .then(data => renderMediaItems(data.media, true))
                            .catch(error => console.error("Error fetching search results:", error));
                    }
                }, 500); // Debounce delay
            });

            // --- Delete Functionality ---
            gallery.addEventListener("click", function (event) {
                let button = event.target.closest(".delete-btn");
                if (button) {
                    let mediaId = button.getAttribute("data-id");

                    SwalGlobal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to recover this media!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/gallery/delete/${mediaId}`, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                    "Accept": "application/json",
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById(`media-${mediaId}`).remove();
                                    SwalGlobal.fire("Deleted!", "The media has been deleted.", "success");
                                } else {
                                    SwalGlobal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch(error => SwalGlobal.fire("Error!", "Could not delete media.", "error"));
                        }
                    });
                }
            });

            // --- Infinite Scrolling ---
            function fetchMediaPage(page, clearExisting = false) {
                if (isSearching || loading) return;

                loading = true;

                fetch(`/gallery/load?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        if (clearExisting) gallery.innerHTML = "";
                        renderMediaItems(data.media);
                    })
                    .catch(error => console.error("Error loading media:", error))
                    .finally(() => loading = false);
            }

            // Initial media load
            fetchMediaPage(1, true);

            window.addEventListener("scroll", function () {
                if (isSearching || loading) return;
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                    currentPage++;
                    fetchMediaPage(currentPage);
                }
            });

          
           // Open Share Modal
        document.addEventListener("click", function (event) {
            let shareBtn = event.target.closest(".share-btn");
            if (shareBtn) {
                let fileUrl = shareBtn.getAttribute("data-url");
                let text = encodeURIComponent("Check out this media: " + fileUrl);
                let shareButtons = `
                    <a href="https://wa.me/?text=${text}" target="_blank" class="social-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=${fileUrl}" target="_blank" class="social-icon facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=${text}" target="_blank" class="social-icon twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=${fileUrl}&title=${text}" target="_blank" class="social-icon linkedin">
                        <i class="fab fa-linkedin"></i>
                    </a>
                `;
                socialLinks.innerHTML = shareButtons;
                shareModal.style.display = "flex";
            }
        });
        
        closeBtn.addEventListener("click", function () {
            shareModal.style.display = "none";
        });
        
        window.addEventListener("click", function (event) {
            if (event.target === shareModal) {
                shareModal.style.display = "none";
            }
        });
        });

    </script>
@endsection