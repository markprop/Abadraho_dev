<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

$fileModified = date('hms');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
  <meta name="description" content="@yield('meta_description','default description')">
  <meta name="title" content="@yield('meta_description','default description')">
  <meta name="CreativeLayers" content="ATFN">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <!-- css file -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css?v=<?php echo $fileModified ?>">
  <link rel="stylesheet" href="/assets/css/style.css?v=<?php echo $fileModified ?>">

  <!-- Animate Text CDN Link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="bower_components/Morphext/dist/morphext.css">



  <!-- Responsive stylesheet -->
  <link rel="stylesheet" href="/assets/css/responsive.css?v=<?php echo $fileModified ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/> -->

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.cjs.js" integrity="sha512-2e2aXOh4/FgkCAUyurkjk0Uw4m1gPcExFwb1Ai4Ajjg97se/FEWfrLG1na4mq8cgOzouc8qLIqsh0EGksPGdqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.cjs.min.js" integrity="sha512-2ftG6Hks6q07Ca+h8f4WCFWQAZca6bm1klWMAFGev51hiusd6FFaRT+kFWcj1G2KjFgZrns1CuwR8eA4OA0zLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.cjs.prod.min.js" integrity="sha512-9eYPYYqSLRRJlQVcobBpNgDNq7ui/VtXRO/abRajYVXlxLFnV6sBNGfro0+/Us2pqE8DLC2ymO5XT4LIyJZbvQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.esm-browser.min.js" integrity="sha512-3DR3ZmLs45hoKPclZCxDCHMvPiKdsCWCzsqq/8zpRGzFHpgK+6q/YAXEmXT8oTWXn/JziaIYOTydNQSL+XfGQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.esm-browser.prod.min.js" integrity="sha512-XtVBOVTPpRi0rqDbeHvaTV52h4JSXRhvh0XC1a8w2lQMaQnYAII3uSLTpOdTHjHzGRh3HFQu7Bg/nvL2Z4FAgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.esm-bundler.min.js" integrity="sha512-lDEaWZSNZ2qSKkqpfEiM8jXudwAPKNDqbwA6uvWe5ju5B0dcmij36neZ2EQjWq3PW6Zmwv5dySHqOnJ83OjXhw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.global.min.js" integrity="sha512-MXAAS+HimUKBNq7JH7RtQDLg9dM+dh4+nED1e29hydWOzkj1IOl+rf0SlCyXnlJS5Acb+wHJUAEGCfKyooCiAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.global.prod.min.js" integrity="sha512-yY2w8QVShzoLAachKPHtZRjXZeQOi9rQ2dYEYLf+lelt+TvZVOm/AlqVX6xFrjiy6wKDxgqvT1RL3BjxPdq/UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

  <link rel="stylesheet" href="/assets/css/common.css?v=<?php echo $fileModified ?>">
  <!-- Title -->
  <title>@yield('title','Abad Raho')</title>
  <!-- Favicon -->
  <link href="/assets/images/fav-icon.svg?v=<?php echo $fileModified ?>" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
  <link href="/assets/images/fav-icon.svg?v=<?php echo $fileModified ?>" sizes="128x128" rel="shortcut icon" />
  <!-- custom style.css created by shahbaz raza -->
  <link href="{{  asset('css/style.css') }}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
  <!-- spinners CSS -->
  <link href="{{ asset('css/spinners.css')}}" rel="stylesheet">

  <!-- start select2-input-js libraries)-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="css/newSelect2.css" rel="stylesheet" type="text/css" />
  <!-- <link href="css/Select2.css" rel="stylesheet" type="text/css" /> -->
  <!--end select2-input-js libraries)-->

  <!--end::Global Theme Styles-->

  <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-X05W5DLNKD"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-X05W5DLNKD');
  </script>

  <!-- Meta Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2092901300981433');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2092901300981433&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Meta Pixel Code -->

  <style>
    .form-group>label {
      font-size: 12px;
    }
  </style>
  @yield('header')
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <!-- Preloader -->
  <div class="preloader" style="display: none;z-index: 100000000;position: fixed;">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10" />
    </svg>
  </div>

  <!-- Error Modal for exception handling -->
  <div class="modal fade" id="divError" tabindex="-1" role="dialog" style="opacity: 1;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-body alert alert-danger" role="alert">
        <button class="close fa fa-close" style="font-size: 20px;" type="button"></button>
        <b>Alert!</b>
        <label id="lblError"></label>
      </div>
    </div>
  </div>

  <!-- Success Modal for exception handling -->
  <div class="modal fade" id="divSuccess" tabindex="-1" role="dialog" style="opacity: 1;">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-body alert alert-success" role="alert" style="background: #0c9d00;">
        <button class="close fa fa-close" style="font-size: 20px;" type="button"></button>
        <b style="color: #033503;">Success!</b>
        <label id="lblSuccess"></label>
      </div>
    </div>
  </div>

  <!--<a href="https://api.whatsapp.com/send?phone=++923167031554&text=Thankyou%21%20for%20Contacting%20Mark%20Properties%20." class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>-->
  <div class="wrapper">

    <!-- Main Header Nav -->
    <header class="header-nav menu_style_home_one style2  main-menu">
      <div class="container-fluid p0">
        <!-- Ace Responsive Menu -->
        <nav>
          <!-- Menu Toggle btn-->
          <div class="menu-toggle">
            <img class="nav_logo_img img-fluid" src="/assets/images/logo.png?v=<?php echo $fileModified ?>" alt="Mark Properties">
            <button type="button" id="menu-btn">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <a href="/" class="navbar_brand float-left dn-smd">
            <img class="logo1 markproperties img-fluid" src="/assets/images/mark-properties-logo.svg?v=<?php echo $fileModified ?>" alt="Mark Properties">
            <img class="logo1 ml-3 abadraho img-fluid" src="/assets/images/abadraho-logo.svg?v=<?php echo $fileModified ?>" alt="Abad Raho">
            <img class="logo2 img-fluid" src="/assets/images/mark-properties-logo.svg?v=<?php echo $fileModified ?>" alt="Abad Raho">
            <img class="logo2 img-fluid" src="/assets/images/abadraho-logo.svg?v=<?php echo $fileModified ?>" alt="Abad Raho">
          </a>
          <!-- Responsive Menu Structure-->
          <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
          <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
            <li>
              <a href="/"><span class="title">Home</span></a>
            </li>
            <li>
              <a href="/about"><span class="title">About Us</span></a>
            </li>
            <li>
              <a href="/projects/listings"><span class="title">Projects</span></a>
            </li>

            <li>
              <a href="/blogs"><span class="title">Blogs</span></a>
            </li>
            <li>
              <a href="/contact"><span class="title">Contact Us</span></a>
            </li>
            @if (Auth::user())
            <li class="user_setting">
              <div class="dropdown">
                <a class="btn dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                  @if (Auth::user()->avatar)
                    <img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px"><span class="dn-1199">&nbsp;{{ Auth::user()->first_name }}
                      {{ Auth::user()->last_name }}</span>
                  @else
                    <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}" onerror="this.src='/assets/images/user-icon.png'" width="30px" height="30px"><span class="dn-1199">&nbsp;{{ Auth::user()->first_name }}
                      {{ Auth::user()->last_name }}</span>
                  @endif
                </a>
                <div class="dropdown-menu">
                  <div class="user_set_header row">
                    <!-- Recent Changes -->
                    @if (Auth::user()->avatar)
                      <div class="col-md-12">
                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="50px" height="50px">
                        <span class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><br>
                          @if (Auth::user()->user_type_id == -10021)
                            <br><a href="/admin/dashboard" class="btn" style="background-color: #EC1C24; font-weight:600; color:#fff; font-size:14px;">Admin Dashboard</a><br>
                          @endif
                        <br><span><i class="fa fa-envelope"></i>&nbsp;{{Auth::user()->email}}</span>
                      </div>

                    @else
                      <div class="col-md-12">
                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}" onerror="this.src='/assets/images/user-icon.png'" width="50px" height="50px">
                        <span class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><br>
                        <br><i class="fa fa-envelope">&nbsp;&nbsp;{{Auth::user()->email}}</i>

                        <br>

                      </div>
                    @endif


                    <div class="col-md-12">
                      @if (Auth::user()->is_phone_no_verified==1)
                        <i class="fa fa-2x fa-mobile"></i><span style="color: green;">&nbsp;&nbsp;Verified</span>
                      @elseif(Auth::user()->is_phone_no_verified==0)
                        <i class="fa fa-2x fa-mobile"></i> <span style="color:#EC1C24;">&nbsp;&nbsp;Not Verified</span>
                      @else
                        <span style="color:#EC1C24;display:none;"></span>
                      @endif
                    </div>
                    <!-- Recent Changes -->
                  </div>
                  @if (Auth::user()->avatar)
                    <div class="user_setting_content">
                      <!-- <a class="dropdown-item profile_popup active" href="/admin/dashboard"><i class="fa fa-lock"></i>Admin Dashboard</a> -->
                      <a class="dropdown-item profile_popup active" href="/profilepage"><i class="fa fa-user"></i>My Profile</a>
                      <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> -->
                      <a class="dropdown-item profile_popup" href="{{ route('web.logout') }}">
                        <i class="fa fa-lock"></i>Log out
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                      </form>
                    </div>
                  @else
                    <div class="user_setting_content">
                      <a class="dropdown-item profile_popup active" href="/profilepage"><i class="fa fa-user"></i>My Profile</a>
                      <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> -->
                      <a class="dropdown-item profile_popup" href="{{ route('web.logout') }}">
                        <i class="fa fa-lock"></i>Log out
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                      </form>
                    </div>
                  @endif
                </div>
              </div>
            </li>
            @else
              <li class="list-inline-item list_s">
                <!-- <a href="#" class="btn flaticon-user" data-toggle="modal" data-target=".bd-example-modal-lg"> -->
                <a href="javascript:void(0)" class="btn flaticon-user" onclick="OpenLoginRegisterModal('')">
                  <span class="dn-lg">Login/Register</span>
                </a>
              </li>
            @endif
          </ul>
        </nav>
      </div>
    </header>
    <!-- Modal -->
    @if (!Auth::user())
    <div class="sign_up_modal modal fade bd-example-modal-lg" id="authenticationModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body container pb20">
            <div class="row">
              <!-- id="afterSuccessRedirectUrl" -->
              <input type="hidden" id="afterSuccessRedirectUrl" style="width: 100%;">

              <div class="col-lg-12">
                <ul class="sign_up_tab nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-content container" id="myTabContent">
              <div class="row mt25 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="col-lg-6 col-xl-6 d-none d-lg-block">
                  <div class="login_thumb">
                    <img class="img-fluid w100" src="/assets/images/resource/Login-Image.png?v=<?php echo $fileModified ?>" alt="login.jpg">
                  </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                  <form id="frmWebLoginValidate">
                    @csrf
                    <div class="login_form">
                      <div class="heading">
                        <h4>Login</h4>
                      </div>
                      <div class="row mt25">
                        <div class="col-lg-12">
                          <a href="javascript:void(0)" id="btnFacebookLogin" onclick="FacbookLogin()" class="btnFacebookLogin btn btn-fb btn-block"><i class="fa fa-facebook float-left mt5"></i> Login
                            with Facebook</a>
                        </div>
                        <div class="col-lg-12">
                          <a href="javascript:void(0)" id="btnGoogleLogin" onclick="redirectGoogleLogin()" class="btnGoogleLogin btn btn-googl btn-block"><i class="fa fa-google float-left mt5"></i> Login with
                            Google</a>
                        </div>
                      </div>
                      <hr>
                      <div class="col-md-12">
                        <div class="form-group mb-2 mr-sm-2">
                          <label class="text-left">Email <span class="text-red"> *</span></label>
                          <input type="text" class="form-control" @if(Cookie::has('adminemail')) value="{{ Cookie::get('adminemail') }}" checked @endif name="email" id="inlineFormInputGroupUsername2" placeholder="User Name Or Email" required>
                          <!-- <label id="login-email" class="text-danger w-100"></label> -->
                        </div>
                        <!-- <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-user"></i></div>
                        </div> -->
                      </div>
                      <div class="col-md-12">
                        <div class="form group-group form-group">
                          <label class="text-left">Password <span class="text-red"> *</span></label>
                          <input type="password" class="form-control mb0" @if(Cookie::has('adminpwd')) value="{{ Cookie::get('adminpwd') }}" @endif name="password" id="exampleInputPassword1" placeholder="Password" required>
                          <!-- <div class="input-group-prepend">
                            <div class="input-group-text"><i class="flaticon-password"></i>
                            </div>
                          </div>
                          <label id="login-password" class="text-danger w-100"></label> -->
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" name="remember" class="custom-control-input" id="remember" value="First_Choice">
                          <span class="custom-control-label" for="remember">Remember me</span>
                        </label>
                        <a class="btn-fpswd float-right" href="{{url('/reset-password')}}">Lost your password?</a>
                      </div>

                      <!-- id="btnWebloginForm" -->
                      <button type="button" onclick="LoginToWebSite()" class="btn btn-log btn-block btn-thm mt-2">Log In</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row mt25 tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-lg-6 col-xl-6 d-none d-lg-block">
                  <div class="regstr_thumb">
                    <img class="img-fluid w100" src="/assets/images/resource/abad.png?v=<?php echo $fileModified ?>" alt="regstr.jpg">
                  </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                  <div class="sign_up_form">
                    <div class="heading">
                      <h4>Register</h4>
                    </div>
                    <div class="row mt25">
                      <div class="col-lg-12">
                        <a href="javascript:void(0)" id="btnFacebookLogin" onclick="FacbookLogin()" class="btnFacebookLogin btn btn-fb btn-block"><i class="fa fa-facebook float-left mt5"></i> Login
                          with Facebook</a>
                      </div>
                      <div class="col-lg-12">
                        <a href="javascript:void(0)" id="btnGoogleLogin" onclick="redirectGoogleLogin()" class="btnGoogleLogin btn btn-googl btn-block"><i class="fa fa-google float-left mt5"></i> Login with
                          Google</a>
                      </div>
                    </div>
                    <hr>
                    <form id="frmValidate">
                      @csrf
                      <div class="row d-none">
                        <div class="col-lg-12">
                          <button type="submit" class="btn btn-block btn-fb"><i class="fa fa-facebook float-left mt5"></i> Login with
                            Facebook
                          </button>
                        </div>
                        <div class="col-lg-12">
                          <button type="submit" class="btn btn-block btn-googl"><i class="fa fa-google float-left mt5"></i> Login with Google
                          </button>
                        </div>
                      </div>
                      {{-- <hr> --}}
                      <div class="form-group">
                        <label id="lbl-first_name">First Name <span class="text-red">*</span></label><br>
                        <input type="text" class="form-control" id="exampleInputName" name="first_name" placeholder="First Name" required>
                        <!-- <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-user"></i></div>
                        </div>
                        <label id="register-first_name" class="text-danger w-100"></label> -->
                      </div>
                      <div class="form-group">
                        <label id="lbl-last_name">Last Name <span class="text-red">*</span></label><br>
                        <input type="text" class="form-control" id="exampleInputName" name="last_name" placeholder="Last Name" required>
                        <!-- <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-user"></i></div>
                        </div>
                        <label id="register-last_name" class="text-danger w-100"></label> -->
                      </div>
                      <div class="form-group">
                        <label id="lbl-phone">Phone <span class="text-red">*</span></label><br>
                        <input type="text" class="form-control phoneInputMask" id="phone_number" name="phone_number" required>
                        <!-- <label id="register-phone_number" class="text-danger w-100"></label> -->
                      </div>
                      <div class="form-group">
                        <label id="lbl-email">Email <span class="text-red">*</span></label><br>
                        <input type="email" class="form-control" id="email" name="user_email" placeholder="Email" required>
                        <!-- <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                        </div>
                        <label id="register-email" class="text-danger w-100"></label> -->
                      </div>
                      <div class="form-group">
                        <label id="lbl-password">Password <span class="text-red">*</span></label><br>
                        <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Password" required>
                        <!-- <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-password"></i>
                          </div>
                        </div> -->
                      </div>
                      <div class="form-group">
                        <label id="lbl-re_type_password">Re Enter Password <span class="text-red">*</span></label><br>
                        <input type="password" class="form-control" id="registerConfirmPassword" name="registerConfirmPassword" placeholder="Re-enter password" required>
                        <!-- <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-password"></i>
                          </div>
                        </div> -->
                        <!-- <label id="register-password" class="text-danger w-100"></label> -->
                      </div>

                      <button type="button" id="submitRegisterForm" class="btn btn-log btn-block btn-thm">Sign
                        Up</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
    {{-- Phone Number Modal --}}
    {{-- @if (Auth::user() && Auth::user()->phone_number == null) --}}
    <div class="sign_up_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="phoneNumberModal">
      <div class="modal-dialog modal-lg" role="document" style="top: 25%; max-width: 450px">
        <form id="frmInputPhoneNo">
          @csrf
          <div class="modal-content pt20 pb20">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body container">
              <div class="row" id="submitPhoneNoSection">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="modal-title">Please Provide Phone Number <span class="text-red">*</span></label>
                    <input id="submit_phone_no" type="text" class="form-control phoneInputMask" name="submit_phone_no" style="width:100%" required />
                    <!-- <div class="alert alart_style_four alert-dismissible fade show alert-info" role="alert" style="display: none">
                      Please check the information below
                      <button type="button" class="close ml-10" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div> -->
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="button" onclick="SubmitInputPhoneNoForm()" class="btn btn-block btn-thm">
                    Save And Send Otp
                  </button>
                </div>

              </div>
              <div class="row" style="margin-top: 20px;" id="submitPhoneNoOtpSection">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="modal-title col-md-12 display-flex-wrap">
                      <div class="col-md-6 p-0">
                        <span>Mobile Otp </span>
                        <span class="text-red">*</span>
                      </div>
                      <div class="col-md-6 text-right p-0">
                        <a href="javascript:void(0)" class="btn btn-thm" onclick="ResendPhoneNoOtp()">Resend Otp</a>
                      </div>
                    </label>
                    <input id="phone_no_otp" type="text" class="form-control phone_no_otp" name="phone_no_otp" style="width:100%" numtxt data-maxlength="4" required />
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="button" onclick="SubmitPhoneNoOtpForm()" class="btn btn-block btn-thm">
                    Verify
                  </button>
                  <h3 class="text-center" id="showOtp"></h3>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>



    {{-- Auth::user()->phone_number --}}
    {{-- @endif --}}

    <!-- Main Header Nav For Mobile -->
    <div id="page" class="stylehome1 h0">
      <div class="mobile-menu">
        <div class="header stylehome1">
          <div class="main_logo_home2 text-center">
            <a href="/">
              <img class="nav_logo_img abadraho img-fluid" src="/assets/images/abadraho-logo.svg?v=<?php echo $fileModified ?>" alt="Abad Raho">
            </a>
          </div>
          <ul class="menu_bar_home2">
            @if (Auth::user())
            <li class="list-inline-item">
              <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                  @if (Auth::user()->avatar)
                    <img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px">
                  @else
                    <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px">
                  @endif
                    <span class="dn-1199">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span>
                </a>
                <div class="dropdown-menu">
                  <div class="user_set_header row">
                    @if (Auth::user()->avatar)
                      <div class="col-md-12">
                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px">
                        <span class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><br>
                        <br><span><i class="fa fa-envelope"></i>&nbsp;{{Auth::user()->email}}</span>
                      </div>

                    @else
                      <div class="col-md-12">
                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px">
                        <span class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                        <br><i class="fa fa-envelope">&nbsp;&nbsp;{{Auth::user()->email}}</i>

                        <br>

                      </div>
                    @endif

                    <div class="col-md-12">
                      @if (Auth::user()->is_phone_no_verified==1)
                      <i class="fa fa-2x fa-mobile"></i><span style="color: green;">&nbsp;&nbsp;Verified</span>
                      @elseif(Auth::user()->is_phone_no_verified==0)
                      <i class="fa fa-2x fa-mobile"></i> <span style="color:#EC1C24;">&nbsp;&nbsp;Not Verified</span>
                      @else
                      <span style="color:#EC1C24;display:none;"></span>
                      @endif
                    </div>


                  </div>
                  <div class="user_setting_content">
                    <a class="dropdown-item profile_popup" href="/profilepage" style="padding: 0px;"><i class="fa fa-user"></i>&nbsp;My Profile</a>
                    <a class="dropdown-item profile_popup" href="{{ route('web.logout') }}" style="padding: 0px;">
                      <i class="fa fa-lock"></i>&nbsp;Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </div>
              </div>
            </li>
            @else
            <li class="list-inline-item list_s"><a data-toggle="modal" data-target=".bd-example-modal-lg"><span class="flaticon-user"></span></a>
            </li>
            @endif
            <li class="list-inline-item"><a href="javascript:void(0)" class="menu-tray"><span></span></a></li>
          </ul>
        </div>
      </div><!-- /.mobile-menu -->
      <nav id="menu" class="stylehome1">
        <ul>
          <li>
            <a href="/"><span class="title">Home</span></a>
          </li>
          <li>
            <a href="/about"><span class="title">About Us</span></a>
          </li>
          <li>
            <a href="/projects/listings"><span class="title">Projects</span></a>
          </li>

          <li>
            <a href="/blogs"><span class="title">Blogs</span></a>
          </li>
          <li>
            <a href="/contact"><span class="title">Contact Us</span></a>
          </li>
        </ul>
      </nav>
    </div>

    @yield('content')

    <!-- Our Footer -->
    <section class="footer_one">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3 pr0 pl0">
            <div class="footer_about_widget">
              <h4>About Us</h4>
              <p>Abad Raho stands for quality, trust, and authenticity in the real estate industry
                that deals in marketing and sales of residential and commercial projects.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="footer_qlink_widget">
              <h4>Quick Links</h4>
              <ul class="list-unstyled">
                <li><a href="/about">About Us</a></li>
                <li><a href="/terms&condition">Terms & Conditions</a></li>
                <li><a href="/contact">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="footer_contact_widget">
              <h4>Contact Us</h4>
              <ul class="list-unstyled">
                <li><a href="#">info@markproperties.pk</a></li>
                <li><a href="#">Plot Number B-354, Ground Floor</a></li>
                <li><a href="#">Block 7-8 Kathiawaar C.H.S Karachi.</a></li>
                <li><a href="tel:03167031554">+92 316-703-1554</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
            <div class="footer_social_widget">
              <h4>Follow us</h4>
              <ul class="mb30">
                <li class="list-inline-item"><a href="https://www.facebook.com/markpropertiespk"><i class="fa fa-facebook"></i></a></li>
                <li class="list-inline-item"><a href="https://www.instagram.com/markproperties.pk/?hl=en"><i class="fa fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="https://www.linkedin.com/company/markpropertiespk/?viewAsMember=true"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Footer Bottom Area -->
    <section class="footer_middle_area pt40 pb40">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-xl-12">
            <div class="copyright-widget text-center">
              <p>© {{ date('Y') }} Powered by <a class="text-white" href="#" target="_blank">ABAD RAHO</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>

    <!-- Wrapper End -->
    <script type="text/javascript" src="/assets/js/jquery-3.3.1.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/jquery-migrate-3.0.0.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/popper.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/jquery.mmenu.all.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/ace-responsive-menu.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/chart.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-select.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/isotop.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/snackbar.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/simplebar.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/parallax.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/scrollto.js?v=<?php echo $fileModified ?>"></script>
    {{-- <script type="text/javascript" src="/assets/js/jquery-scrolltofixed-min.js?v=<?php echo $fileModified ?>"></script> --}}
    <script type="text/javascript" src="/assets/js/jquery.counterup.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/progressbar.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/slider.js?v=<?php echo $fileModified ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript" src="/assets/js/timepicker.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js?v=<?php echo $fileModified ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC07CvVyZNLAxycxXkMq64WWif3fkS0LE4&callback=initMap" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/js/googlemaps1.js?v=<?php echo $fileModified ?>"></script>
    <script type="text/javascript" src="/assets/js/googlemaps2.js?v=<?php echo $fileModified ?>"></script>
    <!-- Custom script for all pages -->
    <script type="text/javascript" src="/assets/js/script.js?v=<?php echo $fileModified ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
   
    <!-- <script src="{{Config::get('app.url')}}/node_modules/select2/dist/js/select2.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


    <script src="/assets/js/custom.js?v=<?php echo $fileModified ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts for vuejs -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- helper.js created by shahbaz raza -->
    <script src="{{asset('js/helper.js') }}"></script>
    <!-- Phone no masking -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <!-- <script src="assets/js/pages/crud/forms/widgets/select2.js"></script> -->

    <!-- select2-input-js -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Vue.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.cjs.js" integrity="sha512-2e2aXOh4/FgkCAUyurkjk0Uw4m1gPcExFwb1Ai4Ajjg97se/FEWfrLG1na4mq8cgOzouc8qLIqsh0EGksPGdqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.cjs.min.js" integrity="sha512-2ftG6Hks6q07Ca+h8f4WCFWQAZca6bm1klWMAFGev51hiusd6FFaRT+kFWcj1G2KjFgZrns1CuwR8eA4OA0zLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.cjs.prod.min.js" integrity="sha512-9eYPYYqSLRRJlQVcobBpNgDNq7ui/VtXRO/abRajYVXlxLFnV6sBNGfro0+/Us2pqE8DLC2ymO5XT4LIyJZbvQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.esm-browser.min.js" integrity="sha512-3DR3ZmLs45hoKPclZCxDCHMvPiKdsCWCzsqq/8zpRGzFHpgK+6q/YAXEmXT8oTWXn/JziaIYOTydNQSL+XfGQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.esm-browser.prod.min.js" integrity="sha512-XtVBOVTPpRi0rqDbeHvaTV52h4JSXRhvh0XC1a8w2lQMaQnYAII3uSLTpOdTHjHzGRh3HFQu7Bg/nvL2Z4FAgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.esm-bundler.min.js" integrity="sha512-lDEaWZSNZ2qSKkqpfEiM8jXudwAPKNDqbwA6uvWe5ju5B0dcmij36neZ2EQjWq3PW6Zmwv5dySHqOnJ83OjXhw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.global.min.js" integrity="sha512-MXAAS+HimUKBNq7JH7RtQDLg9dM+dh4+nED1e29hydWOzkj1IOl+rf0SlCyXnlJS5Acb+wHJUAEGCfKyooCiAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.global.prod.min.js" integrity="sha512-yY2w8QVShzoLAachKPHtZRjXZeQOi9rQ2dYEYLf+lelt+TvZVOm/AlqVX6xFrjiy6wKDxgqvT1RL3BjxPdq/UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script>
      const GetActivityLogNames = <?php echo json_encode(Config::get("constants.CustomActivityLogs")) ?>;
      const ConfigConstants = <?php echo json_encode(Config::get("constants")) ?>;
      $(document).ready(function() {

        let menuclicked = 0;

        function openMenu() {

          if (menuclicked == 0) {
            $($("#menu")[0]).addClass("mm-menu_opened");
            $($("#menu")[0]).removeAttr("aria-hidden");
            $($("#mm-0")[0]).addClass("mm-0");
            $($('html')[0]).addClass("mm-wrapper_opened mm-wrapper_blocking mm-wrapper_background mm-wrapper_opening");
            menuclicked = 1;
            return;
          } else {
            $($("#menu")[0]).removeClass("mm-menu_opened");
            $($("#menu")[0]).attr("aria-hidden", true);
            $($("#mm-0")[0]).removeClass("mm-0");
            $($('html')[0]).removeClass("mm-wrapper_opened mm-wrapper_blocking mm-wrapper_background mm-wrapper_opening");
            menuclicked = 0;
            return;
          }
        }
        $("a[class='menu-tray']").on('click', openMenu);

        // alert("ready");
        ValiadteInputs();
        // $('[name="first_name"]').val("shahbaz");
        // $('[name="last_name"]').val("raza");
        // $('[name="phone_number"]').val("03242901739");
        // $('[name="user_email"]').val("shahbaz2@gmail.com");
        // $('[name="registerPassword"]').val("12345678");
        // $('[name="registerConfirmPassword"]').val("12345678");
        var auth = <?php echo json_encode(Auth::user()); ?>;
        $('.phoneInputMask').inputmask('0399-9999999');
        $('.phone_no_otp').inputmask('9999');
        $('#submitPhoneNoSection').show();
        $('#submitPhoneNoOtpSection').hide();

        ValiadteInputs();
        if (auth != null) {
          // if (auth.phone_number == null || auth.is_phone_no_verified == 0) {
          if (auth.phone_number == null) {
            // alert(JSON.stringify(auth != null && auth.phone_number == null && auth.is_phone_no_verified == 0));
            $('[name="submit_phone_no"]').val(auth.phone_number);
            $("#phoneNumberModal").modal("show");
            setInterval(function() {
              // if (auth.phone_number == null || auth.is_phone_no_verified == 0) {
              if (auth.phone_number == null) {
                // $('#submit_phone_no').val("12345678910");
                $("#phoneNumberModal").modal("show");
              }
            }, 20000);
          }
        }


      });

      function LoginToWebSite() {
        // using this page stop being refreshing
        //   e.preventDefault();
        ValiadteInputs();
        if (SubmitForm("frmWebLoginValidate")) {
          ShowLoader();
          var params = $("#frmWebLoginValidate").serialize();
          CallLaravelAction("/web/login", params, function(response) {
            if (response.status) {
              let SweetAlertParsm = {
                icon: "success",
                title: "Logged in successfully!",
                showConfirmButton: true,
                timer: 2000,
              };
              ShowSweetAlert(SweetAlertParsm);
              var redirectUrl = $("#afterSuccessRedirectUrl").val();
              window.location.replace(redirectUrl);
              // ShowSuccess(response.message, function() {
              //   // console.log("CallLaravelActionCallLaravelActionCallLaravelAction");
              //   location.reload()
              // });
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
              }
              let SweetAlertParsm = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 10000,
              };
              ShowSweetAlert(SweetAlertParsm);
              // ShowError(ErrorMsg);
              HideLoader();
            }
          });
        }
        // const phoneNumber = phoneInput.getNumber();
        // $('#phone').val(phoneNumber);
      }

      $('#submitRegisterForm').bind('click', function(e) {
        // using this page stop being refreshing
        //   e.preventDefault();
        ValiadteInputs();
        if (SubmitForm("frmValidate")) {
          ShowLoader();
          var params = {
            first_name: $('[name="first_name"]').val(),
            last_name: $('[name="last_name"]').val(),
            phone_number: $('[name="phone_number"]').val().replace(/\D/g, ""),
            email: $('[name="user_email"]').val(),
            password: $('[name="registerPassword"]').val(),
            password_confirmation: $('[name="registerConfirmPassword"]').val(),
          };
          CallLaravelAction("/register-web-user", params, function(response) {
            if (response.status) {
              let SweetAlertParsm = {
                icon: "success",
                title: "You're registered successfully!",
                showConfirmButton: true,
                timer: 2000,
              };
              ShowSweetAlert(SweetAlertParsm);
              location.reload();
              // ShowSuccess(response.message, function() {
              //   // console.log("CallLaravelActionCallLaravelActionCallLaravelAction");
              //   location.reload()
              // });
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.email !== "undefined") {
                  ErrorMsg = response.error.email + " " + "please choose other email.";
                }
                if (typeof response.error.phone_number !== "undefined") {
                  ErrorMsg = response.error.phone_number;
                }
                if (typeof response.error.password !== "undefined") {
                  ErrorMsg = response.error.password;
                }
                if (typeof response.error.password_confirmation !== "undefined") {
                  ErrorMsg = response.error.password_confirmation;
                }
              }
              let SweetAlertParsm = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 10000,
              };
              ShowSweetAlert(SweetAlertParsm);
              // ShowError(ErrorMsg);
              HideLoader();
            }
          });
        }
        // const phoneNumber = phoneInput.getNumber();
        // $('#phone').val(phoneNumber);
      });

      $('#submit_phone_no').keypress(function(e) {
        e.preventDefault();
        if (e.which == 13) {
          console.log($(this).parent(".form-group").addClass("error"));

          SubmitInputPhoneNoForm();
        }
      });

      function ResendPhoneNoOtp() {
        ShowLoader();
        var params = {};
        CallLaravelAction("/resend-phone-no-otp", params, function(response) {
          if (response.status) {
            let SweetAlertParams = {
              icon: "success",
              title: response.message,
              showConfirmButton: true,
              timer: 20000,
            };
            ShowSweetAlert(SweetAlertParams);
            // ShowSuccess(response.message);
            // $('[name="phone_no_otp"]').val(response.data.phone_no_otp);
            $('#showOtp').html("OTP : " + response.data.phone_no_otp);
            HideLoader();
          } else {
            let SweetAlertParams = {
              icon: "error",
              title: response.message,
              showConfirmButton: true,
              timer: 20000,
            };
            ShowSweetAlert(SweetAlertParams);
            // ShowError(response.message);
            HideLoader();
          }
        });
      }

      function SubmitPhoneNoOtpForm() {
        if (SubmitForm("submitPhoneNoOtpSection")) {
          ShowLoader();
          var params = {
            phone_no_otp: $('[name="phone_no_otp"]').val(),
          };
          if (params.phone_no_otp.length != 4) {
            let SweetAlertParams = {
              icon: "error",
              title: "Phone no OTP lenght is incorrect , please enter otp correctly.",
              showConfirmButton: true,
              timer: 20000,
            };
            ShowSweetAlert(SweetAlertParams);
            // ShowError("Phone no OTP lenght is incorrect , please enter otp correctly.");
            HideLoader();
            return;
          }
          CallLaravelAction("/verify-phone-no-otp", params, function(response) {
            if (response.status) {
              let SweetAlertParams = {
                icon: "success",
                title: response.message,
                showConfirmButton: true,
                timer: 20000,
              };
              ShowSweetAlert(SweetAlertParams);
              location.reload();
              // ShowSuccess(response.message, function() {
              //   location.reload()
              // });
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.phone_no_otp !== "undefined") {
                  ErrorMsg = response.error.phone_no_otp;
                }
              }
              // ShowError(ErrorMsg);
              let SweetAlertParams = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 20000,
              };
              ShowSweetAlert(SweetAlertParams);
              HideLoader();
            }
          });
        }
      }

      function SubmitInputPhoneNoForm() {
        if (SubmitForm("submitPhoneNoSection")) {
          ShowLoader();
          var params = {
            submit_phone_no: $('[name="submit_phone_no"]').val().replace(/\D/g, ""),
          };
          if (params.submit_phone_no.length != 11) {
            let SweetAlertParams = {
              icon: "error",
              title: "Phone no lenght is incorrect , please enter phone no correctly.",
              showConfirmButton: true,
              timer: 20000,
            };
            ShowSweetAlert(SweetAlertParams);
            // ShowError("Phone no lenght is incorrect , please enter phone no correctly.");
            HideLoader();
            return;
          }
          CallLaravelAction("/submit-web-user-phone-no", params, function(response) {
            if (response.status) {
              let SweetAlertParams = {
                icon: "success",
                title: response.message,
                showConfirmButton: true,
                timer: 1000,
              };
              ShowSweetAlert(SweetAlertParams);
              window.location.reload();
              // ShowSuccess(response.message);
              // $('#submitPhoneNoOtpSection').fadeIn(700);
              // $('#showOtp').html("OTP : " + response.data.phone_no_otp);
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.submit_phone_no !== "undefined") {
                  ErrorMsg = response.error.submit_phone_no;
                }
                if (typeof response.error.phone_number !== "undefined") {
                  ErrorMsg = response.error.phone_number;
                }
              }
              let SweetAlertParams = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 20000,
              };
              ShowSweetAlert(SweetAlertParams);
              // ShowError(ErrorMsg);
              HideLoader();
            }
          });
        }
      }

      function FacbookLogin() {
        // alert("FacbookLogin");
        let inputRedirectUrl = $("#afterSuccessRedirectUrl").val() ? $("#afterSuccessRedirectUrl").val() : window.location.href;
        let objUrl = new URL(inputRedirectUrl);
        let actionUrl = objUrl.pathname + objUrl.search;
        let afterSuccessRedirectUrl = btoa(actionUrl);
        // console.log("FacbookLogin() -> afterSuccessRedirectUrl -> ", afterSuccessRedirectUrl);
        // console.log("objUrl -> ", objUrl);
        // console.log("actionUrl -> ", actionUrl);
        // console.log("btoa(actionUrl) -> ", btoa(actionUrl));
        // $(this).attr("href", "/facebook-login?redirectto=" + afterSuccessRedirectUrl);
        $(".btnFacebookLogin").attr("href", "/facebook-login?redirectto=" + afterSuccessRedirectUrl);
      }

      function redirectGoogleLogin() {
        // alert("redirectGoogleLogin");
        let inputRedirectUrl = $("#afterSuccessRedirectUrl").val() ? $("#afterSuccessRedirectUrl").val() : window.location.href;
        let objUrl = new URL(inputRedirectUrl);
        let actionUrl = objUrl.pathname + objUrl.search;
        let afterSuccessRedirectUrl = btoa(actionUrl);
        // console.log("FacbookLogin() -> afterSuccessRedirectUrl -> ", afterSuccessRedirectUrl);
        // console.log("objUrl -> ", objUrl);
        // console.log("actionUrl -> ", actionUrl);
        // console.log("btoa(actionUrl) -> ", btoa(actionUrl));

        // const parts = ['protocol', 'hostname', 'pathname', 'port', 'hash'];
        // parts.forEach(key => console.log(key, objUrl[key]))

        $(".btnGoogleLogin").attr("href", "/google-login?redirectto=" + afterSuccessRedirectUrl);
        // $(this).attr("href", "/google-login?redirectto=" + afterSuccessRedirectUrl);
      }
    </script>


    @yield('footer')

  </div>

  <!--Start of Tawk.to Script
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = "https://embed.tawk.to/5b462c976d961556373da042/default";
      s1.charset = "UTF-8";
      s1.setAttribute("crossorigin", "*");
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
  End of Tawk.to Script-->


  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4KJWJK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->



</body>

</html>
