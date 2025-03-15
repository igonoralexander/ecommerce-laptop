@extends('layouts.auth.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : ($settings ? $settings->site_name : 'Genius Photography') . ' - Admin Register')

@section('content')

     <!-- #wrapper -->
     <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="login-page">
                <div class="left">
                    <div class="login-box type-signup">
                        <div>
                            <h3>Create your account</h3>
                            <div class="body-text text-white">Or enter your personal details to create account</div>
                        </div>
                        <form id="registerForm" class="form-login flex flex-column gap22 w-full" method = "POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div>
                                <div class="body-title mb-10 text-white">Your name <span class="tf-color-1">*</span></div>
                                <div class="cols gap10">
                                    <fieldset class="name mb-10">
                                        <input class="flex-grow" type="text" placeholder="First name" name="first_name" id="first_name" value="{{old('first_name')}}" required autofocus>
                                    </fieldset>
                                    <br>
                                    <fieldset class="name">
                                        <input class="flex-grow" type="text" placeholder="Last name" name="last_name" id="last_name" value="{{old('last_name')}}" required>
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="email">
                                <div class="body-title mb-10 text-white">Email address <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="email" placeholder="Enter your email address" name="email" id="email" value="{{old('email')}}" required>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Password <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Enter your password" name="password" id="password" required  autocomplete="new-password">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10 text-white">Confirm password <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Enter your password" name="password_confirmation" required id = "password_confirmation">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                            </fieldset>
                            <div class="flex justify-between items-center">
                                <div class="flex gap10">
                                    <input class="tf-check" type="checkbox" id="signed">
                                    <label class="body-text text-white" for="signed">Agree with Privacy Policy</label>
                                </div>
                            </div>
                            <button type="button" class="tf-button w-full" onclick="confirmRegistration()">Register</button>
                        </form>
                        <div class="bottom body-text text-center text-center text-white w-full">
                            Already have account?
                            <a href="{{ route('login') }}" class="body-text tf-color">Sign in here</a>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <img src="{{asset('frontend/images/img_2.jpg')}}" alt="">
                </div>
            </div>
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->
@endsection

@section('script')
    <script>
      
            document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("registerButton").addEventListener("click", function () {
                confirmRegistration();
            });
        });

        function confirmRegistration() {
            let firstName = document.getElementById("first_name").value.trim();
            let lastName = document.getElementById("last_name").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let confirmPassword = document.getElementById("password_confirmation").value.trim();

            // Check if fields are empty
            if (!firstName || !lastName || !email || !password || !confirmPassword) {
                SwalGlobal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields!',
                });
                return;
            }

            // Validate email format
            let emailPattern = /^[^@]+@\w+(\.\w+)+\w$/;
            if (!emailPattern.test(email)) {
                SwalGlobal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address.',
                });
                return;
            }

            // Check password length
            if (password.length < 8) {
                SwalGlobal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must be at least 8 characters long.',
                });
                return;
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                SwalGlobal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Passwords do not match. Please check and try again!',
                });
                return;
            }

            // Check email availability before proceeding
            checkEmailAvailability(email).then(isAvailable => {
                if (!isAvailable) {
                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'User already exists',
                        text: 'This email is already taken.',
                    });
                    return;
                }

                // Proceed with registration if email is available
                SwalGlobal.fire({
                    title: 'Are you sure?',
                    text: "Please confirm your registration details.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Register!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("registerForm").submit();
                    }
                });
            }).catch(error => {
                console.error('Error checking email:', error);
                SwalGlobal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again later.',
                });
            });
        }

        // Check if email is already taken
        function checkEmailAvailability(email) {
            return new Promise((resolve, reject) => {
                fetch('/check-email', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => resolve(data.available))
                .catch(error => reject(error));
            });
        }   
    </script>
@endsection