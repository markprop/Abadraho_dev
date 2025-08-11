@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')

@section('content')

<style>
  .panel-header {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px 5px 0px 0px;
    background: #ec1c24;
    color: white;
  }

  .panel-collapse-body {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 0px 0px 5px 5px;
  }

  .project-detail-label {
    font-weight: 700;
    color: black;
    margin: 0;
  }

  strong {
    font-weight: 100;
  }
</style>

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
        <link rel="stylesheet" href="/assets/css/compareProject.css">

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js"></script> -->
        <div id="warp">
          <div class="container">
            <div class="row m-top-new-details compare-detail">
              <div class="col-md-12">
                <div id="app">
                  <compare-project :baseurl="{{json_encode(url('/'))}}" :areas="{{json_encode($areas)}}" :projecttypes="{{json_encode($projectTypes)}}" :tags="{{json_encode($tags)}}" :selectedprojectid="{{json_encode($selectedProjectId)}}"></compare-project>
                </div>
                <br>


                <!-- <div class="compare-type">
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
                <hr> -->
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

@section('footer')

<script>
  const constantCustomActivityLogs = <?php echo json_encode(Config::get("constants.CustomActivityLogs")); ?>;

  $(document).ready(function() {
    // alert("ssswqd");
    // console.log("constantCustomActivityLogs -> ", constantCustomActivityLogs);
    addViewCompareActivityLog();
    // console.log("activityLogParam -> ", activityLogParam);
  });

  function addViewCompareActivityLog() {
    // console.log("addClickToCompareActivityLog -> objActivityLog -> ", objActivityLog);
    ShowLoader();
    let params = {
      log_name: constantCustomActivityLogs.compareProjectDetail.value,
      page_url: window.location.href,
      conversion_id: ConfigConstants.ActivityLogsConversionIds.viewPageId,
      description: "View Compare Page",
    };
    console.log("params -> ", params);
    CallLaravelAction("/create/custom-activity-log", params, function(response) {
      console.log("Insert view compare project log");
      HideLoader();
    });
  }
</script>
@endsection
