<div class="sidebar_listing_list">
    <div class="utf-boxed-list-headline-item">
        <h3>Housing Calculator</h3>
    </div>
    <div class="sidebar_advanced_search_widget">
        <div class="row">
            <div class="col-md-12">
                {{--                <img src="http://markproperties.pk/projects/wp-content/uploads/2021/03/download.png" class="img-responsive gar1 cal_img">--}}
                <p class="text-center fz20">
                    <strong>My Budget</strong><br>
                    <strong>Rs. <span id="cal-result">{!! round($searchData['maxBudget'] ?? 0) !!}</span></strong>
                </p>
            </div>
        </div>
        <div class="row">
            <ul class="nav nav-tabs desktop_tab" id="myTab" role="tablist">
                <li class="nav-item desktop_tab_housing">
                    <a class="nav-link active" id="flat-tab" data-toggle="tab"
                       href="#tab-flat" role="tab" aria-controls="tab-flat"
                       aria-selected="true">FLAT</a>
                </li>
                <li class="nav-item desktop_tab_housing">
                    <a class="nav-link" id="construction-tab" data-toggle="tab"
                       href="#tab-construction" role="tab"
                       aria-controls="tab-construction" aria-selected="false">CONSTRUCTION</a>
                </li>
            </ul>
            <div class="tab-content desktop_tab_housing_content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-flat" role="tabpanel" aria-labelledby="flat-tab">
                    <br>
                    <form id="searchPropertiesWithFlat">

                        <input type="hidden" name="maxBudget" id="maxBudgetFlat" value="0">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="col-sm-12">
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
                                                title="Please Select Area">
                                            <option value="" disabled>Please Select Area</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}"
                                                        data-tokens="{{ $area->name }}"
                                                        @if ($searchData['area'] && $searchData['calcSearch'])
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
                                <div class="form-group">
                                    <input type="number" class="form-control" name="downPayment"
                                           id="calculator_down_payment_flat" placeholder="Down Payment">
                                </div>
                            </div>
                        </div>

                        <label class="cal_split_txt">
                            <input class="down_payment_checkbox_flat cal_split_txt"
                                   type="checkbox"
                                   value="split">
                            Split Down Payment ?</label>

                        <div class="project_type col-sm-12">
                            <div class="down_payment_options_flat hide">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control number Booking" placeholder="Booking">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control number allocation"
                                               placeholder="Allocation">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control number confirmation"
                                               placeholder="Confirmation">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control number start_of_work"
                                               placeholder="Start of Work">
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="search_option_two areaSelect">
                            <div class="candidate_revew_select">
                                <select id="duration_month_flat" class="select2-month form-control" name="duration">
                                    <option disabled value="24" data-m="24" data-q="8" data-h="4" data-y="2"> Select
                                        Months
                                    </option>
                                    <option value="1" data-m="1" data-q="0" data-h="0" data-y="0">1 Month</option>
                                    <option value="3" data-m="3" data-q="1" data-h="0" data-y="0">3 Months</option>
                                    <option value="6" data-m="6" data-q="2" data-h="1" data-y="0">6 Months</option>
                                    <option value="9" data-m="9" data-q="3" data-h="1" data-y="0">9 Months</option>
                                    <option value="12" data-m="12" data-q="4" data-h="2" data-y="1">12 Months</option>
                                    <option value="24" data-m="24" data-q="8" data-h="4" data-y="2">24 Months</option>
                                    <option value="36" data-m="36" data-q="12" data-h="6" data-y="3">36 Months</option>
                                    <option value="48" data-m="48" data-q="16" data-h="8" data-y="4">48 Months</option>
                                    <option value="60" data-m="60" data-q="20" data-h="10" data-y="5">60 Months</option>
                                </select>
                            </div>
                        </div>

                        <input type="number" name="monthInstall" class="cal_input number1 number"
                               id="Monthly_Installment"
                               placeholder="Monthly Installment">
                        <input type="number" name="quarterlyInstall" class="cal_input number1 number"
                               id="Quarterly_Installment"
                               placeholder="Quarterly Installment">
                        <input type="number" name="halfYearlyInstall" class="cal_input number1 number"
                               id="Half_Yearly_Installment"
                               placeholder="Half Yearly Installment">
                        <input type="number" name="yearlyInstall" class="cal_input number1 number"
                               id="Yearly_Installment"
                               placeholder="Yearly Installment">
                        <input type="number" name="possession" class="cal_input number1 number" id="Possession"
                               placeholder="Possession">
                        <button type="submit" name="isCalculator" class="btn btn-block btn-thm">Projects in this
                            Budget
                        </button>
                    </form>
                </div>
                <div class="tab-pane fade" id="tab-construction" role="tabpanel" aria-labelledby="construction-tab">
                    <br>
                    <form id="searchPropertiesWithConstruction">

                        <input type="hidden" name="maxBudget" id="maxBudgetConstruction" value="0">

                        {!! csrf_field() !!}

                        <div class="project_type">
                            <div class="construction_options">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="number" name="slabCasting" class="form-control number"
                                                   placeholder="Slab Casting">
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="number" name="plinth" class="form-control number"
                                                   placeholder="Plinth">
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="number" name="colour" class="form-control number"
                                                   placeholder="Colour">
                                        </div>
                                        <div class="col-sm-12">
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
                                                            title="Please Select Area">
                                                        <option value="" disabled>Please Select Area</option>
                                                        @foreach ($areas as $area)
                                                            <option value="{{ $area->id }}"
                                                                    data-tokens="{{ $area->name }}"
                                                                    @if ($searchData['area'] && $searchData['calcSearch'])
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
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="downPayment"
                                                       id="down_payment" placeholder="Down Payment">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="cal_split_txt">
                                                <input class="down_payment_checkbox cal_split_txt"
                                                       type="checkbox"
                                                       value="split">
                                                Split Down Payment ?</label>
                                        </div>
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
                                                        <input type="number" class="form-control number confirmation"
                                                               placeholder="Confirmation">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control number start_of_work"
                                                               placeholder="Start of Work">
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="search_option_two areaSelect">
                                                <div class="candidate_revew_select">
                                                    <select id="duration_month" class="select2-month form-control"
                                                            name="duration">
                                                        <option disabled value="24" data-m="24" data-q="8" data-h="4"
                                                                data-y="2"> Select Months
                                                        </option>
                                                        <option value="1" data-m="1" data-q="0" data-h="0" data-y="0">1
                                                            Month
                                                        </option>
                                                        <option value="3" data-m="3" data-q="1" data-h="0" data-y="0">3
                                                            Months
                                                        </option>
                                                        <option value="6" data-m="6" data-q="2" data-h="1" data-y="0">6
                                                            Months
                                                        </option>
                                                        <option value="9" data-m="9" data-q="3" data-h="1" data-y="0">9
                                                            Months
                                                        </option>
                                                        <option value="12" data-m="12" data-q="4" data-h="2" data-y="1">
                                                            12 Months
                                                        </option>
                                                        <option value="24" data-m="24" data-q="8" data-h="4" data-y="2">
                                                            24 Months
                                                        </option>
                                                        <option value="36" data-m="36" data-q="12" data-h="6"
                                                                data-y="3">36 Months
                                                        </option>
                                                        <option value="48" data-m="48" data-q="16" data-h="8"
                                                                data-y="4">48 Months
                                                        </option>
                                                        <option value="60" data-m="60" data-q="20" data-h="10"
                                                                data-y="5">60 Months
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="number" name="monthInstall" class="cal_input number1 number"
                               id="Monthly_Installment" placeholder="Monthly Installment">
                        <input type="number" name="quarterlyInstall" class="cal_input number1 number"
                               id="Quarterly_Installment" placeholder="Quarterly Installment">
                        <input type="number" name="halfYearlyInstall" class="cal_input number1 number"
                               id="Half_Yearly_Installment" placeholder="Half Yearly Installment">
                        <input type="number" name="yearlyInstall" class="cal_input1 number1 number"
                               id="Yearly_Installment" placeholder="Yearly Installment">
                        <input type="number" name="possession" class="cal_input1 number1 number" id="Possession"
                               placeholder="Possession">
                        <button type="submit" name="isCalculator" class="btn btn-block btn-thm">Projects in this
                            Budget
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
