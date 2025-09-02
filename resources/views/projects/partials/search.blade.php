<div class="row search_filter_section">
    <div class="col-md-12 col-lg-12 filter-section">
        <div class="">
            <div class="tab-content home1_adsrchfrm" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form id="searchProperties" action="/projects/getlistings" method="get">
                        @csrf
                        <div class="row">
                            <!-- Project Name Filter -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="shortcode_widget_multiselect">
                                        <div class="ui_kit_multi_select_box">
                                            <select class="selectpicker" name="project_name[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Project Name">
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
                                </div>
                            </div>

                            <!-- Area Filter -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="shortcode_widget_multiselect">
                                        <div class="ui_kit_multi_select_box">
                                            <select class="selectpicker" name="area[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Area">
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}" 
                                                            @if($searchData['area'] && in_array($area->id, $searchData['area'])) selected @endif>
                                                        {{ $area->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Type Filter -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="shortcode_widget_multiselect">
                                        <div class="ui_kit_multi_select_box">
                                            <select class="selectpicker" name="type_id[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Project Type">
                                                @foreach ($projectTypes as $projectType)
                                                    <option value="{{ $projectType->id }}" 
                                                            @if($searchData['type_id'] && in_array($projectType->id, $searchData['type_id'])) selected @endif>
                                                        {{ $projectType->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Advanced Filters (Hidden by Default) -->
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Max Down Payment" name="maxDP" value="{{ $searchData['maxDP'] ?? '' }}">
                                    <input type="text" min="0" id="downPayment" style="display:none" value="{{ $searchData['downPayment'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Max Monthly Installment" name="maxMI" value="{{ $searchData['maxMI'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Min Down Payment" name="minDP" value="{{ $searchData['minDP'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Min Monthly Installment" name="minMI" value="{{ $searchData['minMI'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Min Price" name="minPrice" value="{{ $searchData['minPrice'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <div id="minPriceError" class="hide">Value should be greater than Min Price</div>
                                    <input type="text" min="0" class="form-control" placeholder="Max Price" name="maxPrice" value="{{ $searchData['maxPrice'] ?? '' }}">
                                    <input type="text" min="0" id="maxBudget" style="display:none" value="{{ $searchData['maxBudget'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <select class="selectpicker" name="progress[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Project Progress">
                                        @foreach ($progress as $progressItem)
                                            <option value="{{ $progressItem->progress_status_name }}" 
                                                    @if($searchData['progress'] && in_array($progressItem->progress_status_name, $searchData['progress'])) selected @endif>
                                                {{ $progressItem->progress_status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <select class="selectpicker" name="builder[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Builder">
                                        @foreach ($builders as $builder)
                                            <option value="{{ $builder->id }}" 
                                                    @if($searchData['builder'] && in_array($builder->id, $searchData['builder'])) selected @endif>
                                                {{ $builder->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <select class="selectpicker" name="tag_id[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Tags">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" 
                                                    @if($searchData['tag_id'] && in_array($tag->id, $searchData['tag_id'])) selected @endif>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-md-3 txt-center">
                                <ul>
                                    <li class="custome_fields_520 list-inline-item">
                                        <div class="navbered">
                                            <div class="mega-dropdown advance_filter_btn">
                                                <span id="show_advancefields" class="dropbtn">
                                                    <span id="more-less-txt">More</span> <i class="flaticon-more pl10 flr-520"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="search_option_button">
                                            <button type="submit" class="btn btn-thm flaticon-magnifying-glass">
                                                Search
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer')
    <!-- Begin::Page Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.selectpicker').selectpicker();

            // Toggle advanced fields when "More" button is clicked
            $('#show_advancefields').on('click', function() {
                $('.toggle-advanced-fields').toggleClass('hide');
                var text = $('#more-less-txt').text();
                $('#more-less-txt').text(text === 'More' ? 'Less' : 'More');
            });
        });
    </script>
    <!-- End::Page Scripts -->
@endsection