@extends('layouts.master')

@section('meta_keywords', '')

@section('meta_description')

@section('meta_title', '')

@section('content')

<!-- Home Design -->

    <input type="hidden" value="" id="btn-link-project-detail">

    <section class="home-one home1-overlay home1_bgi1">

        <div class="container">

            <div class="row posr d-block">

                <div class="col-lg-12">

                    <div class="home_content">

                        <div class="home-text text-center">

                            <h2 class="fz48"><span class="text2"></span> <span id="project-red">Made Easy!</span></h2>

                            <p class="fz22 color-white">Ready For Possession, Under Construction & Pre Launch

                                Projects </p>

                            <br>

                            <br>

                            <br>

                        </div>

                        <div class="home_adv_srch_opt">

                            @include('projects.partials.search', ['home' => true])

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>







    <!-- End to End Assistance Section -->



    <section id="feature-property" class="whychose_us feature-property bgc-f7">

        <!-- <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <a href="#feature-property">

                        <div class="mouse_scroll">

                            <div class="icon">

                                <h4>Scroll Down</h4>

                                <p>to discover more</p>

                            </div>

                            <div class="thumb">

                                <img src="/assets/images/resource/mouse.png" alt="mouse.png">

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div> -->



    

        <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>



        <div class="modal fade" id="myModal" role="dialog">

            <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Alert!</h4>

                </div>

                <div class="modal-body">

                <p>Plesae Sign in before seeing the properties details.</p>

                </div>

                <div class="modal-footer">

                <a href="http://qa-staging.com/login" class="btn btn-success">Login</a>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>

            </div>

            </div>

        </div> -->



        <div class="container ovh">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">

                    <div class="utf-section-headline-item centered text-center mb20">

                        <!-- <h3 class="headline"><span>Do You Need Assistance?</span> End To End Assistance</h3> -->

                        <h3 class="headline">End To End <span class="head-red">Assistance</span></h3>

                        <div class="utf-headline-display-inner-item">End To End Assistance</div>

                    </div>

                    <p class="utf-slogan-text">You will be provided with complete assistance from start to end.</p>

                </div>

                <div class="col-lg-12">

                    <div class="feature_property_slider">



                        <div class="item check-if-auth-id">



                            <div class="context-menu">

                                <div class="why_chose_us context-menu">

                                    <div class="icon context-menu">

                                        <span class="flaticon-magnifying-glass context-menu"></span>

                                    </div>

                                    <div class="details context-menu">

                                        <h4>Search Karo</h4>

                                        <p>Your first step is initiated with a thorough search on properties you vision

                                            to invest in with us. </p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="item check-if-auth-id">



                            <div class="context-menu">

                                <div class="why_chose_us context-menu">

                                    <div class="icon context-menu">

                                        <span class="flaticon-invoice context-menu"></span>

                                    </div>

                                    <div class="details context-menu">

                                        <h4>Schedule Karo</h4>

                                        <p>Schedule your site visit with us once you’ve gained a profound insight on

                                            investment opportunities. </p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="item check-if-auth-id">



                            <div class="context-menu">

                                <div class="why_chose_us context-menu">

                                    <div class="icon context-menu">

                                         <span class="mr-1">

                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="phone-icon feather feather-phone-call"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>

                                             </span>

                                    </div>

                                    <div class="details context-menu">

                                        <h4>Contact Karo</h4>

                                        <p>Contact us for a guidance, counseling and dealing of properties with our

                                            highly professional Agents.</p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="item check-if-auth-id">



                            <div class="context-menu">

                                <div class="why_chose_us context-menu">

                                    <div class="icon context-menu">

                                        <span class="flaticon-profit context-menu"></span>

                                    </div>

                                    <div class="details context-menu">

                                        <h4>Invest Karo</h4>

                                        <p>Invest in exceptional opportunities we provide you with our wide range of

                                            high-end property options.</p>

                                    </div>

                                </div>

                            </div>

                        </div>





                    </div>

                </div>

            </div>

        </div>

    </section>


