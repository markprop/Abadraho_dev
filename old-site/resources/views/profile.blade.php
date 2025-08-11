@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')
@section('content')

    <section class="our-dashbord dashbord bgc-f7 pb50">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 col-xl-12 maxw100flex-992">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard_navigationbar dn db-992">
                                <div class="dropdown">
                                    <button onclick="myFunction()" class="dropbtn profile_dashboard"><i
                                            class="fa fa-bars pr10"></i> Dashboard Navigation</button>
                                    <ul id="myDropdown" class="dropdown-content">
                                        <li><a href="page-dashboard.html"><span class="flaticon-layers"></span>
                                                Dashboard</a></li>
                                        <li><a href="page-message.html"><span class="flaticon-envelope"></span> Message</a>
                                        </li>
                                        <li><a href="page-my-properties.html"><span class="flaticon-home"></span> My
                                                Properties</a></li>
                                        <li><a href="page-my-favorites.html"><span class="flaticon-heart"></span> My
                                                Favorites</a></li>
                                        <li><a href="page-my-savesearch.html"><span
                                                    class="flaticon-magnifying-glass"></span> Saved Search</a></li>
                                        <li><a href="page-my-review.html"><span class="flaticon-chat"></span> My Reviews</a>
                                        </li>
                                        <li><a href="page-my-packages.html"><span class="flaticon-box"></span> My
                                                Package</a></li>
                                        <li class="active"><a href="page-my-profile.html"><span
                                                    class="flaticon-user"></span> My Profile</a></li>
                                        <li><a href="page-add-new-property.html"><span
                                                    class="flaticon-filter-results-button"></span> Add New Listing</a></li>
                                        <li><a href="page-login.html"><span class="flaticon-logout"></span> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb10">
                            <div class="breadcrumb_content style2">
                                <h2 class="breadcrumb_title">My Profile</h2>
                                <p>We are glad to see you again!</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="my_dashboard_review">
                                <div class="row">
                                    <div class="col-xl-2">
                                        <h4>Profile Information</h4>
                                    </div>
                                    <div class="col-xl-12">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success">
                                                {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        <div class="col-md-6 offset-3 pt-4">
                                            @if ($errors->any())
                                                {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                                            @endif
                                            @if (Session::get('error') && Session::get('error') != null)
                                                <div style="color:red">{{ Session::get('error') }}</div>
                                                @php
                                                    Session::put('error', null);
                                                @endphp
                                            @endif
                                            <!-- @if (Session::get('success') && Session::get('success') != null)
                                                <div style="color:green">{{ Session::get('success') }}</div>
                                                @php
                                                    Session::put('success', null);
                                                @endphp
                                            @endif -->
                                        </div>
                                        <form action="{{ url('my-profile-update') }}" method="POST"
                                            enctype="multipart/form-data">

                                            {{ csrf_field() }}

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <br>
                                                    <img src="{{ asset('uploads/profile/' . Auth::user()->image) }}"
                                                        onerror="this.src='/assets/images/profile_image_insert.jpg'"
                                                        width="250" height="250"><br>
                                                    <br><input type="file" name="image" class="form-control"><br>

                                                </div>
                                                <div class="col-lg-6 col-xl-6">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleInput1">Username</label>
                                                        <input type="text" class="form-control" name="username"
                                                            id="formGroupExampleInput1" value="{{ Auth::user()->username }}"
                                                            placeholder="abc" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xl-6">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleEmail">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="formGroupExampleEmail" readonly
                                                            value="{{ Auth::user()->email }}" placeholder="abc@gmail.com"
                                                            required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xl-6">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleInput3">First Name</label>
                                                        <input type="text" class="form-control" name="first_name"
                                                            id="formGroupExampleInput3"
                                                            value="{{ Auth::user()->first_name }}" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-xl-6">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleInput4">Last Name</label>
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="formGroupExampleInput4"
                                                            value="{{ Auth::user()->last_name }}" required="">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-xl-6">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleInput8">Phone</label>
                                                        <input type="text" class="form-control" name="phone_number"
                                                            id="formGroupExampleInput8"
                                                            value="{{ Auth::user()->phone_number }}" required="">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-xl-6">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleInput10">City</label>
                                                        <input type="text" class="form-control" name="city"
                                                            id="formGroupExampleInput10" value="{{ Auth::user()->city }}"
                                                            required="">
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <div class="my_profile_setting_input form-group">
                                                        <label for="formGroupExampleInput13">Address</label>
                                                        <input type="text" name="Address" class="form-control"
                                                            id="formGroupExampleInput13"
                                                            value="{{ Auth::user()->Address }}" required="">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <div class="my_profile_setting_textarea">
                                                        <label for="exampleFormControlTextarea1">About me</label>
                                                        <textarea class="form-control" required="" name="about_me" id="exampleFormControlTextarea1"
                                                            value="{{ Auth::user()->about_me }}" rows="7">{{ Auth::user()->about_me }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 text-right">
                                                    <div class="my_profile_setting_input">

                                                        <button type="submit" class="btn btn2">Update Profile</button>
                                                    </div>
                                                </div>
                                            </div>


                                        </form>

                                    </div>
                                </div>
                            </div>

                            <div class="my_dashboard_review mt30">
                                <div class="row">

                                    <div class="col-xl-2">
                                        <h4>Change password</h4>
                                    </div>

                                    <div class="col-xl-10">
                                        <form class="form" action="{{ route('my-profile-update-password') }}"
                                            method="post">
                                            @csrf
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="my_profile_setting_input form-group">
                                                    <label for="current_password" class="text-left"><b>Old
                                                            Password</b><span class="text-red"> *</span></label>
                                                    <input type="password" class="form-control" id="current_password" placeholder="Enter Old Password" 
                                                        name="current_password">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="my_profile_setting_input form-group">
                                                    <label for="new_password" class="text-left"><b>New
                                                            Password</b><span class="text-red"> *</span></label>
                                                    <input type="password" class="form-control" id="new_password"
                                                        name="new_password" placeholder="Enter New Password">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="my_profile_setting_input form-group">
                                                    <label for="new_password_confirmation"
                                                        class="form-label"><b>Confirm Password</b><span
                                                            class="text-red"> *</span></label>
                                                    <input type="password" class="form-control"
                                                        id="new_password_confirmation" placeholder="Enter Confirm Password" name="new_password_confirmation">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="my_profile_setting_input float-right fn-520">
                                                    <button type="submit" class="btn btn2"
                                                        onclick="SubmitChangePasswordForm()">Update Password</button>
                                        </form>
                                    </div>

                                    <!-- <div class="col-xl-10">
             <div class="row" id="frmPasswordChange">
              <div class="col-lg-12 col-xl-12">
               <div class="my_profile_setting_input form-group">
                <label class="text-left">Old Password <span class="text-red"> *</span></label>
                <input type="password" class="form-control" id="old_password" placeholder="Enter Old Password" required>
               </div>
              </div>
              <div class="col-lg-12 col-xl-12">
               <div class="my_profile_setting_input form-group">
                <label class="text-left">New Password <span class="text-red"> *</span></label>
                <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" required>
               </div>
              </div>
              <div class="col-lg-12 col-xl-12">
               <div class="my_profile_setting_input form-group">
                <label class="text-left">Confirm New Password <span class="text-red"> *</span></label>
                <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" required>
               </div>
              </div>
              <div class="col-lg-12">
               <div class="my_profile_setting_input float-right fn-520">
                <button class="btn btn2" onclick="SubmitChangePasswordForm()">Update Password</button>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div> -->
                                    <div class="row mt10">
                                        <div class="col-lg-12">
                                            <div class="copyright-widget text-center">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </section>
@endsection

@section('footer')
    <!-- <script>
        $(document).ready(function() {

            ValiadteInputs();

        });

        function SubmitChangePasswordForm() {

            if (SubmitForm("frmPasswordChange")) {
                ShowLoader();
                var params = {
                    old_password: $('#old_password').val(),
                    new_password: $('#new_password').val(),
                    confirm_password: $('#confirm_password').val(),
                };

                if (params.new_password != params.confirm_password) {
                    ShowError("The new password and confirm password does not match.");
                    HideLoader();
                    return;
                }

                CallLaravelAction("/my-profile-update-password", params, function(response) {
                    if (response.status) {
                        ShowSuccess(response.message, function() {

                            location.reload()
                        });
                        HideLoader();
                    } else {
                        var ErrorMsg = response.message;
                        if (typeof response.error !== "undefined") {
                            if (typeof response.error.old_password !== "undefined") {
                                ErrorMsg = response.error.old_password;
                            }
                            if (typeof response.error.new_password !== "undefined") {
                                ErrorMsg = response.error.new_password;
                            }
                            if (typeof response.error.confirm_password !== "undefined") {
                                ErrorMsg = response.error.confirm_password;
                            }
                        }
                        ShowError(ErrorMsg);
                        HideLoader();
                    }
                });
            }

        }
    </script> -->
@endsection
