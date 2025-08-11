@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')
<div class="col-lg-12">
    @if(count($projects) > 0)
    @foreach ($projects as $Pkey => $project)


    {{-- <div class="feat_property list" @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'" @else data-toggle="modal" class="btn-link-project-detail btn btn-thm float-right" data-target=".bd-example-modal-lg" @endif> --}}
    <div class="feat_property list">
        <!-- <div class="thumb"> -->
        <?php $afterRedirect = "\/project/" . $project->slug ?>
        <div class="thumb" @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'" @else class="btn-link-project-detail btn btn-thm float-right" onclick="OpenLoginRegisterModal('{{$afterRedirect}}')" @endif>

            <img class="img-whp" src="/{{ $project->project_cover_img }}" alt="{{ $project->name }}">
            <div class="ribbon">
                <div class="txt">
                    {{ $project->progress }}
                </div>
            </div>
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
                        {{-- $project->min_price --}}
                        Starting from Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}

                    </h4>
                        
                </div>
                <p class="text-builder">
                    By {{ $project->owners->first()->full_name }}
                </p>
                <p class="text-thm">
                    <span>
                        @foreach ($project->units->unique('unit_type_id') as $unit)

                        <span>{{ optional($unit->type)->title }} </span>
                        @if($project->units->unique('unit_type_id')->count() > ($loop->index+1))
                        <span>|</span>
                        @endif
                        @endforeach
                    </span>
                </p>
                <p class="project_location">
                    <span class="flaticon-placeholder"></span>
                    <span class="addressclickable" value="{{$loop->index+1}}">
                        <span id="lat{{$loop->index+1}}" class="d-none lat">{{$project->latitude}}</span>
                        <span id="lon{{$loop->index+1}}" class="d-none lon">{{$project->longitude}}</span>
                        <!-- <span data-toggle="modal" data-target=".addressModal"> -->
                        {!! Str::limit($project->address, 50) !!}
                    </span>

                </p>
                <p>
                    <span> {!! Str::limit($project->details, 125) !!}</span>
                </p>

                <span style="color: #ec1c24 !important; font-weight:900;font-size:14px;">
                  

                    No. of views: {{$project->views}}

                </span>

                <!-- <p style="color: #ec1c24 !important; font-weight:900;">
                    <br>
                    Added:
                    @if ($project->added_time)
                    {{ \Carbon\Carbon::parse($project->added_time)->diffForHumans() }}
                    @else
                    {{ \Carbon\Carbon::parse($project->created_at)->diffForHumans() }}
                    @endif
                </p> -->

            </div>
            <div class="fp_footer search_option_button">

                @if (Auth::id())
                <?php
                $pageUrl = url('/') . "/compare/" . $project->id;
                // $pageUrl = ;

                $arrActivityLogParams = [
                    "log_name" => Config::get("constants.CustomActivityLogs.compareProjectDetail.value"),
                    "log_table" => "projects",
                    "project_name" => $project->name,
                    "subject_type" => "App\\Models\\Project",
                    "subject_id" => $project->id,
                    "page_url" => $pageUrl,
                ];
                ?>
                <!-- href="/compare/{{$project->id}}" -->
                <!-- json_ecode($arrActivityLogParams) -->
                <button style="background-color:#fff; border:0px; cursor:pointer;" class="float-left float-lg-left float-xl-left" onclick='addClickToCompareActivityLog(<?php echo json_encode($arrActivityLogParams); ?>)'>
                    <img src="\assets\images\property\comparison_icon.png" width="35%"><span style="font-weight:400;">Compare</span>
                </button>


                @else

                <!-- <a href="/compare" data-toggle="modal" class="btn-link-project-detail float-left float-lg-right" data-target=".bd-example-modal-lg"> -->
                <a href="javascript:void(0)" onclick="OpenLoginRegisterModal('/compare/{{$project->id}}')" class="float-left float-lg-left float-xl-left">
                    <img src="\assets\images\property\comparison_icon.png" width="35%"><span style="font-weight:400;">Compare</span>
                </a>
                @endif

                @if (Auth::id())

                <a href="/project/{{ $project->slug }}" class="btn btn-thm float-right float-lg-right">
                    View Details
                </a>

                @else
                <a href="javascript:void(0)" onclick="OpenLoginRegisterModal('/project/{{ $project->slug }}')" data-toggle="modal" class="btn-link-project-detail btn btn-thm float-right float-lg-right" data-target=".bd-example-modal-lg">
                    View Details
                </a>

                <!-- <a href="/compare" data-toggle="modal" class="btn-link-project-detail float-left float-lg-right" data-target=".bd-example-modal-lg"> -->

                @endif
            </div>
            @if((int)$searchData['downPayment'] > 0)
            @if(round((int)$project->units[0]->down_payment) > (int)$searchData['downPayment'])
            <div style="padding: 0px 20px 0px;">Down Payment: <span class='bdg-line-through'>{{$searchData['downPayment']}}</span> | Increase Down Payment</div>
            @endif
            @endif
            <!-- @if((int)$minDP > 0)
                @if(round((int)$project->units[0]->down_payment) > (int)$minDP)
                <div style="padding: 0px 20px 0px;">Min Down Payment: <span class='bdg-line-through'>{{$minDP}}</span> | Increase Min Down Payment</div>
                @endif
            @endif -->
            @if((int)$searchData['maxDP'] > 0)
            @if(round((int)$project->units[0]->down_payment) > (int)$searchData['maxDP'])
            <div style="padding: 0px 20px 0px;">Max Down Payment: <span class='bdg-line-through'>{{$searchData['maxDP']}}</span> | Increase Max Down Payment</div>
            @endif
            @endif
            @if((int)$searchData['maxBudget'] > 0)
            @if(round((int)$project->units[0]->price) > (int)$searchData['maxBudget'])
            <div style="padding: 0px 20px 0px;">Max Budget: <span class='bdg-line-through'>{{$searchData['maxBudget']}}</span> | Increase Max Budget</div>
            @endif
            @endif
            <!-- @if((int)$searchData['minPrice'] > 0)
                @if(round((int)$project->min_price) > (int)$searchData['minPrice'])
                <div style="padding: 0px 20px 0px;">Min Price: <span class='bdg-line-through'>{{$searchData['minPrice']}}</span> | Increase Min Price</div>
                @endif
            @endif -->
            @if((int)$searchData['maxPrice'] > 0)
            @if(round((int)$project->min_price) > (int)$searchData['maxPrice'])
            <div style="padding: 0px 20px 0px;">Max Price: <span class='bdg-line-through'>{{$searchData['maxPrice']}}</span> | Increase Max Price</div>
            @endif
            @endif
            @if((int)$searchData['monthInstall'] > 0)
            @if(round((int)$project->units[0]->monthly_installment) > (int)$searchData['monthInstall'])
            <div style="padding: 0px 20px 0px;">Monthly Installment: <span class='bdg-line-through'>{{$searchData['monthInstall']}}</span> | Increase Monthly Installment</div>
            @endif
            @endif
            @if((int)$searchData['possession'] > 0)
            @if(round((int)$project->units[0]->possession) > (int)$searchData['possession'])
            <div style="padding: 0px 20px 0px;">Possession: <span class='bdg-line-through'>{{$searchData['possession']}}</span> | Increase Possession</div>
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
    {{-- $projects->links() --}}

    <div class="col-md-12 no-padding">
        @if ($projects->hasPages())
        <div>
            <span>
                Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} results
            </span>
        </div>
        <ul class="pagination pagination">
            {{-- Previous Page Link --}}
            @if ($projects->onFirstPage())
            <li class="disabled btn btn-light"><span>«</span></li>
            @else
            <li><a class="btn btn-light" href="{{ $projects->previousPageUrl() }}" rel="prev">«</a></li>
            @endif

            @if($projects->currentPage() >= 2)
            <li class="hidden-xs btn btn-light"><a href="{{ $projects->url(1) }}">1</a></li>
            @endif
            @if($projects->currentPage() > 2)
            <li><span class="btn btn-light">...</span></li>
            @endif
            @foreach(range($projects->currentPage(), $projects->lastPage()) as $i)
            @if($i >= ($projects->currentPage() - 2) && $i <= ($projects->currentPage() + 2))
                @if ($i == $projects->currentPage())
                <li class="active btn btn-light active-btn-zoomer"><span>{{ $i }}</span></li>
                @else
                <li><a class="btn btn-light" href="{{ $projects->url($i) }}">{{ $i }}</a></li>
                @endif
                @endif
                @endforeach
                @if($projects->currentPage() < ($projects->lastPage() - 3))
                    <li><span class="btn btn-light">...</span></li>
                    @endif
                    @if($projects->currentPage() < ($projects->lastPage() - 2))
                        <li class="hidden-xs"><a class="btn btn-light" href="{{ $projects->url($projects->lastPage()) }}">{{ $projects->lastPage() }}</a></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($projects->hasMorePages())
                        <li><a class="btn btn-light" href="{{ $projects->nextPageUrl() }}" rel="next">»</a></li>
                        @else
                        <li class="disabled btn btn-light"><span>»</span></li>
                        @endif
        </ul>
        @endif
    </div>


    <script>
        var projects = '<?= $projects->firstItem() ?>';
        var projects_last = '<?= $projects->lastItem() ?>';
        var active_proj = '<?= $projects->total() ?>';
        $("#searchCount")[0].innerText = ` Showing ${projects} to ${projects_last} of ${active_proj} results`;

        function sortBy(stack, sortByVal) {
            let domain = window.location.origin;
            let exits = `${domain}/projects/listings${stack}&reseller_id=${sortByVal}`;
            window.location.replace(exits)
        }

        function searchProperties() {
            // alert("function searchProperties() -> ");
            $("#search-results").html("");
            let token = $($("input[name='_token']")[0]).val();
            let budget = $("#cal-result").html().replaceAll(",", "");
            let monthInstall = $("#Monthly_Installment").val().replaceAll(",", "");
            let yearlyInstall = $("#Yearly_Installment").val().replaceAll(",", "");
            let halfYearlyInstall = $("#Half_Yearly_Installment").val().replaceAll(",", "");
            let quarterlyInstall = $("#Quarterly_Installment").val().replaceAll(",", "");
            let possession = $("#Possession").val().replaceAll(",", "");
            let downPayment = $("#down_payment").val() != "" ? $("#down_payment").val().replaceAll(",", "") : '0';
            let slabCasting = $($("input[placeholder='Slab Casting']")[1]).val();
            let plinth = $($("input[placeholder='Plinth']")[1]).val();
            let colour = $($("input[placeholder='Colour']")[1]).val();
            let areas = $("#areaSelectDiv").val();
            let sortBy = $("select[id='reseller_id']").val();

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
                error: function(err) {
                    console.log("Error", err);
                },
                success: function(res) {
                    $("#maxBudget").val(budget);
                    $("#downPayment").val(downPayment);
                    $("#search-results").html(res);
                },
            });
        }

        function historyStack() {
            // event.preventDefault();

            // alert("function historyStack() -> ");
            let searchData = @json($searchData);
            console.log("searchData -> ", searchData);
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
                                        stack += `&tag_id[]=${val}`
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
            $("select[id='reseller_id']").on('change', function() {
                // let sortByVal = $("select[id='reseller_id']").val();
                // console.log(sortByVal);
                // sortBy(stack,sortByVal)
                searchProperties();
                return;
            })

            // history.pushState({}, "", `?q=${btoa(stack.split("?")[1])}`)

            history.pushState({}, "", stack)
        }

        function handlePagination() {
            // console.log("Session in laravel ", $session());
            let searchData = @json($searchData);
            console.log("SearchData", searchData);
            let domain = window.location.origin;
            let exits = `${domain}/projects/listings?page`;
            let tags = $("a");
            let maxBudget = $("#maxBudget").val();
            let downPayment = $("#downPayment").val() != "" ? $("#downPayment").val() : '0';
            let searchObj = {};
            let token = $($("input[name='_token']")[0]).val();
            searchObj['calculatorResult'] = true;
            searchObj['_token'] = token;
            searchObj['area'] = searchData['area'] ? searchData['area'] : null;
            searchObj['tag_id'] = searchData['tag_id'];
            searchObj['builder'] = searchData['builder'] ? searchData['builder'] : null;
            searchObj['maxBudget'] = searchData['maxBudget'] ? searchData['maxBudget'] : null;
            searchObj['maxDP'] = searchData['maxDP'] ? searchData['maxDP'] : null;
            searchObj['maxMI'] = searchData['maxMI'] ? searchData['maxMI'] : null;
            searchObj['maxPrice'] = searchData['maxPrice'] ? searchData['maxPrice'] : null;
            searchObj['minDP'] = searchData['minDP'] ? searchData['minDP'] : null;
            searchObj['minMI'] = searchData['minMI'] ? searchData['minMI'] : null;
            searchObj['minPrice'] = searchData['minPrice'] ? searchData['minPrice'] : null;
            searchObj['progress'] = searchData['progress'] ? searchData['progress'] : null;
            searchObj['tags'] = searchData['tags'] ? searchData['tags'] : null;
            searchObj['type_id'] = searchData['type_id'] ? searchData['type_id'] : null;
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
                    $(tags[a]).on("click", function() {
                        ShowLoader();
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
                        console.log("Search Obj", searchObj)
                        $.post({
                            url: "/projects/listings",
                            data: searchObj,
                            error: function(err) {
                                console.log("Error", err);
                                HideLoader();
                            },
                            success: function(res) {
                                $("#maxBudget1").val(maxBudget);
                                $("#maxBudget").val(maxBudget);
                                $("#downPayment1").val(downPayment);
                                $("#downPayment").val(downPayment);
                                $("#search-results").html(res);
                                HideLoader();
                            },
                        });
                    })
                    console.log("Tag", $(tags[a])[0].className)
                    if ($(tags[a])[0].className != "menu-tray") {
                        tags[a].href = "#";
                    }
                }
            }
            $("select[id='reseller_id']").on('change', function() {
                // let sortByVal = $("select[id='reseller_id']").val();
                // console.log(sortByVal);
                // sortBy(stack,sortByVal)
                searchProperties();
                return;
            })
        }

        handlePagination();
        historyStack();

        function addClickToCompareActivityLog(objActivityLog) {
            console.log("addClickToCompareActivityLog -> objActivityLog -> ", objActivityLog);
            ShowLoader();
            let params = objActivityLog;
            params.conversion_id = ConfigConstants.ActivityLogsConversionIds.clickToCompareId;
            params.description = "Compare " + params.project_name;
            CallLaravelAction("/create/custom-activity-log", params, function(response) {
                console.log("Insert compare project log");
                HideLoader();
                window.open(params.page_url, '_blank');
            });
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
                                        localStorageSessionParams += `&area[]=${val}`
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

    </script>
</div>
