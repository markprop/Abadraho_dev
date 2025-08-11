<?php
$fileModified = date('hms');
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Abad Raho') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link href="/assets/images/fav-icon.svg?v=<?php echo $fileModified ?>" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
  <link href="/assets/images/fav-icon.svg?v=<?php echo $fileModified ?>" sizes="128x128" rel="shortcut icon" />
  <!-- custom style.css created by shahbaz raza -->
  <link href="{{  asset('css/style.css') }}" rel="stylesheet">
  <!-- animation CSS -->
  <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
  <!-- spinners CSS -->
  <link href="{{ asset('css/spinners.css')}}" rel="stylesheet">


  <script type="text/javascript" src="{{asset('/assets/js/jquery-3.3.1.js')}}"></script>
  <script type="text/javascript" src="{{asset('/assets/js/jquery-migrate-3.0.0.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/assets/js/popper.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/assets/js/bootstrap.min.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- helper.js created by shahbaz raza -->
  <script src="{{asset('js/helper.js') }}"></script>
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
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{-- {{ config('app.name', 'Abad Raho') }} --}}

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->full_name }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>

  </div>
</body>

</html>