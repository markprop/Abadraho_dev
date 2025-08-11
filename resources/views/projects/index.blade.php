@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')
@section('content')
    <input type="hidden" value="" id="btn-link-project-detail">

    <!-- Listing Grid View -->
    <section class="our-listing pb30-991 bgc-f7">
        <div class="container">

            @if(isMobile())
                <!-- Search Filters Mobile -->
                <div class="modal fade" id="filters-modal" tabindex="-1" role="dialog"
                     aria-labelledby="filters-modal-label"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filters-modal-label">Filters</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('projects.partials.search')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Housing Calculator Mobile -->
                <div class="modal fade" id="housing-calculator-modal" tabindex="-1" role="dialog"
                     aria-labelledby="housing-calculator-modal-label"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="housing-calculator-modal-label">Housing Calculator</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('projects.partials.housing_calculator')
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page">Projects</li>
                        </ol>
                        <h2 class="breadcrumb_title">Projects</h2>
                        @if(isMobile())
                            <div class="mobile-filters pull-right large-disable">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#filters-modal">
                                    Filters
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#housing-calculator-modal">Housing Calculator</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="search-hd mob-srch-hide">
                @include('projects.partials.search')
            </div>

            <div class="row mt30">

                <div class="col-lg-4 col-xl-4 hc-sidebar">
                    <div class="sidebar_listing_grid1 dn-991">

                            @include('projects.partials.housing_calculator')

                        <!-- Recent Projects -->
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
                                                <div class="widget-thumb"><a
                                                        href="{!! url('/project/' . $r_project->project->slug) !!}"><img
                                                            src="/{{ $r_project->project ? $r_project->project->project_cover_img : '' }}"
                                                            alt="{{ $r_project->project ? $r_project->project->name : '' }}"></a>
                                                </div>
                                                <div class="widget-text">
                                                    <h5>
                                                        <a href="{!! url('/project/' . $r_project->project->slug) !!}">{{ $r_project->project ? $r_project->project->name : '' }}</a>
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

                        <!--Social Icons-->
                        <div class="widget utf-sidebar-widget-item">
                            <div class="utf-boxed-list-headline-item">
                                <h3>Social Sharing</h3>
                            </div>
                            <ul class="utf-social-icons rounded">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a class="gplus" href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="grid_list_search_result">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 f-mob">
                            <div class="left_area tac-xsd">
                                <p id="searchCount">Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} results</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 f-mob">
                            <div class="right_area text-right tac-xsd shortby">
                                <ul>
                                    <li class="list-inline-item"><span class="shrtby">Sort by:</span>
                                        <div class="dropdown bootstrap-select show-tick">
                                            <select id="reseller_id" class="selectpicker show-tick" tabindex="-98"
                                                    name="reseller_id">
                                                <option value="default">Select</option>
                                                <option
                                                    value="Latest" {!! request('reseller_id') && request('reseller_id') === 'Latest' ? 'selected': '' !!}>
                                                    Latest
                                                </option>
                                                <option
                                                    value="Oldest" {!! request('reseller_id') && request('reseller_id') === 'Oldest' ? 'selected': '' !!}>
                                                    Oldest
                                                </option>
                                                <option
                                                    value="popularity" {!! request('reseller_id') && request('reseller_id') === 'Oldest' ? 'selected': '' !!}>
                                                    By Popularity
                                                </option>
                                                <option
                                                    value="Highest_by_price" {!! request('reseller_id') && request('reseller_id') === 'Highest_by_price' ? 'selected': '' !!}>
                                                    Highest By Price
                                                </option>
                                                <option
                                                    value="Lowest_by_price" {!! request('reseller_id') && request('reseller_id') === 'Lowest_by_price' ? 'selected': '' !!}>
                                                    Lowest By Price
                                                </option>
                                                <option
                                                    value="Sort_by_progress" {!! request('reseller_id') && request('reseller_id') === 'Sort_by_progress' ? 'selected': '' !!}>
                                                    By Progress
                                                </option>
                                                <option
                                                    value="Sort_by_area" {!! request('reseller_id') && request('reseller_id') === 'Sort_by_area' ? 'selected': '' !!}>
                                                    By Area
                                                </option>
                                            </select>
                                            <div id="debug"></div>
                                            <div class="dropdown-menu " role="combobox">
                                                <div class="inner show" role="listbox" aria-expanded="false"
                                                     tabindex="-1">
                                                    <ul class="dropdown-menu inner show"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="search-results">
                        @include('projects.search')
                    </div>
                    <input type="hidden" id="currentSearch" value="1">
                </div>
            </div>
        </div>
    </section>

    {{--    Location Modal--}}
    @include('projects.partials.location_modal')
@endsection

@section('footer')
    <script>
        function getData(data = [], query = false, string = '') {
            $.post({
                url: "/projects/listings",
                data: query ? string : $.param(data),
                error: function (err) {
                    console.log("ERROR: ", err);
                },
                success: function (res) {
                    $("#search-results").empty().html($(res).find('#results-data'));
                },
            });
        }

        function CreateCustomActivityLog() {
            var pageVisitSeconds = 0
            window.setInterval(function () {
                pageVisitSeconds++;
                console.log("pageVisitSeconds -> ", pageVisitSeconds);
            }, 1000);

            $(window).on("beforeunload", function () {
                let params = {
                    log_name: GetActivityLogNames.viewProject,
                    log_table: "projects",
                    description: "View Project List",
                    subject_type: "App\Models\Project",
                    page_url: window.location.href,
                    duration_in_second: pageVisitSeconds,
                };
                CallLaravelAction("/create/custom-activity-log", params, function (response) {
                    console.log(JSON.stringify("response.status"));
                });
            });
        }
    </script>

    @include('projects.scripts.search_fields_with_select2_script')
    @include('projects.scripts.search_and_housing_calculator_script')
@endsection
