<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="keywords" content="@yield('meta_keywords','some default keywords')">
    <meta name="description" content="@yield('meta_description','default description')">
    <meta name="title" content="@yield('meta_description','default description')">
    <meta name="CreativeLayers" content="ATFN">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- css file -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css?v={!! time() !!}">
    <link rel="stylesheet" href="/assets/css/style.css?v={!! time() !!}">

    <!-- Animate Text CDN Link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.1/typed.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="bower_components/Morphext/dist/morphext.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="/assets/css/responsive.css?v={!! time() !!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    
    <link rel="stylesheet" href="/assets/css/common.css?v={!! time() !!}">
    <!-- Title -->
    <title>@yield('title', 'Abad Raho')</title>
    <!-- Favicon -->
    <link href="/assets/images/fav-icon.svg?v={!! time() !!}" sizes="128x128" rel="shortcut icon"
          type="image/x-icon"/>
    <link href="/assets/images/fav-icon.svg?v={!! time() !!}" sizes="128x128" rel="shortcut icon"/>
    <!-- custom style.css created by shahbaz raza -->
    <link href="{{  asset('css/style.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">

    <!-- start select2-input-js libraries)-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
{{--    <link href="css/newSelect2.css" rel="stylesheet" type="text/css"/>--}}


  <!-- Meta Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s)
  {ifi5(f.fbq)return;n=f.fbq=function(){n.callMethod?
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

@yield('header')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')
</head>

<body class="maxw1600 m0a">
    <div class="loaderscreen">
        <div class="preloader"></div>
    </div>
<div class="wrapper">

    <!-- Preloader -->
{{-- <div class="preloader"></div> --}}

<!-- Main Header Nav -->
    <header class="header-nav menu_style_home_one style2 home3 navbar-scrolltofixed stricky main-menu">
        <div class="container-fluid p0">
            <!-- Ace Responsive Menu -->
            <nav>
                <!-- Menu Toggle btn-->
                <div class="menu-toggle">
                    <img class="nav_logo_img img-fluid" src="/assets/images/logo.png?v={!! time() !!}"
                         alt="Mark Properties">
                    <button type="button" id="menu-btn">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <a href="/" class="navbar_brand float-left dn-smd">
                <!-- <img class="logo1 markproperties img-fluid"
                         src="/assets/images/mark-properties-logo.svg?v={!! time() !!}"
                         alt="Mark Properties"> -->
                    <img class="logo1 abadraho img-fluid"
                         src="/assets/images/main-logo.png" alt="Abad Raho">
                <!-- <img class="logo2 img-fluid"
                         src="/assets/images/mark-properties-logo.svg?v={!! time() !!}" alt="Abad Raho">
                    <img class="logo2 img-fluid" src="/assets/images/abadraho-logo.svg?v={!! time() !!}"
                         alt="Abad Raho"> -->
                </a>
                <!-- Responsive Menu Structure-->
                <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
                <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
                    @include('partials.menu')

                    @if (Auth::user())
                        <li class="user_setting">
                            <div class="dropdown">

                                <a class="btn dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px">
                                    @else
                                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}" onerror="this.src='/assets/images/user-icon.png'" width="30px" height="30px">
                                    @endif
                                </a>
                                <div class="dropdown-menu">
                                    <div class="user_set_header row">
                                        <div class="col-md-12">
                                           <div class="d-flex py-2">
											<div class="avatar avatar-md avatar-indicators avatar-online">
											 @if (Auth::user()->avatar)
                                            <img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px">
                                    @else
                                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}" onerror="this.src='/assets/images/user-icon.png'" width="30px" height="30px">
                                    @endif
                                        </div>
                                        <div class="ml-3 lh-1">
                                            <h5 class="mb-0"><span
                                            class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span></h5>
                                            <p class="mb-0">{!! Auth::user()->email !!}</p>
                                        </div>
										</div>
                                        </div>
                                    </div>
                                    <div class="user_setting_content">
                                        <!-- Phone verified -->
                                        @if (Auth::user()->is_phone_no_verified === 1)
                                            <a class="dropdown-item profile_popup" href="javascript:void(0)">
                                               <span class="mr-1">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="new-icon bi bi-telephone" viewBox="0 0 16 16"> <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/> </svg>
                                             </span>Verified
                                            </a>
                                        @else
                                            <a class="dropdown-item profile_popup" href="javascript:void(0)">
                                                <span class="mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="new-icon bi bi-telephone" viewBox="0 0 16 16"> <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>Not Varified </svg>
                                            </span>Not Verified
                                            </a>
                                        @endif

                                        <a class="dropdown-item profile_popup" href="/profilepage">
                                            <span class="mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            </span>Profile
                        				</a>
                        				 <!-- <a class="dropdown-item profile_popup" href="@@webRoot/pages/student-subscriptions.html">
                                                          <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></span>Subscription
                        							</a> -->
                        					
                        							<!-- <a class="dropdown-item profile_popup" href="#!">
                                                            <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Settings
                        				</a> -->
                                                
                                        	<a class="dropdown-item " href="{{ route('web.logout') }}">
                                                            <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg></span>Log Out
                        							</a>
                        							 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          class="d-none">
                                                        @csrf
                                                    </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="list-inline-item add_listing">
                            <a href="/login" class="dn-lg title"> <span class="mr-1">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                          </span>Login</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <div class="sign_up_modal modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"
         id="phoneNumberModal">
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
                                    <label class="modal-title">Please verify your phone number.<span
                                            class="text-red">*</span></label>
                                    <input id="submit_phone_no" type="text" class="form-control phoneInputMask"
                                           name="submit_phone_no" style="width:100%" required/>
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
                                    Verify Now
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
                                            <a href="javascript:void(0)" class="btn btn-thm"
                                               onclick="ResendPhoneNoOtp()">Resend Otp</a>
                                        </div>
                                    </label>
                                    <input id="phone_no_otp" type="text" class="form-control phone_no_otp"
                                           name="phone_no_otp" style="width:100%" numtxt data-maxlength="4" required/>
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

