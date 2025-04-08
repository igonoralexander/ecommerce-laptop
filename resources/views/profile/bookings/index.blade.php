@extends('layouts.frontend.account')

@section('account_content')

                    <div class="col-lg-9">
                        <div class="my-account-content account-order">
                            <div class="wrap-account-order">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="fw-6">Booking</th>
                                            <th class="fw-6">Date</th>
                                            <th class="fw-6">Time</th>
                                            <th class="fw-6">Location</th>
                                            <th class="fw-6">Payment Status</th>
                                            <th class="fw-6">Amount Paid</th>
                                            <th class="fw-6">Booking Status</th>
                                            <th class="fw-6">Package</th>
                                            <th class="fw-6">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    @foreach($bookings as $booking)
                                        <tr class="tf-order-item">
                                            <td>
                                                #123
                                            </td>
                                            <td>
                                                {{ $booking->date }}
                                            </td>
                                            <td>
                                                {{ $booking->time }}
                                            </td>
                                            <td>
                                                {{ $booking->location }}
                                            </td>
                                            <td>
                                                <a href="my-account-orders-details.html" class="tf-btn btn-fill animate-hover-btn rounded-0 justify-content-center">
                                                    <span>View</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection