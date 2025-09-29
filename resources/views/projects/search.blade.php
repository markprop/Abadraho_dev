<div class="col-lg-12" id="results-data">
@php
    $isPaginator = isset($projects) && ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator);
    $list = $isPaginator ? $projects : (is_array($projects ?? null) ? collect($projects) : collect($projects ?? []));
@endphp
@if(isset($groupedProjects) && is_array($groupedProjects))
    @php
        $sections = [
            'perfect' => 'Perfect Match',
            'related' => 'Related Projects',
            'other' => 'Other Project with Best Deal',
        ];
    @endphp
    @foreach($sections as $groupKey => $title)
        @if(isset($groupedProjects[$groupKey]) && count($groupedProjects[$groupKey]) > 0)
            <div class="col-lg-12"><h3 class="mb20">{{ $title }}</h3></div>
            @foreach ($groupedProjects[$groupKey] as $key => $project)
        <!-- <div class="feat_property list" @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'" @else data-toggle="modal" class="btn-link-project-detail btn btn-thm float-right" data-target=".bd-example-modal-lg" @endif> -->
            <?php $afterRedirect = "\/project/" . $project->slug ?>
            <div class="feat_property list project_data">
                <div class="thumb">
                    <div @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'"
                    @else class="btn-link-project-detail btn btn-thm float-right"
                    onclick="OpenLoginRegisterModal('{{$afterRedirect}}')" @endif>
                        <img class="img-whp" src="/{{ $project->project_cover_img }}" alt="{{ $project->name }}">
                        <div class="ribbon">
                            <div class="txt">
                                {{ $project->progress }}
                            </div>
                        </div>
                    </div>
                    
                    <!--<a class="service-wishlist " data-id="1" data-type="property"><i class="fa fa-heart project_icon"></i></a> -->
                    <a class="service-wishlist addressclickable" data-id="1" data-type="property" value="{{$loop->index+1}}">
                        <span id="lat{{$loop->index+1}}" class="d-none lat">{{$project->latitude}}</span>
                        <span id="lon{{$loop->index+1}}" class="d-none lon">{{$project->longitude}}</span>
                        <i class="fa fa-map-marker project_icon"></i>
                    </a>
                    <input type="hidden" class="project_id" value="{{$project->id}}">
                    @if (Auth::id())
                        <a href="Javascript:void(0);" type="btn" class="add-to-wishlist-btn service-heart" data-project="{{$project->id}}" data-id="1" data-type="property"><i class="fa fa-heart project_icon"></i></a>
                    @else
                        <a class="service-heart" data-id="1" data-toggle="modal" data-target=".bd-example-modal-lg" data-type="property"><i class="fa fa-heart project_icon"></i></a>
                    @endif
                <!-- <a class="service-photos" data-id="1" data-type="property"><i class="fa fa-camera project_icon"></i></a>-->
                </div>
                <div class="details">
                    <div class="tc_content">
                        <div class="utf-listing-title">
                            <h4>{{ $project->name }}</h4>
                        </div>
                        <div class="dtls_headr">
                            <span class="utf-listing-price">
                                <?php
                                $minimumProjectUnitPrice = 0;
                                if (count($project->units)) {
                                    $minimumProjectUnitPrice = $project->units->min("total_unit_amount");
                                }
                                ?>

                                Starting from
                                Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}
                            </span>
                        </div>
                        <span class="num-view flaticon-view">{{$project->views}}</span>
                        <p class="text-builder">By {{ isset($project->owners->first()->full_name) ? $project->owners->first()->full_name : ''  }}</p>
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
                                            <span id="lat{{$loop->index+1}}"
                                                  class="d-none lat">{{$project->latitude}}</span>
                                            <span id="lon{{$loop->index+1}}"
                                                  class="d-none lon">{{$project->longitude}}</span>
                                <!-- <span data-toggle="modal" data-target=".addressModal"> -->
                                            {!! Str::limit($project->address, 50) !!}
                                        </span>

                        </p>
                        <p>
                            <span> {!! Str::limit($project->details, 125) !!}</span>
                        </p>

                    <!-- <span
                            style="color: #ec1c24 !important; font-weight:900; font-size:14px;">
                                        <br>

                                        No. of views: {{$project->views}}

                        </span> -->

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
                            <a href="{!! url("/compare/" . $project->id . '/?clicked=true') !!}"
                               class="float-left float-lg-left float-xl-left">
                                <img src="\assets\images\property\comparison_icon.png" width="35%;"> <span
                                    style="font-weight: 400">Compare</span>
                            </a>
                        @else
                            <a href="/login?ref={!! url("/compare/" . $project->id . '/?clicked=true') !!}"
                               class="float-left float-lg-left float-xl-left">
                                <img src="\assets\images\property\comparison_icon.png" width="35%"> <span
                                    style="font-weight: 400">Compare</span>
                            </a>
                        @endif

                        @if (Auth::id())
                            <a href="/project/{{ $project->slug }}"
                               class="btn btn-thm float-right float-lg-right">
                                View Details
                            </a>
                        @else
                            <a href="#" data-toggle="modal" data-target="#myModal{{ $key }}" class="btn-link-project-detail btn btn-thm float-right float-lg-right">
                                View Details
                            </a>

                            <div class="modal fade" id="myModal{{ $key }}" role="dialog">
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
                                        <a href="/login?ref={!! url('/project/' . $project->slug) !!}" class="btn btn-success">Login</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach
        @elseif($groupKey === 'related')
            <div class="col-lg-12"><h3 class="mb20">Related Projects</h3></div>
            <div class="col-lg-12">
                <p>No closely related projects found. Try widening your budget or adjusting duration.</p>
            </div>
        @elseif($groupKey === 'other')
            <div class="col-lg-12"><h3 class="mb20">Other Project with Best Deal</h3></div>
            <div class="col-lg-12">
                <p>No good out-of-area alternatives found within your budget range.</p>
            </div>
        @endif
    @endforeach
