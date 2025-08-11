@extends('layouts.master')
@section('title', $project->name)
@section('meta_keywords', $project->meta_tags)
@section('meta_description', $project->meta_description)
@section('meta_title', $project->meta_title)
<style>
    .hide {
        display: none !important;
    }

    .calc-extra-option-btn {
        padding: 15px 20px;
        color: #fff;
    }

    .calc-extra-option-btn:hover {
        color: #ec1c24;
    }

    /* for select2 dropdown */
    .dropdown-toggle {
        height: 46px !important;
    }
</style>
@section('content')

<?php
$imgs_exploded = explode('|', $project->project_imgs);
?>

<!-- Listing Single Property -->
<button class="btn btn-danger hide" onclick="CreatePageVisitActivityLog()">Add Activity</button>
<section class="listing-title-area" data-project-latitude="{{ $project->latitude }}" data-project-longitude="{{ $project->longitude }}">

<div class="container">
    <div class="row detail-page">
        <div class="col-lg-6">
            <div class="breadcrumb_content style2 mb0-991">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active text-thm" aria-current="page">Details</li>
                </ol>
                <h2 class="breadcrumb_title">Project Details</h2>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="image-grid">
            <img class="img-fluid w100 image-grid-col-2 image-grid-row-2" src="/{{$imgs_exploded[0]}}" alt="1.jpg">
            @foreach ($imgs_exploded as $img)
            <img src="/{{$img}}" alt="1.jpg">
            @endforeach
        </div>
    </div>

    <div class="projects-title">
    <div class="container">
        <div class="row">
            <div class="col-md-7 real">
                <div id="titlebar-dtl-item" class="property-titlebar margin-bottom-0">
                    <div class="property-title">
                        <div class="property-pricing">
                            <?php
                                $minimumProjectUnitPrice = 0;
                                if (count($project->units)) {
                                    $minimumProjectUnitPrice = $project->units->min("total_unit_amount");
                                }
                            ?>
                            Starting from {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}<small class="d-none"> /
                            starting from</small></div>
                            <h2>{{ $project->name }} <span class="property-badge-sale">By
                                @foreach ($project->owners as $owner)
                                {{ $owner['full_name'] }}
                                @endforeach
                            </span></h2>
                            <span class="utf-listing-address flaticon-maps-and-flags"><i class="icon-material-outline-location-on"></i> {{ $project->address }}</span>
                        </div>
                    </div>
                </div>
            <div class="col-md-5">
                <ul class="social-new">
                    <li><a href="tel:+" class=""><button type="button" class="btn btn-danger btn-social"><i class="fa fa-phone" aria-hidden="true"></i>
                    Call</button></a></li>
                    <li><a target="_blank" href="https://api.whatsapp.com/send?phone=" class=""><button type="button" class="btn btn-success btn-social"><i class="fa fa-whatsapp" aria-hidden="true"></i>
                    WhatsApp</button></a></li>
                    <li><a href="mailto:" class=""><button type="button" class="btn btn-secondary btn-social"><i class="fa fa-envelope" aria-hidden="true"></i>
                    Email</button></a></li>
                </ul>
                <br>
                <h3 style="text-align: center;">
                    <marquee width="60%" direction="left" height="">
                        {!! htmlspecialchars_decode(nl2br($project->details)) !!}
                    </marquee>
                </h3>
            </div>
        </div>
    </div>
</div>


        <div class="row detail_image_mobile">

            <div class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                        @foreach ($imgs_exploded as $img)

                        <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                            <img class="d-block w-100" src="/{{$img}}" alt="2.jpg">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>

        </div>

        <!-- <div class="row detail_image_desktop">

            <div class="col-sm-7 col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="spls_style_two mb30-520">
                            <a class="popup-img" href="/{{$imgs_exploded[0]}}">
                                <img class="img-fluid w100" src="/{{$imgs_exploded[0]}}" alt="1.jpg">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-lg-4">
                <div class="row">

                    @foreach ($imgs_exploded as $img)
                    <div class="col-sm-6 col-lg-6">
                        <div class="spls_style_two mb30">
                            <a class="popup-img" href="/{{$img}}" alt="2.jpg">
                                <img class="img-fluid w100" src="/{{$img}}" alt="2.jpg">
                            </a>
                        </div>
                    </div>
                    @endforeach

                    
                </div>
            </div>
        </div> -->
    </div>

</section>


<section class="sticky_heading h60 p0">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="sticky-nav-tabs">
                    <ul class="sticky-nav-tabs-container" id="top-menu">
                        <li class="list-inline-item nav-item active"><a class="sticky-nav-tab" href="#tab-detail">Details</a>
                        </li>
                        <li class="list-inline-item nav-item"><a class="sticky-nav-tab" href="#tab-units">Unit Types</a>
                        </li>
                        <li class="list-inline-item nav-item"><a class="sticky-nav-tab" href="#tab-features">Project Features</a>
                        </li>
                        <li class="list-inline-item nav-item"><a class="sticky-nav-tab" href="#tab-location">Locations</a>
                        </li>
                        @if ($project->project_video)
                        <li class="list-inline-item nav-item"><a class="sticky-nav-tab" href="#tab-video">Video</a>
                        </li>
                        @endif
                        <li class="list-inline-item nav-item"><a class="sticky-nav-tab" href="#tab-calculator">Customized
                                Payment Schedule</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Listing Single V5 Area -->