<!-- Video Showcase Section -->
<section class="video-showcase-section pb70 pt70" id="video-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="utf-section-headline-item text-center">
                    <h2 class="headline-text">Explore Our Property Videos</h2>
                    <p class="sub-headline">Immerse yourself in stunning visuals of our premium properties.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="video-showcase-grid">
                    <div class="video-showcase-item active" data-video-index="0">
                        <div class="video-card">
                            <video class="video-player" muted>
                                <source src="/assets/media/project_videos/project_1/p1.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-overlay">
                                <a href="javascript:void(0);" class="play-btn"><span class="fa fa-play"></span></a>
                            </div>
                            <div class="video-progress">
                                <div class="progress-bar"></div>
                            </div>
                            <button class="mute-btn muted"><span class="fa fa-volume-up"></span><span class="fa fa-volume-mute"></span></button>
                            <!-- <button class="maximize-btn"><span class="fa fa-expand"></span></button> -->
                            <div class="video-caption">
                                <h5>Luxury Villa in Dubai Hills</h5>
                                <p>A tour of modern elegance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="video-showcase-item" data-video-index="1">
                        <div class="video-card">
                            <video class="video-player" muted>
                                <source src="/assets/media/project_videos/project_2/p2.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-overlay">
                                <a href="javascript:void(0);" class="play-btn"><span class="fa fa-play"></span></a>
                            </div>
                            <div class="video-progress">
                                <div class="progress-bar"></div>
                            </div>
                            <button class="mute-btn muted"><span class="fa fa-volume-up"></span><span class="fa fa-volume-mute"></span></button>
                            <!-- <button class="maximize-btn"><span class="fa fa-expand"></span></button> -->
                            <div class="video-caption">
                                <h5>Beachfront Condo in Jumeirah</h5>
                                <p>Experience coastal living.</p>
                            </div>
                        </div>
                    </div>
                    <div class="video-showcase-item" data-video-index="2">
                        <div class="video-card">
                            <video class="video-player" muted>
                                <source src="/assets/media/project_videos/project_1/p1.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-overlay">
                                <a href="javascript:void(0);" class="play-btn"><span class="fa fa-play"></span></a>
                            </div>
                            <div class="video-progress">
                                <div class="progress-bar"></div>
                            </div>
                            <button class="mute-btn muted"><span class="fa fa-volume-up"></span><span class="fa fa-volume-mute"></span></button>
                            <!-- <button class="maximize-btn"><span class="fa fa-expand"></span></button> -->
                            <div class="video-caption">
                                <h5>Urban Penthouse in Downtown</h5>
                                <p>A stylish city retreat.</p>
                            </div>
                        </div>
                    </div>
                    <div class="video-showcase-item" data-video-index="3">
                        <div class="video-card">
                            <video class="video-player" muted>
                                <source src="/assets/media/project_videos/project_2/p2.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="video-overlay">
                                <a href="javascript:void(0);" class="play-btn"><span class="fa fa-play"></span></a>
                            </div>
                            <div class="video-progress">
                                <div class="progress-bar"></div>
                            </div>
                            <button class="mute-btn muted"><span class="fa fa-volume-up"></span><span class="fa fa-volume-mute"></span></button>
                            <!-- <button class="maximize-btn"><span class="fa fa-expand"></span></button> -->
                            <div class="video-caption">
                                <h5>Luxury Apartment in Marina</h5>
                                <p>Seaside luxury living.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-controls">
                    <button class="play-pause-btn">Play</button>
                    <button class="next-btn">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Video Showcase Section -->


    <!-- Feature Properties -->

    <section id="feature-property" class="whychose_us feature-property">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <a href="#feature-property">

                        <div class="mouse_scroll">

                            <div class="icon">

                                <h4>Scroll Down</h4>

                                <p>to discover more</p>

                            </div>

                            <div class="thumb">

                                <img src="/assets/images/resource/mouse.png" alt="mouse.png">

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>

        <div class="container ovh">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">

                    <div class="utf-section-headline-item centered text-center mb20">

                        <!-- <h3 class="headline"><span>Most Featured Properties</span> Featured Properties</h3> -->

                        <h3 class="headline"> Featured <span class="head-red">Properties</span></h3>

                        <div class="utf-headline-display-inner-item">Most Featured Properties</div>

                    </div>

                    <p class="utf-slogan-text">Scroll through the featured properties listed on our page to see the

                        top </p>

                </div>

                <div class="col-lg-12">

                    <div class="feature_property_slider_main">

                        @foreach ($featured_properties as $featured)

                            <div class="item check-if-auth-id">

                                <div class="feat_property">

                                    <?php $afterRedirect = "\/project/" . $featured->slug ?>

                                    <div class="thumb"

                                         @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{$featured->slug}}'"

                                         @else class="btn-link-project-detail btn btn-thm float-right"

                                         onclick="OpenLoginRegisterModal('{{$afterRedirect}}')" @endif>

                                        <img class="img-whp" src="{{ $featured->project_cover_img }}"

                                             alt="{{ $featured->name }}">

                                        <div class="thmb_cntnt">

                                            <div class="ribbon">

                                                <div class="txt">

                                                    {{ $featured->progress }}

                                                </div>

                                            </div>

                                            <a class="service-wishlist addressclickable tooltip" title="Location"

                                               data-id="1"

                                               data-type="property" value="{{$loop->index+1}}">

                                                                        <span id="lat{{$loop->index+1}}"

                                                                              class="d-none lat">{{$featured->latitude}}</span>

                                                <span id="lon{{$loop->index+1}}"

                                                      class="d-none lon">{{$featured->longitude}}</span>

                                                <i class="fa fa-map-marker project_icon" data-tip-content="Location">



                                                </i>



                                            </a>

                                            <input type="hidden" class="project_id" value="{{$featured->id}}">

                                            @if (Auth::id())

                                                <a type="button" class="add-to-wishlist-btn service-heart " data-id="1"

                                                   data-type="property"><i class="fa fa-heart project_icon"></i></a>

                                            @else

                                                <a class="service-heart tooltip" title="Wishlist" href="/login"><i

                                                        class="fa fa-heart project_icon"></i></a>

                                            @endif



                                        </div>

                                    </div>

                                    <div class="details">

                                        <div class="tc_content">

                                            <h4>

                                                @if (Auth::id())

                                                    <a class="featured_properties_title"

                                                       href="/project/{{ $featured->slug }}">

                                                        {{ Str::limit($featured->name, 25) }}

                                                    </a>

                                                @else

                                                    <a class="featured_properties_title"

                                                       href="/project/{{ $featured->slug }}" data-toggle="modal"

                                                       class="btn-link-project-detail"

                                                       data-target=".bd-example-modal-lg">



                                                        {{ Str::limit($featured->name, 25) }}

                                                    </a>

                                                @endif



                                            </h4>

                                            <span class="utf-listing-price">

                                                @php

                                                    $minimumProjectUnitPrice = 0;

                                                    if (count($featured->units)) {

                                                        $minimumProjectUnitPrice = $featured->units->min("total_unit_amount");

                                                    }

                                                @endphp

                                                Starting from Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}</span>

                                            <p class="text-thm">

                                            <span>

                                            @foreach ($featured->units->unique('unit_type_id') as $unit)



                                                    <span>{{ optional($unit->type)->title }} </span>

                                                    @if($featured->units->unique('unit_type_id')->count() > ($loop->index+1))

                                                        <span>|</span>

                                                    @endif

                                                @endforeach

                                            </span>

                                            </p>

                                            <p><span class="flaticon-placeholder map_icon"></span>

                                                <span

                                                    class="map_icon_txt"> {{ Str::limit($featured->address, 25) }}</span>

                                            </p>





                                        </div>

                                        <div class="fp_footer text-center search_option_button">



                                            @if (Auth::id())

                                                <a href="{!! url("/compare/" . $featured->id . '/?clicked=true') !!}"

                                                   class="float-left float-lg-left float-xl-left">

                                                    <img src="\assets\images\property\comparison_icon.png" width="35%;">

                                                    <span style="font-weight: 400">Compare</span>

                                                </a>

                                            @else

                                                <a href="/login?ref={!! url("/compare/" . $featured->id . '/?clicked=true') !!}"

                                                   class="float-left float-lg-left float-xl-left">

                                                    <img src="\assets\images\property\comparison_icon.png" width="35%">

                                                    <span style="font-weight: 400">Compare</span>

                                                </a>

                                            @endif



                                            @if (Auth::id())

                                                <a href="/project/{{ $featured->slug }}"

                                                   class="btn btn-thm float-right float-lg-right">

                                                    View Details

                                                </a>

                                            @else

                                                <a href='#' data-toggle="modal" data-target="#myModal" data-slug="{!! url("/project/". $featured->slug) !!}" class="btn-link-project-detail btn btn-thm float-right float-lg-right btn-modal">

                                                    View Details

                                                </a>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- feature properties End -->



    <!-- Home Banner Start -->



    <div class="utf-photo-section-block">

        <div class="utf-photo-text-content white-font">

            <div class="container">

                <div class="row">

                    <div class="col-lg-8 col-md-12 col-sm-12">

                        <h2>What is Abad Raho?</h2>

                        <p>Abad Raho is your go-to property finder platform. It was founded in 2020, with the aim to

                            provide exceptional residential and commercial projects to our clients that satisfy market

                            requirements and preferences. We strive to be Pakistan's leading property platform where you

                            can search for your desired properties, compare projects and invest in the top-notch and

                            renowned projects all over Pakistan. </p>

                        <!--  <p>We are unmatched property specialists when it comes to meeting the demands and budget of our

                             valued clients, from finding the best homes to finalizing sales, we are the experts. </p>

                         <p>With a goal of expanding our reach to new heights, we seek to build honest and trustworthy

                             relationships with our clients with our utmost dedication.</p> -->

                        <ul class="utf-download-text">

                            <li>

                                <a href="#" class="top">

                                    <img src="\assets\images\icon/icon01.png" class="img-responsive icon1">

                                    <span>Search</span>

                                    <p>Available Now</p>

                                </a>

                            </li>

                            <li>

                                <a href="#" class="top">

                                    <img src="\assets\images\icon/icon02.png" class="img-responsive icon1">

                                    <span>Invest</span>

                                    <p>Available Now</p>

                                </a>

                            </li>

                            <li>

                                <a href="#" class="top">

                                    <img src="\assets\images\icon\icon3.png" class="img-responsive icon1">

                                    <span>Compare</span>

                                    <p>Get in On</p>

                                </a>

                            </li>

                        </ul>

                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">

                        <div class="download-img">

                            <img src="\assets\images\home\mobile-view1.png" alt="">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Home Banner End -->







    <!-- Our Categories SEction -->



    <section id="feature-property" class="whychose_us feature-property bgc-f7">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <a href="#feature-property">

                        <div class="mouse_scroll">

                            <div class="icon">

                                <h4>Scroll Down</h4>

                                <p>to discover more</p>

                            </div>

                            <div class="thumb">

                                <img src="/assets/images/resource/mouse.png" alt="mouse.png">

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>

        <div class="container ovh">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">

                    <div class="utf-section-headline-item centered text-center mb20">

                        <!-- <h3 class="headline"><span>What Are You Looking For?</span> Most Popular Categories</h3> -->

                        <h3 class="headline"> Most Popular <span class="head-red">Categories</span></h3>

                        <div class="utf-headline-display-inner-item">Most Popular Categories</div>

                    </div>

                    <p class="utf-slogan-text">In this section, you will get to know about our top-selling & most

                        preferred properties.</p>

                </div>

                <div class="col-lg-12">

                    <div class="feature_property_slider">



                        <a href="{{ url('/')}}/projects/listings?type_id[]=11">

                            <div class="item check-if-auth-id">

                                <div class="context-menu">

                                    <div class="why_chose_us context-menu">

                                        <div class="icon context-menu">

                                            <span class="flaticon-building context-menu"></span>

                                        </div>

                                        <div class="details context-menu">

                                            <h4>Appartments</h4>

                                            <p>Apartment or Flat and Town house are styled developments.<br></p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </a>



                        <a href="{{ url('/')}}/projects/listings?type_id[]=3">

                            <div class="item check-if-auth-id">

                                <div class="context-menu">

                                    <div class="why_chose_us context-menu">

                                        <div class="icon context-menu">

                                            <span class="flaticon-house-2 context-menu"></span>

                                        </div>

                                        <div class="details context-menu">

                                            <h4>Plots</h4>

                                            <p>Extensive range of Land and Plots releases and Real Estates</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </a>



                        <a href="{{ url('/')}}/projects/listings?type_id[]=2">

                            <div class="item check-if-auth-id">

                                <div class="context-menu">

                                    <div class="why_chose_us context-menu">

                                        <div class="icon context-menu">

                                            <span class="flaticon-house-1 context-menu"></span>

                                        </div>

                                        <div class="details context-menu">

                                            <h4>Houses</h4>

                                            <p>The latest in New Home designs from our leading builders.</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </a>



                        <a href="{{ url('/')}}/projects/listings?type_id[]=6">

                            <div class="item check-if-auth-id">

                                <div class="context-menu">

                                    <div class="why_chose_us context-menu">

                                        <div class="icon context-menu">

                                            <span class="flaticon-money-bag context-menu"></span>

                                        </div>

                                        <div class="details context-menu">

                                            <h4>Commercial</h4>

                                            <p>New category for new commercial offerings at AbadRaho.PK</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </a>



                    </div>

                </div>

            </div>

        </div>

    </section>



    <!-- Our Categories Section End -->



    <!-- Popular Cities Section -->



    <section id="property-city" class="property-city pb20 style_1">

        <div class="container">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">

                    <div class="utf-section-headline-item centered text-center mb20">

                        <!-- <h3 class="headline"><span>Most Popular Places</span> Most Popular Properties Places</h3> -->

                        <h3 class="headline"> Most Popular <span class="head-red">Properties</span> Places</h3>

                        <div class="utf-headline-display-inner-item">Most Popular Properties Places</div>

                    </div>

                    <p class="utf-slogan-text">Discover hot-selling places and best areas to invest in Karachi</p>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-4 col-xl-4">

                    <a href="projects/getlistings?area[]=9">

                        <div class="properti_city ">

                            <div class="thumb"><img class="img-fluid w100"

                                                    src="/assets/images/home/northkarachi.jpg"

                                                    alt=""></div>

                            <div class="overlay">

                                <div class="details ">

                                    <div class="">

                                        <h4>North Karachi</h4>

                                    </div>

                                    <p class="desc">

                                        <!-- <span>2 Properties</span> -->

                                    </p>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

                <div class="col-lg-8 col-xl-8">

                    <a href="projects/getlistings?area[]=11">

                        <div class="properti_city ">

                            <div class="thumb"><img class="img-fluid w100"

                                                    src="/assets/images/home/scheme33.jpg"

                                                    alt=""></div>

                            <div class="overlay">

                                <div class="details ">

                                    <div class="">

                                        <h4>Scheme 33</h4>

                                    </div>

                                    <p class="desc">

                                        <!-- <span>2 Properties</span> -->

                                    </p>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

                <div class="col-lg-8 col-xl-8">

                    <a href="projects/getlistings?area[]=28">

                        <div class="properti_city ">

                            <div class="thumb"><img class="img-fluid w100"

                                                    src="/assets/images/home/jinnah_avenue.jpg"

                                                    alt=""></div>

                            <div class="overlay">

                                <div class="details ">

                                    <div class="">

                                        <h4>Jinnah Avenue</h4>

                                    </div>

                                    <p class="desc">

                                        <!-- <span>4 Properties</span> -->

                                    </p>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

                <div class="col-lg-4 col-xl-4">

                    <a href="projects/getlistings?area[]=14">

                        <div class="properti_city ">

                            <div class="thumb"><img class="img-fluid w100"

                                                    src="/assets/images/home/maymaar.jpg"

                                                    alt=""></div>

                            <div class="overlay">

                                <div class="details ">

                                    <div class="">

                                        <h4>Gulshan - e - Maymaar</h4>

                                    </div>

                                    <p class="desc">

                                        <!-- <span>2 Properties</span> -->

                                    </p>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </section>



    <!-- Popular Cities Section End -->



    <!-- Our Blog -->

    <section class="our-blog bgc-f7">

        <div class="container">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">

                    <div class="utf-section-headline-item centered text-center mb20">

                        <!-- <h3 class="headline"><span>Our Blog & Articles</span> Latest Blog Post</h3> -->

                        <h3 class="headline"> Latest <span class="head-red">Blog</span> Post</h3>

                        <div class="utf-headline-display-inner-item">Our Blog & Articles</div>

                    </div>

                    <p class="utf-slogan-text">Read about the latest update in the world of property</p>

                </div>

            </div>

            <div class="row">
                @foreach ($blogs->take(3) as $blog)
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="for_blog feat_property">
                            <div class="thumb">
                                <a href="/{{ $categories[$blog->category_id]->slug }}/{{ $blog->slug }}" class="w-100">
                                    <img class="img-whp" src="/uploads/blogs/{{ $blog->cover_img }}" alt="{{ $blog->title }}">
                                </a>
                            </div>
                            <div class="details">
                                <div class="tc_content">
                                    <p class="text-thm">{{ optional($blog->category)->title ? optional($blog->category)->title : 'Uncategorized' }}</p>
                                    <h4><a href="/{{ $categories[$blog->category_id]->slug }}/{{ $blog->slug }}" class="w-100 blog-title-heading">{{ $blog->title }}</a></h4>
                                    <ul class="utf-blog-item-post-list">
                                        <li>By, Mark Admin</li>
                                        <li>{{ $blog->created_at->format('d M, Y') }}</li>
                                    </ul>
                                    <br>
                                    {!! Str::limit($blog->description, 90) !!}
                                </div>

                            <!-- <div class="fp_footer">

                                    <ul class="fp_meta float-left mb0">

                                        <li class="list-inline-item d-none"><a href="#"><img

                                                    src="assets/images/property/pposter1.png" alt="pposter1.png"></a>

                                        </li>

                                        <li class="list-inline-item d-none"><a href="#">Ali Tufan</a></li>

                                        <li class="list-inline-item">

                                            <a href="#"><span class="flaticon-calendar pr10"></span>

                                                {{ $blog->updated_at->format('l, jS \\ F Y | h:i:s A') }}

                                </a>

                            </li>

                        </ul>

                        <a class="fp_pdate float-right text-thm" href="/blog/{{ $blog->slug }}">Read

                                        More <span class="flaticon-next"></span></a>

                                </div> -->

                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>



    <!-- Our Blog End -->



    <!-- Our Partners -->

    <section id="our-partners" class="our-partners">

        <div class="container">

            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">

                    <div class="utf-section-headline-item centered text-center mb20">

                        <!-- <h3 class="headline"><span>Most Featured Partners</span> Exclusive Partners</h3> -->

                        <h3 class="headline"> Exclusive <span class="head-red">Partners</span></h3>

                        <div class="utf-headline-display-inner-item">Exclusive Partners</div>

                    </div>

                    <p class="utf-slogan-text">Mark Properties is proud to work with the top-notch and renowned builders

                        and developers of Karachi</p>

                </div>

            </div>



            <div class="client-logoss">

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Firdouse-01.jpg">

                </div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Domanin-01.jpg">

                </div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Elite-01.jpg"></div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Untitled-2-01.jpg">

                </div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/NB-01.jpg"></div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Falaknaz-01.jpg">

                </div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Goldline-01.jpg">

                </div>

                <div class="client_logo"><img class="client_logo_img" src="/assets/images/partners/Shahmeer-01.jpg">

                </div>

            </div>

        </div>

    </section>



    <div class="modal fade" id="myModal" role="dialog">

        <div class="modal-dialog">

            <!-- Modal content-->

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Alert!</h4>

                </div>

                <div class="modal-body">

                    <p>Plesae Sign in before seeing the properties details.</p>

                </div>

                <div class="modal-footer">

                    <a href="/login" class="btn btn-success" id="modal-login-btn">Login</a>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>



    <!-- Our Partners Section End -->

    <!-- Partner End -->

    {{--    Location Modal--}}

    @include('projects.partials.location_modal')