<!-- Interest Form Modal
<div class="modal fade" id="interestModal" tabindex="-1" role="dialog" aria-labelledby="interestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interestModalLabel">Let's find your ideal property</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex">
                <div class="sidebar p-3" style="width: 200px; background: #f8f9fa;">
                    <img src="assets/images/about/banner.jpg" alt="Adnan" class="rounded-circle mb-2" style="width: 50px; height: 50px;">
                    <p>Adnan<br><small>Sales Director</small></p>
                </div>
                <div class="main-content p-4 flex-grow-1">
                    <form action="/submit-interest" method="POST" id="interest-form" class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label>What is your primary goal for this property?</label>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="/assets/images/background/03-min.jpg" alt="Rental" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="goal-rental" name="goal" value="rental" class="custom-control-input" required>
                                                <label class="custom-control-label" for="goal-rental">Seeking long-term rental income</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="/assets/images/background/03-min.jpg" alt="Capital" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="goal-capital" name="goal" value="capital" class="custom-control-input" required>
                                                <label class="custom-control-label" for="goal-capital">Capital appreciation and resale potential</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="/assets/images/background/03-min.jpg" alt="Vacation" class="card-img-top" style="height: 150px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="goal-vacation" name="goal" value="vacation" class="custom-control-input" required>
                                                <label class="custom-control-label" for="goal-vacation">Personal use as a vacation home or residence</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Next <i class="fas fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- Interest Form Modal -->
