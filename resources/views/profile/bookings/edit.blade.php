@extends('layouts.backend.admin')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Edit Booking')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            <!-- Booking Edit Form -->
            <form class="form-style-2" id="bookingEditForm">
                @csrf
                @method('PUT')
                <div class="wg-box">
                    <div class="right flex-grow">
                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Client Name</div>
                                <input type="text" value="{{ $booking->client && $booking->client->first_name ? $booking->client->first_name . ' ' . $booking->client->last_name : $booking->client_name }}" disabled>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Email</div>
                            <input type="email" value="{{ $booking->client && $booking->client->email ? $booking->client->email : $booking->client_email }}" disabled>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Phone Number</div>
                            <input type="text" value="{{ $booking->client && $booking->client->phone ? $booking->client->phone : $booking->client_phone }}" disabled>

                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Booking Date</div>
                            <input type="date" id="date" name="date" value="{{ $booking->date }}" required>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Booking Time</div>
                            <input type="time" id="time" name="time" value="{{ $booking->time }}" required>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Package</div>
                            <select id="package_id" name="package_id" required>
                                <option value="">Choose Package</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" {{ $booking->package_id == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} - {{ number_format($package->price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>

                        <fieldset class="mb-24">
                            <div class="body-title mb-10">Booking Status</div>
                            <select id="status" name="status" required>
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="bot">
                    <button type="submit" class="btn-success tf-button w180">Update</button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn-secondary tf-button w180">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#bookingEditForm').on('submit', function (e) {
            e.preventDefault();

            var formData = {
                date: $('#date').val(),
                time: $('#time').val(),
                package_id: $('#package_id').val(),
                status: $('#status').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
                _method: 'PUT'
            };

            $.ajax({
                url: '{{ route("admin.bookings.update", $booking->id) }}',
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
                            width: '300px', 
                            padding: '5px', 
                            customClass: {
                                    popup: 'swal-custom-popup',
                                    title: 'swal-title-custom'
                                }
                        });
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