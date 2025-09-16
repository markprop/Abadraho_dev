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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/>

    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="/assets/css/responsive.css?v={!! time() !!}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/css/intlTelInput.css"/>

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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-98XHRQF9R1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-98XHRQF9R1');
    </script>
    <!-- End Global site tag (gtag.js) - Google Analytics -->

    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5HB5KRL');
    </script>
    <!-- End Google Tag Manager -->

@yield('header')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .select2-container--default .select2-search--inline .select2-search__field {
            position: absolute !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {

            padding: 0 20px 0px 20px !important;

        }
    </style>

    @yield('css')
</head>

<body class="maxw1600 m0a">
<div class="wrapper">

    <!-- Preloader -->
{{--    <div class="preloader"></div>--}}

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
                         src="https://markproperties.pk/karachi-underconstruction/img/mainlogo.webp" alt="Abad Raho">
                <!-- <img class="logo2 img-fluid"
                         src="/assets/images/mark-properties-logo.svg?v={!! time() !!}" alt="Abad Raho">
                    <img class="logo2 img-fluid" src="/assets/images/abadraho-logo.svg?v={!! time() !!}"
                         alt="Abad Raho"> -->
                </a>
                <!-- Responsive Menu Structure-->
                <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
                <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">

                    <li>
                        <a href="/" class="current"><span class="title">Home</span></a>
                    </li>
                    <li>
                        <a href="/about-us"><span class="title">About Us</span></a>
                    </li>
                    <li>
                        <a href="/projects/listings"><span class="title">Find Projects</span></a>
                    </li>
                    <li>
                        <a href="/compare" class="{{ (request()->segment(1) == 'compare') ? 'current' : '' }}"><span class="title">Compare</span></a>
                    </li>
                    <li>
                        <a href="/blogs"><span class="title">Blogs</span></a>
                    </li>
                    <li>
                        <a href="/contact-us"><span class="title">Contact Us</span></a>
                    </li>
                    @if (Auth::user())
                        <li class="user_setting">
                            <div class="dropdown">

                                <a class="btn dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}"
                                             onerror="this.src='/assets/images/user-icon.png'" width="40px"
                                             height="40px"><span class="dn-1199">&nbsp;{{ Auth::user()->first_name }}
                                            {{ Auth::user()->last_name }}</span>
                                    @else
                                        <img class="rounded-circle" src="/uploads/profile/{{ Auth::user()->image }}"
                                             onerror="this.src='/assets/images/user-icon.png'" width="50px"
                                             height="50px"><span class="dn-1199">&nbsp;{{ Auth::user()->first_name }}
                                            {{ Auth::user()->last_name }}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu">
                                    <div class="user_set_header row">
                                        <!-- Recent Changes -->
                                        @if (Auth::user()->avatar)
                                            <div class="col-md-12">
                                                <img class="rounded-circle" src="{{ Auth::user()->avatar }}"
                                                     onerror="this.src='/assets/images/user-icon.png'" width="50px"
                                                     height="50px">
                                                <span
                                                    class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><br>
                                                @if (Auth::user()->user_type_id == -10021)
                                                    <br><a href="/admin/dashboard" class="btn"
                                                           style="background-color: #EC1C24; font-weight:600; color:#fff; font-size:14px;">Admin
                                                        Dashboard</a><br>
                                                @endif
                                                <br><span><i
                                                        class="fa fa-envelope"></i>&nbsp;{{Auth::user()->email}}</span>
                                            </div>

                                        @else
                                            <div class="col-md-12">
                                                <img class="rounded-circle"
                                                     src="/uploads/profile/{{ Auth::user()->image }}"
                                                     onerror="this.src='/assets/images/user-icon.png'" width="50px"
                                                     height="50px">
                                                <span
                                                    class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><br>
                                                <br><i class="fa fa-envelope">&nbsp;&nbsp;{{Auth::user()->email}}</i>

                                                <br>

                                            </div>
                                        @endif


                                        <div class="col-md-12">
                                            @if (Auth::user()->is_phone_no_verified==1)
                                                <i class="fa fa-phone"></i><span style="color: green;">&nbsp;&nbsp;Verified</span>
                                            @elseif(Auth::user()->is_phone_no_verified==0)
                                                <i class="fa fa-phone"></i> <span style="color:#EC1C24;">&nbsp;&nbsp;Not Verified</span>
                                            @else
                                                <span style="color:#EC1C24;display:none;"></span>
                                            @endif
                                        </div>
                                        <!-- Recent Changes -->
                                    </div>
                                    @if (Auth::user()->avatar)
                                        <div class="user_setting_content">
                                            <!-- <a class="dropdown-item profile_popup active" href="/admin/dashboard"><i class="fa fa-lock"></i>Admin Dashboard</a> -->
                                            <a class="dropdown-item profile_popup active" href="/profilepage"><i
                                                    class="fa fa-user"></i>My Profile</a>
                                        <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> -->
                                            <a class="dropdown-item profile_popup" href="{{ route('web.logout') }}">
                                                <i class="fa fa-lock"></i>Log out
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    @else
                                        <div class="user_setting_content">
                                            <a class="dropdown-item profile_popup active" href="/profilepage"><i
                                                    class="fa fa-user"></i>My Profile</a>
                                        <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> -->
                                            <a class="dropdown-item profile_popup" href="{{ route('web.logout') }}">
                                                <i class="fa fa-lock"></i>Log out
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="list-inline-item add_listing"><a href="/login"><span></span><span
                                    class="dn-lg title flaticon-user"> Login/Register</span></a></li>
                        <!-- <li class="list-inline-item list_s">
                             <a href="#" class="btn flaticon-user" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <a href="javascript:void(0)" class="btn flaticon-user" onclick="OpenLoginRegisterModal('')">
                                <span class="dn-lg">Login/Register</span>
                            </a>
                        </li> -->
                    @endif
                </ul>
            </nav>
        </div>
    </header>

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
                                    <span class="dn-1199">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name }}</span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="user_set_header row">
                                        @if (Auth::user()->avatar)
                                            <div class="col-md-12">
                                                <img class="rounded-circle" src="{{ Auth::user()->avatar }}"
                                                     onerror="this.src='/assets/images/user-icon.png'" width="40px"
                                                     height="40px">
                                                <span
                                                    class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><br>
                                                <br><span><i
                                                        class="fa fa-envelope"></i>&nbsp;{{Auth::user()->email}}</span>
                                            </div>

                                        @else
                                            <div class="col-md-12">
                                                <img class="rounded-circle"
                                                     src="/uploads/profile/{{ Auth::user()->image }}"
                                                     onerror="this.src='/assets/images/user-icon.png'" width="40px"
                                                     height="40px">
                                                <span
                                                    class="profile_text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                                <br><i class="fa fa-envelope">&nbsp;&nbsp;{{Auth::user()->email}}</i>

                                                <br>

                                            </div>
                                        @endif

                                        <div class="col-md-12">
                                            @if (Auth::user()->is_phone_no_verified==1)
                                                <i class="fa fa-phone"></i><span style="color: green;">&nbsp;&nbsp;Verified</span>
                                            @elseif(Auth::user()->is_phone_no_verified==0)
                                                <i class="fa fa-phone"></i> <span style="color:#EC1C24;">&nbsp;&nbsp;Not Verified</span>
                                            @else
                                                <span style="color:#EC1C24;display:none;"></span>
                                            @endif
                                        </div>


                                    </div>
                                    <div class="user_setting_content">
                                        <a class="dropdown-item profile_popup" href="/profilepage"
                                           style="padding: 0px;"><i class="fa fa-user"></i>&nbsp;My Profile</a>
                                        <a class="dropdown-item profile_popup" href="{{ route('web.logout') }}"
                                           style="padding: 0px;">
                                            <i class="fa fa-lock"></i>&nbsp;Log out
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
                        <li class="list-inline-item list_s"><a data-toggle="modal"
                                                               data-target=".bd-example-modal-lg"><span
                                    class="flaticon-user"></span></a>
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
                    <a href="/contact-us"><span class="title">Contact Us</span></a>
                </li>
            </ul>
        </nav>
    </div>

@yield('content')

<!-- Our Footer -->
<x-footer />

    <a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
    <!-- Scripts for vuejs -->
    <script src="{{ asset('js/app.js') }}" defer></script>

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
        });
    </script>

    @include('projects.scripts.search_fields_with_select2_script')
    @include('projects.scripts.search_and_housing_calculator_script')
    @yield('footer')

    @yield('js')
</div>

</body>
</html>
