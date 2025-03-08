@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle: $settings->site_name . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            <!-- Form for updating site settings -->
            <form class="form-setting form-style-2" method="POST" action="{{ route('admin.site-settings.update', 1) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Upload Site Logo -->
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Upload Site Logo<span class="tf-color-1">*</span></h5>
                        <div class="body-text">Upload Site Logo</div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title"> </div>
                            <div class="upload-image flex-grow">
                                <div class="item up-load">
                                    <label class="uploadfile h250" for="myFile" style="position: relative; display: inline-block;">
                                        <!-- Image (Visible by Default If Exists) -->
                                        @if($siteSettings->logo)
                                            <img id="myFile-input" src="{{ asset($siteSettings->logo) }}" data-src="{{ asset($siteSettings->logo) }}" alt="Current Logo" style="width: 100%; height: auto;">
                                        @else
                                            <img id="myFile-input" src="" alt="" style="width: 100%; height: auto;">
                                        @endif

                                        <!-- Overlay Icon and Text (Hidden by Default) -->
                                        <span class="icon" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; font-size: 50px; color: #fff; font-weight: bold; opacity: 0.8;">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="body-text" style="display: none; position: absolute; top: 60%; left: 50%; transform: translate(-50%, -50%); text-align: center; font-size: 18px; font-weight: 700; color: #fff; opacity: 0.9;">
                                            Drop your images here or select <span class="tf-color" style="color: #ffcc00;">click to browse</span>
                                        </span>

                                        <!-- File Input (Hidden) -->
                                        <input type="file" id="myFile" name="filename" style="display: none;">

                                        <style>
                                            /* Show icon and text on hover */
                                            .uploadfile:hover .icon,
                                            .uploadfile:hover .body-text {
                                                display: block !important;
                                            }

                                            /* Optional: Dim the image slightly when hovering */
                                            .uploadfile:hover img {
                                                opacity: 0.7;
                                            }

                                            /* Adjustments for boldness, font size, and color */
                                            .uploadfile:hover .icon {
                                                font-size: 60px; /* Increase icon size */
                                                color: #000; /* Set icon color to white */
                                                opacity: 1; /* Make icon fully visible */
                                            }

                                            .uploadfile:hover .body-text {
                                                font-size: 20px; /* Increase font size */
                                                font-weight: 800; /* Make text bold */
                                                color: #fff; /* White text */
                                                opacity: 1; /* Make text fully visible */
                                            }

                                            /* Optional: Background overlay on hover for better contrast */
                                            .uploadfile:hover {
                                                background-color: rgba(0, 0, 0, 0.6); /* Dark overlay on image */
                                            }
                                        </style>
                                    </label>


                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <!-- General Information Section -->
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">General Information</h5>
                        <div class="body-text">Setting general information</div>
                    </div>
                    <div class="right flex-grow">
                        <div class="cols gap24">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Site Name</div>
                                <input class="flex-grow" type="text" placeholder="Site Name" name="site_name" value="{{ old('site_name', $siteSettings->site_name) }}" required>
                            </fieldset>
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Site Tagline</div>
                                <input class="flex-grow" type="text" placeholder="Tagline" name="site_tagline" value="{{ old('site_tagline', $siteSettings->site_tagline) }}">
                            </fieldset>
                        </div>
                        <div class="cols gap24">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Contact Email</div>
                                <input class="flex-grow" type="email" placeholder="Email" name="contact_email" value="{{ old('contact_email', $siteSettings->contact_email) }}" required>
                            </fieldset>
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Phone Number</div>
                                <input class="flex-grow" type="text" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number', $siteSettings->phone_number) }}">
                            </fieldset>
                        </div>
                        <div class="cols gap24">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Address</div>
                                <input class="flex-grow" type="text" placeholder="Address" name="address" value="{{ old('address', $siteSettings->address) }}" required>
                            </fieldset>
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Country</div>
                                <input class="flex-grow" type="text" placeholder="Country" name="country" value="{{ old('country', $siteSettings->country) }}" required>
                            </fieldset>
                        </div>
                        <div class="cols gap24">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Business Hours</div>
                                <input class="flex-grow" type="text" placeholder="Business Hours" name="business_hours" value="{{ old('business_hours', $siteSettings->business_hours) }}">
                            </fieldset>
                        </div>
                        <!-- Timezone Dropdown -->
                        <div class="cols gap24">
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Timezone</div>
                                <select class="flex-grow" name="timezone">
                                    <option value="UTC" {{ old('timezone', $siteSettings->timezone) == 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="PST" {{ old('timezone', $siteSettings->timezone) == 'PST' ? 'selected' : '' }}>Pacific Standard Time (PST)</option>
                                    <option value="EST" {{ old('timezone', $siteSettings->timezone) == 'EST' ? 'selected' : '' }}>Eastern Standard Time (EST)</option>
                                    <option value="CST" {{ old('timezone', $siteSettings->timezone) == 'CST' ? 'selected' : '' }}>Central Standard Time (CST)</option>
                                    <option value="MST" {{ old('timezone', $siteSettings->timezone) == 'MST' ? 'selected' : '' }}>Mountain Standard Time (MST)</option>
                                </select>
                            </fieldset>
                            <!-- Currency Dropdown -->
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Currency</div>
                                <select class="flex-grow" name="currency">
                                    <option value="USD" {{ old('currency', $siteSettings->currency) == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                    <option value="EUR" {{ old('currency', $siteSettings->currency) == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                    <option value="GBP" {{ old('currency', $siteSettings->currency) == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                                    <option value="JPY" {{ old('currency', $siteSettings->currency) == 'JPY' ? 'selected' : '' }}>JPY (¥)</option>
                                </select>
                            </fieldset>
                            <!-- Site Language Dropdown -->
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Site Language</div>
                                <select class="flex-grow" name="site_language">
                                    <option value="en" {{ old('site_language', $siteSettings->site_language) == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="es" {{ old('site_language', $siteSettings->site_language) == 'es' ? 'selected' : '' }}>Spanish</option>
                                    <option value="fr" {{ old('site_language', $siteSettings->site_language) == 'fr' ? 'selected' : '' }}>French</option>
                                    <option value="de" {{ old('site_language', $siteSettings->site_language) == 'de' ? 'selected' : '' }}>German</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <!-- Social Links Section -->
                <div class="wg-box">
                    <div class="left">
                        <h5 class="mb-4">Social Links</h5>
                        <div class="body-text">Setting Social Links</div>
                    </div>
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Facebook URL</div>
                            <input class="flex-grow" type="url" name="social_links[facebook]" 
                                value="{{ old('social_links.facebook', $siteSettings->social_links['facebook'] ?? '') }}">
                        </fieldset>
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Twitter URL</div>
                            <input class="flex-grow" type="url" name="social_links[twitter]" 
                                value="{{ old('social_links.twitter', $siteSettings->social_links['twitter'] ?? '') }}">
                        </fieldset>
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Instagram URL</div>
                            <input class="flex-grow" type="url" name="social_links[instagram]" 
                                value="{{ old('social_links.instagram', $siteSettings->social_links['instagram'] ?? '') }}">
                        </fieldset>
                    </div>

                </div>
                <!-- Submit Button -->
                <div class="cols gap10">
                    <button class="tf-button w380" type="submit">Save Changes</button>
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
    
    document.addEventListener("DOMContentLoaded", function () {
        var fileInput = document.getElementById("myFile");
        var imgElement = document.getElementById("myFile-input");

        // Check if an image exists and set it as default
        if (imgElement.dataset.src) {
            imgElement.src = imgElement.dataset.src;
            imgElement.classList.add("has-img");
        }

        if (fileInput) {
            fileInput.addEventListener("change", function (event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function (e) {
                    imgElement.src = e.target.result;
                    imgElement.classList.add("has-img");
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }
    });

</script>
@endsection