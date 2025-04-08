@extends('layouts.frontend.account')

@section('account_content')
<div class="col-lg-9">
        <div class="my-account-content account-edit">
            <div class="">
                <form class="" id="form-password-change" action="#">
                    <h6 class="mb_20">Password Change</h6>

                    <!-- Current Password -->
                    <div class="tf-field style-1 mb_30">
                        <input class="tf-field-input tf-input" type="password" id="property5" name="current_password">
                        <label class="tf-field-label fw-4 text_black-2" for="property5">Current password</label>
                    </div>

                    <!-- New Password -->
                    <div class="tf-field style-1 mb_30">
                        <input class="tf-field-input tf-input" type="password" id="property6" name="new_password">
                        <label class="tf-field-label fw-4 text_black-2" for="property6">New password</label>
                    </div>

                    <!-- Confirm Password -->
                    <div class="tf-field style-1 mb_30">
                        <input class="tf-field-input tf-input" type="password" id="property7" name="confirm_password">
                        <label class="tf-field-label fw-4 text_black-2" for="property7">Confirm password</label>
                    </div>

                    <div class="mb_20">
                        <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection