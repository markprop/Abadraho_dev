@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')

@section('content')
  <body class="home page-template page-template-fullwidth page-template-fullwidth-php page page-id-403 no-transition">
    <div id="hero-container">
      <div id="slideshow">
        <div style="background-image: url(https://markproperties.pk/projects/wp-content/themes/markproperties2/search-results/uploads/2017/02/MKT-ext-Lot505_Graylands-dusk_FINAL-remove_tree_sRGB-Custom.jpg)"></div>
        <div style="background-image: url(https://markproperties.pk/projects/wp-content/themes/markproperties2/search-results/uploads/2017/02/slide2.jpg); display:none;"></div>
        <div style="background-image: url(https://markproperties.pk/projects/wp-content/themes/markproperties2/search-results/uploads/2017/02/slide3.jpg); display:none;"></div>
      </div>

      <div id="" class=" ">
        <div class="page-content">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css">
          <link rel="stylesheet" href="https://markproperties.pk/projects/wp-content/themes/markproperties2/css/housing-calculator.css">

          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js"></script>



          <div id="warp">
            <div class="container">
              <div class="row m-top-new-details compare-detail">
                <div class="col-md-12">
                  <h3 class="camp">Compare</h3>
                  <br>
                  <form class="form-inline">
                    <label class="sr-only" for="inlineFormInputName2">Project1</label>
                    <input type="text" class="form-control col-4 input-project" id="project1" placeholder="Project1">

                    <label class="sr-only" for="inlineFormInputGroupUsername2">Project2</label>
                    <div class="input-group col-4">

                      <input type="text" class="form-control input-project" id="project2" placeholder="Project2">
                    </div>


                    <button type="submit" class="btn btn-danger col-4">Compare</button>
                  </form>
                  <br>
                  <div class="compare-type">
                    <ul>

                      <li><a href="#" id="btn1" class="buttonInactive"> <span class="Name">Project Name</span></a></li>
                      <li><a href="#" id="btn2" class="buttonInactive"> <span class="Progress">Project Progress</span></a></li>
                      <li><a href="#" id="btn3" class="buttonInactive"> <span class="Price">Project Picture</span></a></li>
                      <li><a href="#" id="btn4" class="buttonInactive"> <span class="Location">Project Location</span></a></li>
                      <li><a href="#" id="btn5" class="buttonInactive"> <span class="Area">Project Area</span></a></li>
                      <li><a href="#" id="btn6" class="buttonInactive"> <span class="Rooms">Project Rooms</span></a></li>
                      <li><a href="#" id="btn7" class="buttonInactive"> <span class="Price">Project Price</span></a></li>


                      <li id="reset_filter"><a href="#" id="btn8" class="buttonInactive"> <span class="reset_filter">Reset</span></a></li>



                    </ul>
                  </div>
                  <hr>
                </div>

              </div>






              <div class="container compare_container compare_container2">
                <div class="row">

                  <table class="table" id="tr8">
                    <thead class="thead compare_table">
                      <tr id="tr1">
                        <th scope="col">Project Name</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <th scope="col">{{ $projectcompare->name }}</th>
                          @endforeach
                        <?php
                        } ?>

                      </tr>
                    </thead>
                    <tbody>
                      <tr id="tr3">
                        <th scope="row">Project Picture</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td>
                            <div class="thumb">

                              <img class="img-whp" src="/{{ $projectcompare->project_cover_img }}" alt="{{ $projectcompare->name }}">
                              <div class="ribbon">
                                <div class="txt">
                                  {{ $projectcompare->progress }}
                                </div>
                              </div>
                            </div>
                          </td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>

                      <tr id="tr2">
                        <th scope="row">Project Progress</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td>{{ $projectcompare->progress }}</td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>
                      <tr id="tr4">
                        <th scope="row">Project Location</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td>{{ $projectcompare->address }}</td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>
                      <tr id="tr5">
                        <th scope="row">Project Area</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td>{{ $projectcompare->area }}</td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>

                      <tr id="tr6">
                        <th scope="row">Project Room</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td> @if ($projectcompare->rooms != null)

                            <span>{{ $projectcompare->rooms }}</span>

                            @endif
                          </td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>

                      <tr id="tr7">
                        <th scope="row">Project Price</th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td> Rs.
                            {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $projectcompare->min_price) }}
                          </td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>

                      <tr id="tr10">
                        <th scope="row"></th>
                        <?php
                        if (!empty($projects_compare)) { ?>
                          @foreach($projects_compare as $projectcompare)
                          <td>
                            @if (Auth::id())
                            <a href="/project/{{ $projectcompare->slug }}" class="btn btn-thm float-left float-lg-right">
                              View Details
                            </a>
                            @else
                            <a href="/project/{{ $projectcompare->slug }}" data-toggle="modal" class="btn-link-project-detail btn btn-thm float-center" data-target=".bd-example-modal-lg">
                              View Details
                            </a>
                            @endif
                          </td>
                          @endforeach
                        <?php
                        } ?>
                      </tr>

                    </tbody>
                  </table>

                </div>


              </div>








            </div>
          </div>



          <!-- Modal -->
          <div class="modal fade" id="myCompare" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <div class="compare-modal">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="camp">Select Project</h3>
                    <input type="submit" value="Compare Product" class="btn compare_btn1 quicklinks-button" onclick="submit_myform()" style="float:right;">
                  </div>
                  <div class="modal-body">


                    <div class="col-md-12">


                      <div class="compare_search">
                        <div class="" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form id="compare-search-form" action="/compare" method="POST">
                              @csrf
                              <div class="home1-advnc-search">
                                <ul class="h1ads_1st_list mb0">
                                  <li class="list-inline-item">
                                    <div class="form-group">
                                      <div class="shortcode_widget_multiselect">
                                        <h5 class="search_heading">Area</h5>
                                        <div class="ui_kit_multi_select_box">
                                          <select class="selectpicker w-100" name="area[]" multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">
                                              {{ $area->name }}
                                            </option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  <li class="list-inline-item">
                                    <div class="form-group">
                                      <div class="shortcode_widget_multiselect">
                                        <h5 class="search_heading">Progress</h5>
                                        <div class="ui_kit_multi_select_box">
                                          <select class="selectpicker" name="progress[]" multiple>
                                            <option>Ready For Possession</option>
                                            <option>Under Construction</option>
                                            <option>Complete</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  <li class="list-inline-item">
                                    <div class="form-group">
                                      <div class="shortcode_widget_multiselect">
                                        <h5 class="search_heading">Type</h5>
                                        <div class="ui_kit_multi_select_box">
                                          <select class="selectpicker" name="type_id[]" multiple multiple multiple data-live-search="true" data-live-search-placeholder="Search">
                                            @foreach ($projectTypes as $projectType)
                                            <option value="{{ $projectType->id }}">
                                              {{ $projectType->title }}
                                            </option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </li>



                                  </li>
                                  <li class="list-inline-item mt-4">
                                    <div class="search_option_button">
                                      <button type="submit" class="btn btn-thm">Search</button>
                                    </div>
                                  </li>
                                </ul>

                              </div>
                            </form>

                          </div>
                        </div>
                      </div>



                    </div>




                    <div class="col-md-12">

                      @if(!empty($projects))

                      <for4m action="compare" method="post" name="myform">
                        @csrf

                        <div class="row ">

                          <div class="col-lg-12 variation_form_section">

                            @foreach ($projects as $Pkey => $project)
                            <label class="btn btn-danger">
                              <input class="checkBoxClass" type="checkbox" name="check[]" id="check_id" value="<?php echo $project->id; ?>">
                            </label>
                            <div class="feat_property compare_card list" id="feature_property">
                              <div class="thumb">

                                <img class="img-whp" src="/{{ $project->project_cover_img }}" alt="{{ $project->name }}">
                                <div class="ribbon">
                                  <div class="txt">
                                    {{ $project->progress }}
                                  </div>
                                </div>
                              </div>
                              <div class="details">
                                <div class="tc_content">
                                  <div class="dtls_headr">
                                    <h4>{{ $project->name }} {{ $project->id }}</h4>
                                    <a class="fp_price" href="#">
                                      Rs.
                                      {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $project->min_price) }}
                                    </a>
                                  </div>
                                  {{-- <p class="text-builder">
                          By {{ $project->owners->first()->full_name }}
                                  </p>--}}
                                  <p class="text-thm">
                                    @foreach ($project->units->unique('unit_type_id') as $unit)
                                    {{ optional($unit->type)->title }}
                                    @endforeach
                                  </p>
                                  <p class="project_location">
                                    <span class="flaticon-placeholder"></span>
                                    <span class="addressclickable" value="{{$loop->index+1}}">
                                      <span id="lat{{$loop->index+1}}" class="d-none lat">{{$project->latitude}}</span>
                                      <span id="lon{{$loop->index+1}}" class="d-none lon">{{$project->longitude}}</span>
                                      <!-- <span data-toggle="modal" data-target=".addressModal"> -->
                                      {{ $project->address }}
                                    </span>

                                  </p>
                                  <p class="project_summary">
                                    {!! Str::limit($project->details, 125) !!}
                                  </p>


                                  <ul class="prop_details mb0">


                                    {{-- If it has any units --}}
                                    @if ($project->units)
                                    {{-- Get individual Room Type in a specific project --}}
                                    <br>
                                    @foreach ($project->project_unit_rooms->unique('id') as $Rkey => $roomType)
                                    @if ($roomType->to_show != null)
                                    <span class="mr-2 listing-icon-style"><i class="fa {{ $roomType->icon }}"></i>

                                    </span>
                                    @endif
                                    @endforeach
                                    @endif
                                  </ul>
                                </div>
                                <div class="fp_footer search_option_button">
                                  <div class="fp_pdate float-left">Added:
                                    @if ($project->added_time)
                                    {{ \Carbon\Carbon::parse($project->added_time)->diffForHumans() }}
                                    @else
                                    {{ \Carbon\Carbon::parse($project->created_at)->diffForHumans() }}
                                    @endif
                                  </div>
                                  @if (Auth::id())
                                  <a href="/project/{{ $project->slug }}" class="btn btn-thm float-left float-lg-right">
                                    View Details
                                  </a>
                                  @else
                                  <a href="/project/{{ $project->slug }}" data-toggle="modal" class="btn-link-project-detail btn btn-thm float-right" data-target=".bd-example-modal-lg">
                                    View Details
                                  </a>
                                  @endif
                                </div>
                              </div>
                            </div>
                            <div class="units" id="units-{{$project->id}}">

                            </div>


                            @endforeach



                          </div>








                        </div>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">X Close</button>
                    <div>


                      </form>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>






        <!-- end Simple Custom CSS and JS -->
        <!-- start Simple Custom CSS and JS -->



        <!-- end Simple Custom CSS and JS -->
        <!-- start Simple Custom CSS and JS -->
        <style type="text/css">
          h3.camp {
            font-size: 36px;
            font-weight: 700;
            color: #000 !important;
            margin-top: 7%;

          }

          .row.m-top-new-details.compare-detail {
            min-height: 43px !important;
          }

          .compare-type span {
            color: #d31414;
            font-size: 16px;
            position: relative;
            border: 1px solid gray;
            padding: 4px 7px 7px 12px;
            border-radius: 7px;
            font-weight: bold;
          }

          .compare-type ul li {
            margin-right: 14px;
          }

          .compare-type ul {
            display: -webkit-inline-box;
          }

          img.img-responsive.add {
            width: 19%;
            margin: 0 auto;
            margin-top: 15%;
          }

          h1.com-head {
            margin-bottom: 11px !important;
            font-size: 18px;
            margin: 0;
            color: #272626;
            font-weight: 900;
            width: 100%;

          }

          .row.main-compare {
            margin-bottom: 53px;
          }

          img#main-view {
            border-radius: 14px;
          }

          span.book {
            float: right;
            color: #d31414;
            font-size: 12px;
            position: relative;
            border: 1px solid gray;
            padding: 4px 7px 7px 12px;
            border-radius: 7px;
            font-weight: bold;
          }

          p.comp-p {
            line-height: 1.4;
          }

          .compare-modal {
            position: absolute;
            width: 100%;
            top: 61px;
          }

          .compare-modal .modal-header {
            display: block !important;
          }

          h2.type-compare {
            font-weight: bold;
            color: #4d4d4d;
            margin-top: 10%;
            border-bottom: 1px solid #ccc;
            font-size: 20px;
          }

          p.type-compare {
            font-weight: bold;
            color: #4d4d4d;
            margin-top: 10%;
            border-bottom: 1px solid #ccc;
            font-size: 20px;
          }

          .compare_checkbox {
            background: #1ab3ed36;
            padding: 10px;
            border-radius: 10px;

          }

          .compare_checkbox:before {

            display: inline-block;
            padding-right: 3px;
            vertical-align: middle;
            font-weight: 900;
            color: green;
            font-size: 30px;
            float: left;

          }

          .compare-modal .row {
            height: 500px;
            overflow-y: scroll;
          }
        </style>
        <!-- end Simple Custom CSS and JS -->






      </div>
    </div>

  </body>
@endsection