<section class="our-listing-single bgc-f7 pb30-991">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <div id="tab-detail" class="col-lg-12">
                        <div class="listing_single_description">
                           <div class="utf-boxed-list-headline-item">
                                    <h3>Property Description</h3>
                                </div>
                            <p class="mb25">
                                {!! htmlspecialchars_decode(nl2br($project->details)) !!}
                            </p>
                        </div>
                        <br>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="additional_details">
                            <div class="row">
                                <div class="col-lg-12">
                                   <div class="utf-boxed-list-headline-item">
                                    <h3>Property Details</h3>
                                </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <ul class="list-inline-item ">
                                        <li>
                                            <p>Property ID : <span class="text-uppercase">  
                                            {{$project->property_id}}</span></p>
                                        </li>
                                        @if ($project->rooms != null)
                                        <li>
                                            <p>Rooms :  <span>  {{ $project->rooms }}</span></p>
                                        </li>
                                        @endif

                                        <li>
                                            <p>Location :<span> {{ $project->address }}</span></p>
                                        </li>
                                        <li>
                                            <p>
                                                <span>
                                                    @foreach($project->areas as $area)
                                                    {{ $area->name }} {{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </span>
                                            </p>
                                        </li>
                                        <li>
                                            <p>Added Time :<span>   {{ $project->added_time }}</span></p>
                                        </li>
                                    </ul>
                                    <!-- <ul class="list-inline-item ">
                                        <li>
                                            <p><span class="text-uppercase">{{ $project->property_id }}</span></p>
                                        </li>
                                        @if ($project->rooms != null)
                                        <li>
                                            <p><span>{{ $project->rooms }}</span></p>
                                        </li>
                                        @endif
                                        <li>
                                            <p class="p-id"><span class="">{{ $project->address }}</span></p>
                                        </li>
                                        <li>
                                            <p><span>
                                                    @foreach($project->areas as $area)
                                                    {{ $area->name }} {{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </span></p>
                                        </li>
                                        <li>
                                            <p><span>{{ $project->added_time }}</span></p>
                                        </li>
                                    </ul> -->
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <ul class="list-inline-item">
                                       
                                        <li>
                                            <p>Progress :</p>
                                        </li>
                                        <li>
                                            <p>Project Types :</p>
                                        </li>
                                    </ul>
                                    <ul class="list-inline-item">
                                       
                                        <li>
                                            <p><span>{{ $project->progress }}</span></p>
                                        </li>
                                        <li>
                                            <p>
                                                @foreach ($project->units->unique('unit_type_id') as $unit)

                                                <span> {{ optional($unit->type)->title }}</span>

                                                @endforeach
                                            </p>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if ($project->units)
                    <div class="col-lg-12">

                        <div id="tab-units" class="shop_single_tab_content style2 mt30">
                            <div class="col-lg-12 mb10 mt20 unit">
                                <div class="utf-boxed-list-headline-item">
                                    <h3>Unit Types</h3>
                                </div>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach ($project->units as $unit)

                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="unit-id-{{ $unit->id }}" data-toggle="tab" href="#unit-{{ $unit->id }}" role="tab" aria-controls="description" aria-selected="true">{{ $unit->title }}</a>
                                </li>
                                @endforeach

                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                @foreach ($project->units as $unit)
                                <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="unit-{{ $unit->id }}" role="tabpanel" aria-labelledby="description-tab">
                                    <div class="additional_details">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="mb15 pera">
                                                    {{ $unit->description }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <ul class="list-inline-item">
                                                    <li>
                                                        <p>Project Type :</p>
                                                    </li>
                                                    <li>
                                                        <p>Covered Area :</p>
                                                    </li>
                                                    <li>
                                                        <p>Installment Length :</p>
                                                    </li>
                                                    <li>
                                                        <p>Down Payment :</p>
                                                    </li>
                                                    @if ((int) $unit->loan_amount)
                                                    <li>
                                                        <p>Loan Amount :</p>
                                                    </li>
                                                    @endif

                                                </ul>
                                                <ul class="list-inline-item">

                                                    <li>
                                                        @if ($unit->unit_type_id != 0)
                                                        <p><span>
                                                                
                                                            </span></p>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <span>
                                                                <a href="javascript:void(0)" data-toggle="tooltip" title="@foreach ($unit->measurement->where('id', '!=',
                                                                                $unit->measurement_type)->get() as
                                                                                $convertor) {{ number_format($unit->covered_area / $convertor->convertor) }}
                                                                                {{ $convertor->symbol }}
                                                                                {{ !$loop->last ? ', ' : '' }} @endforeach">
                                                                    {{ number_format($unit->covered_area / $unit->measurement->convertor) }}
                                                                    {{ $unit->measurement->symbol }}
                                                                </a>
                                                            </span>

                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p><span>{{ $unit->installment }}</span></p>
                                                    </li>

                                                    <li>
                                                        <p>
                                                            <span>
                                                                Rs.
                                                                {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $unit->down_payment) }}
                                                            </span>
                                                        </p>
                                                    </li>
                                                    @if ((int) $unit->loan_amount)
                                                    <li>
                                                        <p><span>
                                                                Rs.
                                                                {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $unit->loan_amount) }}
                                                            </span></p>
                                                    </li>
                                                    @endif

                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                <ul class="list-inline-item">
                                                    @if ($unit->rooms != null)
                                                    <li>
                                                        <p>Rooms :</p>
                                                    </li>
                                                    @endif


                                                    <li>
                                                        <p>Installment Type :</p>
                                                    </li>
                                                    <li>
                                                        <p>Installment Amount :</p>
                                                    </li>
                                                    <li>
                                                        <p>Price :</p>
                                                    </li>
                                                    @if ((int) $unit->total_unit_amount)
                                                    <li>
                                                        <p>Total Amount :</p>
                                                    </li>
                                                    @endif
                                                </ul>
                                                <ul class="list-inline-item">
                                                    @if ($unit->rooms != null)
                                                    <li>
                                                        <p><span>{{ $unit->rooms }}</span></p>
                                                    </li>
                                                    @endif

                                                    <li>
                                                        <p><span>{{ $unit->installments->name }}

                                                            </span></p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <span>
                                                                Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $unit->monthly_installment) }}
                                                            </span>
                                                            </span>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <span>
                                                                Rs.
                                                                {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $unit->price) }}
                                                            </span>
                                                        </p>
                                                    </li>
                                                    @if ((int) $unit->total_unit_amount)
                                                    <li>
                                                        <p>
                                                            <span>
                                                                Rs.
                                                                {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $unit->total_unit_amount) }}
                                                            </span>
                                                        </p>
                                                    </li>
                                                    @endif

                                                </ul>
                                            </div>
                                       
                                       <div class="col-lg-12">
                                                <div id="tab-5" class="shop_single_tab_content style2 mt30">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                                        @if ($unit->payment_plan_img)
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="listing-tab" data-toggle="tab" href="#listing-{{ $unit->id }}" role="tab" aria-controls="listing" aria-selected="false">Payment Plan</a>
                                                        </li>
                                                        @endif

                                                        @if ($unit->floor_plan_img)
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="description-tab" data-toggle="tab" href="#description-{{ $unit->id }}" role="tab" aria-controls="description" aria-selected="true">Floor Plan</a>
                                                        </li>
                                                        @endif

                                                        @if (count($unit->UnitRooms) != 0)
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="listing-tab" data-toggle="tab" href="#rooms-{{ $unit->id }}" role="tab" aria-controls="listing" aria-selected="false">Unit Details</a>
                                                        </li>
                                                        @endif

                                                    </ul>
                                                    <div class="tab-content" id="myTabContent2">
                                                        @if ($unit->floor_plan_img)
                                                        <div class="tab-pane fade p-3" id="description-{{ $unit->id }}" role="tabpanel" aria-labelledby="description-tab">
                                                            <div class="gallery_item">
                                                                <img class="img-fluid img-circle-rounded w100" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->floor_plan_img }}" alt="{{ $project->name }}">
                                                                <div class="gallery_overlay">
                                                                    <a class="icon popup-img" href="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->floor_plan_img }}" onclick="addOpenImageActivityLog('Floor Plan')">
                                                                        <span class="flaticon-zoom-in"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if ($unit->payment_plan_img)
                                                        <div class="tab-pane fade show active row p-3" id="listing-{{ $unit->id }}" role="tabpanel" aria-labelledby="listing-tab">
                                                            <div class="gallery_item">
                                                                <img class="img-fluid img-circle-rounded w100" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->payment_plan_img }}" alt="{{ $project->name }}">
                                                                <div class="gallery_overlay"><a class="icon popup-img" href="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->payment_plan_img }}" onclick="addOpenImageActivityLog('Payment Plan')">
                                                                        <span class="flaticon-zoom-in"></span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        @if(count($unit->UnitRooms) > 0)
                                                        <div class="tab-pane fade row p-3" id="rooms-{{ $unit->id }}" role="tabpanel" aria-labelledby="rooms-tab">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead class="text-center-last">
                                                                        <tr>
                                                                           
                                                                            <th style="background-color: #ec1c24; color:#fff;" class="text-left font-weight-bold">
                                                                                Name
                                                                            </th>
                                                                            <th style="background-color: #ec1c24; color:#fff;" class="text-left font-weight-bold">
                                                                                Width x Length
                                                                            </th>
                                                                            <th style="background-color: #ec1c24; color:#fff;" class="text-left font-weight-bold">
                                                                                Covered Area
                                                                            </th>
                                                                            
                                                                        </tr>

                                                                    </thead>
                                                                    <tbody id="table_data" class="text-center-last">
                                                                        @foreach ($unit->UnitRooms as $room)
                                                                        <tr class="font-weight-boldest font-size-lg">
                                                                           
                                                                            <td class="text-left pt-7">
                                                                                <span>
                                                                                    <i class="fa {{ $room->RoomType ? $room->RoomType->icon : '' }}"></i> :
                                                                                    <span> {{ $room->extras ? $room->extras : '0' }}</span>
                                                                                </span>
                                                                                <span>{{ $room->RoomType ? $room->RoomType->name : '-' }}</span>
                                                                            </td>
                                                                            <td class="text-left pt-7">
                                                                                @if (($room->width_feet == 0 || $room->width_feet == null) && ($room->length_feet == 0 || $room->length_feet == null))
                                                                                No Dimensions Provided
                                                                                @else
                                                                                <span>{{$room->width_feet ? $room->width_feet : '0'}}.{{$room->width_inches ? $room->width_inches : '0'}}</span>
                                                                                <span> x </span>
                                                                                <span>{{$room->length_feet ? $room->length_feet : '0'}}.{{$room->length_inches ? $room->length_inches : '0'}}</span>
                                                                                @endif
                                                                            </td>
                                                                            <td class="text-left pt-7">
                                                                                <span> {{ $room->covered_area ? $room->covered_area : '0' }}</span> <span>Sq.Ft</span>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($project->ProjectAmenities->count() > 0)
                    <div class="col-lg-12">
                        <div id="tab-features" class="application_statics mt30 g-attributes amenities attr-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="utf-boxed-list-headline-item">
                                        <h3>Amenities</h3>
                                      </div>
                                 
                                </div>
                                @foreach ($project->ProjectAmenities as $ProjectAmenity)
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <ul class="order_list list-inline-item all-amit">
                                        <li><a href="#">
                                                <span class="flaticon-tick"></span>
                                                {{ $ProjectAmenity->Amenity ? $ProjectAmenity->Amenity->amenity_name : "-" }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    @endif

                    @if($project->ProjectUtils->count() > 0)
                    <div class="col-lg-12">
                        <div class="application_statics mt20 g-attributes amenities attr-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="utf-boxed-list-headline-item">
                                        <h3>Utilities</h3>
                                      </div>
                                  
                                </div>
                                @foreach ($project->ProjectUtils as $ProjectUtility)
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <ul class="order_list list-inline-item all-amit">
                                        <li><a href="#">
                                                <span class="flaticon-tick"></span>
                                                {{ $ProjectUtility->Utility ? $ProjectUtility->Utility->utility_name : "-" }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    @endif


                    @if ($project->project_doc)
                    <div class="col-lg-12">
                        <div class="property_attachment_area mt20">
                            <div class="utf-boxed-list-headline-item">
                                        <h3>Project Attachments</h3>
                                      </div>
                            <div class="iba_container style2">
                                <div class="icon_box_area style2">
                                    {{-- <div class="score"><span class="flaticon-pdf text-thm fz30"></span></div> --}}
                                    <div class="details">
                                        <a href="/uploads/project_documents/project_{{ $project->id }}/{{ $project->project_doc }}" download onclick="addDownloadPdfActivityLog()">
                                            <h5><span class="flaticon-download text-thm pr10"></span> Download PDF</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <div id="tab-location" class="application_statics mt30">
                            <div class="utf-boxed-list-headline-item">
                                        <h3>Location</h3>
                                      </div>
              
                            <h4 class="mb30 flaticon-maps-and-flags"><small class="mt-3 mt-lg-0">
                                    {{ $project->address }}<br>
                                </small></h4>
                            <div class="property_video p0">
                                <div class="thumb">
                                    <div class="h400" id="map-canvas2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($project->project_video)
                    <div class="col-lg-12">
                        <div id="tab-video" class="shop_single_tab_content style2 mt30">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Property video</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <div class="property_video">
                                        <div class="thumb">
                                            <img class="pro_img img-fluid w100" src="{{ '/' }}{{ $project->project_cover_img }}" alt="{{ $project->name }}">
                                            <div class="overlay_icon">
                                                <a class="video_popup_btn popup-img red popup-youtube" href="{{ $project->project_video }}"><span class="flaticon-play"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                   
                    <div class="col-lg-12 mt30">
                        <div class="product_single_content">
                            <div class="mbp_pagination_comments">
                                <ul class="total_reivew_view">
                                    <li class="list-inline-item sub_titles">
                                       {{$ratings->count()}} Reviews
                                    </li>
                                    
                                    
                                    <li class="list-inline-item">
                                        <ul class="star_list">
                                            <ul>
                                            <li class="list-inline-item avrg_review"><?php $ratenum = number_format($rating_value) ?></li>
                                                @for($i=1; $i<= $ratenum; $i++)
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                @endfor
                                                @for($j = $ratenum+1; $j<=5; $j++)
                                                <li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                @endfor
                                            </ul>
                                        </ul>
                                    </li>
                                    
                                </ul>
                                @foreach($ratings as $item)
                                <div class="mbp_first media">
                                    
                                    <div class="media-body">
                                        <h4 class="sub_title mt-0">{{$item->user->first_name. '' .$item->user->last_name}}
                                            <div class="sspd_review dif">
                                            
                                            <?php $user_rated = $item->rating ?>
                                                <ul class="ml10">
                                                    @for($i=1; $i<= $user_rated; $i++)
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                                    @endfor
                                                    @for($j = $user_rated+1; $j<=5; $j++)
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    @endfor
                                                   
                                                </ul>
                                               
                                            </div>
                                        </h4>
                                        <a class="sspd_postdate fz14" href="#">{{$item->created_at}}</a>
                                        <p class="mt10">{{$item->review}}</p>
                                    </div>
                                    
                                </div>
                                @endforeach
                                
                                <div class="custom_hr"></div>
                                    <div class="mbp_comment_form style2">
                                        <h4>Write a review</h4>
                                        @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                        @endif 
                                    <form class="comments_form review-form" id="review-form" action="{{url('/add-rating')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <ul class="sspd_review star_rating_ul">
											<li class="list-inline-item">
												<ul class="mb0">
													<li class="list-inline-item">
                                                    <div class="rating-css">
                                                        <div class="star-icon">
                                                            <input type="radio" value="1" name="product_rating" checked id="rating1">
                                                            <label for="rating1" class="fa fa-star"></label>
                                                            <input type="radio" value="2" name="product_rating" id="rating2">
                                                            <label for="rating2" class="fa fa-star"></label>
                                                            <input type="radio" value="3" name="product_rating" id="rating3">
                                                            <label for="rating3" class="fa fa-star"></label>
                                                            <input type="radio" value="4" name="product_rating" id="rating4">
                                                            <label for="rating4" class="fa fa-star"></label>
                                                            <input type="radio" value="5" name="product_rating" id="rating5">
                                                            <label for="rating5" class="fa fa-star"></label>
                                                        </div>
                                                    </div>
                                                    </li>
													
												</ul>
											</li>
											<li class="list-inline-item review_rating_para">Your Rating &amp; Review</li>
										</ul>
                                        
                                        <div class="form-group">
                                            <textarea class="form-control" required name="review" rows="12" placeholder="Your Review"></textarea>
                                        </div>
                                        <a download onclick="addReviewLog()">

                                            <button type="submit" class="btn btn-thm">Submit Review <span class="flaticon-right-arrow-1"></span>
                            </a>    
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 mt30">
                        <div id="tab-calculator" class="application_statics">
                            <div class="row d-block">
                                <form id="paymentSchedule">
                                    @csrf
                                    <input type="number" class="d-none" name="project_id" value="{{ $project->id }}">
                                    <div class="calculator  col-12">
                                        <div class="utf-boxed-list-headline-item">
                                        <h3>Customize Payment Schedule</h3>
                                      </div>
                                   
                                            <h3 price="{{ $project->min_price }}" class="price_area calculator_price d-none">
                                                <span class="price-cal price2 calculator_price" price='{{ $project->min_price }}'>{{ $project->min_price }}</span>
                                            </h3>
                                            <div id="results_display_housing" class="results show-amount results_display results_eligible results_eligible_tr hide">
                                                <span></span>
                                            </div>
                                            <div id="divProjectDetailCaclulator" class="cal-form">
                                                <div id="project_types">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label class="cal-label">Projects Type</label>
                                                            <br>
                                                            <select id="project_type_select" name="unit_id" class="form-control ">
                            
                                                            <option value="0">Select Type</option>
                                                                @foreach ($project->units as $unit)
                                                                <option value="{{ $unit->id }}" price_inner="{{ (int) $unit->price }}" total_unit_amount="{{ (int) $unit->total_unit_amount }}" loan_amount="{{ (int) $unit->loan_amount }}" type1_monthly_duration_inner="{{ $project->installment_length }}" default_down_payment="{{ (int) $unit->down_payment }}" installment_type="{{ $total_months }}">
                                                                    {{ $unit->title }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            <span id="project_type_unit" class="text-danger"></span>
                                                        </div>
                                                        <div class="col-lg-6" id="Months_Duration_select_div_section">
                                                            <label class="cal-label">Months Duration</label>
                                                            <div id="Months_Duration_select_div">
                                                                <select id="Months_Duration_select" name="duration" class="form-control">
                                                                    <option> Please Select</option>
                                                                    <option value="1" m="1" q="0" h="0" y="0">01
                                                                        Months
                                                                    </option>
                                                                    <option value="3" m="3" q="1" h="0" y="0">03
                                                                        Months
                                                                    </option>
                                                                    <option value="6" m="6" q="2" h="1" y="0">06
                                                                        Months
                                                                    </option>
                                                                    <option value="9" m="9" q="3" h="1" y="0">09
                                                                        Months
                                                                    </option>
                                                                    <option value="12" m="12" q="4" h="2" y="1">12
                                                                        Months
                                                                    </option>
                                                                    <option value="24" m="24" q="8" h="4" y="2">24
                                                                        Months
                                                                    </option>
                                                                    <option value="36" m="36" q="12" h="6" y="3">36
                                                                        Months
                                                                    </option>
                                                                    <option value="48" m="48" q="16" h="8" y="4">48
                                                                        Months
                                                                    </option>
                                                                    <option value="60" m="60" q="20" h="10" y="5">60
                                                                        Months
                                                                    </option>
                                                                </select>
                                                                
                                                            </div>
                                                   
                                                        </div>
                                                    </div>
                                                    <div id="calculator_form_fields">
                                                        <div class="tab-cal col-sm-12 ui_kit_button mb35">
                                                            <div class="row mt-4">
                                                                <a id="defaultOpen" val1="Buy" class="tablinks mr-2 calc-extra-option-btn active" onclick="openCity(event, 'Buy')">FLAT
                                                                </a>
                                                                <a id="defaultOpen" val1="Rent" class="tablinks mt-0 calc-extra-option-btn" onclick="openCity(event, 'Rent')">CONSTRUCTION
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div id="Buy" class="tabcontent" style="display: block;"></div>
                                                        <div id="Rent" class="tabcontent construction_options" style="display: none;">
                                                            <div class="input form-group">
                                                                <input type="tel" class="form-control number1 number" name="slab_casting" placeholder="Slab Casting">
                                                            </div>
                                                            <div class="input form-group">
                                                                <input type="tel" class="form-control number1 number" name="plinth" placeholder="Plinth">
                                                            </div>
                                                            <div class="input form-group">
                                                                <input type="tel" class="form-control number1 number" name="colour" placeholder="Colour">
                                                            </div>
                                                            <div class="input_fields_wrap mb-2">
                                                                <a class="add_field_button btn btn-thm">Add More Value
                                                                    +
                                                                </a>
                                                                <!--<div><input type="text" name="mytext[]"></div>-->
                                                            </div>
                                                        </div>
                                                        <!--<label class="cal-label1">Down Payment</label>-->
                                                        <div class="form-group">
                                                           
                                                            <input type="tel" class="form-control number1 number" name="down_payment" id="down_payment" placeholder="Down Payment">
                                                        </div>
                                                        <div class="form-group">

                                                            <input class="down_payment_checkbox" type="checkbox" value="split">
                                                            <label> Split Down Payment ?</label>

                                                        </div>


                                                        <!--<label class="cal-label1">Monthly Installment</label>-->

                                                        <div class="col-sm-12 project_type">
                                                            <div class="down_payment_options hide">

                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control number Booking" name="booking" placeholder="Booking">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control number allocation" name="allocation" placeholder="Allocation">
                                                                        </div>
                                                                       </div>
                                                                       <div class="row"> 
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control number confirmation" name="confirmation" placeholder="Confirmation">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control number start_of_work" name="start_of_work" placeholder="Start of Work">
                                                                        </div>
                                                                       </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                      

                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <input type="tel" class="form-control number1 number" id="Monthly_Installment" name="monthly_installment" placeholder="Monthly Installment">
                                                            </div>
                                                            <div class="form-group col-lg-6" id="divQuarterly_Installment">
                                                                <input type="tel" class="form-control number1 number" id="Quarterly_Installment" name="quarterly_installment" placeholder="Quarterly Installment">
                                                            </div>

                                                            <div class="form-group col-lg-6" id="divHalf_Yearly_Installment">
                                                                <input type="tel" class="form-control number1 number" id="Half_Yearly_Installment" name="half_yearly_installment" placeholder="Half Yearly Installment">
                                                            </div>

                                                            <div class="form-group col-lg-6" id="divYearly_Installment">
                                                                <input type="tel" class="form-control number1 number" name="yearly_installment" id="Yearly_Installment" placeholder="Yearly Installment">
                                                            </div>

                                                            <div class="form-group col-lg-6">
                                                                <input type="tel" class="form-control number1 number" id="Possession" name="possession" placeholder="Possession">
                                                            </div>

                                                            <div class="form-group col-lg-6">
                                                                <input type="tel" class="form-control number1 number" id="LoanAmount" name="loan_amount" placeholder="Loan Amount">
                                                                <div class="text-danger" id="loan_amount_error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="results_display_housing" class="results show-amount results_display results_eligible results_eligible_br hide">
                                                <span></span>
                                            </div>
                                            <p class="text-danger" id="payment_schedule_error"></p>
                                            <div class="search_option_button">
                                                <button type="button" id="submitPaymentSchedule" class="btn btn-block btn-thm form-btn">Submit Enquiry
                                                </button>
                                            </div>

                                    </div>
                                </form>
                            </div>
                            <form id="customised-payment-schedule">
                                <div class="row d-none">
                                    <div class="col-lg-12 mb-3">
                                        <div class="chart_circle_doughnut mt30">
                                            <h4>Customized Payment Schedule</h4>
                                        </div>
                                        <h1 id="calculation-data"></h1>
                                        <h1 id="remaining-amount"></h1>
                                    </div>
                                    @if ($project->units)
                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                                            <label>Unit Type</label>
                                            <select class="selectpicker" id="unit_type" data-live-search="true" data-width="100%">
                                                <option>Please Select</option>
                                                @foreach ($project->units as $unit)
                                                <option value="{{ $unit['id'] }}">{{ $unit['title'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($installment_length)
                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input ui_kit_select_search form-group">
                                            <label>Monthly Duration</label>
                                            <select class="selectpicker" id="monthly_duration" data-live-search="true" data-width="100%">
                                                <option>Please Select</option>
                                                @foreach ($installment_length as $length)
                                                <option value="{{ $length->value }}">{{ $length->value }}
                                                    Months
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input form-group">
                                            <label>Down Payment</label>
                                            <input type="text" class="form-control" id="calculator-down-payment">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input form-group">
                                            <label>Monthly Installment</label>
                                            <input type="text" class="form-control" id="monthly_installment">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input form-group">
                                            <label>Quarterly Installment</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input form-group">
                                            <label>Half Yearly Installment</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input form-group">
                                            <label>Yearly Installment</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xl-4">
                                        <div class="my_profile_setting_input form-group">
                                            <label>Possession</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="sidebar_listing_list">
                    <div class="sidebar_advanced_search_widget">
                        <div class="sl_creator">
                                <div class="utf-boxed-list-headline-item">
                                    <h3>Get In Touch</h3>
                                </div>

                          <div class="agent-title media">
                                <div class="agent-photo"><img src="/assets/images/partners/agent-avatar.png" alt=""></div>
                                <div class="agent-details">
                                  <h4 id="agent-made">@foreach ($project->owners as $owner)
                                        {{ $owner['full_name'] }}
                                        @endforeach</h4>
                                  <span>@foreach ($project->owners as $owner)
                                        {{ $owner['contact_person_phone_number'] }}
                                        @endforeach</span>
                                  <span>@foreach ($project->owners as $owner)
                                        {{ $owner['contact_person_email'] }}
                                        @endforeach</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>



                        </div>
                        @if(Auth::user())
                        
                        <form id="zohoInquiryForm">
                            
                            <input type="number" id="user_id" name="user_id" class="d-none" value="{{ Auth::user()->id }}">
                            <div class="row" style="font-size: 12px;">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    
                                        <input type="text" class="form-control" id="name" name="name" readonly placeholder="Your Name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" required>
                                        <div class="text-danger" id="zoho-name"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                      
                                        <input type="email" class="form-control" id="exampleInputEmail" id="email" readonly name="email" value="{{ Auth::user()->email }}" placeholder="Email" required>
                                        <div class="text-danger" id="zoho-email"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="phone" type="tel" class="form-control" name="phone_number" value="{{ Auth::user()->phone_number }}" required />
                                        <!-- <div class="text-danger" id="zoho-phone_number"></div> -->
                                    </div>
                                 </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                    <textarea id="address" type="text" class="form-control" name="address" placeholder="Your Address" required></textarea>
                                    <div class="text-danger" id="zoho-address"></div> 
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea id="message" name="message" class="form-control" rows="3" placeholder="Your Message" required></textarea>
                                        <div class="text-danger" id="zoho-message"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <textarea id="address" type="text" class="form-control" name="address" placeholder="Your Address" required></textarea>
                                    <div class="text-danger" id="zoho-address"></div> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group" id="select-opts">
                                        <label class="search_heading">Select Unit</label>
                                        <select class="selectpicker form-control" id="unit_id" data-allow-clear="true" name="unit_id" data-live-search="true" data-width="100%" required>
                                            <option disabled value="" selected>Select Unit</option>
                                            @foreach ($project->units as $unit)
                                            <option value="{{ $unit->id }}" selected>{{ $unit->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="search_option_button">
                                        <button type="button" id="submitZohoInquiryForm" class="btn btn-block btn-thm"><i class="fa fa-paper-plane"></i> Get Expert Advise Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif                    </div>
                </div>

                <div class="sidebar_listing_list">
                    <div class="sidebar_advanced_search_widget">
                        @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        <div class="sl_creator">
                                <div class="utf-boxed-list-headline-item">
                                    <h3>Get Your Voucher</h3>
                                </div>
                        </div>
                        <form>
                            <div class="row" style="font-size: 12px;">
                                <div class="col-md-12">
                                    <div class="search_option_button">
                                        <a  href="/projects/generate-voucher/{{$project->id}}" onclick="addDownloadVoucherActivityLog()" type="btn" class="btn btn-block btn-thm"><i class="fa fa-paper-plane"></i> Get Your Voucher Code
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(!empty($recent_view_data))               
                @if ($recent_view_data->count())
                    <div class="widget utf-sidebar-widget-item">
                        <div class="utf-boxed-list-headline-item">
                            <h3>Recently Viewed</h3>
                        </div>
                        @foreach ($recent_view_data as $r_project)
                            <ul class="widget-tabs">
                                <!-- Post #1 -->
                                <li>
                                    <div class="widget-content">
                                        <div class="widget-thumb"><a href="{!! url('/project/' . $r_project->project->slug) !!}"><img src="/{{ $r_project->project ? $r_project->project->project_cover_img : '' }}" alt="{{ $r_project->project ? $r_project->project->name : '' }}"></a>
                                        </div>
                                        <div class="widget-text">
                                            <h5>
                                                <a href="blog-full-width-single-post.html">{{ $r_project->project ? $r_project->project->name : '' }}</a>
                                            </h5>
                                            <span>
                                        <?php
                                            $minimumProjectUnitPrice = 0;
                                            if (count($r_project->project->units)) {
                                                $minimumProjectUnitPrice = $r_project->project->units->min("total_unit_amount");
                                            }
                                        ?>
                                        Starting from Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}
                                        </span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                @endif
            @endif
            </div>
        </div>
    </div>
</section>

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
  <div class="container ovh" style="margin-bottom: 5%;">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 offset-lg-12 mb30">
            <div class="utf-section-headline-item centered text-center mb20">
            <!-- <h3 class="headline"><span>Similar Projects</span>Related Projects</h3> -->
            <h3 class="headline">Related <span class="head-red">Projects</span></h3>
            <div class="utf-headline-display-inner-item">Related Projects</div>
            </div>
            <p class="utf-slogan-text">Mark Properties is proud to work with the top-notch and renowned builders and developers of Karachi</p>
        </div>
      <div class="col-lg-12">
        <div class="feature_property_slider_main">
        @foreach($project->subcategory->project as $item)
          <div class="item check-if-auth-id">
            <div class="feat_property">
              <?php $afterRedirect = "\/project/" . $item->slug ?>
              <div class="thumb related-feat" @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{$item->slug}}'" @else class="btn-link-project-detail btn btn-thm float-right" onclick="OpenLoginRegisterModal('{{$afterRedirect}}')" @endif>
                <img class="img-whp" src="/{{ $item->project_cover_img }}" alt="{{ $item->name }}">
                <div class="thmb_cntnt">
                  <div class="ribbon">
                    <div class="txt">
                      {{ $item->progress }}
                    </div>
                  </div>
                  <a class="service-wishlist addressclickable" data-id="1" data-type="property" value="{{$loop->index+1}}">
                    <span id="lat{{$loop->index+1}}" class="d-none lat">{{$item->latitude}}</span>
                    <span id="lon{{$loop->index+1}}" class="d-none lon">{{$item->longitude}}</span>
                    <i class="fa fa-map-marker project_icon"></i>
                  </a>
                  <input type="hidden" class="project_id" value="{{$item->id}}">
                    @if (Auth::id())
                        <a type="button" class="add-to-wishlist-btn service-heart" data-id="1"
                        data-type="property"><i class="fa fa-heart project_icon"></i></a>
                    @else
                        <a class="service-heart" href="/login"><i
                                class="fa fa-heart project_icon"></i></a>
                    @endif
                </div>
              </div>
              <div class="details">
                <div class="tc_content">
                <span class="utf-listing-price">
                        <?php
                        $minimumProjectUnitPrice = 0;
                        if (count($item->units)) {
                        $minimumProjectUnitPrice = $item->units->min("total_unit_amount");
                        }
                        ?>
                        Starting from
                        Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}</span>
                  <p class="text-thm">
                    <span>
                      @foreach ($item->units->unique('unit_type_id') as $unit)
                      <span>{{ optional($unit->type)->title }} </span>
                      @if($item->units->unique('unit_type_id')->count() > ($loop->index+1))
                      <span>|</span>
                      @endif
                      @endforeach
                    </span>
                  </p>
                  <h4>
                    @if (Auth::id())
                    <a href="/project/{{ $item->slug }}">
                      {{ Str::limit($item->name, 25) }}
                    </a>
                    @else
                    <a href="/project/{{ $item->slug }}" data-toggle="modal" class="btn-link-project-detail" data-target=".bd-example-modal-lg">
                      {{ Str::limit($item->name, 25) }}
                    </a>
                    @endif
                  </h4>
                  <p><span class="flaticon-placeholder"></span>
                    {{ Str::limit($item->address, 25) }}
                  </p>
                </div>
                <div class="fp_footer text-center search_option_button">
                  @if (Auth::id())
                  <a onclick="location.href = '/compare'" class="float-left float-lg-left float-xl-left">
                    <img src="\assets\images\property\comparison_icon.png" width="35%">Compare
                  </a>
                  @else
                  <!-- <a href="/compare" data-toggle="modal" class="btn-link-project-detail float-left float-lg-right" data-target=".bd-example-modal-lg"> -->
                  <a href="javascript:void(0)" onclick="OpenLoginRegisterModal('/compare')" data-toggle="modal" data-target=".bd-example-modal-lg" class="float-left float-lg-left float-xl-left">
                    <img src="\assets\images\property\comparison_icon.png" width="35%">Compare
                  </a>
                  @endif
                  @if (Auth::id())
                  <a onclick="location.href = '/project/{{ $item->slug }}'" class="btn btn-thm float-right float-lg-right">
                    View Details
                  </a>
                  @else
                  <a href="javascript:void(0)" onclick="OpenLoginRegisterModal('/project/{{ $item->slug }}')" class="btn-link-project-detail btn btn-thm float-right float-lg-right" data-target=".bd-example-modal-lg">
                    View Details
                  </a>
                  <!-- <a href="/compare" data-toggle="modal" class="btn-link-project-detail float-left float-lg-right" data-target=".bd-example-modal-lg"> -->
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

@endsection

@section('footer')
<script>
    const CurrentProject = <?php echo json_encode($project); ?>;
    const ConstActivtyLogParams = {
        log_name: GetActivityLogNames.viewProjectDetails.value,
        log_table: "projects",
        subject_type: "App\\Models\\Project",
        subject_id: CurrentProject.id,
        page_url: window.location.href,
    };
    
    function CreatePageVisitActivityLog() {
        var pageVisitSeconds = 0
        window.setInterval(function() {
            pageVisitSeconds++;
        }, 1000);

        $(window).on("beforeunload", function() {
            let params = ConstActivtyLogParams;
            params.description = CurrentProject.name;
            params.duration_in_second = pageVisitSeconds;
            params.conversion_id = ConfigConstants.ActivityLogsConversionIds.viewPageId;
            
            console.log("beforeunload", true);

            CallLaravelAction("/create/custom-activity-log", params, function(response) {
                console.log("insert page visit log");
            });
        });
    }
</script>
<script>
    jQuery(document).ready(function(jQuery) {
        var topMenu = jQuery("#top-menu"),
            offset = 40,
            topMenuHeight = topMenu.outerHeight() + offset,
            // All list items
            menuItems = topMenu.find('a[href*="#"]'),
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function() {
                var href = jQuery(this).attr("href"),
                    id = href.substring(href.indexOf('#')),
                    item = jQuery(id);
                
                if (item.length) {
                    return item;
                }
            });

        // so we can get a fancy scroll animation
        menuItems.click(function(e) {
            var href = jQuery(this).attr("href"),
                id = href.substring(href.indexOf('#'));
            offsetTop = href === "#" ? 0 : jQuery(id).offset().top - topMenuHeight + 1;
            jQuery('html, body').stop().animate({
                scrollTop: offsetTop
            }, 300);
            e.preventDefault();
        });

        // Bind to scroll
        jQuery(window).scroll(function() {
            // Get container scroll position
            var fromTop = jQuery(this).scrollTop() + topMenuHeight;

            // Get id of current scroll item
            var cur = scrollItems.map(function() {
                if (jQuery(this).offset().top < fromTop)
                return this;
            });

            // Get the id of the current element
            cur = cur[cur.length - 1];
            var id = cur && cur.length ? cur[0].id : "";

            menuItems.parent().removeClass("active");
            if (id) {
                menuItems.parent().end().filter("[href*='#" + id + "']").parent().addClass("active");
            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(function() {
        CreatePageVisitActivityLog();
        $('#submitPaymentSchedule').prop('disabled', true);
        $('#calculator_form_fields').hide();
        $('#Months_Duration_select_div_section').hide();
        /*
        CUSTOMIZED PAYMENT PLAN
         */
        $(document).on("change", "#project_type_select", function() {
            var price_inner = $("#project_type_select option:selected").attr("total_unit_amount");
            var loan_amount = $("#project_type_select option:selected").attr("loan_amount");
            var default_down_payment = $("#project_type_select option:selected").attr("default_down_payment");
            var installment_type = $("#project_type_select option:selected").attr("installment_type");
            $('#down_payment').val(default_down_payment);
            $(".calculator_price").attr("price", price_inner);
            if (loan_amount) {
                $('#LoanAmount').val(loan_amount);
            }
            var price2 = numDifferentiation(price_inner);
            $(document).find("span.calculator_price").html("<small>PKR </small> " + price2);
            if ($("#project_type_select option:selected").val() == 0) {
                price_inner = 0;
                loan_amount = 0;
                default_down_payment = 0;
                $('.results_display').empty();
                $('#calculator_form_fields').hide();
                $('#Months_Duration_select_div_section').hide();
                $("#Months_Duration_select option:selected").each(function() {
                    $(this).prop('selected', false);
                });
            } else {
                $('.results_display').html('<span></span>');
                $('#calculator_form_fields').show();
                $('#Months_Duration_select_div_section').show();
                $("#Months_Duration_select [value=" + installment_type + "]").prop('selected', true);
            }
        });
        $(document).on("change", ".down_payment_checkbox", function() {
            if (this.checked) {
                $(".down_payment_options").addClass("show").removeClass("hide");
                $("input#down_payment").attr("disabled", true);
            } else {
                $(".down_payment_options").addClass("hide").removeClass("show");
                $("input#down_payment").attr("disabled", false);
            }
        });
        $(document).on("change", ".Booking", function() {
            var Booking = $("input.Booking").val().replace(/,/g, '');
            var allocation = $("input.allocation").val().replace(/,/g, '');
            var confirmation = $("input.confirmation").val().replace(/,/g, '');
            var start_of_work = $("input.start_of_work").val().replace(/,/g, '');
            if (Booking == "") {
                Booking = 0;
            }
            if (allocation == "") {
                allocation = 0;
            }
            if (confirmation == "") {
                confirmation = 0;
            }
            if (start_of_work == "") {
                start_of_work = 0;
            }
            var addition = parseInt(Booking) + parseInt(allocation) + parseInt(confirmation) + parseInt(start_of_work);
            $("#down_payment").val(addition);
        });

        $(document).on("change", ".allocation", function() {
            var Booking = $("input.Booking").val().replace(/,/g, '');
            var allocation = $("input.allocation").val().replace(/,/g, '');
            var confirmation = $("input.confirmation").val().replace(/,/g, '');
            var start_of_work = $("input.start_of_work").val().replace(/,/g, '');
            if (allocation == "") {
                allocation = 0;
            }
            if (confirmation == "") {
                confirmation = 0;
            }
            if (start_of_work == "") {
                start_of_work = 0;
            }
            var addition = parseInt(Booking) + parseInt(allocation) + parseInt(confirmation) + parseInt(start_of_work);
            $("#down_payment").val(addition);
        });

        $(document).on("change", ".confirmation", function() {
            var Booking = $("input.Booking").val().replace(/,/g, '');
            var allocation = $("input.allocation").val().replace(/,/g, '');
            var confirmation = $("input.confirmation").val().replace(/,/g, '');
            var start_of_work = $("input.start_of_work").val().replace(/,/g, '');
            if (allocation == "") {
                allocation = 0;
            }
            if (confirmation == "") {
                confirmation = 0;
            }
            if (start_of_work == "") {
                start_of_work = 0;
            }
            var addition = parseInt(Booking) + parseInt(allocation) + parseInt(confirmation) + parseInt(start_of_work);
            $("#down_payment").val(addition);
        });
        $(document).on("change", ".start_of_work", function() {
            var Booking = $("input.Booking").val().replace(/,/g, '');
            var allocation = $("input.allocation").val().replace(/,/g, '');
            var confirmation = $("input.confirmation").val().replace(/,/g, '');
            var start_of_work = $("input.start_of_work").val().replace(/,/g, '');
            if (allocation == "") {
                allocation = 0;
            }
            if (confirmation == "") {
                confirmation = 0;
            }
            if (start_of_work == "") {
                start_of_work = 0;
            }
            var addition = parseInt(Booking) + parseInt(allocation) + parseInt(confirmation) + parseInt(start_of_work);
            $("#down_payment").val(addition);
        });

        $(document).on("change", "input.number", function() {
            console.log("Inside on change! Abdullah")
            var Monthly = $("#Months_Duration_select option:selected").attr("m");
            var Quarterly = $("#Months_Duration_select option:selected").attr("q");
            var Half_Yearly = $("#Months_Duration_select option:selected").attr("h");
            var Yearly = $("#Months_Duration_select option:selected").attr("y");

            $(".results span").html("<div id='wait'><center><img width='30px' src='https://markproperties.pk/projects/wp-content/themes/markproperties2/images/wait.gif' /></center></div>");

            var down_payment = $("#down_payment").val().replace(/,/g, '');
            var Monthly_Installment = $("#Monthly_Installment").val().replace(/,/g, '') * Monthly;
            var Quarterly_Installment = $("#Quarterly_Installment").val().replace(/,/g, '') * Quarterly;
            var Half_Yearly_Installment = $("#Half_Yearly_Installment").val().replace(/,/g, '') * Half_Yearly;
            var Yearly_Installment = $("#Yearly_Installment").val().replace(/,/g, '') * Yearly;
            var Possession = $("#Possession").val().replace(/,/g, '');
            var LoanAmount = $("#LoanAmount").val() ? $("#LoanAmount").val().replace(/,/g, '') : 0;

            if (down_payment == "") {
                var down_payment_val = 0;
            } else {
                var down_payment_val = down_payment;
            }
            if (Monthly_Installment == "") {
                var Monthly_Installment_val = 0;
            } else {
                var Monthly_Installment_val = Monthly_Installment;
            }
            if (Quarterly_Installment == "") {
                var Quarterly_Installment_val = 0;
            } else {
                var Quarterly_Installment_val = Quarterly_Installment;
            }
            if (Half_Yearly_Installment == "") {
                var Half_Yearly_Installment_val = 0;
            } else {
                var Half_Yearly_Installment_val = Half_Yearly_Installment;
            }
            if (Yearly_Installment == "") {
                var Yearly_Installment_val = 0;
            } else {
                var Yearly_Installment_val = Yearly_Installment;
            }
            if (Possession == "") {
                var Possession_val = 0;
            } else {
                var Possession_val = Possession;
            }
            if (LoanAmount == "") {
                var LoanAmount_val = 0;
            } else {
                var LoanAmount_val = LoanAmount;
            }

            var construction_options_addition = 0;
            $(".construction_options .number").each(function() {
                var val = $(this).val().replace(/,/g, '');
                if (val == "") {
                    var value = 0;
                } else {
                    var value = parseInt(val);
                }
                construction_options_addition += value;
            });

            var addition = parseInt(down_payment_val) + parseInt(Monthly_Installment_val) + parseInt(Quarterly_Installment_val) + parseInt(Half_Yearly_Installment_val) + parseInt(Yearly_Installment_val) + parseInt(Possession_val) + parseInt(LoanAmount_val) + construction_options_addition;

            var project_price = $(".calculator_price").attr('price');
            console.log('$(".calculator_price").attr("price")', $(".calculator_price").attr('price'));
            project_price = parseInt(project_price);

            $(".results").addClass("results_display");
            var value = project_price - addition;
            $("#remaining_amount").val(value);
            $(".results span").html("<b>Total Amount: " + " " + new Intl.NumberFormat().format(project_price) + "</b><br/><b>Remaining Amount:</b> " + " " + new Intl.NumberFormat().format(value));

            if (value > 0 || value < 0) {
                $('#submitPaymentSchedule').prop('disabled', true)
            } else {
                $('#submitPaymentSchedule').prop('disabled', false)
            }

            $("#final_price").val(addition);
            var remaining_amount = $("#remaining_amount").val();
            if (remaining_amount == 0) {
                $(".eligible_form").find("button").removeAttr("disabled");
            } else {
                $(".eligible_form").find("button").attr("disabled", "disabled");
            }
            $(".results_eligible").removeClass("hide");
            if (value < 0) {
                $('#payment_schedule_error').html('<b>Remaining amount must be Zero</b>');
            } else {
                $('#payment_schedule_error').empty();
            }
            $(".results_eligible span").html("<b>Total Amount:</b> " + " " + new Intl.NumberFormat().format(project_price) + "<br/><b>Remaining Amount:</b> " + " " + new Intl.NumberFormat().format(value));
        });

        $(document).on("change", "#divProjectDetailCaclulator select", function() {
            var Monthly = $("#Months_Duration_select option:selected").attr("m");
            var Quarterly = $("#Months_Duration_select option:selected").attr("q");
            var Half_Yearly = $("#Months_Duration_select option:selected").attr("h");
            var Yearly = $("#Months_Duration_select option:selected").attr("y");

            $(".results span").html("<div id='wait'><center><img width='30px' src='https://markproperties.pk/projects/wp-content/themes/markproperties2/images/wait.gif' /></center></div>");

            checkSelectedInstallments(Quarterly, Half_Yearly, Yearly);

            var down_payment = $("#down_payment").val().replace(/,/g, '');
            var Monthly_Installment = $("#Monthly_Installment").val().replace(/,/g, '') * Monthly;
            var Quarterly_Installment = $("#Quarterly_Installment").val().replace(/,/g, '') * Quarterly;
            var Half_Yearly_Installment = $("#Half_Yearly_Installment").val().replace(/,/g, '') * Half_Yearly;
            var Yearly_Installment = $("#Yearly_Installment").val().replace(/,/g, '') * Yearly;
            var Possession = $("#Possession").val().replace(/,/g, '');

            var LoanAmount = $("#LoanAmount").val().replace(/,/g, '');

            if (down_payment == "") {
                var down_payment_val = 0;
            } else {
                var down_payment_val = down_payment;
            }
            if (Monthly_Installment == "") {
                var Monthly_Installment_val = 0;
            } else {
                var Monthly_Installment_val = Monthly_Installment;
            }
            if (Quarterly_Installment == "") {
                var Quarterly_Installment_val = 0;
            } else {
                var Quarterly_Installment_val = Quarterly_Installment;
            }
            if (Half_Yearly_Installment == "") {
                var Half_Yearly_Installment_val = 0;
            } else {
                var Half_Yearly_Installment_val = Half_Yearly_Installment;
            }
            if (Yearly_Installment == "") {
                var Yearly_Installment_val = 0;
            } else {
                var Yearly_Installment_val = Yearly_Installment;
            }
            if (Possession == "") {
                var Possession_val = 0;
            } else {
                var Possession_val = Possession;
            }
            if (LoanAmount == 0) {
                var LoanAmount_val = 0;
            } else {
                var LoanAmount_val = LoanAmount;
            }
            var construction_options_addition = 0;
            $(".construction_options .number").each(function() {
                var val = $(this).val().replace(/,/g, '');
                if (val == "") {
                    var value = 0;
                } else {
                    var value = parseInt(val);
                }
                construction_options_addition += value;
            });

            var addition = parseInt(down_payment_val) + parseInt(Monthly_Installment_val) + parseInt(Quarterly_Installment_val) + parseInt(Half_Yearly_Installment_val) + parseInt(Yearly_Installment_val) + parseInt(Possession_val) + parseInt(LoanAmount_val) + construction_options_addition;
            //var project_price = '10320000';
            var project_price = $(".calculator_price").attr('price');
            project_price = parseInt(project_price);

            $(".results").addClass("results_display");
            var value = project_price - addition;
            $("#remaining_amount").val(value);
            $(".results ul").html("<li class='pl-0'><b>Total Amount:</b> " + " " + new Intl.NumberFormat().format(project_price) + "</li><li class='pl-0'><b>Remaining Amount:</b> " + " " + new Intl.NumberFormat().format(value)) + "<li>";

            $("#final_price").val(addition);
            var remaining_amount = $("#remaining_amount").val();
            if (remaining_amount == 0) {
                $(".eligible_form").find("button").removeAttr("disabled");
            } else {
                $(".eligible_form").find("button").attr("disabled", "disabled");
            }
            $(".results_eligible").removeClass("hide");
            $(".results_eligible span").html("<b>Total Amount:</b> " + " " + new Intl.NumberFormat().format(project_price) + "<br/><b>Remaining Amount:</b> " + " " + new Intl.NumberFormat().format(value));
        });
    });

    function checkSelectedInstallments(Quarterly, Half_Yearly, Yearly) {
        $("#divQuarterly_Installment").hide();
        $("#divHalf_Yearly_Installment").hide();
        $("#divYearly_Installment").hide();

        console.log("Quarterly -> ", Quarterly);
        console.log("Half_Yearly -> ", Half_Yearly);
        console.log("Yearly -> ", Yearly);

        if (Quarterly > 0) {
            $("#divQuarterly_Installment").show();
        }
        if (Half_Yearly > 0) {
            $("#divHalf_Yearly_Installment").show();
        }
        if (Yearly > 0) {
            $("#divYearly_Installment").show();
        }
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function numDifferentiation(val) {
        if (val >= 10000000) val = (val / 10000000).toFixed(2) + " Crore";
        else if (val >= 100000) val = (val / 100000).toFixed(2) + " Lac";
        else if (val >= 1000) val = (val / 1000).toFixed(2) + " Thousand";
        return val;
    }

    var construction_added_field = 0
    $(document).on("click", ".add_field_button", function() {
        var value = $(this).attr("value");
        construction_added_field++;
        $(".construction_options .input:last").after("<div class='input form-group'> <div class='d-flex'><input class='form-control number1 number col-sm-10 construction_added_fields' name='construction_added_field[]' placeholder='New Value'><i class='fa fa-remove col-sm-2 remove_input_const'></i></div> </div>");
    });

    let token = $("input[name='_token']").val();
    $(document).on("click", ".remove_input_const", function() {
        $(this).closest('.input').remove();
    });

    $("#submitPaymentSchedule").on("click", function(e) {
        // using this page stop being refreshing
        e.preventDefault();
        let projectDetail = @json($project);
        let projectType = $("#project_type_select").val();
        let unitDetails;
        let allInputs = $("#paymentSchedule input");
        let amountsDiv = $(".show-amount");

        projectDetail.units.map(unit => {
            if (unit.id == projectType) {
                unitDetails = unit
            }
        })

        let downPayment = unitDetails.down_payment;
        let projectPrice = unitDetails.price;
        let amountHtml = `<span><b>Total Amount:</b> ${Number(projectPrice).toLocaleString()}<br/><b>Remaining Amount:</b> ${(Number(projectPrice) - Number(downPayment)).toLocaleString()}</span>`;
        var construction_fields_added = $(".construction_added_fields").length;
        let para
        $.ajax({
            type: "POST",
            url: "/projects/payment-schedule",
            data: $("#paymentSchedule").serialize() +
                "&construction_fields_added=" +
                construction_fields_added,
            error: function(response) {
                var errors = response.responseJSON.errors;
                console.log("Error", errors);

                if (errors.unit_id) {
                    $("#project_type_unit").html(
                        "Please select a Project Type"
                    );
                }
            },
            success: function(response) {
                console.log(response);
                for (let a = 0; a < allInputs.length; a++) {
                    if ("down_payment" != $(allInputs[a])[0].id) {
                        if ($(allInputs[a])[0].name != "project_id") {
                            $(allInputs[a]).val("")
                        }
                    }
                }
                for (let a = 0; a < amountsDiv.length; a++) {
                    $(amountsDiv[a]).html("");
                    $(amountsDiv[a]).append(amountHtml);
                }
                Swal.fire({
                    icon: "success",
                    title: "You're request has been submitted!",
                    showConfirmButton: false,
                    timer: 1500,
                });

                // insert activity log
                let logParams = ConstActivtyLogParams;
                logParams.conversion_id = ConfigConstants.ActivityLogsConversionIds.cutomizedPaymentPlan;
                logParams.description = "Customized payment plan of unit " + unitDetails.title;
                addCustomizedPaymentLog(logParams);

                $("input[name='_token']").val(token);
                $('#submitPaymentSchedule').prop('disabled', true);
            },
        });
    });

    $("#submitZohoInquiryForm").on("click", function(e) {
        if (SubmitForm("zohoInquiryForm")) {
            // using this page stop being refreshing
            e.preventDefault();
            // $("#submitZohoInquiryForm")
            let phoneNumber = $("input[id='phone']").val();
            let address = $("#address").val();
            let message = $("#message").val();

            let dataParams = $("#zohoInquiryForm").serialize() +
                "&log_name=" + GetActivityLogNames.submitProjectDetailInquiry.value +
                "&description=" + (GetActivityLogNames.submitProjectDetailInquiry.description + " (" + CurrentProject.name + ")") +
                "&conversion_id=" + ConfigConstants.ActivityLogsConversionIds.submitPropertyInquiry +
                "&subject_id=" + CurrentProject.id +
                "&subject_type=" + "App\\Models\\Project" +
                "&objective=" + CurrentProject.name +
                "&page_url=" + window.location.href +
                "&phone_number=" + phoneNumber +
                "&Address=" + address +
                "&message=" + message;

            ShowLoader();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/web/project-detail/inquiry",
                data: dataParams,
                success: function(response) {
                    addSubmitPropertyInquiryLog();
                    $("#address").val('');
                    $("#message").val('');
                    let options = $("#unit_id").children();
                    $("#unit_id").empty().trigger('change');
                    for (let i = 0; i < options.length; i++) {
                        if ($(options[i])[0].innerText == 'Select Unit') {
                            $("#unit_id").append(`<option disabled value="" selected>Select Unit</option>`)
                        }
                        $("#unit_id").append(`<option value="${$(options[i]).val()}" >${$(options[i])[0].innerText}</option>`)
                    }
                    $("#unit_id").trigger('change');
                    Swal.fire({
                        icon: "success",
                        title: "You're request has been submitted!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    HideLoader();
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    var ErrorMsg = "Validation Errors";
                    if (typeof errors !== "undefined") {
                        if (typeof errors.name !== "undefined") {
                            ErrorMsg = errors.name;
                        } else if (typeof errors.email !== "undefined") {
                            ErrorMsg = errors.email;
                        } else if (typeof errors.phone_number !== "undefined") {
                            ErrorMsg = errors.phone_number;
                        } else if (typeof errors.message !== "undefined") {
                            ErrorMsg = errors.message;
                        } else if (typeof errors.address !== "undefined") {
                            ErrorMsg = errors.address;
                        } else if (typeof errors.unit_id !== "undefined") {
                            ErrorMsg = errors.unit_id;
                        }
                    }
                    let SweetAlertParams = {
                        icon: "error",
                        title: ErrorMsg,
                        showConfirmButton: true,
                        timer: 20000,
                    };
                    ShowSweetAlert(SweetAlertParams);
                    HideLoader();
                    var errors = response.responseJSON.errors;
                    console.log("Errors -> ", errors)
                    console.log("response -> ", response)
                },
            });
        }
    });

    function addOpenImageActivityLog(imageType) {
        let params = ConstActivtyLogParams;
        params.conversion_id = ConfigConstants.ActivityLogsConversionIds.clickToCall;
        params.description = "Open " + imageType + " of " + CurrentProject.name;
        CallLaravelAction("/create/custom-activity-log", params, function(response) {
            console.log("Insert project detail inquiry log");
        });
    }

    function addDownloadPdfActivityLog() {
        let params = ConstActivtyLogParams;
        params.conversion_id = ConfigConstants.ActivityLogsConversionIds.downloadPdf;
        params.description = "Download PDF from " + CurrentProject.name;
        CallLaravelAction("/create/custom-activity-log", params, function(response) {
            console.log("Insert Download PDF log");
        });
    }

    function addCustomizedPaymentLog(logParams) {
        CallLaravelAction("/create/custom-activity-log", logParams, function(response) {
            console.log("Insert " + logParams.description);
        });
    }

    function addSubmitPropertyInquiryLog() {
        let logParams = ConstActivtyLogParams;
        logParams.conversion_id = ConfigConstants.ActivityLogsConversionIds.submitPropertyInquiry;
        logParams.description = "Submit project detail inquiry of " + CurrentProject.name;
        CallLaravelAction("/create/custom-activity-log", logParams, function(response) {
            console.log("Insert " + logParams.description);
        });
    }
    function addReviewLog() {
        let logParams = ConstActivtyLogParams;
        logParams.conversion_id = ConfigConstants.ActivityLogsConversionIds.Review;
        logParams.description = "Added Review in " + CurrentProject.name;
        CallLaravelAction("/create/custom-activity-log", logParams, function(response) {
            console.log("Insert " + logParams.description);
        });
    }
    function addDownloadVoucherActivityLog() {
        let params = ConstActivtyLogParams;
        params.conversion_id = ConfigConstants.ActivityLogsConversionIds.downloadPdf;
        params.description = "Download Voucher from " + CurrentProject.name;
        CallLaravelAction("/create/custom-activity-log", params, function(response) {
            console.log("Insert Download PDF log");
        });
    }
    
</script>
@endsection