@endsection



@section('footer')

    @include('projects.scripts.search_fields_with_select2_script')

    <script>

        

        $(document).ready(function () {

            

            $('.btn-modal').click(function() {

                var slug = $(this).data('slug');

                $('#modal-login-btn').attr('href', "/login?ref="+slug);

            });

            

            getData([], true, `${location.search.replace('?', '')}&_token={!! csrf_token() !!}`)



            $('.add-to-wishlist-btn').click(function (e) {

                e.preventDefault();

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });



                var project_id = $(this).closest('.project_data').find('.project_id').val();



                $.ajax({

                    method: "POST",

                    url: "/add-wishlist",

                    data: {

                        'project_id': project_id,

                    },

                    success: function (response) {

                        swal.fire({

                            text: response.status,

                            button: "Ok",

                        });

                    }

                });



            });

        });



        $(document).ready(function () {

            $('#home-search-form').submit(function (e) {

                e.preventDefault();

                var params = [];

                $(this).serializeArray().map(function (i) {

                    if (i.value !== "" && i.value !== null) {

                        params.push(i);

                    }

                })

                if (params.length) {

                    window.location.href = $(this).attr('action') + '/?' + $.param(params);

                } else {

                    window.location.href = $(this).attr('action');

                }

            });



            $(".text2").typed({

                strings: ["Searching", "Investing", "Budgeting", "Comparing"],

                typeSpeed: 70,

                backSpeed: 20,

                backDelay: 1500,

                showCursor: false,

                loop: true

            });

        });



        $('#show_advancefields').on('click', function() {

            $('.toggle-advanced-fields').slideToggle();



            setTimeout(function () {

                $("#more-less-txt").text($(".toggle-advanced-fields").is(':visible') ? 'Hide' : 'More');

            }, 1000)

        });

    </script>

@endsection