@elseif($list->count() > 0)
    @foreach ($list as $key => $project)
        <!-- <div class="feat_property list" @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'" @else data-toggle="modal" class="btn-link-project-detail btn btn-thm float-right" data-target=".bd-example-modal-lg" @endif> -->
            <?php $afterRedirect = "\/project/" . $project->slug ?>
            <div class="feat_property list project_data">
                <div class="thumb">
                    <div @if (Auth::id()) onclick="window.location='{{URL::to('/')}}/project/{{ $project->slug }}'"
                    @else class="btn-link-project-detail btn btn-thm float-right"
                    onclick="OpenLoginRegisterModal('{{$afterRedirect}}')" @endif>
                        <img class="img-whp" src="/{{ $project->project_cover_img }}" alt="{{ $project->name }}">
                        <div class="ribbon">
                            <div class="txt">
                                {{ $project->progress }}
                            </div>
                        </div>
                    </div>
                    
                    <!--<a class="service-wishlist " data-id="1" data-type="property"><i class="fa fa-heart project_icon"></i></a> -->
                    <a class="service-wishlist addressclickable" data-id="1" data-type="property" value="{{$loop->index+1}}">
                        <span id="lat{{$loop->index+1}}" class="d-none lat">{{$project->latitude}}</span>
                        <span id="lon{{$loop->index+1}}" class="d-none lon">{{$project->longitude}}</span>
                        <i class="fa fa-map-marker project_icon"></i>
                    </a>
                    <input type="hidden" class="project_id" value="{{$project->id}}">
                    @if (Auth::id())
                        <a href="Javascript:void(0);" type="btn" class="add-to-wishlist-btn service-heart" data-project="{{$project->id}}" data-id="1" data-type="property"><i class="fa fa-heart project_icon"></i></a>
                    @else
                        <a class="service-heart" data-id="1" data-toggle="modal" data-target=".bd-example-modal-lg" data-type="property"><i class="fa fa-heart project_icon"></i></a>
                    @endif
                <!-- <a class="service-photos" data-id="1" data-type="property"><i class="fa fa-camera project_icon"></i></a>-->
                </div>
                <div class="details">
                    <div class="tc_content">
                        <div class="utf-listing-title">
                            <h4>{{ $project->name }}</h4>
                        </div>
                        <div class="dtls_headr">
                            <span class="utf-listing-price">
                                <?php
                                $minimumProjectUnitPrice = 0;
                                if (count($project->units)) {
                                    $minimumProjectUnitPrice = $project->units->min("total_unit_amount");
                                }
                                ?>

                                Starting from
                                Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minimumProjectUnitPrice) }}
                            </span>
                        </div>
                        <span class="num-view flaticon-view">{{$project->views}}</span>
                        <p class="text-builder">By {{ isset($project->owners->first()->full_name) ? $project->owners->first()->full_name : ''  }}</p>
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
                                            <span id="lat{{$loop->index+1}}"
                                                  class="d-none lat">{{$project->latitude}}</span>
                                            <span id="lon{{$loop->index+1}}"
                                                  class="d-none lon">{{$project->longitude}}</span>
                                <!-- <span data-toggle="modal" data-target=".addressModal"> -->
                                            {!! Str::limit($project->address, 50) !!}
                                        </span>

                        </p>
                        <p>
                            <span> {!! Str::limit($project->details, 125) !!}</span>
                        </p>

                    </div>
                    <div class="fp_footer search_option_button">
                        @if (Auth::id())
                            <a href="{!! url("/compare/" . $project->id . '/?clicked=true') !!}"
                               class="float-left float-lg-left float-xl-left">
                                <img src="\assets\images\property\comparison_icon.png" width="35%;"> <span
                                    style="font-weight: 400">Compare</span>
                            </a>
                        @else
                            <a href="/login?ref={!! url("/compare/" . $project->id . '/?clicked=true') !!}"
                               class="float-left float-lg-left float-xl-left">
                                <img src="\assets\images\property\comparison_icon.png" width="35%"> <span
                                    style="font-weight: 400">Compare</span>
                            </a>
                        @endif

                        @if (Auth::id())
                            <a href="/project/{{ $project->slug }}"
                               class="btn btn-thm float-right float-lg-right">
                                View Details
                            </a>
                        @else
                            <a href="#" data-toggle="modal" data-target="#myModal{{ $key }}" class="btn-link-project-detail btn btn-thm float-right float-lg-right">
                                View Details
                            </a>

                            <div class="modal fade" id="myModal{{ $key }}" role="dialog">
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
                                        <a href="/login?ref={!! url('/project/' . $project->slug) !!}" class="btn btn-success">Login</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
    @endforeach
