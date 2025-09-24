<!-- @extends('layouts.compare_master') -->
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
    <link rel="stylesheet" href="https://markproperties.pk/projects/wp-content/themes/markproperties2/css/housing-calculator.css">
    <link rel="stylesheet" href="/assets/css/compareProject.css">
@endsection

@section('content')
    <div id="hero-container" class="bgc-f7">
        <div id="slideshow">
            <div style="background-image: url(https://markproperties.pk/projects/wp-content/themes/markproperties2/search-results/uploads/2017/02/MKT-ext-Lot505_Graylands-dusk_FINAL-remove_tree_sRGB-Custom.jpg)"></div>
            <div style="background-image: url(https://markproperties.pk/projects/wp-content/themes/markproperties2/search-results/uploads/2017/02/slide2.jpg); display:none;"></div>
            <div style="background-image: url(https://markproperties.pk/projects/wp-content/themes/markproperties2/search-results/uploads/2017/02/slide3.jpg); display:none;"></div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="row m-top-new-details compare-detail">
                    <div class="col-md-12">
                        <div id="app">
                            <compare-project :baseurl="{{json_encode(url('/'))}}" :areas="{{json_encode($areas)}}"
                            :projecttypes="{{json_encode($projectTypes)}}"
                            :tags="{{json_encode($tags)}}"
                            :selectedprojectid="{{json_encode($selectedProjectId)}}"></compare-project>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="/assets/js/jquery-3.3.1.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/jquery-migrate-3.0.0.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/popper.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/jquery.mmenu.all.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/ace-responsive-menu.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/chart.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-select.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/isotop.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/snackbar.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/simplebar.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/parallax.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/scrollto.js?v={!! time() !!}"></script>
    {{-- <script type="text/javascript" src="/assets/js/jquery-scrolltofixed-min.js?v={!! time() !!}"></script> --}}
    <script type="text/javascript" src="/assets/js/jquery.counterup.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/progressbar.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/slider.js?v={!! time() !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script type="text/javascript" src="/assets/js/timepicker.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/wow.min.js?v={!! time() !!}"></script>
    <script type="text/javascript" src="/assets/js/script.js?v={!! time() !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/helper.js') }}"></script>
    <script src="/assets/js/custom.js?v={!! time() !!}"></script>
@endsection
