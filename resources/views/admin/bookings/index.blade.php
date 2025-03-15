@extends('layouts.backend.admin')

@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Bookings')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            @include('layouts.backend.inc.breadcrumbs')

            <!-- Bookings Management -->
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <!-- Search -->
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('admin.bookings.index') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Search bookings..." name="search" value="" required>
                            </fieldset>
                            <div class="button-submit">
                                <button type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.bookings.create') }}">
                        <i class="icon-plus"></i> Add Booking
                    </a>
                </div>

                <!-- Booking List Table -->
                <div class="wg-table table-all-user">
                    <ul class="table-title flex gap20 mb-14">
                        <li><div class="body-title">Client's Name</div></li>
                        <li><div class="body-title">Phone Number</div></li>
                        <li><div class="body-title">Date</div></li>
                        <li><div class="body-title">Time</div></li>
                        <li><div class="body-title">Status</div></li>
                        <li><div class="body-title">Action</div></li>
                    </ul>

                    <ul class="flex flex-column">
                        @foreach($bookings as $booking)
                            <li class="wg-product item-row">
                                <div class="name flex-grow">
                                    <div>
                                        <div class="title">
                                            <a href="#" class="body-title-2">{{ $booking->client_name }}</a>
                                        </div>
                                        <div class="text-tiny">{{ $booking->client_email }}</div>
                                    </div>
                                </div>
                                <div class="body-text">{{ $booking->client_phone }}</div>
                                <div class="body-text">{{ $booking->date }}</div>
                                <div class="body-text">{{ $booking->time }}</div>

                                <div class="body-text">
                                    @if($booking->status == 'confirmed')
                                        <div>
                                            <div class="block-available bg-1 fw-7">Confirmed</div>
                                        </div>
                                    @elseif($booking->status == 'pending')
                                        <div>
                                            <div class="block-pending bg-1 fw-7">Pending</div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="block-pending bg-1 fw-7">Cancelled</div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <a class="item edit" href="{{ route('admin.bookings.edit', $booking->id) }}">
                                            <i class="icon-edit-3"></i>
                                        </a>
                                    </div>
                                    <div class="item trash">
                                        <a href="#" class="item trash delete-booking-btn" data-id="{{ $booking->id }}">
                                            <i class="icon-trash-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Pagination -->
                <div class="divider"></div>
            </div>
        </div>
    </div>

    <div class="bottom-page">
        <div class="body-text">
            Copyright © 2024 <a href="#">Genius Photography</a>. All rights reserved.
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-booking-btn', function(e) {
            e.preventDefault();

            var bookingId = $(this).data('id');
            var deleteUrl = '/admin/bookings/' + bookingId;

            SwalGlobal.fire({
                title: 'Are you sure?',
                text: "This booking will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            SwalGlobal.fire('Deleted!', response.message, 'success');
                        },
                        error: function(xhr) {
                            SwalGlobal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