<div class="modal fade" id="interestModal" tabindex="-1" role="dialog" aria-labelledby="interestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interestModalLabel">Let's find your ideal property</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex">
                <div class="sidebar p-3" style="width: 200px; background: #f8f9fa;">
                    <img src="assets/images/about/banner.jpg" alt="Adnan" class="rounded-circle mb-2" style="width: 50px; height: 50px;">
                    <p>Adnan<br><small>Sales Director</small></p>
                </div>
                <div class="main-content p-4 flex-grow-1">
                    <form action="/submit-interest" method="POST" id="interest-form" class="mt-4">
                        @csrf
                        <input type="hidden" id="step" name="step" value="1">
                        <div id="step-1" class="step">
                            <div class="form-group">
                                <label>What is your primary goal for this property?</label>
                                <div class="row" style="max-height: 300px; overflow-y: auto;">
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="rental">
                                            <img src="uploads/blogs/cover_1626529108.png" alt="Rental" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="goal-rental" name="goal" value="rental" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="goal-rental">Seeking long-term rental income</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="capital">
                                            <img src="uploads/blogs/cover_1684745403.webp" alt="Capital" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="goal-capital" name="goal" value="capital" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="goal-capital">Capital appreciation and resale potential</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="vacation">
                                            <img src="assets/images/testamonials.jpg" alt="Vacation" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="goal-vacation" name="goal" value="vacation" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="goal-vacation">Personal use as a vacation home or residence</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <button type="button" class="btn btn-primary btn-block" id="next-step-1">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                        <div id="step-2" class="step" style="display: none;">
                            <div class="form-group">
                                <label>Choose your preferred property type</label>
                                <div class="row" style="max-height: 300px; overflow-y: auto;">
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="apartment">
                                            <img src="assets/images/test/shameer-residency-featured-img.jpg" alt="Apartment" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="type-apartment" name="property_type" value="apartment" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="type-apartment">Apartment</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="townhouse">
                                            <img src="assets/images/test/shameer-residency-3dviews9.jpg" alt="Townhouse" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="type-townhouse" name="property_type" value="townhouse" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="type-townhouse">Townhouse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="villa">
                                            <img src="assets/images/test/shameer-residency-3dviews8.jpg" alt="Villa" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="type-villa" name="property_type" value="villa" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="type-villa">Villa</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="mansion">
                                            <img src="assets/images/background/mainbg.jpg" alt="Mansion" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="type-mansion" name="property_type" value="mansion" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="type-mansion">Mansion</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">Apartment, villa or a townhouse, it's a matter of taste. Select one option you are interested in.</p>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" id="progress-bar" role="progressbar" style="width: 19%;" aria-valuenow="19" aria-valuemin="0" aria-valuemax="100">19%</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" id="prev-step-2">Back</button>
                                <button type="button" class="btn btn-primary" id="next-step-2">Next <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div id="step-3" class="step" style="display: none;">
                            <div class="form-group">
                                <label>Choose the number of bedrooms you are looking for</label>
                                <div class="row" style="max-height: 300px; overflow-y: auto;">
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="1">
                                            <img src="assets/images/bedrooms/bed-1.jpg" alt="1 Bedroom" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="bed-1" name="bedrooms" value="1" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="bed-1">1 Bedroom</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="2-4">
                                            <img src="assets/images/bedrooms/bedroom2-4.jpeg" alt="2-4 Bedrooms" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="bed-2-4" name="bedrooms" value="2-4" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="bed-2-4">2-4 Bedrooms</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="5+">
                                            <img src="assets/images/bedrooms/bedroom-5.jpeg" alt="5+ Bedrooms" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="bed-5+" name="bedrooms" value="5+" class="custom-control-input" required>
                                                    <label class="custom-control-label" for="bed-5+">5+ Bedrooms</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">Select the number of bedrooms that suits your needs.</p>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" id="progress-bar" role="progressbar" style="width: 38%;" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100">38%</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" id="prev-step-3">Back</button>
                                <button type="button" class="btn btn-primary" id="next-step-3">Next <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div id="step-4" class="step" style="display: none;">
                            <div class="form-group">
                                <label>Select your budget range (in millions)</label>
                                <div class="row" style="max-height: 300px; overflow-y: auto;">
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="1.5-5M">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="budget-1.5-5" name="budget[]" value="1.5-5M" class="custom-control-input">
                                                    <label class="custom-control-label" for="budget-1.5-5">1.5-5M</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="2-4M">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="budget-2-4" name="budget[]" value="2-4M" class="custom-control-input">
                                                    <label class="custom-control-label" for="budget-2-4">2-4M</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="4-6M">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="budget-4-6" name="budget[]" value="4-6M" class="custom-control-input">
                                                    <label class="custom-control-label" for="budget-4-6">4-6M</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="8+M">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="budget-8+" name="budget[]" value="8+M" class="custom-control-input">
                                                    <label class="custom-control-label" for="budget-8+">8+M</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">Select all budget ranges you are comfortable with (multiple selections allowed).</p>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" id="progress-bar" role="progressbar" style="width: 57%;" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100">57%</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" id="prev-step-4">Back</button>
                                <button type="button" class="btn btn-primary" id="next-step-4">Next <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div id="step-5" class="step" style="display: none;">
                            <div class="form-group">
                                <label>Choose the lifestyle that best suits you</label>
                                <div class="row" style="max-height: 300px; overflow-y: auto;">
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="urban">
                                            <img src="assets/images/lifestyle/Urban.jpeg" alt="Urban" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="lifestyle-urban" name="lifestyle[]" value="urban" class="custom-control-input">
                                                    <label class="custom-control-label" for="lifestyle-urban">Urban</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="suburban">
                                            <img src="assets/images/lifestyle/Green_community_gardens.jpeg" alt="Suburban" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="lifestyle-suburban" name="lifestyle[]" value="suburban" class="custom-control-input">
                                                    <label class="custom-control-label" for="lifestyle-suburban">Suburban</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="rural">
                                            <img src="assets/images/lifestyle/Luxurious.jpeg" alt="Rural" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="lifestyle-rural" name="lifestyle[]" value="rural" class="custom-control-input">
                                                    <label class="custom-control-label" for="lifestyle-rural">Rural</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="card selectable" data-value="coastal">
                                            <img src="assets/images/lifestyle/island.jpeg" alt="Coastal" class="card-img-top" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            <div class="card-body text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="lifestyle-coastal" name="lifestyle[]" value="coastal" class="custom-control-input">
                                                    <label class="custom-control-label" for="lifestyle-coastal">Coastal</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">Select all lifestyles that suit you (multiple selections allowed).</p>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" id="progress-bar" role="progressbar" style="width: 76%;" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100">76%</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" id="prev-step-5">Back</button>
                                <button type="button" class="btn btn-primary" id="next-step-5">Next <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div id="step-6" class="step" style="display: none;">
                            <div class="form-group">
                                <label>Review Your Preferences</label>
                                <div class="row" style="max-height: 300px; overflow-y: auto;">
                                    <div class="col-md-12 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <p><strong>Goal:</strong> <span id="review-goal"></span></p>
                                                <p><strong>Property Type:</strong> <span id="review-property-type"></span></p>
                                                <p><strong>Bedrooms:</strong> <span id="review-bedrooms"></span></p>
                                                <p><strong>Budget:</strong> <span id="review-budget"></span></p>
                                                <p><strong>Lifestyle:</strong> <span id="review-lifestyle"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">Please review your selections. Make changes if needed by going back.</p>
                            </div>
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" id="progress-bar" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">95%</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" id="prev-step-6">Back</button>
                                <button type="submit" class="btn btn-primary" id="submit-final">Finish <i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Main Header Nav For Mobile -->
    <div id="page" class="stylehome1 h0">
        <div class="mobile-menu">
            <div class="header stylehome1">
                <div class="main_logo_home2 text-center">
                    <a href="/">
                        <img class="nav_logo_img abadraho img-fluid"
                             src="/assets/images/abadraho-logo.svg?v={!! time() !!}" alt="Abad Raho">
                    </a>
                </div>
                <ul class="menu_bar_home2">
                    @if (Auth::user())
                        <li class="list-inline-item">
                            <div class="dropdown">
                                <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}"
                                             onerror="this.src='/assets/images/user-icon.png'" width="40px"
                                             height="40px">
                                    @else
                                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}"
                                             onerror="this.src='/assets/images/user-icon.png'" width="40px"
                                             height="40px">
                                    @endif
                                </a>
                                 <div class="dropdown-menu">
                                    <div class="user_set_header row">
                                        <div class="col-md-12">
                                           <div class="d-flex py-2">
											<div class="avatar avatar-md avatar-indicators avatar-online">
											 @if (Auth::user()->avatar)
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}"
                                             onerror="this.src='/assets/images/user-icon.png'" width="40px"
                                             height="40px">
                                    @else
                                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}"
                                             onerror="this.src='/assets/images/user-icon.png'" width="30px"
                                             height="30px">
                                    @endif
											</div>
											<div class="ml-3 lh-1">
												<h5 class="mb-0"><span
                                                class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span></h5>
												<p class="mb-0">{!! Auth::user()->email !!}</p>
											</div>
				
										</div>

                                        </div>
                                    </div>
                                   
                                    <div class="user_setting_content">

                                        <!-- Phone verified -->
                                        @if (Auth::user()->is_phone_no_verified === 1)
                                            <a class="dropdown-item profile_popup" href="javascript:void(0)">
                                               <span class="mr-1">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="new-icon bi bi-telephone" viewBox="0 0 16 16"> <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/> </svg>
                                             </span>Verified
                                            </a>
                                        @else
                                            <a class="dropdown-item profile_popup" href="javascript:void(0)">
                                                <span class="mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="new-icon bi bi-telephone" viewBox="0 0 16 16"> <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>Not Varified </svg>
                                            </span>Not Verified
                                            </a>
                                        @endif

                                       <a class="dropdown-item profile_popup" href="/profilepage">
                                                          <span class="mr-1">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                          </span>Profile
                        				</a>
                        				 <!-- <a class="dropdown-item profile_popup" href="@@webRoot/pages/student-subscriptions.html">
                                                          <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg></span>Subscription
                        							</a> -->
                        					
                        							<!-- <a class="dropdown-item profile_popup" href="#!">
                                                            <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Settings
                        				</a> -->
                                                
                                        	<a class="dropdown-item " href="{{ route('web.logout') }}">
                                                            <span class="mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="new-icon feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg></span>Log Out
                        							</a>
                        							 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          class="d-none">
                                                        @csrf
                                                    </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="list-inline-item list_s"><a href="/login"><span
                                    class="flaticon-user"></span></a>
                        </li>
                    @endif
                    <li class="list-inline-item"><a href="javascript:void(0)" class="menu-tray"><span></span></a></li>
                </ul>
            </div>
        </div><!-- /.mobile-menu -->
        <nav id="menu" class="stylehome1">
            <ul>
                @include('partials.menu')
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
                            <li><a href="/about-us">About Us</a></li>
                            <li><a href="/terms-conditions">Terms & Conditions</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_contact_widget">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                            <li><a href="mailto://info@markproperties.pk">info@markproperties.pk</a></li>
                            <li>Plot Number B-354, Ground Floor</li>
                            <li>Block 7-8 Kathiawaar C.H.S Karachi.</li>
                            <li><a href="tel:+923167031554">+92 316-703-1554</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer_social_widget">
                        <h4>Follow us</h4>
                        <ul class="mb30">
                            <li class="list-inline-item"><a href="https://www.facebook.com/markpropertiespk"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="https://www.instagram.com/markproperties.pk"><i
                                        class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a
                                    href="https://www.linkedin.com/company/markpropertiespk"><i
                                        class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt40">
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="copyright-widget text-center">
                        <p>
                            Copyright © {{ date('Y') }} | Powered by <a class="footer_company_name"
                                                                        href="https://markproperties.pk"
                                                                        target="_blank">Mark Properties</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>

    <!-- Wrapper End -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="/assets/js/jquery-3.3.1.js?v={!! time() !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/1.1.1/typed.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-migrate-3.0.0.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/popper.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/jquery.mmenu.all.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/ace-responsive-menu.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/chart.min.js?v={!! time() !!}"></script>
    {{--    <script type="text/javascript" src="/assets/js/bootstrap-select.min.js?v={!! time() !!}"></script>--}}
    <script type="text/javascript" src="/assets/js/isotop.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/snackbar.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/simplebar.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/parallax.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/scrollto.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/jquery-scrolltofixed-min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/jquery.counterup.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/progressbar.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/slider.js?v={!! time() !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript" src="/assets/js/timepicker.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js?v={!! time() !!}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC07CvVyZNLAxycxXkMq64WWif3fkS0LE4&callback=initMap"
            type="text/javascript"></script>
    <script type="text/javascript" src="/assets/js/googlemaps1.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/googlemaps2.js?v={!! time() !!}"></script>
    <!-- Custom script for all pages -->
    <script type="text/javascript" src="/assets/js/script.js?v={!! time() !!}"></script>
    <script src="https://markproperties.pk/kings-grand/js/formv/formValidation.min.js"></script>
    <script src="https://markproperties.pk/kings-grand/js/formv/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/intlTelInput.min.js"></script>
