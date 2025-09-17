@include('clients.blocks.header')

<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container-signin">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('clients/images/login/signin-image.jpg') }}" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link" id="sign-in">Tạo tài khoản mới</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Đăng nhập</h2>
                    <form method="POST" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label class="lable-login" for="your_name"><i
                                    class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="username_login" id="username_login" placeholder="Your Name" />
                        </div>
                        <div class="invalid-feedback-login" style="margin-top: -15px" id="validate_username"></div>
                        <div class="form-group">
                            <label class="lable-login" for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password_login" id="password_login" placeholder="Password" />
                        </div>
                        <div class="invalid-feedback-login" style="margin-top: -15px" id="validate_password"></div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">Or login with</span>
                        <ul class="socials">
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container-signup">
            <div class="signup-content">

                <div class="signup-form">
                    <h2 class="form-title">Đăng ký</h2>
                    <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label class="lable-login" for="user_name"><i
                                    class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="user_name" id="user_name" placeholder="Your Name" />
                        </div>
                        <div class="invalid-feedback-register" style="margin-top: -15px"
                            id="validate_username_register"></div>
                        @error('email')
                            <div class="invalid-feedback-register" style="color: red; margin-top: -15px;">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            <label class="lable-login" for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email" />
                        </div>
                        <div class="invalid-feedback-register" style="margin-top: -15px" id="validate_email_register">
                        </div>

                        <div class="form-group">
                            <label class="lable-login" for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Password" />
                        </div>
                        <div class="invalid-feedback-register" style="margin-top: -15px"
                            id="validate_password_register"></div>

                        <div class="form-group">
                            <label class="lable-login" for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_password" id="re_password"
                                placeholder="Repeat your password" />
                        </div>
                        <div class="invalid-feedback-register" style="margin-top: -15px"
                            id="validate_re_password_register">
                        </div>


                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit"
                                value="Register" />
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('clients/images/login/signup-image.jpg') }}" alt="sing up image">
                    </figure>
                    <a href="#" class="signup-image-link" id="sign-up">Tôi đã có tài khoản</a>
                </div>
            </div>
        </div>
    </section>



</div>
<script>
    const checkEmailUrl = "{{ route('check.email') }}";
    const csrfToken = "{{ csrf_token() }}";
</script>

@include('clients.blocks.footer')
