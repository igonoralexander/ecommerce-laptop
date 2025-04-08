@extends('layouts.frontend.account')

@section('account_content')
    <div class="col-lg-9">
        <div class="my-account-content account-edit">
            <div class="">
                <form class="" id="form-password-change" action="#">

                    <!-- First Name -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="property1" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                        <label class="tf-field-label fw-4 text_black-2" for="property1">First name</label>
                    </div>

                    <!-- Last Name -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="property2" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                        <label class="tf-field-label fw-4 text_black-2" for="property2">Last name</label>
                    </div>

                    <!-- Phone -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="text" id="property3" name="phone" value="{{ old('phone', $user->phone) }}">
                        <label class="tf-field-label fw-4 text_black-2" for="property3">Phone</label>
                    </div>

                    <!-- Email -->
                    <div class="tf-field style-1 mb_15">
                        <input class="tf-field-input tf-input" type="email" id="property4" name="email" value="{{ old('email', $user->email) }}">
                        <label class="tf-field-label fw-4 text_black-2" for="property4">Email</label>
                    </div>

                    <div class="mb_20">
                        <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
