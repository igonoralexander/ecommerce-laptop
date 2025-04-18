@extends('layouts.frontend.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin Management')

@section('content')
<div id="thankyou" class="thankyou-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="thankyou-message">
                    <br>
                    <div style="padding: 50px; text-align: center;">
                        @if(empty($thankyou_name)) 
                            <h3 style="color: #007bff;"><b>THANK YOU FOR YOUR ORDER</b></h3>
                        @else
                            <h3 style="color: green;"><b>Dear <strong style="color: black;">{{ $thankyou_name }}</strong>, Thank you for your Order</b></h3>
                        @endif
                        <br>
                        <h6 style="color: #333;">We’ve received your order and are currently processing it. You’ll receive a confirmation email shortly.</h6>
                        <br>
                        <h6 style="color: #333;">We appreciate your trust in us. We’re committed to delivering the best service and products to you.</h6>
                        <br>
                        <h6 style="background-color: red; color: white; padding: 10px; border-radius: 5px;">
                            <b>Please check your email for further updates regarding your order.</b>
                        </h6>
                        <br>
                        <h6 style="color: #333;">If you have any questions or concerns, feel free to reach out to us:</h6>
                        <ul style="list-style: none; padding: 0; color: #333;">
                            <li><b>Call or WhatsApp:</b> {{ $contact->phone ?? '+234-000-000-0000' }} </li>
                            <li><b>Email:</b> {{ $contact->email ?? 'info@example.com' }}</li>
                        </ul>
                        <br>
                        <a href="{{ url('/') }}" class="btn btn-primary" style="padding: 10px 30px; border-radius: 5px;">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
