@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')
@section('content')
    <div id="app"></div>
    <input type="hidden" value="" id="btn-link-project-detail">
    
    <!-- PHP Helper Function for Image Paths -->
    @php
        function fixImagePath($path) {
            if (empty($path)) return asset('assets/images/no_image_project.png');
            
            // Fix common incorrect paths
            if (strpos($path, 'projects/uploads/') === 0) {
                $path = str_replace('projects/uploads/', 'uploads/', $path);
            } elseif (strpos($path, 'projects/assets/') === 0) {
                $path = str_replace('projects/assets/', 'assets/', $path);
            } elseif (strpos($path, '/projects/uploads/') !== false) {
                $path = str_replace('/projects/uploads/', '/uploads/', $path);
            } elseif (strpos($path, '/projects/assets/') !== false) {
                $path = str_replace('/projects/assets/', '/assets/', $path);
            }
            
            return asset($path);
        }
    @endphp
    
    <!-- ULTRA-AGGRESSIVE IMAGE FIX - RUNS BEFORE ANYTHING ELSE -->
    <script>
    (function() {
        'use strict';
        
        // 1. INTERCEPT NETWORK REQUESTS
        const originalFetch = window.fetch;
        window.fetch = function(url, options) {
            if (typeof url === 'string' && url.includes('/projects/')) {
                url = url.replace('/projects/uploads/', '/uploads/').replace('/projects/assets/', '/assets/');
            }
            return originalFetch.call(this, url, options);
        };
        
        // 2. INTERCEPT XMLHttpRequest
        const originalXHROpen = XMLHttpRequest.prototype.open;
        XMLHttpRequest.prototype.open = function(method, url, async, user, password) {
            if (typeof url === 'string' && url.includes('/projects/')) {
                url = url.replace('/projects/uploads/', '/uploads/').replace('/projects/assets/', '/assets/');
            }
            return originalXHROpen.call(this, method, url, async, user, password);
        };
        
        // 3. INTERCEPT ALL IMAGE CREATION
        const originalCreateElement = document.createElement;
        document.createElement = function(tagName) {
            const element = originalCreateElement.call(this, tagName);
            if (tagName.toLowerCase() === 'img') {
                // Override ALL possible ways to set src
                const originalSetAttribute = element.setAttribute;
                element.setAttribute = function(name, value) {
                    if (name === 'src' && value.includes('/projects/')) {
                        value = value.replace('/projects/uploads/', '/uploads/').replace('/projects/assets/', '/assets/');
                    }
                    return originalSetAttribute.call(this, name, value);
                };
                
                // Override src property
                let _src = '';
                Object.defineProperty(element, 'src', {
                    get: function() { return _src; },
                    set: function(value) {
                        if (value.includes('/projects/')) {
                            value = value.replace('/projects/uploads/', '/uploads/').replace('/projects/assets/', '/assets/');
                        }
                        _src = value;
                        element.setAttribute('src', value);
                    }
                });
            }
            return element;
        };
        
        // 4. FIX ALL EXISTING IMAGES IMMEDIATELY
        function fixAllImages() {
            const images = document.querySelectorAll('img');
            images.forEach(function(img) {
                let src = img.src || img.getAttribute('src') || img.getAttribute('data-src');
                if (src && src.includes('/projects/')) {
                    const fixedSrc = src.replace('/projects/uploads/', '/uploads/').replace('/projects/assets/', '/assets/');
                    img.src = fixedSrc;
                    img.setAttribute('src', fixedSrc);
                }
                
                img.onerror = function() {
                    this.src = '/assets/images/no_image_project.png';
                };
            });
        }
        
        // 5. RUN IMMEDIATELY AND AGGRESSIVELY
        fixAllImages();
        setTimeout(fixAllImages, 0);
        setTimeout(fixAllImages, 1);
        setTimeout(fixAllImages, 5);
        setTimeout(fixAllImages, 10);
        setTimeout(fixAllImages, 25);
        setTimeout(fixAllImages, 50);
        setTimeout(fixAllImages, 100);
        setTimeout(fixAllImages, 250);
        setTimeout(fixAllImages, 500);
        setTimeout(fixAllImages, 1000);
        
        // 6. WATCH FOR ALL CHANGES
        const observer = new MutationObserver(function() {
            fixAllImages();
        });
        observer.observe(document.documentElement, { 
            childList: true, 
            subtree: true, 
            attributes: true,
            attributeFilter: ['src', 'data-src']
        });
        
        // 7. RUN ON ALL EVENTS
        document.addEventListener('DOMContentLoaded', fixAllImages);
        window.addEventListener('load', fixAllImages);
        document.addEventListener('readystatechange', fixAllImages);
        
    })();
    </script>
    
    <!-- Listing Grid View -->
    <section class="our-listing bgc-f7 pb30-991">
        <div class="container">

            {{-- Mobile Search--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="listing_sidebar dn db-991">
                        <div class="sidebar_content_details style3">
                            <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
                            <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
                                <div class="sidebar_advanced_search_widget">
                                    <h4 class="mb25 search_heading">Advanced Search <a
                                            class="filter_closed_btn float-right float" href="javascript:void(0)"><small>Hide
                                                Filter</small> <span class="flaticon-close"></span></a></h4>
                                    <div class="container-fluid">
                                        <div class="row">

                                            <div class="col-md-12" style="padding:0px;">
                                                <nav>
                                                    <div class="nav nav-tabs listing_tab_mob nav-fill" id="nav-tab"
                                                         role="tablist">
                                                        <button
                                                            class="nav-item nav-link listing_tab_link_mob active custom-tab2"
                                                            id="nav-mob1-tab" data-toggle="tab" role="tab"
                                                            aria-controls="nav-mob1" aria-selected="true">Search Filter
                                                        </button>
                                                        <button
                                                            class="nav-item nav-link listing_tab_link_mob custom-tab2"
                                                            id="nav-mob2-tab" data-toggle="tab" role="tab"
                                                            aria-controls="nav-mob2" aria-selected="false">Housing
                                                            Calculator
                                                        </button>

                                                    </div>
                                                </nav>

                                                <div class="tab-content" id="nav-tabContent">


                                                    <div class="tab-pane fade show active" id="nav-mob1" role="tabpanel"
                                                         aria-labelledby="nav-mob1-tab">
                                                        <form id="searchFilterForm" action="/projects/listings"
                                                              method="POST">
                                                            @csrf
                                                            <ul class="sasw_list mb0">
                                                                <li>
                                                                    <div class="search_option_two">
                                                                        <div class="candidate_revew_select">
                                                                            <h5 class="search_heading">Project Name</h5>
                                                                            <select class="selectpicker w100 show-tick"
                                                                                    data-actions-box="true"
                                                                                    data-done-button="true"
                                                                                    name="project_name[]" multiple multiple
                                                                                    data-live-search="true"
                                                                                    data-live-search-placeholder="Search">
                                                                                <option disabled value="">Select Project Name
                                                                                </option>
                                                                                @if(isset($allProjects) && !$allProjects->isEmpty())
                                                                                    @foreach ($allProjects as $project)
                                                                                        <?php $selected = (isset($projectId) && $projectId == $project->id) ? 'selected' : ''; ?>
                                                                                        <option {{ $selected }} value="{{ $project->id }}">
                                                                                            {{ $project->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @else
                                                                                    <option disabled>No projects available</option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="search_option_two">
                                                                        <div class="candidate_revew_select">
                                                                            <h5 class="search_heading">Area</h5>
                                                                            <select class="selectpicker w100 show-tick"
                                                                                    data-actions-box="true"
                                                                                    data-done-button="true"
                                                                                    placeholder="Location" name="area[]"
                                                                                    multiple multiple
                                                                                    data-live-search="true"
                                                                                    data-live-search-placeholder="Search">
                                                                                <option disabled value="">Select Areas
                                                                                </option>
                                                                                @foreach ($areas as $area)
                                                                                    <option value="{{ $area->id }}"
                                                                                            data-tokens="{{ $area->name }}"
                                                                                            @if (isset($searchData['area']) && $searchData['area']) @foreach ($searchData['area'] as $searcharea) @if ($area->id == $searcharea)
                                                                                            selected @endif
                                                                                        @endforeach
                                                                                        @endif
                                                                                    >
                                                                                        {{ $area->name }}


                                                                                    </option>


                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="search_option_two">
                                                                        <div class="candidate_revew_select">
                                                                            <h5 class="search_heading">Project Type</h5>
                                                                            <select class="selectpicker w100 show-tick"
                                                                                    data-actions-box="true"
                                                                                    data-done-button="true"
                                                                                    name="type_id[]" multiple multiple
                                                                                    data-live-search="true"
                                                                                    data-live-search-placeholder="Search">
                                                                                <option disabled value="">Select Project
                                                                                    Type
                                                                                </option>
                                                                                @foreach ($projectTypes as $projectType)
                                                                                    <option
                                                                                        value="{{ $projectType->id }}"
                                                                                        data-tokens="{{ $projectType->title }}"
                                                                                        @if ($searchData['type_id']) @foreach ($searchData['type_id'] as $searchtype) @if ($projectType->id == $searchtype)
                                                                                        selected @endif
                                                                                        @endforeach
                                                                                        @endif
                                                                                    >
                                                                                        {{ $projectType->title }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="search_option_two">
                                                                        <div class="candidate_revew_select">
                                                                            <h5 class="search_heading">Progress</h5>
                                                                            <select class="selectpicker w-100"
                                                                                    name="progress[]"
                                                                                    data-actions-box="true"
                                                                                    data-done-button="true" multiple
                                                                                    multiple data-live-search="true"
                                                                                    data-live-search-placeholder="Search">
                                                                                @foreach ($progress as $prog)
                                                                                    <option
                                                                                        value="{{ $prog->progress_status_name }}">
                                                                                        {{ $prog->progress_status_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="search_option_two">
                                                                        <div class="candidate_revew_select">
                                                                            <h5 class="search_heading">Builder</h5>
                                                                            <select class="selectpicker w100 show-tick"
                                                                                    data-actions-box="true"
                                                                                    name="builder[]"
                                                                                    data-done-button="true" multiple
                                                                                    multiple multiple
                                                                                    data-live-search="true"
                                                                                    data-live-search-placeholder="Search">
                                                                                @foreach ($builders as $blder)
                                                                                    <option value="{{ $blder->id }}"
                                                                                            @foreach($blderIDs as $blderID) @if($blder->id == $blderID) selected
                                                                                        @endif
                                                                                        @endforeach
                                                                                    >
                                                                                        {{ $blder->full_name }}
                                                                                    </option>


                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="min_area list-inline-item">
                                                                    <div class="form-group">
                                                                        <h5 class="search_heading">Min Down Payment</h5>
                                                                        <input type="text" min="0" class="form-control"
                                                                               name="minDP"
                                                                               value="{{ $searchData['minDP'] }}">
                                                                    </div>
                                                                </li>
                                                                <li class="max_area list-inline-item">
                                                                    <div class="form-group">
                                                                        <h5 class="search_heading">Max Down Payment</h5>
                                                                        <input type="text" min="0" class="form-control"
                                                                               name="maxDP"
                                                                               value="{{ $searchData['maxDP'] }}">
                                                                        <input type="text" min="0" id="downPayment1"
                                                                               style="display:none"
                                                                               value="{{ $downPayment }}">
                                                                    </div>
                                                                </li>

                                                                <li class="min_area list-inline-item">
                                                                    <div class="form-group">
                                                                        <h5 class="search_heading">Min Monthly
                                                                            Installment</h5>
                                                                        <input type="text" min="0" class="form-control"
                                                                               name="minMI"
                                                                               value="{{ $searchData['minMI'] }}">
                                                                    </div>
                                                                </li>
                                                                <li class="max_area list-inline-item">
                                                                    <div class="form-group">
                                                                        <h5 class="search_heading">Max Monthly
                                                                            Installment</h5>
                                                                        <input type="text" min="0" class="form-control"
                                                                               name="maxMI"
                                                                               value="{{ $searchData['maxMI'] }}">
                                                                    </div>
                                                                </li>

                                                                <li class="min_area list-inline-item">
                                                                    <div class="form-group">
                                                                        <h5 class="search_heading">Min Price</h5>
                                                                        <input type="text" class="form-control"
                                                                               name="minPrice"
                                                                               value="{{ $searchData['minPrice'] }}">
                                                                    </div>
                                                                </li>
                                                                <li class="max_area list-inline-item">
                                                                    <div class="form-group">
                                                                        <h5 class="search_heading">Max Price</h5>
                                                                        <input type="text" min="0" class="form-control"
                                                                               name="maxPrice"
                                                                               value="{{ $searchData['maxPrice'] }}">
                                                                        <input type="text" min="0" id="maxBudget1"
                                                                               style="display:none"
                                                                               value="{{ $searchData['maxBudget'] }}">
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="search_option_two">
                                                                        <div class="candidate_revew_select">
                                                                            <h5 class="search_heading">Tags</h5>
                                                                            <select class="selectpicker w100 show-tick"
                                                                                    data-actions-box="true"
                                                                                    data-done-button="true"
                                                                                    name="tag_id[]" multiple multiple
                                                                                    data-live-search="true"
                                                                                    data-live-search-placeholder="Search">
                                                                                <option disabled value="">Select Project
                                                                                    Tags
                                                                                </option>
                                                                                @foreach ($tags as $tag)
                                                                                    <option value="{{ $tag->id }}"
                                                                                            data-tokens="{{ $tag->name }}"
                                                                                            @if ($searchData['tag_id']) @foreach ($searchData['tag_id'] as $searchtag) @if ($tag->id == $searchtag)
                                                                                            selected @endif
                                                                                        @endforeach
                                                                                        @endif
                                                                                    >
                                                                                        {{ $tag->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="search_option_button">
                                                                        <button type="submit"
                                                                                id="searchFilterFormSubmit"
                                                                                class="btn btn-block btn-thm">Search
                                                                        </button>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-mob2" role="tabpanel"
                                                         aria-labelledby="nav-mob2-tab">


                                                        <div class="col-md-12">
                                                            <!-- <form id="searchFilterForm" action="/projects/listings" method="POST"> -->
                                                            @csrf
                                                            <img
                                                                src="http://markproperties.pk/projects/wp-content/uploads/2021/03/download.png"
                                                                class="img-responsive gar1 cal_img">
                                                            <div class="cal-colum">
                                                                <h5 class="ttl2">My Budget</h5>
                                                                <h5 class="rem-price1 results"
                                                                    id="cal-result1">{{ $searchData['maxBudget'] ?? 0}}</h5>
                                                            </div>
                                                            <br>

                                                            <!-- <button type="submit" class="btn btn-block btn-thm">Search</button> -->
                                                            <!-- </form> -->
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-12 project_type project_type_const">
                                                                <div class="tab-cal col-6 " style="padding: 0;">
                                                                    <button id="defaultOpen" val1="Buy"
                                                                            class="tablinks active">FLAT
                                                                    </button>
                                                                </div>

                                                                <div class="tab-cal col-6"
                                                                     style="padding: 0; float:right;">
                                                                    <button id="defaultOpen" val1="Rent"
                                                                            class="tablinks" margin-left: -21px; *
                                                                    /">CONSTRUCTION</button>
                                                                </div>


                                                            </div>

                                                        </div>

                                                        <div class="col-sm-12 p0">
                                                            <div class="project_type">
                                                                <div class="construction_options hide">
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">

                                                                                <input type="tel"
                                                                                       class="form-control number"
                                                                                       placeholder="Slab Casting">
                                                                                <br>
                                                                            </div>
                                                                            <div class="col-sm-12">

                                                                                <input type="tel"
                                                                                       class="form-control number"
                                                                                       placeholder="Plinth">
                                                                                <br>
                                                                            </div>

                                                                            <div class="col-sm-12">

                                                                                <input type="tel"
                                                                                       class="form-control number"
                                                                                       placeholder="Colour">
                                                                                <br>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>


                                                            <div>
                                                                <div class="search_option_two areaSelect">
                                                                    <div class="candidate_revew_select">
                                                                        <select id="areaSelectDivMob" data-all="false"
                                                                                class="selectpicker w100 show-tick"
                                                                                data-actions-box="true"
                                                                                data-done-button="true" name="area[]"
                                                                                multiple data-live-search="true"
                                                                                data-live-search-placeholder="Search">

                                                                            <option disabled value="">Select Areas
                                                                            </option>
                                                                            @foreach ($areas as $area)
                                                                                <option value="{{ $area->id }}"
                                                                                        data-tokens="{{ $area->name }}"
                                                                                        @if ($searchData['area']) @foreach ($searchData['area'] as $searcharea) @if ($area->id == $searcharea) selected @endif
                                                                                    @endforeach
                                                                                    @endif
                                                                                >
                                                                                    {{ $area->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="tel" class="form-control number1 number"
                                                                   name="maxPrice" id="down_payment1"
                                                                   placeholder="Down Payment">

                                                        </div>

                                                        <input class="down_payment_checkbox cal_split_txt"
                                                               type="checkbox" value="split">
                                                        <label class="cal_split_txt"> Split Down Payment ?</label>

                                                        <div class="project_type col-12">
                                                            <div class="down_payment_options hide">
                                                                <div class="row">

                                                                    <input type="tel"
                                                                           class="cal_input form-control number Booking1"
                                                                           placeholder="Booking">


                                                                    <input type="tel"
                                                                           class="cal_input form-control number allocation1"
                                                                           placeholder="Allocation">

                                                                </div>

                                                                <div class="row">

                                                                    <input type="tel"
                                                                           class="cal_input form-control number confirmation1"
                                                                           placeholder="Confirmation">


                                                                    <input type="tel"
                                                                           class="cal_input form-control number start_of_work1"
                                                                           placeholder="Start of Work">

                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div>
                                                            <div class="search_option_two areaSelect">
                                                                <div class="candidate_revew_select">
                                                                    <select id="areaSelectDivMob" data-all="false"
                                                                            class="selectpicker w100 show-tick"
                                                                            data-actions-box="true" name="months[]">
                                                                        <option> Please Select</option>
                                                                        <option value="1" m="1" q="0" h="0" y="0">1
                                                                            Months
                                                                        </option>
                                                                        <option value="3" m="3" q="1" h="0" y="0">3
                                                                            Months
                                                                        </option>
                                                                        <option value="6" m="6" q="2" h="1" y="0">6
                                                                            Months
                                                                        </option>
                                                                        <option value="9" m="9" q="3" h="1" y="0">9
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

                                                        <input type="tel" class="cal_input number1 number"
                                                               id="Monthly_Installment1"
                                                               placeholder="Monthly Installment">
                                                        <input type="tel" class="cal_input number1 number"
                                                               id="Quarterly_Installment1"
                                                               placeholder="Quarterly Installment">
                                                        <input type="tel" class="cal_input number1 number"
                                                               id="Half_Yearly_Installment1"
                                                               placeholder="Half Yearly Installment">
                                                        <input type="tel" class="cal_input number1 number"
                                                               id="Yearly_Installment1"
                                                               placeholder="Yearly Installment">
                                                        <input type="tel" class="cal_input number1 number"
                                                               id="Possession1" placeholder="Possession">
                                                        <div class="required-msg1">Down payment is required!</div>
                                                        <input id="calculate1" class="btn cal_btn" type="button"
                                                               value="Projects in this Budget">


                                                    </div>

                                                </div>


                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb_content style2 mb0-991">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active text-thm" aria-current="page">Projects</li>
                        </ol>
                        <h2 class="breadcrumb_title">Projects</h2>
                        <div class="dn db-991 mt30 mb0">
                            <div id="main2">
                            <span id="open2" class="flaticon-filter-results-button filter_open_btn style2"> Show
                                Filter</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                {{-- Desktop Search --}}
                <div class="col-lg-4 col-xl-4">
                    <div class="sidebar_listing_grid1 dn-991">

                        <div class="sidebar_listing_list">
                            <nav class="">
                                <div class="nav nav-tabs listing_tab nav-fill" id="nav-tab" role="tablist">
                                    <button class="nav-item nav-link listing_tab_link active custom-tab"
                                            id="nav-home-tab"
                                            data-toggle="tab" role="tab" aria-controls="nav-home" aria-selected="true">
                                        Search Filter
                                    </button>
                                    <button class="nav-item nav-link listing_tab_link custom-tab" id="nav-profile-tab"
                                            data-toggle="tab" role="tab" aria-controls="nav-profile"
                                            aria-selected="false">
                                        Housing Calculator
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                     aria-labelledby="nav-profile-tab">
                                    <div class="sidebar_advanced_search_widget">
                                        <div class="sidebar_sidebar_search_widget">
                                            <div class="col-md-12 p0">
                                                @csrf
                                                <img
                                                    src="http://markproperties.pk/projects/wp-content/uploads/2021/03/download.png"
                                                    class="img-responsive gar1 cal_img">
                                                <div class="cal-colum">
                                                    <h5 class="ttl2">My Budget</h5>
                                                    <h5 class="rem-price1 results"
                                                        id="cal-result">{{ $searchData['maxBudget'] ?? 0}}</h5>
                                                </div>
                                                <br>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-12 project_type project_type_const">
                                                    <div class="tab-cal col-6" style="padding: 0;">
                                                        <button id="defaultOpen" val1="Buy" class="tablinks active">
                                                            FLAT
                                                        </button>
                                                    </div>

                                                    <div class="tab-cal col-6" style="padding: 0; float:right;">
                                                        <button id="defaultOpen" val1="Rent" class="tablinks">
                                                            CONSTRUCTION
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>
                                            <div class="col-sm-12 p0">
                                                <div class="project_type">
                                                    <div class="construction_options hide">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-12">

                                                                    <input type="tel" class="form-control number"
                                                                           placeholder="Slab Casting">
                                                                    <br>
                                                                </div>
                                                                <div class="col-sm-12">

                                                                    <input type="tel" class="form-control number"
                                                                           placeholder="Plinth">
                                                                    <br>
                                                                </div>

                                                                <div class="col-sm-12">

                                                                    <input type="tel" class="form-control number"
                                                                           placeholder="Colour">
                                                                    <br>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div>

                                                <div class="search_option_two areaSelect">
        <div class="candidate_revew_select">
            <select id="areaSelectDiv" data-all="false"
                    class="selectpicker w100 show-tick"
                    data-actions-box="true"
                    data-done-button="true"
                    name="area[]"
                    multiple
                    data-live-search="true"
                    data-live-search-placeholder="Search Areas"
                    title="Please Select">
                <option value="" disabled selected>Please Select</option>
                <option value="all" data-tokens="all">Select All</option>
                <option value="none" data-tokens="none">Deselect All</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}"
                            data-tokens="{{ $area->name }}"
                            @if (isset($searchData['area']) && isset($searchData['calcSearch']) && $searchData['area'] && $searchData['calcSearch'])
                                @foreach ($searchData['area'] as $searcharea)
                                    @if ($area->id == $searcharea) selected @endif
                                @endforeach
                            @endif
                    >
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
                                                </div>


                                                <input type="tel" class="form-control number1 number" name="maxPrice"
                                                       id="down_payment"
                                                       placeholder="Down Payment">

                                            </div>

                                            <input class="down_payment_checkbox cal_split_txt" type="checkbox"
                                                   value="split">
                                            <label class="cal_split_txt"> Split Down Payment ?</label>

                                            <div class="project_type col-sm-12">
                                                <div class="down_payment_options hide">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <input type="tel" class="form-control number Booking"
                                                                   placeholder="Booking">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="tel" class="form-control number allocation"
                                                                   placeholder="Allocation">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <input type="tel" class="form-control number confirmation"
                                                                   placeholder="Confirmation">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="tel" class="form-control number start_of_work"
                                                                   placeholder="Start of Work">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div>
                                                <div class="search_option_two areaSelect">
                                                    <div class="candidate_revew_select">
                                                        <select id="duration_month" data-all="false"
                                                                class="selectpicker w100 show-tick"
                                                                data-actions-box="true" data-done-button="true"
                                                                name="month">
                                                            <option disabled value=""> Select Months</option>
                                                            <option value="1" m="1" q="0" h="0" y="0">1
                                                                Months
                                                            </option>
                                                            <option value="3" m="3" q="1" h="0" y="0">3
                                                                Months
                                                            </option>
                                                            <option value="6" m="6" q="2" h="1" y="0">6
                                                                Months
                                                            </option>
                                                            <option value="9" m="9" q="3" h="1" y="0">9
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


                                            <input type="tel" class="cal_input number1 number" id="Monthly_Installment"
                                                   placeholder="Monthly Installment">
                                            <input type="tel" class="cal_input number1 number"
                                                   id="Quarterly_Installment" placeholder="Quarterly Installment">
                                            <input type="tel" class="cal_input number1 number"
                                                   id="Half_Yearly_Installment" placeholder="Half Yearly Installment">
                                            <input type="tel" class="cal_input number1 number" id="Yearly_Installment"
                                                   placeholder="Yearly Installment">
                                            <input type="tel" class="cal_input number1 number" id="Possession"
                                                   placeholder="Possession">
                                            <div class="required-msg">Down Payment is required!</div>
                                            <input id="calculate" class="btn cal_btn disable-btn" type="button"
                                                   value="Projects in this Budget" disabled>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="sidebar_advanced_search_widget">
                                        <form id="searchFilterForm" action="/projects/listings" method="POST">
                                            @csrf
                                            <ul class="sasw_list mb0">
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <h5 class="search_heading">Project Name</h5>
                                                            <select id="divProjectName" data-selected-text-format="count>2" data-all="false" class="selectpicker w100 show-tick" data-actions-box="true" data-done-button="true" name="project_name[]" multiple data-live-search="true" data-live-search-placeholder="Search">
                                                                <option disabled value="">Select Project Name</option>
                                                                @if(isset($allProjects) && !$allProjects->isEmpty())
                                                                    @foreach ($allProjects as $project)
                                                                        <option value="{{ $project->id }}" 
                                                                                @if($searchData['project_name'] && in_array($project->id, $searchData['project_name'])) selected @endif>
                                                                            {{ $project->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @else
                                                                    <option disabled>No projects available</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <h5 class="search_heading">Area</h5>
                                                            <select id="divRatings" data-selected-text-format="count>2" data-all="false" class="selectpicker w100 show-tick" data-actions-box="true" data-done-button="true" placeholder="Location" name="area[]" multiple data-live-search="true" data-live-search-placeholder="Search">
                                                                <option disabled value="">Select Areas</option>
                                                                @foreach ($areas as $area)
                                                                    <option value="{{ $area->id }}" data-tokens="{{ $area->name }}" 
                                                                            @if($searchData['area'] && in_array($area->id, $searchData['area'])) selected @endif>
                                                                        {{ $area->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <h5 class="search_heading">Project Type</h5>
                                                            <select id="divRatings2" data-selected-text-format="count>2" data-all="false" class="selectpicker w100 show-tick" data-actions-box="true" data-done-button="true" name="type_id[]" multiple data-live-search="true" data-live-search-placeholder="Search">
                                                                <option disabled value="">Select Project Type</option>
                                                                @foreach ($projectTypes as $projectType)
                                                                    <option value="{{ $projectType->id }}" data-tokens="{{ $projectType->title }}" 
                                                                            @if($searchData['type_id'] && in_array($projectType->id, $searchData['type_id'])) selected @endif>
                                                                        {{ $projectType->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <h5 class="search_heading">Progress</h5>
                                                            <select id="divprogress" data-selected-text-format="count>2" data-all="false" class="selectpicker w100 show-tick" data-actions-box="true" data-done-button="true" name="progress[]" multiple>
                                                                <option disabled value="">Progress</option>
                                                                @foreach ($progress as $progress)
                                                                    <option value="{{ $progress->progress_status_name }}" data-tokens="{{ $progress->progress_status_name }}" 
                                                                            @if($searchData['progress'] && in_array($progress->progress_status_name, $searchData['progress'])) selected @endif>
                                                                        {{ $progress->progress_status_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <h5 class="search_heading">Builder</h5>
                                                            <select id="divbuilder" data-selected-text-format="count>2" data-all="false" class="selectpicker w100 show-tick" data-done-button="true" data-actions-box="true" name="builder[]" multiple data-live-search="true" data-live-search-placeholder="Search">
                                                                @foreach ($builders as $blder)
                                                                    <option value="{{ $blder->id }}" 
                                                                            @if($searchData['builder'] && in_array($blder->id, $searchData['builder'])) selected @endif>
                                                                        {{ $blder->full_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-group">
                                                        <h5 class="search_heading">Min Down Payment</h5>
                                                        <input type="text" min="0" class="form-control" name="minDP" value="{{ $searchData['minDP'] ?? '' }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <h5 class="search_heading">Max Down Payment</h5>
                                                        <div id="minDownError" class="hide">value should be greater than Min Down Payment</div>
                                                        <input type="text" min="0" class="form-control" name="maxDP" value="{{ $searchData['maxDP'] ?? '' }}">
                                                        <input type="text" min="0" id="downPayment" style="display:none" value="{{ $searchData['downPayment'] ?? '' }}">
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-group">
                                                        <h5 class="search_heading">Min Monthly Installment</h5>
                                                        <input type="text" min="0" class="form-control" name="minMI" value="{{ $searchData['minMI'] ?? '' }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <h5 class="search_heading">Max Monthly Installment</h5>
                                                        <div id="minMonthlyError" class="hide">value should be greater than Min Monthly Installment</div>
                                                        <input type="text" min="0" class="form-control" name="maxMI" value="{{ $searchData['maxMI'] ?? '' }}">
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-group">
                                                        <h5 class="search_heading">Min Price</h5>
                                                        <input type="text" min="0" class="form-control" name="minPrice" value="{{ $searchData['minPrice'] ?? '' }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-group">
                                                        <h5 class="search_heading">Max Price</h5>
                                                        <div id="minPriceError" class="hide">value should be greater than Min Price</div>
                                                        <input type="text" min="0" class="form-control" name="maxPrice" value="{{ $searchData['maxPrice'] ?? '' }}">
                                                        <input type="text" min="0" id="maxBudget" style="display:none" value="{{ $searchData['maxBudget'] ?? '' }}">
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_two">
                                                        <div class="candidate_revew_select">
                                                            <h5 class="search_heading">Tags</h5>
                                                            <select id="divtag" data-selected-text-format="count>2" data-all="false" class="selectpicker w100 show-tick" data-actions-box="true" data-done-button="true" name="tag_id[]" multiple data-live-search="true" data-live-search-placeholder="Search">
                                                                <option disabled value="">Select Project Tags</option>
                                                                @foreach ($tags as $tag)
                                                                    <option value="{{ $tag->id }}" data-tokens="{{ $tag->name }}" 
                                                                            @if($searchData['tag_id'] && in_array($tag->id, $searchData['tag_id'])) selected @endif>
                                                                        {{ $tag->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="search_option_button">
                                                        <div class="required-msg2"> Area is required!</div>
                                                        <button type="submit" id="searchFilterFormSubmit1" @if(!$searchData['area'] || empty($searchData['area'])) disabled class="btn btn-block btn-thm disable-btn" @else class="btn btn-block btn-thm" @endif>Search</button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($recent_view_data)
                            <div class="terms_condition_widget">
                                <h4 class="title search_heading">Recently Viewed</h4>
                                <div class="sidebar_feature_property_slider">
                                    @foreach ($recent_view_data as $r_project)
                                        <div class="item">
                                            <div class="feat_property home7 agent">
                                                <div class="thumb">
                                                    <img class="img-whp"
                                                         src="/{{ $r_project->project ? $r_project->project->project_cover_img : '' }}"
                                                         alt="{{ $r_project->project ? $r_project->project->name : '' }}">
                                                    <div class="thmb_cntnt">
                                                        <a class="fp_price" href="#">
                                                            <?php
                                                            $minimumProjectUnitPrice = 0;
                                                            if (count($r_project->project->units)) {
                                                                $minimumProjectUnitPrice = $r_project->project->units->min("total_unit_amount");
                                                            }
                                                            ?>
                                                            Starting from
                                                            Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}
                                                        </a>
                                                        <h4 class="posr color-white">{{ $r_project->project ? $r_project->project->name : '' }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-8">
                    <div class="grid_list_search_result">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="left_area tac-xsd">
                                <p id="searchCount">Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }}
                                    of {{ $projects->total() }} results</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

                            <div class="right_area text-right tac-xsd">
                                <ul>

                                    <li class="list-inline-item"><span class="shrtby">Sort by:</span>
                                        <div class="dropdown bootstrap-select show-tick">
                                            <select id="reseller_id" class="selectpicker show-tick" tabindex="-98"
                                                    name="reseller_id">
                                                <option value="default">Select</option>

                                                <option value="Latest" <?php

                                                    use Illuminate\Support\Facades\Config;

                                                    if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Latest") echo 'selected=""'; ?>>
                                                    Latest
                                                </option>
                                                <option
                                                    value="Oldest" <?php if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Oldest") echo 'selected=""'; ?>>
                                                    Oldest
                                                </option>
                                                <option
                                                    value="popularity" <?php if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Oldest") echo 'selected=""'; ?>>
                                                    By Popularity
                                                </option>
                                                <option
                                                    value="Highest_by_price" <?php if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Highest_by_price") echo 'selected=""'; ?>>
                                                    Highest By Price
                                                </option>
                                                <option
                                                    value="Lowest_by_price" <?php if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Lowest_by_price") echo 'selected=""'; ?>>
                                                    Lowest By Price
                                                </option>
                                                <option
                                                    value="Sort_by_progress" <?php if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Sort_by_progress") echo 'selected=""'; ?>>
                                                    By Progress
                                                </option>
                                                <option
                                                    value="Sort_by_area" <?php if (!empty($_POST['reseller_id']) && $_POST['reseller_id'] == "Sort_by_area") echo 'selected=""'; ?>>
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
                        <div class="col-lg-12">
                            @if(count($projects) > 0)
                                @foreach ($projects as $Pkey => $project)
                                    <?php $afterRedirect = "\/project/" . $project->slug ?>
                                    <div class="feat_property list project_data">
                                        <div class="thumb"
                                            @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'"
                                            @else class="btn-link-project-detail btn btn-thm float-right"
                                            onclick="OpenLoginRegisterModal('{{$afterRedirect}}')" @endif>

                                            @if ($project->project_cover_img)
                                                <img class="img-whp" src="{{ fixImagePath($project->project_cover_img) }}" alt="{{ $project->name }}" onerror="this.src='{{ asset('assets/images/no_image_project.png') }}'">
                                            @else
                                                <img class="img-whp" src="{{ asset('assets/images/no_image_project.png') }}" alt="Default Image">
                                            @endif
                                            <div class="ribbon">
                                                <div class="txt">
                                                    {{ $project->progress }}
                                                </div>
                                            </div>

                                            <a class="service-wishlist addressclickable" data-id="1" data-type="property" value="{{ $loop->index + 1 }}">
                                                <span id="lat{{ $loop->index + 1 }}" class="d-none lat">{{ $project->latitude }}</span>
                                                <span id="lon{{ $loop->index + 1 }}" class="d-none lon">{{ $project->longitude }}</span>
                                                <i class="fa fa-map-marker project_icon"></i>
                                            </a>
                                            <input type="hidden" class="project_id" value="{{ $project->id }}">
                                            @if (Auth::id())
                                                <a type="btn" class="add-to-wishlist-btn service-heart" data-id="1" data-type="property"><i class="fa fa-heart project_icon"></i></a>
                                            @else
                                                <a class="service-heart" data-id="1" data-toggle="modal" data-target=".bd-example-modal-lg" data-type="property"><i class="fa fa-heart project_icon"></i></a>
                                            @endif
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                                <div>
                                                    <h3 class="fp_price">
                                                        {{ $project->name }}
                                                    </h3>
                                                </div>
                                                <div class="dtls_headr">
                                                    <h4>
                                                        <?php
                                                        $minimumProjectUnitPrice = 0;
                                                        if (count($project->units)) {
                                                            $minimumProjectUnitPrice = $project->units->min("total_unit_amount");
                                                        }
                                                        ?>
                                                        Starting from
                                                        Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}
                                                    </h4>
                                                </div>
                                                <p class="text-builder">
                                                    By {{ $project->owners->first()->full_name ?? 'Unknown Owner' }}
                                                </p>
                                                <p class="text-thm">
                                                    <span>
                                                        @foreach ($project->units->unique('unit_type_id') as $unit)
                                                            <span>{{ optional($unit->type)->title }} </span>
                                                            @if($project->units->unique('unit_type_id')->count() > ($loop->index + 1))
                                                                <span>|</span>
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </p>
                                                <p class="project_location">
                                                    <span class="flaticon-placeholder"></span>
                                                    <span class="addressclickable" value="{{ $loop->index + 1 }}">
                                                        <span id="lat{{ $loop->index + 1 }}" class="d-none lat">{{ $project->latitude }}</span>
                                                        <span id="lon{{ $loop->index + 1 }}" class="d-none lon">{{ $project->longitude }}</span>
                                                        {!! Str::limit($project->address, 50) !!}
                                                    </span>
                                                </p>
                                                <p>
                                                    <span> {!! Str::limit($project->details, 125) !!}</span>
                                                </p>
                                                <span style="color: #ec1c24 !important; font-weight:900; font-size:14px;">
                                                    <br>
                                                    No. of views: {{ $project->views }}
                                                </span>
                                            </div>
                                            <div class="fp_footer search_option_button">
                                                @if (Auth::id())
                                                    <?php
                                                    $pageUrl = url('/') . "/compare/" . $project->id;
                                                    $arrActivityLogParams = [
                                                        "log_name" => Config::get("constants.CustomActivityLogs.compareProjectDetail.value"),
                                                        "log_table" => "projects",
                                                        "project_name" => $project->name,
                                                        "subject_type" => "App\\Models\\Project",
                                                        "subject_id" => $project->id,
                                                        "page_url" => $pageUrl,
                                                    ];
                                                    ?>
                                                    <button style="background-color:#fff; border:0px; cursor:pointer;"
                                                            class="float-left float-lg-left float-xl-left"
                                                            onclick='addClickToCompareActivityLog(<?php echo json_encode($arrActivityLogParams); ?>)'>
                                                        <img src="/assets/images/property/comparison_icon.png" width="35%">Compare
                                                    </button>
                                                @else
                                                    <a href="javascript:void(0)" onclick="OpenLoginRegisterModal('/compare/{{ $project->id }}')"
                                                    data-toggle="modal" data-target=".bd-example-modal-lg"
                                                    class="float-left float-lg-left float-xl-left">
                                                        <img src="/assets/images/property/comparison_icon.png" width="35%">Compare
                                                    </a>
                                                @endif
                                                @if (Auth::id())
                                                    <a href="/project/{{ $project->slug }}" target="_blank" class="btn btn-thm float-right float-lg-right">
                                                        View Details
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" onclick="OpenLoginRegisterModal('/project/{{ $project->slug }}')"
                                                    data-toggle="modal" class="btn-link-project-detail btn btn-thm float-right float-lg-right"
                                                    data-target=".bd-example-modal-lg">
                                                        View Details
                                                    </a>
                                                @endif
                                            </div>
                                            @if((int)$searchData['maxBudget'] > 0)
                                                @if(round((int)$project->units[0]->price) > (int)$searchData['maxBudget'])
                                                    <div style="padding: 0px 20px 0px;">Max Budget: <span class='bdg-line-through'>{{ $searchData['maxBudget'] }}</span> | Increase Max Budget</div>
                                                @endif
                                            @endif
                                            @if(strpos($_SERVER['REQUEST_URI'], 'downPayment'))
                                                @if(round((int)$project->units[0]->down_payment) > (int)$downPayment)
                                                    <div class="ft-dp">Down Payment: <span class='bdg-line-through'>{{ $downPayment }}</span> | Increase Down Payment</div>
                                                @endif
                                            @else
                                                @if($searchData['maxPrice'])
                                                    @if(round((int)$project->max_price) > (int)$searchData['maxPrice'])
                                                        <div class="ft-dp">Max Price: <span class='bdg-line-through'>{{ $searchData['maxPrice'] }}</span> | Increase Max Price</div>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="bdg-warning">
                                    <h3>Sorry, There are no active properties matching your criteria</h3>
                                </div>
                            @endif

                            @if ($projects->hasPages())
                                <div class="col-lg-12 mt20">
                                    <p>Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} results</p>
                                    <div class="mbp_pagination">
                                        <ul class="page_navigation">
                                            <!-- Previous page -->
                                            @if ($projects->onFirstPage())
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $projects->previousPageUrl() }}" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                                                </li>
                                            @endif
                                            <!-- Page 1 -->
                                            @if($projects->currentPage() >= 2)
                                                <li class="page-item"><a class="page-link" href="{{ $projects->url(1) }}">1</a></li>
                                            @endif
                                            <!-- Page 2 -->
                                            @if($projects->currentPage() > 2)
                                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                            @endif
                                            @foreach(range($projects->currentPage(), $projects->lastPage()) as $i)
                                                @if($i >= ($projects->currentPage() - 2) && $i <= ($projects->currentPage() + 2))
                                                    @if ($i == $projects->currentPage())
                                                        <li class="page-item active" aria-current="page">
                                                            <a class="page-link" href="#">{{ $i }} <span class="sr-only">(current)</span></a>
                                                        </li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $projects->url($i) }}">{{ $i }}</a></li>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if($projects->currentPage() < ($projects->lastPage() - 3))
                                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                            @endif
                                            @if($projects->currentPage() < ($projects->lastPage() - 2))
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $projects->url($projects->lastPage()) }}">{{ $projects->lastPage() }}</a>
                                                </li>
                                            @endif
                                            <!-- Next Page Link -->
                                            @if ($projects->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $projects->nextPageUrl() }}"><span class="flaticon-right-arrow"></span></a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#"><span class="flaticon-right-arrow"></span> Next</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal addressModal bd-example-modal-xl" id="addressModal" tabindex="-1" role="dialog"
         style="padding-top: 2%;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Location</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" id="iframe"></div>
                        <div class="col-sm-12 d-none">
                            <iframe width="100%" height="450" height="450" frameborder="0" style="border:0"
                                    src="https://www.google.com/maps/embed/v1/place?q=40.7127837,-74.0059413&amp;key=AIzaSyC07CvVyZNLAxycxXkMq64WWif3fkS0LE4"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
    <style>
        li.disabled {
            cursor: no-drop;
        }

        .active-btn-zoomer {
            transition: transform 0.9s;
            background: #ec1c24 !important;
            color: white !important;
        }

        .active-btn-zoomer {
            -ms-transform: scale(1.2);
            /* IE 9 */
            -webkit-transform: scale(1.2);
            /* Safari 3-8 */
            transform: scale(1.2);

        }
    </style>
@endsection

@section('footer')

    <script>
        $(document).ready(function () {

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
    </script>

    <script>
        $('#divbuilder').on('change', function () {
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val()) ? thisObj.val() : [];
            var allOptionsLength = thisObj.find('option[value!="All"]').length;

            console.log(selectedOptions);
            var selectedOptionsLength = selectedOptions.length;

            if (isAllSelected == lastAllSelected) {

                if ($.inArray("All", selectedOptions) >= 0) {
                    selectedOptionsLength -= 1;
                }

                if (allOptionsLength <= selectedOptionsLength) {

                    thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
                    isAllSelected = true;
                } else {
                    thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                    isAllSelected = false;
                }

            } else {
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }

            $(this).data('all', isAllSelected);
        }).trigger('change');
    </script>

    <script>
        $('#divtag').on('change', function () {
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val()) ? thisObj.val() : [];
            var allOptionsLength = thisObj.find('option[value!="All"]').length;

            console.log(selectedOptions);
            var selectedOptionsLength = selectedOptions.length;

            if (isAllSelected == lastAllSelected) {

                if ($.inArray("All", selectedOptions) >= 0) {
                    selectedOptionsLength -= 1;
                }

                if (allOptionsLength <= selectedOptionsLength) {

                    thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
                    isAllSelected = true;
                } else {
                    thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                    isAllSelected = false;
                }

            } else {
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }

            $(this).data('all', isAllSelected);
        }).trigger('change');
    </script>


    <script>
        $('#divprogress').on('change', function () {
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val()) ? thisObj.val() : [];
            var allOptionsLength = thisObj.find('option[value!="All"]').length;

            console.log(selectedOptions);
            var selectedOptionsLength = selectedOptions.length;

            if (isAllSelected == lastAllSelected) {

                if ($.inArray("All", selectedOptions) >= 0) {
                    selectedOptionsLength -= 1;
                }

                if (allOptionsLength <= selectedOptionsLength) {

                    thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
                    isAllSelected = true;
                } else {
                    thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                    isAllSelected = false;
                }

            } else {
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }

            $(this).data('all', isAllSelected);
        }).trigger('change');
    </script>

    <script>
        $('#divRatings2').on('change', function () {
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val()) ? thisObj.val() : [];
            var allOptionsLength = thisObj.find('option[value!="All"]').length;

            console.log(selectedOptions);
            var selectedOptionsLength = selectedOptions.length;

            if (isAllSelected == lastAllSelected) {

                if ($.inArray("All", selectedOptions) >= 0) {
                    selectedOptionsLength -= 1;
                }

                if (allOptionsLength <= selectedOptionsLength) {

                    thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
                    isAllSelected = true;
                } else {
                    thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                    isAllSelected = false;
                }

            } else {
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }

            $(this).data('all', isAllSelected);
        }).trigger('change');
    </script>

    <script>
        $('#divRatings').on('change', function () {
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val()) ? thisObj.val() : [];
            var allOptionsLength = thisObj.find('option[value!="All"]').length;

            console.log(selectedOptions);
            if (selectedOptions.length == 0) {
                $("#searchFilterFormSubmit1").addClass("disable-btn");
                $("#searchFilterFormSubmit1").attr("disabled", true);
                $(".required-msg2").removeClass("hide");
            } else {
                $("#searchFilterFormSubmit1").removeClass("disable-btn");
                $("#searchFilterFormSubmit1").removeAttr("disabled");
                $(".required-msg2").addClass("hide");
            }
            var selectedOptionsLength = selectedOptions.length;

            if (isAllSelected == lastAllSelected) {

                if ($.inArray("All", selectedOptions) >= 0) {
                    selectedOptionsLength -= 1;
                }

                if (allOptionsLength <= selectedOptionsLength) {

                    thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
                    isAllSelected = true;
                } else {
                    thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                    isAllSelected = false;
                }

            } else {
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }

            $(this).data('all', isAllSelected);
        }).trigger('change');

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

        function addClickToCompareActivityLog(objActivityLog) {
            // console.log("addClickToCompareActivityLog -> objActivityLog -> ", objActivityLog);
            ShowLoader();
            let params = objActivityLog;
            params.conversion_id = ConfigConstants.ActivityLogsConversionIds.clickToCompareId;
            params.description = "Compare " + params.project_name;
            CallLaravelAction("/create/custom-activity-log", params, function (response) {
                console.log("Insert compare project log");
                HideLoader();
                window.open(params.page_url, '_blank');
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#duration_month").on("change", function () {
                console.log("I m duration handler!!")
            })
            // $("#down_payment").val("");
            // $("#Monthly_Installment").val("");
            // $("#Quarterly_Installment").val("");
            // $("#Half_Yearly_Installment").val("");
            // $("#Yearly_Installment").val("");
            // $("#Possession").val("");
            let projectType = "Flat";
            let duration = "24 Months";
            // $("#phoneNumberModal").modal("show");
            filterPagination();
            historyStack();

            function searchProperties() {
                $("#search-results").html("");
                let token = $($("input[name='_token']")[0]).val();
                let budget = $("#cal-result").html().replaceAll(",", "");
                let monthInstall = $("#Monthly_Installment").val().replaceAll(",", "");
                let yearlyInstall = $("#Yearly_Installment").val().replaceAll(",", "");
                let halfYearlyInstall = $("#Half_Yearly_Installment").val().replaceAll(",", "");
                let quarterlyInstall = $("#Quarterly_Installment").val().replaceAll(",", "");
                let possession = $("#Possession").val().replaceAll(",", "");
                let downPayment = $("#down_payment").val() != "" ? $("#down_payment").val().replaceAll(",", "") : '0';
                let slabCasting = $($("input[placeholder='Slab Casting']")[1]).val().replaceAll(",", "");
                let plinth = $($("input[placeholder='Plinth']")[1]).val().replaceAll(",", "");
                let colour = $($("input[placeholder='Colour']")[1]).val().replaceAll(",", "");
                let areas = $("#areaSelectDiv").val();
                let sortBy = $("select[id='reseller_id']").val();
                let duration = $("#duration_month").val();

                budget = Number(budget);
                $.post({
                    url: "/projects/listings",
                    data: {
                        calculatorResult: true,
                        _token: token,
                        reseller_id: sortBy,
                        maxBudget: budget,
                        downPayment: downPayment,
                        monthInstall: monthInstall,
                        yearlyInstall: yearlyInstall,
                        halfYearlyInstall: halfYearlyInstall,
                        quarterlyInstall: quarterlyInstall,
                        possession: possession,
                        projectType: projectType,
                        duration: duration,
                        slabCasting,
                        plinth,
                        colour,
                        'area[]': areas,
                        calcSearch: true

                    },
                    error: function (err) {
                        console.log("Error", err);
                    },
                    success: function (res) {
                        $("#maxBudget").val(budget);
                        $("#downPayment").val(downPayment);
                        $("#search-results").html(res);
                    },
                });
            }

            $("#calculate").on("click", (e) => searchProperties());

            // Calculate request for Mobile
            $("#calculate1").on("click", (e) => {
                $("#search-results").html("");
                let token = $($("input[name='_token']")[0]).val();
                let budget = $("#cal-result1").html().replaceAll(",", "");
                let monthInstall = $("#Monthly_Installment1").val().replaceAll(",", "");
                let yearlyInstall = $("#Yearly_Installment1").val().replaceAll(",", "");
                let halfYearlyInstall = $("#Half_Yearly_Installment1").val().replaceAll(",", "");
                let quarterlyInstall = $("#Quarterly_Installment1").val().replaceAll(",", "");
                let possession = $("#Possession1").val().replaceAll(",", "");
                let downPayment = $("#down_payment1").val() != "" ? $("#down_payment1").val().replaceAll(",", "") : '0';
                let slabCasting = $($("input[placeholder='Slab Casting']")[0]).val();
                let plinth = $($("input[placeholder='Plinth']")[0]).val();
                let colour = $($("input[placeholder='Colour']")[0]).val();
                let areas = $("#areaSelectDivMob").val();

                budget = Number(budget);
                $.post({
                    url: "/projects/listings",
                    data: {
                        calculatorResult: true,
                        _token: token,
                        maxPrice: budget,
                        downPayment: downPayment,
                        monthInstall: monthInstall,
                        yearlyInstall: yearlyInstall,
                        halfYearlyInstall: halfYearlyInstall,
                        quarterlyInstall: quarterlyInstall,
                        possession: possession,
                        projectType: projectType,
                        duration: duration,
                        slabCasting,
                        plinth,
                        colour,
                        'area[]': areas,
                        calcSearch: true
                    },
                    error: function (err) {
                        console.log("Error", err);
                    },
                    success: function (res) {
                        $("#maxBudget1").val(budget);
                        $("#downPayment1").val(downPayment);
                        $("#search-results").html(res);
                        filterPagination()
                        $(".flaticon-close").click();
                    },
                });
            });

            // Intercept ANY calculator/search form submits to avoid full page reloads
            $(document).on('submit', '#searchFilterForm, #searchPropertiesWithFlat, #searchPropertiesWithConstruction', function (e) {
                e.preventDefault();
                // Prefer desktop calculator if present, otherwise mobile handler
                if ($('#cal-result').length) {
                    searchProperties();
                } else if (typeof budget !== 'undefined') {
                    // Fallback to mobile button logic
                    $("#calculate1").trigger('click');
                }
            });

            function sortBy(stack, sortByVal) {
                let domain = window.location.origin;
                let exits = `${domain}/projects/listings${stack}&reseller_id=${sortByVal}`;
                window.location.replace(exits)
            }

            function historyStack() {
                let searchData = @json($searchData);
                console.log("tagging", searchData);
                let stack = `?`;
                Object.keys(searchData).forEach((data, ind) => {
                    if (searchData[data] != null) {
                        if (data == 'downPayment') {
                            if (searchData[data] != '0') {
                                if (data == 'progress') {
                                    if (stack == "?") {
                                        stack += `${data}[]=${searchData[data]}`
                                    } else {
                                        stack += `&${data}[]=${searchData[data]}`
                                    }
                                } else {
                                    if (stack == "?") {
                                        stack += `${data}=${searchData[data]}`
                                    } else {
                                        stack += `&${data}=${searchData[data]}`
                                    }
                                }
                            }
                        } else {
                            if (data == 'progress') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (stack == "?") {
                                            stack += `progress[]=${val}`
                                        } else {
                                            stack += `&progress[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'area') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (stack == "?") {
                                            stack += `area[]=${val}`
                                        } else {
                                            stack += `&area[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'tag_id') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (stack == "?") {
                                            stack += `tag_id[]=${val}`
                                        } else {
                                            stack += `&${data}[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'type_id') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (stack == "?") {
                                            stack += `type_id[]=${val}`
                                        } else {
                                            stack += `&type_id[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'builder') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (stack == "?") {
                                            stack += `builder[]=${val}`
                                        } else {
                                            stack += `&builder[]=${val}`
                                        }
                                    })
                                }
                            } else {
                                if (stack == "?") {
                                    stack += `${data}=${searchData[data]}`
                                } else {
                                    stack += `&${data}=${searchData[data]}`
                                }
                            }
                        }
                    }
                })
                console.log("Search Stack ", stack)
                console.log("Search Stack to base64", btoa(stack))
                console.log("form tag ", $("select[id='reseller_id']"));
                $("select[id='reseller_id']").on('change', function () {
                    searchProperties();
                    return;
                })

                // history.pushState({}, "", `?q=${btoa(stack.split("?")[1])}`)

                history.pushState({}, "", stack)
            }

            function SessionPrams() {
                // event.preventDefault();
                let localStorageSessionParams = localStorage.getItems();
                Object.keys(searchData).forEach((data, ind) => {
                    if (searchData[data] != null) {
                        if (data == 'downPayment') {
                            if (searchData[data] != '0') {
                                if (data == 'progress') {
                                    if (localStorageSessionParams == "?") {
                                        localStorageSessionParams += `${data}[]=${searchData[data]}`
                                    } else {
                                        localStorageSessionParams += `&${data}[]=${searchData[data]}`
                                    }
                                } else {
                                    if (localStorageSessionParams == "?") {
                                        localStorageSessionParams += `${data}=${searchData[data]}`
                                    } else {
                                        localStorageSessionParams += `&${data}=${searchData[data]}`
                                    }
                                }
                            }
                        } else {
                            if (data == 'progress') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (localStorageSessionParams == "?") {
                                            localStorageSessionParams += `progress[]=${val}`
                                        } else {
                                            localStorageSessionParams += `&progress[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'area') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (localStorageSessionParams == "?") {
                                            localStorageSessionParams += `area[]=${val}`
                                        } else {
                                            localStorageSessionParams += `&${data}[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'tag_id') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (localStorageSessionParams == "?") {
                                            localStorageSessionParams += `tag_id[]=${val}`
                                        } else {
                                            localStorageSessionParams += `&tag_id[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'type_id') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (localStorageSessionParams == "?") {
                                            localStorageSessionParams += `type_id[]=${val}`
                                        } else {
                                            localStorageSessionParams += `&type_id[]=${val}`
                                        }
                                    })
                                }
                            } else if (data == 'builder') {
                                if (searchData[data].length > 0) {
                                    searchData[data].forEach((val) => {
                                        if (localStorageSessionParams == "?") {
                                            localStorageSessionParams += `builder[]=${val}`
                                        } else {
                                            localStorageSessionParams += `&builder[]=${val}`
                                        }
                                    })
                                }
                            } else {
                                if (localStorageSessionParams == "?") {
                                    localStorageSessionParams += `${data}=${searchData[data]}`
                                } else {
                                    localStorageSessionParams += `&${data}=${searchData[data]}`
                                }
                            }
                        }
                    }
                })

                return localStorageSessionParams;
            }

            // new pagination for filter search
            function filterPagination() {
                let searchData = @json($searchData);
                console.log("filterPagination -> SearchData -> ", searchData);
                let domain = window.location.origin;
                let exits = `${domain}/projects/listings?page=`;
                let tags = $("a");
                let maxBudget = $("#maxBudget").val();
                let downPayment = $("#downPayment").val() != "" ? $("#downPayment").val() : '0';
                let downPayment1 = $("#downPayment1").val() != "" ? $("#downPayment").val() : '0';
                let searchObj = {};
                let token = $($("input[name='_token']")[0]).val();
                searchObj['calculatorResult'] = true;
                searchObj['_token'] = token;
                searchObj['area'] = searchData['area'];
                searchObj['tag_id'] = searchData['tag_id'];
                searchObj['builder'] = searchData['builder'];
                searchObj['maxBudget'] = searchData['maxBudget'];
                searchObj['maxDP'] = searchData['maxDP'];
                searchObj['maxMI'] = searchData['maxMI'];
                searchObj['maxPrice'] = searchData['maxPrice'];
                searchObj['minDP'] = searchData['minDP'];
                searchObj['minMI'] = searchData['minMI'];
                searchObj['minPrice'] = searchData['minPrice'];
                searchObj['progress'] = searchData['progress'];
                searchObj['tags'] = searchData['tags'] ? searchData['tags'] : null;
                searchObj['type_id'] = searchData['type_id'];
                searchObj['downPayment'] = downPayment;
                searchObj['reseller_id'] = searchData['reseller_id'];
                searchObj['monthInstall'] = searchData['monthInstall'];
                searchObj['yearlyInstall'] = searchData['yearlyInstall'];
                searchObj['halfYearlyInstall'] = searchData['halfYearlyInstall'];
                searchObj['quarterlyInstall'] = searchData['quarterlyInstall'];
                searchObj['possession'] = searchData['possession'];

                for (let a = 0; a < tags.length; a++) {
                    if (tags[a].href.includes(exits)) {
                        let originalHref = tags[a].href;
                        $(tags[a]).on("click", function (e) {
                            // e.preventDefault();
                            let currentPage = searchData['page'];
                            let clickedPage = 0;
                            let page = $(this);
                            console.log("Page", page)
                            let pageLabel = page[0].ariaLabel != null ? page[0].ariaLabel : page[0].innerText
                            if (pageLabel.includes("Next")) {
                                clickedPage = Number(currentPage) + 1;
                            } else if (pageLabel.includes("Previous")) {
                                clickedPage = Number(currentPage) - 1;
                            } else {
                                clickedPage = originalHref.split("=")[1];
                            }
                            searchObj['page'] = clickedPage;
                            $.post({
                                url: "/projects/listings",
                                data: searchObj,
                                error: function (err) {
                                    console.log("Error", err);
                                },
                                success: function (res) {
                                    $("#maxBudget1").val(maxBudget);
                                    $("#maxBudget").val(maxBudget);
                                    $("#downPayment1").val(downPayment);
                                    $("#downPayment").val(downPayment);
                                    $("#search-results").html(res);
                                },
                            });
                        })
                        console.log("Tag", $(tags[a])[0].className)
                        if ($(tags[a])[0].className != "menu-tray") {
                            tags[a].href = "#";
                        }
                    }
                }
                $("select[id='reseller_id']").on('change', function () {
                    searchProperties();
                    return;
                })
            }

            // adding comma in number fields
            $(document).on("keyup", "input[type='tel']", function () {
                var currentInput = $(this).val();
                var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, "");
                $(this).val(fixedInput);
                if (fixedInput != "") {
                    fixedInput = currentInput.replace(/,/g, "");
                    let final = new Intl.NumberFormat().format(parseInt(fixedInput));
                    $(this).val(final.toString());
                }
            });

            // main calculation
            function calculation() {
                let month = $("option:selected", "#duration_month").attr('m');
                console.log("Inside on change!", month);

                var Monthly = $("option:selected", "#duration_month").attr('m');
                var Quarterly = $("option:selected", "#duration_month").attr('q');
                var Half_Yearly = $("option:selected", "#duration_month").attr('h');
                var Yearly = $("option:selected", "#duration_month").attr('y');
                var down_payment = $("#down_payment").val().replace(/,/g, "");
                var Monthly_Installment =
                    $("#Monthly_Installment").val().replace(/,/g, "") * Monthly;
                var Quarterly_Installment =
                    $("#Quarterly_Installment").val().replace(/,/g, "") * Quarterly;
                var Half_Yearly_Installment =
                    $("#Half_Yearly_Installment").val().replace(/,/g, "") * Half_Yearly;
                var Yearly_Installment =
                    $("#Yearly_Installment").val().replace(/,/g, "") * Yearly;
                var Possession = $("#Possession").val().replace(/,/g, "");
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
                var construction_options_addition = 0;
                $(".construction_options .number").each(function () {
                    var val = $(this).val().replace(/,/g, "");
                    if (val == "") {
                        var value = 0;
                    } else {
                        var value = parseInt(val);
                    }
                    construction_options_addition += value;
                });

                var addition =
                    parseInt(down_payment_val) +
                    parseInt(Monthly_Installment_val) +
                    parseInt(Quarterly_Installment_val) +
                    parseInt(Half_Yearly_Installment_val) +
                    parseInt(Yearly_Installment_val) +
                    parseInt(Possession_val) +
                    construction_options_addition;
                if (parseInt(down_payment_val) < 1) {
                    $("#calculate").addClass("disable-btn")
                    $("#calculate").attr("disabled", "disabled")
                    $(".required-msg").removeClass("hide");
                } else {
                    $("#calculate").removeClass("disable-btn")
                    $("#calculate").removeAttr("disabled")
                    $(".required-msg").addClass("hide");
                }
                $("#cal-result").html(new Intl.NumberFormat().format(addition));
            }

            // Calculation for Mobile version
            function calculation1() {
                console.log("Inside on change!");
                var Monthly = $("#Months_duration button.active").attr("Monthly");
                var Quarterly = $("#Months_duration button.active").attr("Quarterly");
                var Half_Yearly = $("#Months_duration button.active").attr(
                    "Half_Yearly"
                );
                var Yearly = $("#Months_duration button.active").attr("Yearly");
                var down_payment = $("#down_payment1").val().replace(/,/g, "");
                var Monthly_Installment =
                    $("#Monthly_Installment1").val().replace(/,/g, "") * Monthly;
                var Quarterly_Installment =
                    $("#Quarterly_Installment1").val().replace(/,/g, "") * Quarterly;
                var Half_Yearly_Installment =
                    $("#Half_Yearly_Installment1").val().replace(/,/g, "") *
                    Half_Yearly;
                var Yearly_Installment =
                    $("#Yearly_Installment1").val().replace(/,/g, "") * Yearly;
                var Possession = $("#Possession").val().replace(/,/g, "");
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
                var construction_options_addition = 0;
                $(".construction_options .number").each(function () {
                    var val = $(this).val().replace(/,/g, "");
                    if (val == "") {
                        var value = 0;
                    } else {
                        var value = parseInt(val);
                    }
                    construction_options_addition += value;
                });

                var addition =
                    parseInt(down_payment_val) +
                    parseInt(Monthly_Installment_val) +
                    parseInt(Quarterly_Installment_val) +
                    parseInt(Half_Yearly_Installment_val) +
                    parseInt(Yearly_Installment_val) +
                    parseInt(Possession_val) +
                    construction_options_addition;
                if (parseInt(down_payment_val) < 1) {
                    $("#calculate1").addClass("disable-btn")
                    $("#calculate1").attr("disabled", "disabled")
                    $(".required-msg1").removeClass("hide");
                } else {
                    $("#calculate1").removeClass("disable-btn")
                    $("#calculate1").removeAttr("disabled")
                    $(".required-msg1").addClass("hide");
                }
                $("#cal-result1").html(new Intl.NumberFormat().format(addition));
            }

            $(document).on("change", "input[type='tel']", calculation);
            $(document).on("change", "input[type='tel']", calculation1);
            // For durations tab
            $(document).on("click", ".duration-tab button", function () {
                duration = $(this)[0].innerText;
                $(".duration-tab").find("button").removeClass("active");
                $(this).addClass("active");
                calculation();
                calculation1();
            });
            // for flat and construction tab
            $(document).on("click", ".project_type_const button", function () {
                var value = $(this).html();
                $(".project_type_const").find("button").removeClass("active");
                $(this).addClass("active");
                if (val == "FLAT") {
                    projectType = "Flat"
                    $(".flat_options").addClass("show").removeClass("hide");
                    $(".construction_options").addClass("hide").removeClass("show");
                } else {
                    projectType = "Construction"
                    $(".construction_options").addClass("show").removeClass("hide");
                    $(".flat_options").addClass("hide").removeClass("show");
                }
            });

            $(document).on("change", ".confirmation", function () {
                var Booking = $("input.Booking").val().replace(/,/g, "");
                var allocation = $("input.allocation").val().replace(/,/g, "");
                var confirmation = $("input.confirmation").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                console.log("Pocket Val", addition)

                $("#down_payment").val(addition);
                calculation();
            });

            $(document).on("change", ".Booking", function () {
                var Booking = $("input.Booking").val().replace(/,/g, "");
                var allocation = $("input.allocation").val().replace(/,/g, "");
                var confirmation = $("input.confirmation").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                $("#down_payment").val(addition);
                calculation();
            });

            $(document).on("change", ".allocation", function () {
                var Booking = $("input.Booking").val().replace(/,/g, "");
                var allocation = $("input.allocation").val().replace(/,/g, "");
                var confirmation = $("input.confirmation").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                $("#down_payment").val(addition);
                calculation();
            });

            $(document).on("change", ".start_of_work", function () {
                var Booking = $("input.Booking").val().replace(/,/g, "");
                var allocation = $("input.allocation").val().replace(/,/g, "");
                var confirmation = $("input.confirmation").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                $("#down_payment").val(addition);
                calculation();
            });

            $(document).on("change", ".down_payment_checkbox", function () {
                if (this.checked) {
                    $(".down_payment_options").addClass("show").removeClass("hide");
                    $("input#down_payment").attr("disabled", true);
                } else {
                    $(".down_payment_options").addClass("hide").removeClass("show");
                    $("input#down_payment").removeAttr("disabled");
                }
            });

            $(document).on("change", ".Booking1", function () {
                var Booking = $("input.Booking1").val().replace(/,/g, "");
                var allocation = $("input.allocation1").val().replace(/,/g, "");
                var confirmation = $("input.confirmation1").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work1").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                $("#down_payment1").val(addition);
                calculation1();
            });

            $(document).on("change", ".allocation1", function () {
                var Booking = $("input.Booking1").val().replace(/,/g, "");
                var allocation = $("input.allocation1").val().replace(/,/g, "");
                var confirmation = $("input.confirmation1").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work1").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                $("#down_payment1").val(addition);
                calculation1();
            });

            $(document).on("change", ".confirmation1", function () {
                var Booking = $("input.Booking1").val().replace(/,/g, "");
                var allocation = $("input.allocation1").val().replace(/,/g, "");
                var confirmation = $("input.confirmation1").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work1").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                console.log("Pocket Val", addition)

                $("#down_payment1").val(addition);
                calculation1();
            });

            $(document).on("change", ".start_of_work1", function () {
                var Booking = $("input.Booking1").val().replace(/,/g, "");
                var allocation = $("input.allocation1").val().replace(/,/g, "");
                var confirmation = $("input.confirmation1").val().replace(/,/g, "");
                var start_of_work = $("input.start_of_work1").val().replace(/,/g, "");
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
                var addition =
                    parseInt(Booking) +
                    parseInt(allocation) +
                    parseInt(confirmation) +
                    parseInt(start_of_work);
                $("#down_payment1").val(addition);
                calculation1();
            });

            $(document).on("click", ".custom-tab", function () {
                let selectedTab = $(this).attr("id");
                let searchFilterTab = $(`div[aria-labelledby='nav-home-tab']`);
                let calculatorTab = $(`div[aria-labelledby='nav-profile-tab']`);
                if (selectedTab == 'nav-profile-tab') {
                    calculatorTab.addClass("show active");
                    searchFilterTab.removeClass("show active")
                } else {
                    calculatorTab.removeClass("show active");
                    searchFilterTab.addClass("show active")
                }
            })

            $(document).on("click", ".custom-tab2", function () {
                let selectedTab = $(this).attr("id");
                console.log("Select tab Id", selectedTab)
                let searchFilterTab = $(`div[aria-labelledby='nav-mob1-tab']`);
                let calculatorTab = $(`div[aria-labelledby='nav-mob2-tab']`);
                if (selectedTab == 'nav-mob2-tab') {
                    calculatorTab.addClass("show active");
                    searchFilterTab.removeClass("show active")
                } else {
                    calculatorTab.removeClass("show active");
                    searchFilterTab.addClass("show active")
                }
            })

        });

        $(".answer").hide();
        $(".down_payment_checkbox").click(function () {
            if ($(this).is(":checked")) {
                $(".answer").show();
                $(".down_payment").prop("disabled", "disabled");
            } else {
                $(".answer").hide();
                $(".down_payment").removeAttr("disabled");
            }
        });

        $(document).on("submit", "#filterForm", function (e) {
            e.preventDefault();
            var area_inp = $("#area_inp").val();
            var progress_inp = $("#progress_inp").val();
            var projects_inp = $("#project_inp").val();

            $("#filter_actions").append(
                "<div id='wait'><img width='30px' src='https://markproperties.pk/projects/wp-content/themes/markproperties2/images/wait.gif' /> </div>"
            );
            $.ajax({
                url: "https://markproperties.pk/projects/wp-admin/admin-ajax.php",
                type: "POST",
                data: "action=filterForm_action2&area_inp=" +
                    area_inp +
                    "&progress_inp=" +
                    progress_inp +
                    "&projects_inp=" +
                    projects_inp,
                success: function (results) {
                    $("#compare_projects").html(results);
                    $("#wait").remove();
                },
            });
        });

        $(document).on("click", ".add_btn_construction", function () {
            var value = "Value";
            $(".construction_options .form-group:nth-child(1) .col-sm-12:last").after(
                "<div class='col-sm-12 btn_add_fields'>  <input class='form-control number col-sm-11 pull-left' placeholder='" +
                value +
                "'><i class='fa fa-close pull-right remove_const_btn'></i> <br/> </div><br/> "
            );
        });

        $(document).on("keyup", "input[name='maxDP']", function () {

            let minDP = Number($($("input[name='minDP']")[1]).val());
            let maxDP = Number($(this).val());

            if (minDP > 0) {

                if (minDP > maxDP) {
                    $("#minDownError").removeClass('hide');
                } else {
                    $("#minDownError").addClass("hide");
                }
            }
        })

        $(document).on("keyup", "input[name='minDP']", function () {

            let maxDP = Number($($("input[name='maxDP']")[1]).val());
            let minDP = Number($(this).val());

            if (maxDP > 0) {

                if (minDP > maxDP) {
                    $("#minDownError").removeClass('hide');
                } else {
                    $("#minDownError").addClass("hide");
                }
            }
        })

        $(document).on("keyup", "input[name='maxMI']", function () {

            let minMI = Number($($("input[name='minMI']")[1]).val());
            let maxMI = Number($(this).val());

            if (minMI > 0) {

                if (minMI > maxMI) {
                    $("#minMonthlyError").removeClass('hide');
                } else {
                    $("#minMonthlyError").addClass("hide");
                }
            }
        })

        $(document).on("keyup", "input[name='minMI']", function () {

            let maxMI = Number($($("input[name='maxMI']")[1]).val());
            let minMI = Number($(this).val());

            if (maxMI > 0) {

                if (minMI > maxMI) {
                    $("#minMonthlyError").removeClass('hide');
                } else {
                    $("#minMonthlyError").addClass("hide");
                }
            }
        })

        $(document).on("keyup", "input[name='maxPrice']", function () {

            let minPrice = Number($($("input[name='minPrice']")[1]).val());
            let maxPrice = Number($(this).val());

            if (minPrice > 0) {

                if (minPrice > maxPrice) {
                    $("#minPriceError").removeClass('hide');
                } else {
                    $("#minPriceError").addClass("hide");
                }
            }
        })

        $(document).on("keyup", "input[name='minPrice']", function () {

            let maxPrice = Number($($("input[name='maxPrice']")[3]).val());
            let minPrice = Number($(this).val());
            console.log("Min max Price", $("input[name='maxPrice']"))
            if (maxPrice > 0) {

                if (minPrice > maxPrice) {
                    $("#minPriceError").removeClass('hide');
                } else {
                    $("#minPriceError").addClass("hide");
                }
            }
        })


        $(document).on("click", ".remove_const_btn", function () {
            $(this).closest(".col-sm-12").remove();
        });

        // $("#open2").on("click", function(){
        //     console.log("I m clicked!");
        // })

        let allInputs = $("form[id='searchFilterForm'] input");
        console.log("All inputs", allInputs)
        for (let a = 0; a < allInputs.length; a++) {
            let elm = allInputs[a];
            if ($(elm).attr('class') == "form-control") {
                $(elm).on('keyup', function () {
                    console.log("All inputs", allInputs[a]);
                    var currentInput = $(this).val();
                    var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, "");
                    $(this).val(fixedInput);
                    if (fixedInput != "") {
                        fixedInput = currentInput.replace(/,/g, "");
                        let final = new Intl.NumberFormat().format(parseInt(fixedInput));
                        $(this).val(final.toString());
                    }
                })
            }
        }
    </script>
@endsection