<div class="row search_filter_section">
    <div class="col-md-12 col-lg-12 filter-section">
        <div class="">
            <div class="tab-content home1_adsrchfrm" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <form id="searchProperties" action="/projects/getlistings" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="shortcode_widget_multiselect">
                                        <!-- <label class="search_heading">Area</label> -->
                                        <div class="ui_kit_multi_select_box">
                                            <select class="selectpicker" name="area[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Area">
                                                <!-- <option disabled value="">Please Select</option> -->
                                                @foreach ($areas as $area)
                                                    <?php
                                                    $selected = '';
                                                    if (isset($areaId) && $areaId == $area->id) {
                                                        $selected = 'selected';
                                                    }
                                                    ?>
                                                    <option {{ $selected }} value="{{ $area->id }}">
                                                        {{ $area->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="shortcode_widget_multiselect">
                                        <!-- <label class="search_heading">Project Type</label> -->
                                        <div class="ui_kit_multi_select_box">
                                            <select class="selectpicker" name="type_id[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Project Type">
                                                <!-- <option disabled value="">Please Select</option> -->
                                                @foreach ($projectTypes as $projectType)
                                                    <?php
                                                    $selected = '';
                                                    if (isset($projecttypeId) && $projecttypeId == $projectType->id) {
                                                        $selected = 'selected';
                                                    }
                                                    ?>
                                                    <option {{ $selected }} value="{{ $projectType->id }}">
                                                        {{ $projectType->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Max Down Payment</label> -->
                                    <input type="text" min="0" class="form-control" placeholder="Max Down Payment" name="maxDP" @if (request()->get('maxDP')) value="{!! request()->get('maxDP') !!}" @endif>
                                    <input type="text" min="0" id="downPayment" style="display:none">
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Max Monthly Installment</label> -->
                                    <input type="text" min="0" class="form-control" placeholder="Max Monthly Installment" name="maxMI" @if (request()->get('maxMI')) value="{!! request()->get('maxMI') !!}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Min Down Payment</label> -->
                                    <input type="text" min="0" class="form-control" placeholder="Min Down Payment" name="minDP" @if (request()->get('minDP')) value="{!! request()->get('minDP') !!}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Min Monthly Installment</label> -->
                                    <input type="text" min="0" class="form-control" placeholder="Min Monthly Installment" name="minMI" @if (request()->get('minMI')) value="{!! request()->get('minMI') !!}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Min Price</label> -->
                                    <input type="text" min="0" class="form-control" placeholder="Min Price" name="minPrice" @if (request()->get('minPrice')) value="{!! request()->get('minPrice') !!}" @endif>
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Max Price</label> -->
                                    <div id="minPriceError" class="hide">value should be greater than Min Price</div>
                                    <input type="text" min="0" class="form-control" placeholder="Max Price" name="maxPrice" @if (request()->get('maxPrice')) value="{!! request()->get('maxPrice') !!}" @endif>
                                    <input type="text" min="0" id="maxBudget" style="display:none">
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Progress</label> -->
                                    <select class="selectpicker" name="progress[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Project Progress">
                                        <!-- <option disabled value="">Please Select</option> -->
                                        @foreach ($progress as $progress)
                                            <option value="{{ $progress->progress_status_name }}" @if (request()->get('progress') && in_array($progress->progress_status_name, request()->get('progress'))) selected @endif>
                                                {{ $progress->progress_status_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Builder</label> -->
                                    <select class="selectpicker" name="builder[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Builder">
                                        <!-- <option disabled value="">Please Select</option> -->
                                        @foreach ($builders as $blder)
                                            <option value="{{ $blder->id }}" @if (request()->get('builder') && in_array($blder->id, request()->get('builder'))) selected @endif>
                                                {{ $blder->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 toggle-advanced-fields hide">
                                <div class="form-group">
                                    <!-- <label class="search_heading">Tags</label> -->
                                    <select class="selectpicker" name="tag_id[]" multiple="multiple" data-live-search="true" data-actions-box="true" data-live-search-placeholder="Please Select" title="Select Tags">
                                        <!-- <option disabled value="">Please Select</option> -->
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" @if (request()->get('tag_id') && in_array($tag->id, request()->get('tag_id'))) selected @endif>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
<!--begin::Page Scripts-->
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
<!--end::Page Scripts-->
@endsection