<?php
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
  <!-- css file -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css?v=<?php echo $fileModified ?>">
  <link rel="stylesheet" href="/assets/css/style.css?v=<?php echo $fileModified ?>">


  <!-- Responsive stylesheet -->
  <link rel="stylesheet" href="/assets/css/responsive.css?v=<?php echo $fileModified ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />


  <link rel="stylesheet" href="assets/css/common.css?v=<?php echo $fileModified ?>">
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

  <a href="https://api.whatsapp.com/send?phone=+923142384807&text=Thankyou%21%20for%20Contacting%20Mark%20Properties%20." class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
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
                <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                  @if (Auth::user()->avatar)
                  <img class="rounded-circle" src="{{ Auth::user()->avatar }}" alt="e1.png" width="30px">
                  @endif
                  <span class="dn-1199">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span>
                </a>
                <div class="dropdown-menu">
                  <div class="user_set_header">
                    @if (Auth::user()->avatar)
                    <img class="float-left" src="{{ Auth::user()->avatar }}" alt="e1.png" width="50px">
                    @endif
                    <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<br><span class="address">{{ Auth::user()->email }}</span></p>
                  </div>
                  <div class="user_setting_content">
                    <a class="dropdown-item active" href="/profilepage">My Profile</a>
                    <!-- <a class="dropdown-item" href="{{ route('web.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> -->
                    <a class="dropdown-item" href="{{ route('web.logout') }}">
                      Log out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </div>
              </div>
            </li>
            @else
            <li class="list-inline-item list_s">
              <a href="#" class="btn flaticon-user" data-toggle="modal" data-target=".bd-example-modal-lg">
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
    <div class="sign_up_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body container pb20">
            <div class="row">
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
                  <form id="loginForm">
                    @csrf
                    <div class="login_form">
                      <div class="heading">
                        <h4>Login</h4>
                      </div>
                      <div class="row mt25">
                        <div class="col-lg-12">
                          <a href="/facebook-login" class="btn btn-fb btn-block"><i class="fa fa-facebook float-left mt5"></i> Login
                            with Facebook</a>
                        </div>
                        <div class="col-lg-12">
                          <a href="/google-login" target="_blank" class="btn btn-googl btn-block"><i class="fa fa-google float-left mt5"></i> Login with
                            Google</a>
                        </div>
                      </div>
                      <hr>
                      <div class="input-group mb-2 mr-sm-2">
                        <input type="text" class="form-control" name="email" id="inlineFormInputGroupUsername2" placeholder="User Name Or Email">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-user"></i></div>
                        </div>
                        <label id="login-email" class="text-danger w-100"></label>
                      </div>
                      <div class="input-group form-group">
                        <input type="password" class="form-control mb0" name="password" id="exampleInputPassword1" placeholder="Password">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="flaticon-password"></i>
                          </div>
                        </div>
                        <label id="login-password" class="text-danger w-100"></label>
                      </div>

                      <button type="submit" class="btn btn-log btn-block btn-thm mt-2">Log
                        In
                      </button>
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
                        <a href="/facebook-login" class="btn btn-fb btn-block"><i class="fa fa-facebook float-left mt5"></i> Login
                          with Facebook</a>
                      </div>
                      <div class="col-lg-12">
                        <a href="/google-login" class="btn btn-googl btn-block"><i class="fa fa-google float-left mt5"></i> Login with
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
                        <input type="text" class="form-control" id="phone_number" name="phone_number" numtxt data-maxlength="11" required>
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
    @if (Auth::user() && Auth::user()->phone_number == null)
    <div class="sign_up_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="phoneNumberModal">
      <div class="modal-dialog modal-lg" role="document" style="top: 25%; max-width: 450px">
        <form id="form" onsubmit="process(event)">
          @csrf
          <div class="modal-content pt20 pb20">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body container">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="modal-title">Please Provide Phone Number</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input id="phone" type="tel" class="form-control h50 pretext-phone-number mt20" name="phone" style="width:100%" />
                    <div class="alert alart_style_four alert-dismissible fade show alert-info" role="alert" style="display: none">
                      Please check the information below
                      <button type="button" class="close ml-10" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" id="submitPhoneNumber" class="btn btn-log btn-block btn-thm">Submit
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    {{ Auth::user()->phone_number }}
    @endif

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
                  <img class="rounded-circle" src="{{ Auth::user()->avatar }}" alt="e1.png" width="30px">
                  @endif
                  <span class="dn-1199">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</span>
                </a>
                <div class="dropdown-menu">
                  <div class="user_set_header">
                    @if (Auth::user()->avatar)
                    <img class="float-left" src="{{ Auth::user()->avatar }}" alt="e1.png" width="50px">
                    @endif
                    <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<br><span class="address">{{ Auth::user()->email }}</span></p>
                  </div>
                  <div class="user_setting_content">
                    <a class="dropdown-item active" href="#">My Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Log out
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
            <li class="list-inline-item" onclick="openMenu()"><a href="javascript:void(0)" class="menu-tray" onclick="openMenu()"><span></span></a></li>
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
              <p>© {{ date('Y') }} Powered by <a class="text-white" href="https://markproperties.pk" target="_blank">Mark Properties</a>.</p>
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
    <script type="text/javascript" src="/assets/js/jquery-scrolltofixed-min.js?v=<?php echo $fileModified ?>"></script>
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

    <script src="/assets/js/custom.js?v=<?php echo $fileModified ?>"></script>
    <script src="/assets/js/abdullah.js?v=<?php echo $fileModified ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- helper.js created by shahbaz raza -->
    <script src="{{asset('js/helper.js') }}"></script>


    <script>
      $(document).ready(function() {
        // alert("ready");
        ValiadteInputs();
        $('[name="first_name"]').val("shahbaz");
        $('[name="last_name"]').val("raza");
        $('[name="phone_number"]').val("03242901739");
        $('[name="user_email"]').val("shahbaz2@gmail.com");
        $('[name="registerPassword"]').val("12345678");
        $('[name="registerConfirmPassword"]').val("12345678");
      });
      $('#submitRegisterForm').bind('click', function(e) {
        // using this page stop being refreshing
        //   e.preventDefault();
        ValiadteInputs();
        if (SubmitForm("frmValidate")) {
          ShowLoader();
          var params = {
            first_name: $('[name="first_name"]').val(),
            last_name: $('[name="last_name"]').val(),
            phone_number: $('[name="phone_number"]').val(),
            email: $('[name="user_email"]').val(),
            password: $('[name="registerPassword"]').val(),
            password_confirmation: $('[name="registerConfirmPassword"]').val(),
          };
          CallLaravelAction("/register-web-user", params, function(response) {
            if (response.status) {
              ShowSuccess(response.message, function() {
                // console.log("CallLaravelActionCallLaravelActionCallLaravelAction");
                location.reload()
              });
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.email !== "undefined") {
                  ErrorMsg = response.error.email;
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
              ShowError(ErrorMsg);
              HideLoader();
            }
          });
        }
        // const phoneNumber = phoneInput.getNumber();
        // $('#phone').val(phoneNumber);
      });
    </script>

    @yield('footer')

  </div>

  <!--Start of Tawk.to Script-->
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
  <!--End of Tawk.to Script-->


</body>

</html>