@else
    <div class="bdg-warning">
        <h3>Sorry, There are no active properties matching your criteria</h3>
    </div>
@endif

    @if ($isPaginator && $projects->hasPages())
        <div class="col-lg-12 mt20">
            <p>Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }}
                of {{ $projects->total() }} results</p>
            <div class="mbp_pagination">
                <ul class="page_navigation">

                    <!--Previous page-->
                    @if ($projects->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <span class="flaticon-left-arrow"></span> Prev</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-links" href="{{ $projects->previousPageUrl() }}"
                               tabindex="-1" aria-disabled="true"> <span
                                    class="flaticon-left-arrow"></span> Prev</a>
                        </li>
                    @endif
                <!--Previous page-->

                    <!-- Page 1 -->
                    @if($projects->currentPage() >= 2)
                        <li class="page-item"><a class="page-link"
                                                 href="{{ $projects->url(1) }}">1</a></li>
                    @endif
                <!-- Page 1 -->

                    <!-- Page 2 -->
                    @if($projects->currentPage() > 2)
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                    @endif
                <!-- Page 2 -->

                    @foreach(range($projects->currentPage(), $projects->lastPage()) as $i)
                        @if($i >= ($projects->currentPage() - 2) && $i <= ($projects->currentPage() + 2))
                            @if ($i == $projects->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">{{ $i }} <span
                                            class="sr-only">(current)</span></a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link"
                                                         href="{{ $projects->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach

                    @if($projects->currentPage() < ($projects->lastPage() - 3))
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                    @endif

                    @if($projects->currentPage() < ($projects->lastPage() - 2))
                        <li class="page-item">
                            <a class="page-link"
                               href="{{ $projects->url($projects->lastPage()) }}">{{ $projects->lastPage() }}</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($projects->hasMorePages())
                        <li class="page-item">
                            <a class="page-links" href="{{ $projects->nextPageUrl() }}"><span
                                    class="flaticon-right-arrow"></span></a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link" href="#"><span
                                    class="flaticon-right-arrow"></span> Next</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    @endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

<script>
    $('.add-to-wishlist-btn').click(function(){
        var projectId = $(this).attr('data-project');
        // alert(projectId);
        $.ajax ({
            method:'GET',
            url:'/add-wishlist/'+projectId,
            success:  function (response){
                    toastr.success(response.status , {
                    icon: "success",
                })
            }  
        });
    })
</script>