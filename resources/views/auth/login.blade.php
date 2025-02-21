@extends('layouts.auth.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle: 'Admin - Login')

@section('content')
        <!-- #wrapper -->
        <div id="wrapper">
            <!-- #page -->
            <div id="page" class="">
                <div class="login-page">
                    <div class="left">
                        <div class="login-box">
                            <div>
                                <h3>Login to account</h3>
                                <div class="body-text text-white">Or enter your email & password to login</div>
                            </div>

                            <form id = "loginForm" class="form-login flex flex-column gap22 w-full" method = "POST" action="{{ route('login') }}">
                                @csrf

                                <fieldset class="email">
                                    <div class="body-title mb-10 text-white">Email address <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="email" placeholder="Enter your email address" name="email" id = "email" required>
                                </fieldset>
                                <fieldset class="password">
                                    <div class="body-title mb-10 text-white">Password <span class="tf-color-1">*</span></div>
                                    <input class="password-input" type="password" placeholder="Enter your password" name="password" id = "" required>
                                    <span class="show-pass">
                                        <i class="icon-eye view"></i>
                                        <i class="icon-eye-off hide"></i>
                                    </span>
                                </fieldset>
                                <div class="flex justify-between items-center">
                                    <div class="flex gap10">
                                        <input class="tf-check" type="checkbox" id="remember_me" name = "remember">
                                        <label class="body-text text-white" for="signed">Keep me signed in</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="body-text tf-color">Forgot password?</a>
                                    @endif
                                </div>
                                <button type="button" id="loginButton" class="tf-button w-full">Login</button>
                            </form>
                            <div class="bottom body-text text-center text-center text-white w-full">
                                Not regster yet?
                                <a href="{{ route('register') }}" class="body-text tf-color">Register Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <img src="" alt="">
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
            document.getElementById("loginButton").addEventListener("click", function (event) {
                event.preventDefault(); // Prevent form submission
                validateLogin();
            });
        });

        function validateLogin() {
            let email = document.querySelector("input[name='email']").value.trim();
            let password = document.querySelector("input[name='password']").value.trim();

            // Validation check for empty fields
            if (!email || !password) {
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

            // Check if email exists in the database before allowing login
            checkEmailExists(email).then(exists => {
                if (!exists) {
                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'Email Not Found',
                        text: 'This email is not registered. Please sign up first.',
                    });
                    return;
                }

                // Validate password length
                if (password.length < 8) {
                    SwalGlobal.fire({
                        icon: 'error',
                        title: 'Weak Password',
                        text: 'Password must be at least 8 characters long.',
                    });
                    return;
                }

                // If all validations pass, submit the form
                document.querySelector(".form-login").submit();
            });
        }

        // Check if email exists in the database (AJAX request)
        function checkEmailExists(email) {
            return new Promise((resolve, reject) => {
                fetch('/login-checkEmail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => resolve(!data.available)) // If available = false, it means email exists
                .catch(error => reject(error));
            });
        }
    </script>
@endsection