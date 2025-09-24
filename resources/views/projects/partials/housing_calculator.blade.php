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
                    <strong>Rs. <span id="cal-result">{!! round(($searchData['maxBudget'] ?? 0)) !!}</span></strong>
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
                                <div class="form-group">
						<label for="calculator_down_payment_flat">Down Payment</label>
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
									<label for="flat_booking">Booking</label>
									<input type="number" id="flat_booking" class="form-control number Booking" placeholder="Booking">
                                    </div>
                                    <div class="col-sm-6">
									<label for="flat_allocation">Allocation</label>
									<input type="number" id="flat_allocation" class="form-control number allocation"
                                               placeholder="Allocation">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
									<label for="flat_confirmation">Confirmation</label>
									<input type="number" id="flat_confirmation" class="form-control number confirmation"
                                               placeholder="Confirmation">
                                    </div>
                                    <div class="col-sm-6">
									<label for="flat_start_of_work">Start of Work</label>
									<input type="number" id="flat_start_of_work" class="form-control number start_of_work"
                                               placeholder="Start of Work">
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="search_option_two areaSelect">
                            <div class="candidate_revew_select">
								<label for="duration_month_flat">Payment Duration</label>
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

						<label for="Monthly_Installment">Monthly Installment</label>
						<input type="number" name="monthInstall" class="cal_input number1 number"
                               id="Monthly_Installment"
                               placeholder="Monthly Installment">
						<label for="Quarterly_Installment">Quarterly Installment</label>
						<input type="number" name="quarterlyInstall" class="cal_input number1 number"
                               id="Quarterly_Installment"
                               placeholder="Quarterly Installment">
						<label for="Half_Yearly_Installment">Half Yearly Installment</label>
						<input type="number" name="halfYearlyInstall" class="cal_input number1 number"
                               id="Half_Yearly_Installment"
                               placeholder="Half Yearly Installment">
						<label for="Yearly_Installment">Yearly Installment</label>
						<input type="number" name="yearlyInstall" class="cal_input number1 number"
                               id="Yearly_Installment"
                               placeholder="Yearly Installment">
						<label for="Possession">Possession Fee</label>
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
									<label for="slab_casting_input">Slab Casting</label>
                                            <input type="number" name="slabCasting" class="form-control number"
									       id="slab_casting_input" placeholder="Slab Casting">
                                        </div>
                                        <div class="col-sm-12">
									<label for="plinth_input">Plinth</label>
                                            <input type="number" name="plinth" class="form-control number"
									       id="plinth_input" placeholder="Plinth">
                                        </div>
                                        <div class="col-sm-12">
									<label for="colour_input">Colour</label>
                                            <input type="number" name="colour" class="form-control number"
									       id="colour_input" placeholder="Colour">
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="search_option_two areaSelect">
                                                <div class="candidate_revew_select">
											<label for="areaSelectDiv">Please Select Area</label>
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
                                        <div class="col-sm-12">
                                            <div class="form-group">
										<label for="down_payment">Down Payment</label>
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
										<label for="cons_booking">Booking</label>
										<input type="tel" id="cons_booking" class="form-control number Booking"
                                                               placeholder="Booking">
                                                    </div>
                                                    <div class="col-sm-6">
										<label for="cons_allocation">Allocation</label>
										<input type="tel" id="cons_allocation" class="form-control number allocation"
                                                               placeholder="Allocation">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-6">
										<label for="cons_confirmation">Confirmation</label>
										<input type="number" id="cons_confirmation" class="form-control number confirmation"
                                                               placeholder="Confirmation">
                                                    </div>
                                                    <div class="col-sm-6">
										<label for="cons_start_of_work">Start of Work</label>
										<input type="number" id="cons_start_of_work" class="form-control number start_of_work"
                                                               placeholder="Start of Work">
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="search_option_two areaSelect">
                                                <div class="candidate_revew_select">
								<label for="duration_month">Payment Duration</label>
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

						<label for="Monthly_Installment">Monthly Installment</label>
						<input type="number" name="monthInstall" class="cal_input number1 number"
                               id="Monthly_Installment" placeholder="Monthly Installment">
						<label for="Quarterly_Installment">Quarterly Installment</label>
						<input type="number" name="quarterlyInstall" class="cal_input number1 number"
                               id="Quarterly_Installment" placeholder="Quarterly Installment">
						<label for="Half_Yearly_Installment">Half Yearly Installment</label>
						<input type="number" name="halfYearlyInstall" class="cal_input number1 number"
                               id="Half_Yearly_Installment" placeholder="Half Yearly Installment">
						<label for="Yearly_Installment">Yearly Installment</label>
						<input type="number" name="yearlyInstall" class="cal_input1 number1 number"
                               id="Yearly_Installment" placeholder="Yearly Installment">
						<label for="Possession">Possession Fee</label>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
	var resultEl = document.getElementById('cal-result');
	var flatForm = document.getElementById('searchPropertiesWithFlat');
	var constructionForm = document.getElementById('searchPropertiesWithConstruction');
	var activeForm = flatForm || constructionForm;

	function toNumber(value) {
		if (value === null || value === undefined) return 0;
		var num = parseFloat(String(value).toString().replace(/,/g, ''));
		return isNaN(num) || !isFinite(num) || num < 0 ? 0 : num;
	}

	function formatNumber(num) {
		try {
			return new Intl.NumberFormat('en-PK').format(num);
		} catch (e) {
			return String(num).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		}
	}

	function getDurationMonths(form) {
		var select = form && (form.querySelector('#duration_month_flat') || form.querySelector('#duration_month'));
		if (!select) return 0;
		var val = parseInt(select.value, 10);
		return isNaN(val) ? 0 : val;
	}

	function setPossessionValidity(input, valid) {
		// Possession is optional now; keep function as no-op to preserve API
		return;
	}

	function calculateMyBudget(form) {
		if (!form) return 0;
		var downPaymentInput = form.querySelector('input[name="downPayment"]') || form.querySelector('#calculator_down_payment_flat') || form.querySelector('#down_payment');
		var monthlyInput = form.querySelector('#Monthly_Installment');
		var quarterlyInput = form.querySelector('#Quarterly_Installment');
		var halfYearlyInput = form.querySelector('#Half_Yearly_Installment');
		var yearlyInput = form.querySelector('#Yearly_Installment');
		var possessionInput = form.querySelector('#Possession');
		// Construction-specific extras
		var slabInput = form.querySelector('input[name="slabCasting"]');
		var plinthInput = form.querySelector('input[name="plinth"]');
		var colourInput = form.querySelector('input[name="colour"]');

		var durationMonths = getDurationMonths(form);
		var downPayment = toNumber(downPaymentInput ? downPaymentInput.value : 0);
		var monthly = toNumber(monthlyInput ? monthlyInput.value : 0);
		var quarterly = toNumber(quarterlyInput ? quarterlyInput.value : 0);
		var halfYearly = toNumber(halfYearlyInput ? halfYearlyInput.value : 0);
		var yearly = toNumber(yearlyInput ? yearlyInput.value : 0);
		var possession = toNumber(possessionInput ? possessionInput.value : 0);
		var slab = toNumber(slabInput ? slabInput.value : 0);
		var plinth = toNumber(plinthInput ? plinthInput.value : 0);
		var colour = toNumber(colourInput ? colourInput.value : 0);

		var total = 0;
		total += downPayment;
		if (monthly > 0 && durationMonths > 0) total += monthly * durationMonths;
		if (quarterly > 0 && durationMonths > 0) total += (quarterly / 3) * durationMonths;
		if (halfYearly > 0 && durationMonths > 0) total += (halfYearly / 6) * durationMonths;
		if (yearly > 0 && durationMonths > 0) total += (yearly / 12) * durationMonths;
		total += possession;
		// Add construction stage sums when present (only in construction form)
		if (form && form.id === 'searchPropertiesWithConstruction') {
			total += slab + plinth + colour;
		}

		if (!isFinite(total)) return 0;
		return Math.max(0, total);
	}

	var debounceTimer = null;
	function scheduleUpdate(form) {
		if (debounceTimer) window.clearTimeout(debounceTimer);
		debounceTimer = window.setTimeout(function () {
			var total = calculateMyBudget(form);
			if (resultEl) resultEl.textContent = formatNumber(Math.round(total));
			var hidden = form && (form.querySelector('#maxBudgetFlat') || form.querySelector('#maxBudgetConstruction'));
			if (hidden) hidden.value = Math.round(total);
		}, 120);
	}

	function formatInputValue(el) {
		if (!el) return;
		var raw = String(el.value || '').replace(/[^0-9.]/g, '');
		// Handle at most one decimal point
		var parts = raw.split('.');
		if (parts.length > 2) {
			raw = parts[0] + '.' + parts.slice(1).join('');
		}
		var num = toNumber(raw);
		var hasDecimal = /\./.test(raw);
		var decimalPart = '';
		if (hasDecimal) {
			var idx = raw.indexOf('.');
			decimalPart = raw.slice(idx);
		}
		var formatted = formatNumber(Math.floor(num));
		if (hasDecimal && decimalPart.length > 1) {
			formatted = formatted + decimalPart;
		}
		el.value = formatted;
	}

	function sumSplitDownPayment(form) {
		if (!form) return 0;
		var splitContainer = form.querySelector('.down_payment_options_flat') || form.querySelector('.down_payment_options');
		if (!splitContainer) return 0;
		var parts = splitContainer.querySelectorAll('input.number');
		var total = 0;
		parts.forEach(function (p) { total += toNumber(p.value); });
		return total;
	}

	function makeInputsFormatAsCurrency(form) {
		if (!form) return;
		var inputs = form.querySelectorAll('input[type="number"], input.cal_input, input.cal_input1, input.form-control.number');
		inputs.forEach(function (el) {
			// Switch to text to allow commas, keep numeric keyboard
			try { if (el.type && el.type.toLowerCase() === 'number') el.type = 'text'; } catch(e) {}
			el.setAttribute('inputmode', 'decimal');
			// Initial format
			formatInputValue(el);
			el.addEventListener('input', function () { formatInputValue(el); scheduleUpdate(form); });
			el.addEventListener('blur', function () { formatInputValue(el); });
		});
	}

	function attachListeners(form) {
		if (!form) return;
		makeInputsFormatAsCurrency(form);
		var inputs = form.querySelectorAll('input[type="text"], input[type="tel"], input.cal_input, input.cal_input1');
		inputs.forEach(function (el) {
			el.addEventListener('input', function () { scheduleUpdate(form); });
			el.addEventListener('change', function () { scheduleUpdate(form); });
		});
		var selects = form.querySelectorAll('select');
		selects.forEach(function (sel) {
			sel.addEventListener('change', function () { scheduleUpdate(form); });
		});
		form.addEventListener('submit', function () {
			var total = calculateMyBudget(form);
			var hidden = form.querySelector('#maxBudgetFlat') || form.querySelector('#maxBudgetConstruction');
			if (hidden && total !== null) hidden.value = Math.round(total);
		});

		// Split Down Payment toggles (per form)
		var flatToggle = form.querySelector('.down_payment_checkbox_flat');
		var flatSection = form.querySelector('.down_payment_options_flat');
		var flatDownPayment = form.querySelector('#calculator_down_payment_flat');
		if (flatToggle && flatSection) {
			var syncFlatVisibility = function () {
				if (flatToggle.checked) {
					flatSection.classList.remove('hide');
					if (flatDownPayment) flatDownPayment.setAttribute('readonly', 'readonly');
					// Sum parts into down payment display
					var sum = sumSplitDownPayment(form);
					if (flatDownPayment) flatDownPayment.value = formatNumber(Math.floor(sum));
				} else {
					flatSection.classList.add('hide');
					if (flatDownPayment) flatDownPayment.removeAttribute('readonly');
				}
				scheduleUpdate(form);
			};
			flatToggle.addEventListener('change', syncFlatVisibility);
			// Live update when typing in split fields
			flatSection.querySelectorAll('input.number').forEach(function (el) {
				el.addEventListener('input', function () {
					if (flatToggle.checked) {
						var sum = sumSplitDownPayment(form);
						if (flatDownPayment) flatDownPayment.value = formatNumber(Math.floor(sum));
					}
					scheduleUpdate(form);
				});
			});
			syncFlatVisibility();
		}

		var consToggle = form.querySelector('.down_payment_checkbox');
		var consSection = form.querySelector('.down_payment_options');
		var consDownPayment = form.querySelector('#down_payment');
		if (consToggle && consSection) {
			var syncConsVisibility = function () {
				if (consToggle.checked) {
					consSection.classList.remove('hide');
					if (consDownPayment) consDownPayment.setAttribute('readonly', 'readonly');
					var sum = sumSplitDownPayment(form);
					if (consDownPayment) consDownPayment.value = formatNumber(Math.floor(sum));
				} else {
					consSection.classList.add('hide');
					if (consDownPayment) consDownPayment.removeAttribute('readonly');
				}
				scheduleUpdate(form);
			};
			consToggle.addEventListener('change', syncConsVisibility);
			consSection.querySelectorAll('input.number').forEach(function (el) {
				el.addEventListener('input', function () {
					if (consToggle.checked) {
						var sum = sumSplitDownPayment(form);
						if (consDownPayment) consDownPayment.value = formatNumber(Math.floor(sum));
					}
					scheduleUpdate(form);
				});
			});
			syncConsVisibility();
		}
	}

	attachListeners(flatForm);
	attachListeners(constructionForm);

	// Handle tab switching to recalc based on active tab
	var flatTab = document.getElementById('flat-tab');
	var constructionTab = document.getElementById('construction-tab');
	function recalcActive() {
		var flatPane = document.getElementById('tab-flat');
		var isFlatActive = flatPane && flatPane.classList.contains('show') && flatPane.classList.contains('active');
		activeForm = isFlatActive ? flatForm : constructionForm;
		scheduleUpdate(activeForm);
	}
	if (flatTab) flatTab.addEventListener('shown.bs.tab', recalcActive);
	if (constructionTab) constructionTab.addEventListener('shown.bs.tab', recalcActive);

	// Initial calculation on load
	recalcActive();
});
</script>