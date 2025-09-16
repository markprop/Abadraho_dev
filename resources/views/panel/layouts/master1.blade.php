<?php
$fileModified = date('hms');
?>

<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
  <base href="../../../">
  <meta charset="utf-8" />
  <title>ABAD RAHO</title>
  <meta name="description" content="Child datatable from local data" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="ISO-8859-1">

  <link rel="canonical" href="https://keenthemes.com/metronic" />
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <!--end::Fonts-->

  <!--begin::Global Theme Styles(used by all pages)-->
  <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  <!--end::Global Theme Styles-->
  <!--begin::Layout Themes(used by all pages)-->
  <link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
  <!--end::Layout Themes-->


  <!-- custom style.css created by shahbaz raza -->
  <link href="{{  asset('css/style.css') }}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
  <!-- spinners CSS -->
  <link href="{{ asset('css/spinners.css')}}" rel="stylesheet">

  <!-- fav Icon -->
  <link href="/assets/images/fav-icon.svg?v=<?php echo $fileModified ?>" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
  <link href="/assets/images/fav-icon.svg?v=<?php echo $fileModified ?>" sizes="128x128" rel="shortcut icon" />

  <!-- for fa icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

  @yield('header')
  <!--end::Global Theme Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

  <!-- Preloader -->
  <div class="preloader" style="display: none;z-index: 100000;position: fixed;">
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

  <!--begin::Main-->
  <!--begin::Header Mobile-->
  <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="{{ route('admin.dashboard') }}" class="brand-logo">
      <img src="\assets\images\abadraho_admin_logo.png">
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
      <!--begin::Aside Mobile Toggle-->
      <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
        <span></span>
      </button>
      <!--end::Aside Mobile Toggle-->
      <!--begin::Header Menu Mobile Toggle-->

      <!--end::Header Menu Mobile Toggle-->
      <!--begin::Topbar Mobile Toggle-->
      <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <a> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
              </g>
            </svg></a>
          <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
          <!--end::Svg Icon-->
          <!-- </span>
      </button> -->
          <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
  </div>
  <!--end::Header Mobile-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
      <!--begin::Aside-->
      <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
        <!--begin::Brand-->
        <div class="brand flex-column-auto" id="kt_brand">
          <!--begin::Logo-->
          <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <img src="\assets\images\abadraho_admin_logo.png">
          </a>
          <!--end::Logo-->
          <!--begin::Toggle-->
          <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
              <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                  <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                </g>
              </svg>
              <!--end::Svg Icon-->
            </span>
          </button>
          <!--end::Toolbar-->
        </div>
        <!--end::Brand-->
        <!--begin::Aside Menu-->
        @if (Auth::user()->user_type_id==-10025)
        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
          <!--begin::Menu Container-->
          <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="/admin/dashboard" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Layers.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Dashboard</span>
                  <i class="menu-arrow"></i>
                </a>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Project Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/project" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Projects</span>
                      </a>
                  </ul>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/pending/project" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Pending Projects</span>
                      </a>
                  </ul>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/active/project" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Active Projects</span>
                      </a>
                  </ul>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/reviews" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Project Reviews</span>
                      </a>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Inquiry Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/listing" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Property Inquiries</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/payment-schedules" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Payments Plan Inquiries</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg-->
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.68 122.88" width="24px" height="24px">
                      <path fill="#fff" d="M100.87,60.09c-5.65-8.65-9.59-14.76-13.78-21.23-2.2-3.41-4.48-6.93-7.44-11.48l-1.3.85a2.7,2.7,0,0,1-4-3.12,2.64,2.64,0,0,1,1.08-1.4l1.31-.86c-3-4.68-6.77-10.39-11.59-17.77a.68.68,0,0,0-.41-.28.71.71,0,0,0-.49.09L62,6.32a10.12,10.12,0,0,1,.45,5.75,10.24,10.24,0,0,1-4.36,6.44l-.07.06A10.31,10.31,0,0,1,45.34,17.4L43,18.86a10.3,10.3,0,0,1,.48,5.56A10.13,10.13,0,0,1,39.09,31l-.37.24a10.09,10.09,0,0,1-7.58,1.28,10.39,10.39,0,0,1-5-2.71l-2.93,1.91a.65.65,0,0,0-.24.38.68.68,0,0,0,0,.42l.1.16c4.7,7.19,8.39,12.93,11.47,17.72l.08,0,4.52-3a2.7,2.7,0,0,1,4,3.12,2.74,2.74,0,0,1-1.08,1.4l-4.52,2.95-.12.07c1.13,1.77,2.22,3.46,3.35,5.19Zm-65.68,0-3.85-6c-3.1-4.83-6.85-10.67-12.25-18.94h0a5.43,5.43,0,0,1,1.55-7.5c1.26-.84,3.49-2.47,4.74-3.1a2.4,2.4,0,0,1,3.31.73l0,.06a5.61,5.61,0,0,0,3.46,2.46,5.36,5.36,0,0,0,4-.67l.25-.16a5.37,5.37,0,0,0,2.31-3.46,5.6,5.6,0,0,0-.86-4.15l-.09-.15a2.4,2.4,0,0,1,.79-3.29l5.95-3.65a2.39,2.39,0,0,1,3.32.69,5.45,5.45,0,0,0,7.57,1.59l.06,0a5.5,5.5,0,0,0,2.32-3.43,5.34,5.34,0,0,0-.76-4l-.15-.22a2.4,2.4,0,0,1,.7-3.32l4-2.62a5.45,5.45,0,0,1,7.52,1.58C80,19,85.73,28,91.11,36.26c4,6.26,7.83,12.11,15.49,23.83h.63a5.46,5.46,0,0,1,5.45,5.44v5.61a2.41,2.41,0,0,1-2.4,2.4H110a5.3,5.3,0,0,0-3.77,1.57,5.47,5.47,0,0,0-1.61,3.83v.14a5.32,5.32,0,0,0,1.62,3.84l.11.11a5.63,5.63,0,0,0,3.84,1.45h.1a2.4,2.4,0,0,1,2.4,2.38h0v10a2.4,2.4,0,0,1-2.4,2.4h-.1a5.7,5.7,0,0,0-3.94,1.55,5.37,5.37,0,0,0-1.64,3.84v.15a5.49,5.49,0,0,0,1.61,3.83,5.32,5.32,0,0,0,3.77,1.58h.28a2.39,2.39,0,0,1,2.41,2.37v0h0v4.78a5.46,5.46,0,0,1-5.45,5.44H5.44A5.46,5.46,0,0,1,0,117.44v-4.78a2.4,2.4,0,0,1,2.4-2.4h.3a5.3,5.3,0,0,0,3.77-1.57,5.55,5.55,0,0,0,1.61-3.83v-.07h0A5.46,5.46,0,0,0,2.6,99.32a2.4,2.4,0,0,1-2.4-2.4v-.16L0,86.92a2.39,2.39,0,0,1,2.34-2.44H2.5a5.67,5.67,0,0,0,4-1.54h0a5.36,5.36,0,0,0,1.62-3.84v-.16a5.37,5.37,0,0,0-1.62-3.83L6.35,75A5.68,5.68,0,0,0,2.5,73.54l-.27,0A2.38,2.38,0,0,1,0,71.15H0V65.53a5.46,5.46,0,0,1,5.44-5.44Zm26.09,45.22a3.74,3.74,0,0,1-1.49,1.46,6.91,6.91,0,0,1-3.15.52c-1.48,0-2.21-.39-2.21-1.17a1.47,1.47,0,0,1,.09-.36l16-28.23a6.19,6.19,0,0,1,.75-1.11,3.53,3.53,0,0,1,1.24-.77,5.87,5.87,0,0,1,2.25-.38c1.87,0,2.8.41,2.8,1.22a.87.87,0,0,1-.09.4L61.28,105.31ZM54,92.45a14.65,14.65,0,0,1-3.46-.36,7.93,7.93,0,0,1-2.72-1.26c-1.72-1.23-2.57-3.62-2.57-7.17s.9-5.77,2.7-7a11,11,0,0,1,6-1.48,11.34,11.34,0,0,1,6.08,1.48c1.81,1.18,2.71,3.49,2.71,7s-.86,6-2.57,7.17A10.75,10.75,0,0,1,54,92.45Zm0-4.37a.72.72,0,0,0,.58-.27c.39-.42.59-1.49.59-3.2A22.78,22.78,0,0,0,55,81.07a2.65,2.65,0,0,0-.41-1.2.78.78,0,0,0-.58-.22c-.79,0-1.18,1.4-1.18,4.21s.39,4.22,1.18,4.22ZM77.7,107.74a14.5,14.5,0,0,1-3.45-.36,7.89,7.89,0,0,1-2.73-1.26C69.8,104.89,69,102.5,69,99s.9-5.76,2.7-6.9a10.76,10.76,0,0,1,6-1.54,11.14,11.14,0,0,1,6.09,1.54q2.7,1.71,2.7,6.9c0,3.58-.85,6-2.57,7.17a10.75,10.75,0,0,1-6.22,1.62Zm0-4.37a.78.78,0,0,0,.58-.23c.4-.45.59-1.53.59-3.24a22.78,22.78,0,0,0-.18-3.54,2.65,2.65,0,0,0-.41-1.2.78.78,0,0,0-.58-.23c-.78,0-1.17,1.41-1.17,4.22s.39,4.22,1.17,4.22Zm29.53-38.48h-78v3.6a1.63,1.63,0,0,1,0,.31A2.1,2.1,0,0,1,25,68.49v-3.6H5.44a.64.64,0,0,0-.45.19.68.68,0,0,0-.19.45V69a10.38,10.38,0,0,1,4.83,2.53l.15.13a10.14,10.14,0,0,1,3.08,7.25v.24a10.14,10.14,0,0,1-3.08,7.24A10.36,10.36,0,0,1,4.84,89L5,94.79a10.26,10.26,0,0,1,7.92,10s0,.1,0,.12a10.28,10.28,0,0,1-8.06,9.93v2.6a.65.65,0,0,0,.64.64H25V114.7a1.45,1.45,0,0,1,0-.3,2.1,2.1,0,0,1,4.18.3v3.38h78a.67.67,0,0,0,.65-.64v-2.61a10.13,10.13,0,0,1-5.07-2.77,10.33,10.33,0,0,1-3-7.15v-.24a10.18,10.18,0,0,1,3.09-7.23h0a10.38,10.38,0,0,1,5-2.66V89a10.27,10.27,0,0,1-4.83-2.52l-.15-.13a10.19,10.19,0,0,1-3.09-7.24v-.25a10.37,10.37,0,0,1,3-7.15A10.14,10.14,0,0,1,107.88,69V65.53a.65.65,0,0,0-.2-.45.6.6,0,0,0-.45-.19ZM25,81.09a2.1,2.1,0,0,0,4.18.31,1.55,1.55,0,0,0,0-.31v-4.2a2.1,2.1,0,0,0-4.18-.3,1.45,1.45,0,0,0,0,.3v4.2ZM25,93.7a2.1,2.1,0,0,0,4.18.3,1.45,1.45,0,0,0,0-.3V89.5a2.1,2.1,0,0,0-4.18-.31,1.55,1.55,0,0,0,0,.31v4.2Zm0,12.6a2.1,2.1,0,0,0,4.18.31,1.63,1.63,0,0,0,0-.31v-4.2a2.1,2.1,0,0,0-4.18-.31,1.63,1.63,0,0,0,0,.31v4.2ZM55.75,43a2.76,2.76,0,0,0,1.08-1.39,2.7,2.7,0,0,0-4-3.13l-4.52,3a2.7,2.7,0,1,0,3,4.52l4.52-3Zm13.56-8.87a2.62,2.62,0,0,0,1.08-1.39,2.7,2.7,0,0,0-4-3.13l-4.53,3A2.76,2.76,0,0,0,60.75,34a2.7,2.7,0,0,0,4,3.13l4.52-3Z"/></svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Vouchers</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/voucher" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Voucher Listing</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="/admin/downloaded-voucher" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Downloaded Voucher List</span>
                        </a>
                    </li>
                  </ul>
                </div>
              </li>
              {{-- <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                            <a href="javascript:;" class="menu-link menu-toggle">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span>
                                </i>
                                <span class="menu-text">My Teams</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu" style="display: none; overflow: hidden;"
                                kt-hidden-height="120">
                                <i class="menu-arrow"></i>
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="/admin/teams" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">View All Teams</span>
                                        </a>
                                    </li>
                                    <li class="menu-item" aria-haspopup="true">
                                        <a href="/admin/team/create" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Create new Team</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="/admin/joined-teams" class="menu-link">
                                <i class="menu-bullet menu-bullet-line">
                                    <span></span>
                                </i>
                                <span class="menu-text">Joined Teams</span>
                            </a>
                        </li> --}}
            </ul>
            <!--end::Menu Nav-->
          </div>
          <!--end::Menu Container-->
        </div>

        @else
        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
          <!--begin::Menu Container-->
          <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="/admin/dashboard" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Layers.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Dashboard</span>
                  {{-- <i class="menu-arrow"></i> --}}
                </a>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Project Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/project" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Projects</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/pending/project" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Pending Projects</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/active/project" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Active Projects</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/reviews" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Project Reviews</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/area" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Areas</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/project_type" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Project Types</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/room_type" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Room Types</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/amenities" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Amenities</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/utilities" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Utilities</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">User Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/manage_users" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">User Listing</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/agents" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Agent Listing</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/search-history" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">User Search History</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/housing-calc-search-history" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Housing Calculator Search</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Library.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Builder Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/builder" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Builders</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Inquiry Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/listing" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Property Inquiries</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/payment-schedules" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Payments Plan Inquiries</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/contact/" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Contact Form Inquiries</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Shopping/Box2.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000"></path>
                        <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Blogs Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/blog" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Blogs</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/blog_category" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Blog Category</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Tags Management</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/tag" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Tags</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"></path>
                        <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"></path>
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Activity</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/activity-log" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Logs</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                  <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg-->
                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.68 122.88" width="24px" height="24px">
                      <path fill="#fff" d="M100.87,60.09c-5.65-8.65-9.59-14.76-13.78-21.23-2.2-3.41-4.48-6.93-7.44-11.48l-1.3.85a2.7,2.7,0,0,1-4-3.12,2.64,2.64,0,0,1,1.08-1.4l1.31-.86c-3-4.68-6.77-10.39-11.59-17.77a.68.68,0,0,0-.41-.28.71.71,0,0,0-.49.09L62,6.32a10.12,10.12,0,0,1,.45,5.75,10.24,10.24,0,0,1-4.36,6.44l-.07.06A10.31,10.31,0,0,1,45.34,17.4L43,18.86a10.3,10.3,0,0,1,.48,5.56A10.13,10.13,0,0,1,39.09,31l-.37.24a10.09,10.09,0,0,1-7.58,1.28,10.39,10.39,0,0,1-5-2.71l-2.93,1.91a.65.65,0,0,0-.24.38.68.68,0,0,0,0,.42l.1.16c4.7,7.19,8.39,12.93,11.47,17.72l.08,0,4.52-3a2.7,2.7,0,0,1,4,3.12,2.74,2.74,0,0,1-1.08,1.4l-4.52,2.95-.12.07c1.13,1.77,2.22,3.46,3.35,5.19Zm-65.68,0-3.85-6c-3.1-4.83-6.85-10.67-12.25-18.94h0a5.43,5.43,0,0,1,1.55-7.5c1.26-.84,3.49-2.47,4.74-3.1a2.4,2.4,0,0,1,3.31.73l0,.06a5.61,5.61,0,0,0,3.46,2.46,5.36,5.36,0,0,0,4-.67l.25-.16a5.37,5.37,0,0,0,2.31-3.46,5.6,5.6,0,0,0-.86-4.15l-.09-.15a2.4,2.4,0,0,1,.79-3.29l5.95-3.65a2.39,2.39,0,0,1,3.32.69,5.45,5.45,0,0,0,7.57,1.59l.06,0a5.5,5.5,0,0,0,2.32-3.43,5.34,5.34,0,0,0-.76-4l-.15-.22a2.4,2.4,0,0,1,.7-3.32l4-2.62a5.45,5.45,0,0,1,7.52,1.58C80,19,85.73,28,91.11,36.26c4,6.26,7.83,12.11,15.49,23.83h.63a5.46,5.46,0,0,1,5.45,5.44v5.61a2.41,2.41,0,0,1-2.4,2.4H110a5.3,5.3,0,0,0-3.77,1.57,5.47,5.47,0,0,0-1.61,3.83v.14a5.32,5.32,0,0,0,1.62,3.84l.11.11a5.63,5.63,0,0,0,3.84,1.45h.1a2.4,2.4,0,0,1,2.4,2.38h0v10a2.4,2.4,0,0,1-2.4,2.4h-.1a5.7,5.7,0,0,0-3.94,1.55,5.37,5.37,0,0,0-1.64,3.84v.15a5.49,5.49,0,0,0,1.61,3.83,5.32,5.32,0,0,0,3.77,1.58h.28a2.39,2.39,0,0,1,2.41,2.37v0h0v4.78a5.46,5.46,0,0,1-5.45,5.44H5.44A5.46,5.46,0,0,1,0,117.44v-4.78a2.4,2.4,0,0,1,2.4-2.4h.3a5.3,5.3,0,0,0,3.77-1.57,5.55,5.55,0,0,0,1.61-3.83v-.07h0A5.46,5.46,0,0,0,2.6,99.32a2.4,2.4,0,0,1-2.4-2.4v-.16L0,86.92a2.39,2.39,0,0,1,2.34-2.44H2.5a5.67,5.67,0,0,0,4-1.54h0a5.36,5.36,0,0,0,1.62-3.84v-.16a5.37,5.37,0,0,0-1.62-3.83L6.35,75A5.68,5.68,0,0,0,2.5,73.54l-.27,0A2.38,2.38,0,0,1,0,71.15H0V65.53a5.46,5.46,0,0,1,5.44-5.44Zm26.09,45.22a3.74,3.74,0,0,1-1.49,1.46,6.91,6.91,0,0,1-3.15.52c-1.48,0-2.21-.39-2.21-1.17a1.47,1.47,0,0,1,.09-.36l16-28.23a6.19,6.19,0,0,1,.75-1.11,3.53,3.53,0,0,1,1.24-.77,5.87,5.87,0,0,1,2.25-.38c1.87,0,2.8.41,2.8,1.22a.87.87,0,0,1-.09.4L61.28,105.31ZM54,92.45a14.65,14.65,0,0,1-3.46-.36,7.93,7.93,0,0,1-2.72-1.26c-1.72-1.23-2.57-3.62-2.57-7.17s.9-5.77,2.7-7a11,11,0,0,1,6-1.48,11.34,11.34,0,0,1,6.08,1.48c1.81,1.18,2.71,3.49,2.71,7s-.86,6-2.57,7.17A10.75,10.75,0,0,1,54,92.45Zm0-4.37a.72.72,0,0,0,.58-.27c.39-.42.59-1.49.59-3.2A22.78,22.78,0,0,0,55,81.07a2.65,2.65,0,0,0-.41-1.2.78.78,0,0,0-.58-.22c-.79,0-1.18,1.4-1.18,4.21s.39,4.22,1.18,4.22ZM77.7,107.74a14.5,14.5,0,0,1-3.45-.36,7.89,7.89,0,0,1-2.73-1.26C69.8,104.89,69,102.5,69,99s.9-5.76,2.7-6.9a10.76,10.76,0,0,1,6-1.54,11.14,11.14,0,0,1,6.09,1.54q2.7,1.71,2.7,6.9c0,3.58-.85,6-2.57,7.17a10.75,10.75,0,0,1-6.22,1.62Zm0-4.37a.78.78,0,0,0,.58-.23c.4-.45.59-1.53.59-3.24a22.78,22.78,0,0,0-.18-3.54,2.65,2.65,0,0,0-.41-1.2.78.78,0,0,0-.58-.23c-.78,0-1.17,1.41-1.17,4.22s.39,4.22,1.17,4.22Zm29.53-38.48h-78v3.6a1.63,1.63,0,0,1,0,.31A2.1,2.1,0,0,1,25,68.49v-3.6H5.44a.64.64,0,0,0-.45.19.68.68,0,0,0-.19.45V69a10.38,10.38,0,0,1,4.83,2.53l.15.13a10.14,10.14,0,0,1,3.08,7.25v.24a10.14,10.14,0,0,1-3.08,7.24A10.36,10.36,0,0,1,4.84,89L5,94.79a10.26,10.26,0,0,1,7.92,10s0,.1,0,.12a10.28,10.28,0,0,1-8.06,9.93v2.6a.65.65,0,0,0,.64.64H25V114.7a1.45,1.45,0,0,1,0-.3,2.1,2.1,0,0,1,4.18.3v3.38h78a.67.67,0,0,0,.65-.64v-2.61a10.13,10.13,0,0,1-5.07-2.77,10.33,10.33,0,0,1-3-7.15v-.24a10.18,10.18,0,0,1,3.09-7.23h0a10.38,10.38,0,0,1,5-2.66V89a10.27,10.27,0,0,1-4.83-2.52l-.15-.13a10.19,10.19,0,0,1-3.09-7.24v-.25a10.37,10.37,0,0,1,3-7.15A10.14,10.14,0,0,1,107.88,69V65.53a.65.65,0,0,0-.2-.45.6.6,0,0,0-.45-.19ZM25,81.09a2.1,2.1,0,0,0,4.18.31,1.55,1.55,0,0,0,0-.31v-4.2a2.1,2.1,0,0,0-4.18-.3,1.45,1.45,0,0,0,0,.3v4.2ZM25,93.7a2.1,2.1,0,0,0,4.18.3,1.45,1.45,0,0,0,0-.3V89.5a2.1,2.1,0,0,0-4.18-.31,1.55,1.55,0,0,0,0,.31v4.2Zm0,12.6a2.1,2.1,0,0,0,4.18.31,1.63,1.63,0,0,0,0-.31v-4.2a2.1,2.1,0,0,0-4.18-.31,1.63,1.63,0,0,0,0,.31v4.2ZM55.75,43a2.76,2.76,0,0,0,1.08-1.39,2.7,2.7,0,0,0-4-3.13l-4.52,3a2.7,2.7,0,1,0,3,4.52l4.52-3Zm13.56-8.87a2.62,2.62,0,0,0,1.08-1.39,2.7,2.7,0,0,0-4-3.13l-4.53,3A2.76,2.76,0,0,0,60.75,34a2.7,2.7,0,0,0,4,3.13l4.52-3Z"/></svg>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="menu-text">Vouchers</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu" style="display: none; overflow: hidden;" kt-hidden-height="120">
                  <i class="menu-arrow"></i>
                  <ul class="menu-subnav">
                    <li class="menu-item" aria-haspopup="true">
                      <a href="/admin/voucher" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                          <span></span>
                        </i>
                        <span class="menu-text">Voucher Listing</span>
                      </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="/admin/downloaded-voucher" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">Downloaded Voucher List</span>
                        </a>
                    </li>
                  </ul>
                </div>
              </li>

            {{--  <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <i class="menu-bullet menu-bullet-line">
                            <span></span>
                        </i>
                        <span class="menu-text">My Teams</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" style="display: none; overflow: hidden;"
                        kt-hidden-height="120">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/teams" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">View All Teams</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="/admin/team/create" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">Create new Team</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="/admin/joined-teams" class="menu-link">
                        <i class="menu-bullet menu-bullet-line">
                            <span></span>
                        </i>
                        <span class="menu-text">Joined Teams</span>
                    </a>
                </li> --}}
            </ul>
            <!--end::Menu Nav-->
          </div>
          <!--end::Menu Container-->
        </div>
        @endif
        <!--end::Aside Menu-->
      </div>
      <!--end::Aside-->
      <!--begin::Wrapper-->
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <!--begin::Header-->
        <div id="kt_header" class="header header-fixed">
          <!--begin::Container-->
          <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
              <!--begin::Header Menu-->
              <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                </ul>
                <!--end::Header Nav-->
              </div>
              <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
            <!--begin::Topbar-->

            <div class="topbar">
              <!--begin::User-->
              <div class="topbar-item">
                <div class="dropdown">
                  <button class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2 dropdown-toggle" id="menu1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="text-dark-50 font-weight-bolder font-size-base d-md-inline mr-1" style="font-size:15px !important;">Hi,</span>
                    <span class="text-dark-50 font-weight-bolder font-size-base  d-md-inline mr-3" style="font-size:15px !important;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span> <span class="">
                      <span class="symbol-label font-size-h5 font-weight-bold"><img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px"></span>
                    </span>
                    <span class="caret"></span></button>
                  <ul style="padding: 10px; width:100% !important;" class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <!-- <li style="margin-top: 5%; margin-bottom:5%; font-size:15px;"><a class="dropdown-item profile_popup " href="#">Home</a></li> -->
                    <li style="margin-top: 5%; margin-bottom:5%; font-size:15px;"><a class="dropdown-item profile_popup " href="/admin/admin-profile">Edit Profile</a></li>
                    <li style="margin-top: 5%; margin-bottom:5%; font-size:15px;"><a class="dropdown-item profile_popup" href="/admin/admin-change-password">Change Password</a></li>
                    <li style="margin-top: 5%; margin-bottom:5%;"><a href="{{ route('admin.logout') }}" class="btn btn-lg btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a></li>
                  </ul>
                </div>
                <!-- <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                  <span class="text-muted font-weight-bold font-size-base d-md-inline mr-1" style="font-size:15px !important;">Hi,</span>
                  <span class="text-dark-50 font-weight-bolder font-size-base  d-md-inline mr-3" style="font-size:15px !important;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span> <span class="">
                      <span class="symbol-label font-size-h5 font-weight-bold"><img class="rounded-circle" src="{{ Auth::user()->avatar }}" onerror="this.src='/assets/images/user-icon.png'" width="40px" height="40px"></span>
                    </span>
                </div> -->
              </div>
              <!--end::User-->
            </div>
            <!--end::Topbar-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        @yield('content')
        <!--end::Content-->
        <!--begin::Footer-->
        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
          <!--begin::Container-->
          <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted font-weight-bold mr-2">© All Right Reserved 2022</span>
              <a href="#" target="_blank" class="text-dark-75">Abad Raho</a>
            </div>
            <!--end::Copyright-->
            <!--begin::Nav-->
            <!--end::Nav-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::Footer-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Main-->
  <!-- begin::User Panel-->
  <!-- <div id="kt_quick_user" class="offcanvas offcanvas-right p-10"> -->
  <!--begin::Header-->

  <!-- </div> -->
  <!-- end::User Panel-->
  <!--begin::Quick Cart-->

  <!--begin::Demo Panel-->
  <div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
      <h4 class="font-weight-bold m-0">Select A Demo</h4>
      <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
        <i class="ki ki-close icon-xs text-muted"></i>
      </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content">
      <!--begin::Wrapper-->
      <div class="offcanvas-wrapper mb-5 scroll-pull">
        <h5 class="font-weight-bold mb-4 text-center">Demo 1</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo offcanvas-demo-active">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo1.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo1/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo1/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 2</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo2.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo2/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo2/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 3</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo3.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo3/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo3/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 4</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo4.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo4/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo4/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 5</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo5.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo5/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo5/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 6</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo6.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo6/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo6/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 7</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo7.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo7/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo7/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 8</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo8.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo8/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo8/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 9</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo9.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo9/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo9/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 10</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo10.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo10/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo10/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 11</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo11.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo11/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo11/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 12</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo12.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo12/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo12/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 13</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo13.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="../../../../../demo13/dist" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">Default</a>
            <a href="https://preview.keenthemes.com/metronic/demo13/rtl/index.html" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow" target="_blank">RTL Version</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 14</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo14.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 15</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo15.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 16</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo16.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 17</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo17.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 18</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo18.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 19</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo19.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 20</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo20.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 21</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo21.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 22</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo22.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 23</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo23.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 24</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo24.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 25</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo25.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 26</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo26.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 27</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo27.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 28</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo28.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 29</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo29.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
        <h5 class="font-weight-bold mb-4 text-center">Demo 30</h5>
        <div class="overlay rounded-lg mb-8 offcanvas-demo">
          <div class="overlay-wrapper rounded-lg">
            <img src="assets/media/demos/demo30.png" alt="" class="w-100" />
          </div>
          <div class="overlay-layer">
            <a href="#" class="btn btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center min-w-75px shadow disabled opacity-90">Coming
              soon</a>
          </div>
        </div>
      </div>
      <!--end::Wrapper-->
      <!--begin::Purchase-->
      <div class="offcanvas-footer">
        <a href="https://1.envato.market/EA4JP" target="_blank" class="btn btn-block btn-danger btn-shadow font-weight-bolder text-uppercase">Buy Metronic Now!</a>
      </div>
      <!--end::Purchase-->
    </div>
    <!--end::Content-->
  </div>
  <!--end::Demo Panel-->

  <!--end::Global Config-->
  <script src="assets/js/jquery-3.3.1.js"></script>

  <script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
  </script>
  <!--begin::Global Config(global config for global JS scripts)-->
  <script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#3699FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#E4E6EF",
            "dark": "#181C32"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1F0FF",
            "secondary": "#EBEDF3",
            "success": "#C9F7F5",
            "info": "#EEE5FF",
            "warning": "#FFF4DE",
            "danger": "#FFE2E5",
            "light": "#F3F6F9",
            "dark": "#D6D6E0"
          },
          "inverse": {
            "white": "#ffffff",
            "primary": "#ffffff",
            "secondary": "#3F4254",
            "success": "#ffffff",
            "info": "#ffffff",
            "warning": "#ffffff",
            "danger": "#ffffff",
            "light": "#464E5F",
            "dark": "#ffffff"
          }
        },
        "gray": {
          "gray-100": "#F3F6F9",
          "gray-200": "#EBEDF3",
          "gray-300": "#E4E6EF",
          "gray-400": "#D1D3E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#7E8299",
          "gray-700": "#5E6278",
          "gray-800": "#3F4254",
          "gray-900": "#181C32"
        }
      },
      "font-family": "Poppins"
    };

    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      // console.log("KTAppSettings -> ", KTAppSettings);
    });
  </script>

  <!--end::Global Config-->

  <!-- jquery cdn -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--begin::Global Theme Bundle(used by all pages)-->

  <!--begin::Global Theme Bundle(used by all pages)-->
  <script src="assets/plugins/global/plugins.bundle.js"></script>
  <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
  <script src="assets/js/scripts.bundle.js"></script>
  <!--end::Global Theme Bundle-->

  <!-- Sweet Alert -->
  <!-- in this link design problem -->
  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- helper.js created by shahbaz raza -->
  <script src="{{asset('js/helper.js') }}"></script>
  <script src="//unpkg.com/autonumeric"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- app.js Scripts -->
  <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
  <!-- "defer" is mandatory for vue element id="app" -->

  @yield('footer')
</body>
<!--end::Body-->

</html>