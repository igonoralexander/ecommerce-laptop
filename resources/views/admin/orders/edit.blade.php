@extends('layouts.backend.admin')

@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            <!-- Add/Edit Package Form -->
            <form class="form-style-2" id="packageForm" data-id="{{ $package->id ?? '' }}">
                @csrf
                @if(isset($package))
                    @method('PUT') {{-- Ensure correct method for update --}}
                @endif

                <div class="wg-box">
                    <div class="right flex-grow">
                        <fieldset class="category mb-24">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                            <select id="category_id" name="category_id" required>
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($package) && $package->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Package Name</div>
                            <input class="flex-grow" type="text" id="name" name="name" value="{{ $package->name ?? '' }}" placeholder="(e.g., Wedding Photography, Portrait Session)" required autofocus>
                        </fieldset>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Description</div>
                            <textarea class="flex-grow" id="content-editor" rows="5"> {{ old('description', $package->description) }}</textarea>
                            <input type="hidden" name="description" id="description">
                        </fieldset>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Price</div>
                            <input class="flex-grow" type="number" id="price" name="price" value="{{ $package->price ?? '' }}" placeholder="(e.g., 150000, 200000)" required>
                        </fieldset>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Duration</div>
                            <input class="flex-grow" type="text" id="duration" name="duration" value="{{ $package->duration ?? '' }}" placeholder="(e.g., 1 Day, 30 minutes, 1 hour)" required>
                        </fieldset>
                    </div>
                </div>

                <div class="bot">
                    <button type="submit" class="btn-success tf-button w180">{{ isset($package) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('admin.packages.index') }}" class="btn-secondary tf-button w180">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        tinymce.init({
            selector: '#content-editor',
            plugins: 'link image code lists',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | image code',
            setup: function(editor) {
                editor.on('change', function () {
                    document.getElementById('description').value = editor.getContent();
                });

                // Ensure data persists even if no changes are made
                editor.on('init', function () {
                    document.getElementById('description').value = editor.getContent();
                });

            }
        });

        // Ensure content is set before form submission
        document.querySelector("form").addEventListener("submit", function() {
                document.getElementById('description').value = tinymce.get('content-editor').getContent();
        });
    });

    $(document).ready(function () {
        $('#packageForm').on('submit', function (e) {
            e.preventDefault();

            var form = $(this);
            var packageId = form.data('id'); // Get package ID
            var url = packageId ? `/admin/packages/${packageId}` : '{{ route("admin.packages.store") }}';
            var method = packageId ? 'PUT' : 'POST';

            var formData = {
                category_id: $('#category_id').val(),
                name: $('#name').val(),
                description: $('#description').val(),
                price: $('#price').val(),
                duration: $('#duration').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: method
            };

            $.ajax({
                url: url,
                method: 'POST', // Laravel needs POST for PUT via `_method`
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 7000,
                            timerProgressBar: true,
                            background: '#fff',
                            color: '#333',
                            width: '300px', 
                            padding: '5px', 
                            customClass: {
                                    popup: 'swal-custom-popup',
                                    title: 'swal-title-custom'
                                }
                        });

                        if (!packageId) {
                            $('#packageForm')[0].reset(); // Reset only if creating a new package
                        }
                    }
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    let errorMessage = 'Please check the form and try again.';

                    if (errors) {
                        errorMessage = Object.values(errors).join('<br>');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: errorMessage,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        background: '#fff',
                        color: '#333',
                        width: '250px', 
                        padding: '5px', 
                        customClass: {
                            popup: 'swal-custom-popup',
                            title: 'swal-title-custom'
                        }
                    });
                }
            });
        });
    });
</script>
    <style>
            /* Forcefully remove the dark overlay */
            .swal2-container {
                        background: transparent !important; /* Prevents the dark background */
                        pointer-events: none !important; /* Ensures clicks go through */
                    }

                /* Reduce height, fix alignment */
                .swal-custom-popup {
                    font-size: 15px !important;
                    width: 300px !important; /* Set smaller width */
                    height: 50px !important; /* Reduce height */
                    padding: 5px !important;
                    border-radius: 8px !important; /* Rounded corners */
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important; /* Softer shadow instead of overlay */
                    /* Center at the top */
                    position: fixed !important;
                    top: 15px !important; /* Adjust spacing from top */
                    left: 50% !important;
                    transform: translateX(-50%) !important; /* Center horizontally */
                }
                
                .swal-title-custom {
                    font-size: 15px !important;
                    line-height: 1.2 !important; /* Reduce spacing inside */
                }
    </style>
@endsection