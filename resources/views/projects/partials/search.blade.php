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
                                                                @if(isset($searchData['project_name']) && is_array($searchData['project_name']) && in_array($project->id, $searchData['project_name'])) selected @endif>
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
                                                            @if(isset($searchData['area']) && is_array($searchData['area']) && in_array($area->id, $searchData['area'])) selected @endif>
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
                                                            @if(isset($searchData['type_id']) && is_array($searchData['type_id']) && in_array($projectType->id, $searchData['type_id'])) selected @endif>
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
                                    <input type="text" min="0" class="form-control" placeholder="Max Down Payment" name="maxDP" value="{{ isset($searchData['maxDP']) ? $searchData['maxDP'] : '' }}">
                                    <input type="text" min="0" id="downPayment" style="display:none" value="{{ isset($searchData['downPayment']) ? $searchData['downPayment'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Max Monthly Installment" name="maxMI" value="{{ isset($searchData['maxMI']) ? $searchData['maxMI'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Min Down Payment" name="minDP" value="{{ isset($searchData['minDP']) ? $searchData['minDP'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Min Monthly Installment" name="minMI" value="{{ isset($searchData['minMI']) ? $searchData['minMI'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <input type="text" min="0" class="form-control" placeholder="Min Price" name="minPrice" value="{{ isset($searchData['minPrice']) ? $searchData['minPrice'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <div id="minPriceError" class="hide">Value should be greater than Min Price</div>
                                    <input type="text" min="0" class="form-control" placeholder="Max Price" name="maxPrice" value="{{ isset($searchData['maxPrice']) ? $searchData['maxPrice'] : '' }}">
                                    <input type="text" min="0" id="maxBudget" style="display:none" value="{{ isset($searchData['maxBudget']) ? $searchData['maxBudget'] : '' }}">
                                </div>
                            </div>

                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <select class="selectpicker" name="progress[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Project Progress">
                                        @foreach ($progress as $progressItem)
                                            <option value="{{ $progressItem->progress_status_name }}"
                                                    @if(isset($searchData['progress']) && is_array($searchData['progress']) && in_array($progressItem->progress_status_name, $searchData['progress'])) selected @endif>
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
                                                    @if(isset($searchData['builder']) && is_array($searchData['builder']) && in_array($builder->id, $searchData['builder'])) selected @endif>
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
                                                    @if(isset($searchData['tag_id']) && is_array($searchData['tag_id']) && in_array($tag->id, $searchData['tag_id'])) selected @endif>
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

            // Redirect search to Off-Plan page with existing params and a combined text query
            $('#searchProperties').off('submit.redirectOffPlan').on('submit.redirectOffPlan', function(e) {
                e.preventDefault();

                var params = [];
                $(this).serializeArray().forEach(function(i) {
                    if (i.value !== '' && i.value !== null) {
                        params.push(i);
                    }
                });

                // Build a human-friendly query from selected option labels
                var texts = [];
                $('.selectpicker').each(function() {
                    $(this).find('option:selected').each(function() {
                        var t = $(this).text();
                        if (t) { texts.push(t); }
                    });
                });
                var q = texts.join(' ');

                var query = $.param(params);
                if (q) {
                    query = query ? (query + '&q=' + encodeURIComponent(q)) : ('q=' + encodeURIComponent(q));
                }

                window.location.href = '/off-plan' + (query ? ('?' + query) : '');
            });

            // Reset form fields for first-time users
            if (!window.location.search) {
                $('#searchProperties')[0].reset();
                $('.selectpicker').selectpicker('refresh');
            }
        });
    </script>
    <!-- End::Page Scripts -->
@endsection