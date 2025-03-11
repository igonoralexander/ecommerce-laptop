@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')
                <form class="form-setting form-style-2" method="POST" action="{{ route('admin.site-settings.store') }}" enctype="multipart/form-data">
                    @csrf

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
                                                    <label class="uploadfile h250" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                                        <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                                        <img id="myFile-input" src="" alt="">
                                                        <input type="file" id="myFile" name="filename">
                                                    </label>
                                                </div>
                                            </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="wg-box">
                        <div class="left">
                            <h5 class="mb-4">General Information</h5>
                            <div class="body-text">Setting general information</div>
                        </div>
                        <div class="right flex-grow">
                            <div class="cols gap24">
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Site Name<span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Site Name" name="site_name" required>
                                </fieldset>
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Site Tagline</div>
                                    <input class="flex-grow" type="text" placeholder="Tagline" name="site_tagline">
                                </fieldset>
                            </div>
                            <div class="cols gap24">
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Contact Email<span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="email" placeholder="Email" name="contact_email" required>
                                </fieldset>
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Phone Number<span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Phone Number" name="phone_number" required>
                                </fieldset>
                            </div>
                            <div class="cols gap24">
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Address<span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="address" placeholder="Address" name="address" required>
                                </fieldset>
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Country<span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Country" name="country" required>
                                </fieldset>
                            </div>
                            <div class="cols gap24">
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Business Hours</div>
                                    <input class="flex-grow" type="text" placeholder="Business Hours" name="business_hours">
                                </fieldset>
                            </div>
                            <!-- Timezone Dropdown -->
                            <div class="cols gap24">
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Timezone</div>
                                    <select class="flex-grow" name="timezone">
                                        <option value="UTC">UTC</option>
                                        <option value="PST">Pacific Standard Time (PST)</option>
                                        <option value="EST">Eastern Standard Time (EST)</option>
                                        <option value="CST">Central Standard Time (CST)</option>
                                        <option value="MST">Mountain Standard Time (MST)</option>
                                        <!-- Add more timezones as needed -->
                                    </select>
                                </fieldset>
                                <!-- Currency Dropdown -->
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Currency</div>
                                    <select class="flex-grow" name="currency">
                                        <option value="USD">USD ($)</option>
                                        <option value="EUR">EUR (€)</option>
                                        <option value="GBP">GBP (£)</option>
                                        <option value="JPY">JPY (¥)</option>
                                        <!-- Add more currencies as needed -->
                                    </select>
                                </fieldset>
                                <!-- Site Language Dropdown -->
                                <fieldset class="mb-24">
                                    <div class="body-title mb-10">Site Language</div>
                                    <select class="flex-grow" name="site_language">
                                        <option value="en">English</option>
                                        <option value="es">Spanish</option>
                                        <option value="fr">French</option>
                                        <option value="de">German</option>
                                        <!-- Add more languages as needed -->
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="wg-box">
                        <div class="left">
                            <h5 class="mb-4">Social Links</h5>
                            <div class="body-text">Setting Social Links</div>
                        </div>
                        <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Facebook URL</div>
                            <input class="flex-grow" type="url" placeholder="https://facebook.com/yourpage" name="social_links[facebook]">
                        </fieldset>
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Twitter URL</div>
                            <input class="flex-grow" type="url" placeholder="https://twitter.com/yourhandle" name="social_links[twitter]">
                        </fieldset>
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Instagram URL</div>
                            <input class="flex-grow" type="url" placeholder="https://instagram.com/yourhandle" name="social_links[instagram]">
                        </fieldset>
                        </div>
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w380" type="submit">Create</button>
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
    
</script>
@endsection