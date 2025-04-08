@extends('layouts.frontend.account')

@section('account_content')
    <div class="col-lg-9">
        <div class="my-account-content account-edit">
            <div class="">
                <form id="booking-form">
                    @csrf

                    <!-- First Name -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" disabled>
                        <label class="tf-field-label fw-4 text_black-2" for="first_name">First name</label>
                    </div>

                    <!-- Last Name -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" disabled>
                        <label class="tf-field-label fw-4 text_black-2" for="last_name">Last name</label>
                    </div>

                    <!-- Phone -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                        <label class="tf-field-label fw-4 text_black-2" for="phone">Phone</label>
                    </div>

                    <!-- Email -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" disabled>
                        <label class="tf-field-label fw-4 text_black-2" for="email">Email</label>
                    </div>

                    <!-- Select Photography Package -->
                    <div class="tf-field style-1 mb_15">
                        <select class="tf-field-input tf-input" id="package_id" name="package_id" required>
                            <option value="">Select a Package</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }} - NGN{{ $package->price }}</option>
                            @endforeach
                        </select>
                        <label class="tf-field-label fw-4 text_black-2" for="package_id">Photography Package</label>
                    </div>

                    <!-- Date -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="date" id="date" name="date" required>
                        <label class="tf-field-label fw-4 text_black-2" for="date">Date</label>
                    </div>

                    <!-- Time -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="time" id="time" name="time" required>
                        <label class="tf-field-label fw-4 text_black-2" for="time">Time</label>
                    </div>

                    <!-- Location -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="location" name="location">
                        <label class="tf-field-label fw-4 text_black-2" for="location">Location</label>
                    </div>

                    <!-- Special Requests -->
                    <div class="tf-field style-1 mb_15">
                        <textarea class="tf-field-input tf-input" id="special_requests" name="special_requests" placeholder="Any special requests?"></textarea>
                        <label class="tf-field-label fw-4 text_black-2" for="special_requests">Special Requests</label>
                    </div>

                    <!-- Number of People -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="number" id="num_people" name="num_people" min="1" required>
                        <label class="tf-field-label fw-4 text_black-2" for="num_people">Number of People</label>
                    </div>

                    <div class="mb_20">
                        <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Book Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#booking-form').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('client.bookings.store', ['user_prefix' => $user_prefix]) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        Swal.fire({
                            title: "Processing...",
                            text: "Please wait while we confirm your booking.",
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Booking Confirmed!',
                            text: response.message,
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Booking Failed!',
                            text: xhr.responseJSON.message || 'Something went wrong!',
                        });
                    }
                });
            });
        });
    </script>
@endsection