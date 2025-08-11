@extends('layouts.admin_login_header')

<style>
    .navbar {
        display: none !important;
    }

    .btn-thm {
        background-color: #ec1c24;
        border: 2px solid #ec1c24;
        border-radius: 5px;
        color: #ffffff;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    button.btn.admin_login_btn.btn-thm:hover {
        color: #ffffff !important;
    }
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="/assets/images/admin_logo.png" class="admin_dashboard_logo">
            <div class="card">
                <div class="card-header admin-card-header" style="background: #EB1C23; color:white; font-weight:600;">
                    {{ __('Admin Login') }}
                </div>

                <div class="card-body">
                    <form method="POST" id="frmValidate" class="text-center">
                        @csrf
                        <!-- <input type="hidden" id="webSiteUserType" name="user_type_id" value='{{Config::get("constants.UserTypeIds.WebSiteUser")}}'> -->
                        <div class="col-md-6 d-i-b_f-n">
                            <div class="form-group">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 d-i-b_f-n">
                            <div class="form-group">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 d-i-b_f-n">
                            <div class="form-group">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" class="btn admin_login_btn btn-thm" onclick="SubmitAdminLoginForm()" style="background: #EB1C23; color:white; font-weight:600;">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4 text-center">
                                <h6>OR</h6>
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ url('google-login') }}" type="submit" class="btn btn-light w-100">
                        <i class="fab fa-google"></i> Sign In with Google
                        </a>
                </div>
            </div>
            <div class="form-group row mb-0 mt-4">
                <div class="col-md-6 offset-md-4">
                    <a href="{{ url('facebook-login') }}" type="submit" class="btn btn-primary w-100">
                        <i class="fab fa-facebook"></i> Sign In with Facebook
                    </a>
                </div>
            </div>
            --}}
            </form>
        </div>
    </div>
</div>
</div>
</div>

<script>
    $(document).ready(function() {

    });

    function SubmitAdminLoginForm() {
        if (SubmitForm("frmValidate")) {
            let AdminLoginRoute = "<?php echo route('attempt.admin.login'); ?>";
            ShowLoader();
            var params = {
                email: $('[name="email"]').val(),
                password: $('[name="password"]').val(),
            };
            CallLaravelAction(AdminLoginRoute, params, function(response) {
                if (response.status) {
                    ShowSweetAlert({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: true,
                        timer: 20000
                    });
                    // ShowSuccess(response.message);
                    location.reload();
                    HideLoader();
                } else {
                    var ErrorMsg = response.message;

                    if (typeof response.error !== "undefined") {
                        if (typeof response.error.email !== "undefined") {
                            ErrorMsg = response.error.email;
                        }
                        if (typeof response.error.password !== "undefined") {
                            ErrorMsg = response.error.password;
                        }
                        if (typeof response.error.user_type_id !== "undefined") {
                            ErrorMsg = response.error.user_type_id;
                        }
                    }
                    $('[name="email"]').val("");
                    $('[name="password"]').val("");
                    ShowSweetAlert({
                        icon: "error",
                        title: ErrorMsg,
                        showConfirmButton: true,
                        timer: 20000
                    });
                    // ShowError(ErrorMsg);
                    HideLoader();
                }
            });
        }
    }
</script>
@endsection