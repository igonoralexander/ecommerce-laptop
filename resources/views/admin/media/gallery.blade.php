@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')


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
                                            <img src="{{ $item->file_url }}" class="gallery-thumb">
                                            <a href="{{ $item->file_url }}" class="lightbox-image" data-fancybox="gallery">
                                                <div class="lightbox-trigger">    
                                                    <i class="icon fa fa-search-plus"></i>
                                                </div>
                                            </a>
                                            @elseif ($isVideo)
                                            <!-- Video -->
                                            <video class="gallery-thumb" controls>
                                                <source src="{{ $item->file_url }}" type="video/{{ $fileExtension }}">
                                                Your browser does not support the video tag.
                                            </video>
                                            <a href="{{ $item->file_url }}" class="lightbox-image" data-fancybox="gallery" data-type="video">
                                                <div class="lightbox-trigger">
                                                    <i class="icon fa fa-play"></i>
                                                </div>
                                            </a>
                                            @endif

                                            <!-- Action buttons -->
                                            <div class="gallery-actions">
                                                <a href="{{ asset($item->file_url) }}" download class="action-btn">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <button class="action-btn share-btn" data-url="{{ $item->file_url }}">
                                                    <i class="fa fa-share-alt"></i>
                                                </button>
                                                <button type="button" class="action-btn delete-btn" data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
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
            // --- Search functionality ---
            let searchInput = document.querySelector("input[name='search']");
            let gallery = document.getElementById("gallery");
            let currentPage = 1;
            let isSearching = false; // flag for search mode

            // Function to render media items (common for search & infinite scroll)
            function renderMediaItems(mediaArray, clear = false) {
                if (clear) gallery.innerHTML = "";
                if (mediaArray.length === 0 && clear) {
                    gallery.innerHTML = "<p>No results found</p>";
                } else {
                    mediaArray.forEach(item => {
                        let mediaHtml = `
                            <div class="gallery-item" id="media-${item.id}">
                                ${item.media_type === 'image'
                                    ? `<img src="${item.file_url}" class="gallery-thumb">`
                                    : `<video src="${item.file_url}" class="gallery-thumb" controls></video>`}
                                <div class="gallery-actions">
                                    <a href="${item.file_url}" download class="action-btn">
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

            // Search event
            searchInput.addEventListener("input", function () {
                let searchValue = this.value.trim().toLowerCase();
                currentPage = 1; // reset pagination when searching

                // If search is empty, load all media from page 1 using infinite scroll endpoint
                if (searchValue === "") {
                    isSearching = false;
                    fetchMediaPage(1, true);
                } else {
                    isSearching = true;
                    fetch(`/gallery/search?query=${encodeURIComponent(searchValue)}`)
                        .then(response => response.json())
                        .then(data => {
                            renderMediaItems(data.media, true);
                        })
                        .catch(error => console.error("Error fetching search results:", error));
                }
            });

            // --- Delete functionality using event delegation ---
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
                                    // Remove from UI
                                    let mediaEl = document.getElementById(`media-${mediaId}`);
                                    if (mediaEl) mediaEl.remove();
                                    SwalGlobal.fire("Deleted!", "The media has been deleted.", "success");
                                } else {
                                    SwalGlobal.fire("Error!", data.message, "error");
                                }
                            })
                            .catch(error => {
                                console.error("Error deleting media:", error);
                                SwalGlobal.fire("Error!", "Could not delete media.", "error");
                            });
                        }
                    });
                }
            });

            // --- Infinite Scrolling ---
            // Function to fetch a page of media via AJAX (only when not in search mode)
            function fetchMediaPage(page, clearExisting = false) {
                if (isSearching) return; // do not load additional pages during search

                fetch(`/gallery/load?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        if (clearExisting) {
                            gallery.innerHTML = "";
                        }
                        renderMediaItems(data.media);
                        // If no more pages, you might disable further loading (optional)
                    })
                    .catch(error => console.error("Error loading media:", error));
            }

            // Initially load page 1 if not searching
            if (!isSearching) {
                fetchMediaPage(1, true);
            }

            // Listen for scroll events to trigger infinite scrolling
            window.addEventListener("scroll", function () {
                if (isSearching) return; // do not trigger while searching

                // When user scrolls near the bottom of the page
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                    currentPage++;
                    fetchMediaPage(currentPage);
                }
            });
        });
    </script>
@endsection