<!-- <script src="{{Config::get('app.url')}}/node_modules/select2/dist/js/select2.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>--}}


    <script src="/assets/js/custom.js?v={!! time() !!}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts for vuejs -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- helper.js created by shahbaz raza -->
    <script src="{{asset('js/helper.js') }}"></script>
    <!-- Phone no masking -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <!-- <script src="assets/js/pages/crud/forms/widgets/select2.js"></script> -->
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- select2-input-js -->
    {{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}

    <script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
    </script>
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
        const GetActivityLogNames = <?php

            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Facades\Config;

            echo json_encode(Config::get("constants.CustomActivityLogs")) ?>;
        const ConfigConstants = <?php echo json_encode(Config::get("constants")) ?>;
        $(document).ready(function () {

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
                    setInterval(function () {
                        // if (auth.phone_number == null || auth.is_phone_no_verified == 0) {
                        if (auth.phone_number == null) {
                            // $('#submit_phone_no').val("12345678910");
                            $("#phoneNumberModal").modal("show");
                        }
                    }, 20000);
                }
            }

            $('#page').show();
        });

        $('#submit_phone_no').keypress(function (e) {
            e.preventDefault();
            if (e.which == 13) {
                console.log($(this).parent(".form-group").addClass("error"));

                SubmitInputPhoneNoForm();
            }
        });

        function ResendPhoneNoOtp() {
            ShowLoader();
            var params = {};
            CallLaravelAction("/resend-phone-no-otp", params, function (response) {
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
                CallLaravelAction("/verify-phone-no-otp", params, function (response) {
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
                CallLaravelAction("/submit-web-user-phone-no", params, function (response) {
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

        // video showcase slider
        $(document).ready(function() {
    let currentVideoIndex = 0;
    const videoItems = $('.video-showcase-item');
    let videoPlayers = [];

    function loadVideo(index) {
        videoItems.removeClass('active playing');
        const $currentItem = $(videoItems[index]);
        $currentItem.addClass('active');
        videoPlayers = videoItems.map(function() {
            return $(this).find('.video-player')[0];
        }).get();

        videoPlayers.forEach((player, i) => {
            if (i !== index) {
                player.pause();
                $(videoItems[i]).find('.progress-bar').css('width', '0');
                $(videoItems[i]).removeClass('playing');
            } else {
                player.muted = true;
                $(videoItems[i]).find('.mute-btn').addClass('muted');
                player.load();
            }
        });

        $currentItem.find('.play-btn').off('click').on('click', function(e) {
            e.preventDefault();
            if (videoPlayers[index].paused) {
                videoPlayers[index].play().catch(error => {
                    console.log("Play prevented, likely due to browser policy:", error);
                });
                $currentItem.addClass('playing');
                $currentItem.find('.video-overlay').hide();
                videoItems.eq(currentVideoIndex).find('.play-pause-btn').text('Pause');
            }
        });

        videoPlayers[index].addEventListener('timeupdate', function() {
            const progress = (this.currentTime / this.duration) * 100 || 0;
            $currentItem.find('.progress-bar').css('width', progress + '%');
        });

        $currentItem.find('.video-progress').off('click').on('click', function(e) {
            const rect = e.currentTarget.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const width = rect.right - rect.left;
            const newTime = (clickX / width) * videoPlayers[index].duration;
            videoPlayers[index].currentTime = newTime;
        });

        videoPlayers[index].addEventListener('ended', function() {
            $currentItem.removeClass('playing');
            $currentItem.find('.video-overlay').show();
            videoItems.eq(currentVideoIndex).find('.play-pause-btn').text('Play');
        });

        videoPlayers[index].addEventListener('pause', function() {
            if (!this.ended) {
                $currentItem.removeClass('playing');
                $currentItem.find('.video-overlay').show();
                videoItems.eq(currentVideoIndex).find('.play-pause-btn').text('Play');
            }
        });

        $currentItem.find('.mute-btn').off('click').on('click', function() {
            const isMuted = videoPlayers[index].muted;
            videoPlayers[index].muted = !isMuted;
            $(this).toggleClass('muted', !isMuted);
        });

        $currentItem.find('.maximize-btn').off('click').on('click', function() {
            openPopup(index);
        });
    }

    function openPopup(index) {
        const $video = $(videoPlayers[index]).clone();
        const $popup = $('<div class="video-popup"><div class="video-popup-controls"><button class="mute-btn muted"><span class="fa fa-volume-up"></span><span class="fa fa-volume-mute"></span></button><button class="close-btn"><span class="fa fa-times"></span></button></div></div>');
        $popup.find('.video-popup-controls').prepend($video);

        $('body').append($popup);
        $popup.css('display', 'block');

        const popupVideo = $video[0];
        popupVideo.muted = videoPlayers[index].muted;
        if (!popupVideo.paused) popupVideo.play().catch(error => console.log("Popup play prevented:", error));

        $popup.draggable({
            handle: ".video-popup-controls",
            containment: "window"
        });
        $popup.resizable({
            aspectRatio: 16 / 9,
            minWidth: 400,
            minHeight: 225,
            maxWidth: 1200,
            maxHeight: 675
        });

        $popup.find('.mute-btn').on('click', function() {
            const isMuted = popupVideo.muted;
            popupVideo.muted = !isMuted;
            $(this).toggleClass('muted', !isMuted);
        });

        $popup.find('.close-btn').on('click', function() {
            popupVideo.pause();
            $popup.remove();
        });
    }

    loadVideo(currentVideoIndex);

    $('.play-pause-btn').on('click', function() {
        if (videoPlayers[currentVideoIndex].paused) {
            videoPlayers[currentVideoIndex].play();
            $(this).text('Pause');
            videoItems.eq(currentVideoIndex).addClass('playing');
            videoItems.eq(currentVideoIndex).find('.video-overlay').hide();
        } else {
            videoPlayers[currentVideoIndex].pause();
            $(this).text('Play');
            videoItems.eq(currentVideoIndex).removeClass('playing');
            videoItems.eq(currentVideoIndex).find('.video-overlay').show();
        }
    });

    $('.next-btn').on('click', function() {
        currentVideoIndex = (currentVideoIndex + 1) % videoItems.length;
        loadVideo(currentVideoIndex);
    });

    $(window).on('scroll', function() {
        const sectionTop = $('#video-section').offset().top;
        const sectionBottom = sectionTop + $('#video-section').outerHeight();
        const scrollTop = $(window).scrollTop() + $(window).height() / 2;

        if (scrollTop < sectionTop || scrollTop > sectionBottom) {
            videoPlayers.forEach(player => {
                player.pause();
                $(player).closest('.video-showcase-item').removeClass('playing');
                $(player).closest('.video-showcase-item').find('.video-overlay').show();
            });
            $('.play-pause-btn').text('Play');
        } else if (!videoPlayers[currentVideoIndex].paused) {
            videoPlayers[currentVideoIndex].play().catch(error => {
                console.log("Autoplay prevented on scroll back:", error);
            });
            videoItems.eq(currentVideoIndex).addClass('playing');
            videoItems.eq(currentVideoIndex).find('.video-overlay').hide();
            $('.play-pause-btn').text('Pause');
        }
    });
});

// // Interest Form Modal Logic
// $(document).ready(function() {
//     let auth = <?php echo json_encode(Auth::user()); ?>;
//     let hasFilledForm = '{{ session()->get('has_filled_form') }}' === 'true';

//     if (!auth && !hasFilledForm) {
//         setTimeout(() => {
//             $('#interestModal').modal('show');
//         }, 5000);
//     }

//     $('#interest-form').on('submit', function(e) {
//         e.preventDefault();
//         $.ajax({
//             url: '/submit-interest',
//             type: 'POST',
//             data: $(this).serialize(),
//             success: function(response) {
//                 if (response.success) {
//                     $('#interestModal').modal('hide');
//                     window.location.href = '/login';
//                 }
//             },
//             error: function(xhr) {
//                 console.log(xhr.responseText);
//                 alert('Error submitting form. Please try again.');
//             }
//         });
//     });
// });

// Interest Form Modal Logic
$(document).ready(function() {
    let auth = <?php echo json_encode(Auth::user()); ?>;
    let hasFilledForm = '{{ session()->get('has_filled_form') }}' === 'true';

    if (!auth && !hasFilledForm) {
        setTimeout(() => {
            $('#interestModal').modal('show');
        }, 5000);
    }

    $('.selectable').on('click', function() {
        const value = $(this).data('value');
        const input = $(this).find('input');
        if (input.attr('type') === 'radio') {
            input.prop('checked', true).trigger('change');
        } else if (input.attr('type') === 'checkbox') {
            input.prop('checked', !input.prop('checked')).trigger('change');
        }
    });

    $('#next-step-1').on('click', function() {
        if ($('input[name="goal"]:checked').length > 0) {
            $('#step-1').hide();
            $('#step-2').show();
            $('#progress-bar').css('width', '19%').text('19%');
            $('#step').val('2');
        }
    });

    $('#next-step-2').on('click', function() {
        if ($('input[name="property_type"]:checked').length > 0) {
            $('#step-2').hide();
            $('#step-3').show();
            $('#progress-bar').css('width', '38%').text('38%');
            $('#step').val('3');
        }
    });

    $('#next-step-3').on('click', function() {
        if ($('input[name="bedrooms"]:checked').length > 0) {
            $('#step-3').hide();
            $('#step-4').show();
            $('#progress-bar').css('width', '57%').text('57%');
            $('#step').val('4');
        }
    });

    $('#next-step-4').on('click', function() {
        if ($('input[name="budget[]"]:checked').length > 0) {
            $('#step-4').hide();
            $('#step-5').show();
            $('#progress-bar').css('width', '76%').text('76%');
            $('#step').val('5');
        }
    });

    $('#next-step-5').on('click', function() {
        if ($('input[name="lifestyle[]"]:checked').length > 0) {
            $('#step-5').hide();
            $('#step-6').show();
            $('#progress-bar').css('width', '95%').text('95%');
            $('#step').val('6');
        }
    });

    $('#prev-step-2').on('click', function() {
        $('#step-2').hide();
        $('#step-1').show();
        $('#progress-bar').css('width', '0%').text('0%');
        $('#step').val('1');
    });

    $('#prev-step-3').on('click', function() {
        $('#step-3').hide();
        $('#step-2').show();
        $('#progress-bar').css('width', '19%').text('19%');
        $('#step').val('2');
    });

    $('#prev-step-4').on('click', function() {
        $('#step-4').hide();
        $('#step-3').show();
        $('#progress-bar').css('width', '38%').text('38%');
        $('#step').val('3');
    });

    $('#prev-step-5').on('click', function() {
        $('#step-5').hide();
        $('#step-4').show();
        $('#progress-bar').css('width', '57%').text('57%');
        $('#step').val('4');
    });

    $('#prev-step-6').on('click', function() {
        $('#step-6').hide();
        $('#step-5').show();
        $('#progress-bar').css('width', '76%').text('76%');
        $('#step').val('5');
    });

    // Populate review fields
    $('#next-step-5').on('click', function() {
        $('#review-goal').text($('input[name="goal"]:checked').next().text().trim());
        $('#review-property-type').text($('input[name="property_type"]:checked').next().text().trim());
        $('#review-bedrooms').text($('input[name="bedrooms"]:checked').next().text().trim());
        $('#review-budget').text($('input[name="budget[]"]:checked').map(function() { return $(this).next().text().trim(); }).get().join(', '));
        $('#review-lifestyle').text($('input[name="lifestyle[]"]:checked').map(function() { return $(this).next().text().trim(); }).get().join(', '));
    });

    $('#interest-form').on('submit', function(e) {
        e.preventDefault();
        if ($('#step').val() === '6') {
            $.ajax({
                url: '/submit-interest',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#interestModal').modal('hide');
                        window.location.href = '/login';
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error submitting form. Please try again.');
                }
            });
        }
    });
});
        
    </script>

    @yield('footer')
    @yield('js')
</div>
</body>
</html>
