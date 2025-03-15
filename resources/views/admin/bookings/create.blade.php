@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Management')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            <!-- Booking Form -->
            <form class="form-style-2" id="bookingForm">
                @csrf
                <div class="wg-box">
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Existing Clients <span class="tf-color-1">*</span></div>
                            <select id="client_id" name="client_id" >
                                <option value="">Choose From Existing Clients</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" data-name="{{ $client->first_name }} {{ $client->last_name }}" data-email="{{ $client->email }}" data-phone="{{ $client->phone }}">{{ $client->first_name }} - {{ $client->last_name }}</option>
                                @endforeach
                            </select>
                        </fieldset>

                        <p class="mb-24">OR Enter Client Details for a New Client:</p>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Client Name <span class="tf-color-1">*</span></div>
                            <input type="text" id="client_name" name="client_name" placeholder="Enter Client's Name" required>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
                            <input type="email" id="client_email" name="client_email" placeholder="Client's Email" required>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Phone Number <span class="tf-color-1">*</span></div>
                            <input type="text" id="client_phone" name="client_phone" placeholder="Client's Phone Number" required>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Booking Date <span class="tf-color-1">*</span></div>
                            <input type="date" id="date" name="date" required>
                        </fieldset>

                        <fieldset class="name mb-24">
                            <div class="body-title mb-10">Booking Time</div>
                            <input class="flex-grow" type="time" id="time" name="time" required>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Package <span class="tf-color-1">*</span></div>
                            <select id="package_id" name="package_id" required>
                                <option value="">Choose Package</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }} - {{ number_format($package->price, 2) }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="bot">
                    <button type="submit" class="btn-success tf-button w180">Save</button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn-secondary tf-button w180">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let clientSelect = document.getElementById("client_id");
            let nameInput = document.getElementById("client_name");
            let emailInput = document.getElementById("client_email");
            let phoneInput = document.getElementById("client_phone");

            clientSelect.addEventListener("change", function () {
                let selectedOption = clientSelect.options[clientSelect.selectedIndex];

                if (selectedOption.value) {
                    nameInput.value = selectedOption.getAttribute("data-name");
                    emailInput.value = selectedOption.getAttribute("data-email");
                    phoneInput.value = selectedOption.getAttribute("data-phone");
                } else {
                    nameInput.value = "";
                    emailInput.value = "";
                    phoneInput.value = "";
                }
            });
        });

        $(document).ready(function () {
                $('#bookingForm').on('submit', function (e) {
                    e.preventDefault();

                    var formData = {
                        client_id: $('#client_id').val(),
                        client_name: $('#client_name').val(),
                        client_email: $('#client_email').val(),
                        client_phone: $('#client_phone').val(),
                        date: $('#date').val(),
                        time: $('#time').val(),
                        package_id: $('#package_id').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    $.ajax({
                        url: '{{ route("admin.bookings.store") }}',
                        method: 'POST',
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
                                    width: '250px', 
                                    padding: '5px', 
                                    customClass: {
                                        popup: 'swal-custom-popup',
                                        title: 'swal-title-custom'
                                    }
                                });
                                $('#bookingForm')[0].reset();
                            }
                        },
                        error: function (xhr) {
                            var errors = xhr.responseJSON.errors;
                            let errorMessage = 'Error, Please check the form and try again.';

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
                    font-size: 14px !important;
                    width: 250px !important; /* Set smaller width */
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
                    font-size: 14px !important;
                    line-height: 1.2 !important; /* Reduce spacing inside */
                }
    </style>
@endsection