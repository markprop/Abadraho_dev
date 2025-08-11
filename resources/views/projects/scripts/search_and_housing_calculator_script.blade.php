<script>

    $(document).on("change", ".down_payment_checkbox", function () {
        if (this.checked) {
            $(".down_payment_options").addClass("show").removeClass("hide");
            $("input#down_payment").attr("disabled", true);
        } else {
            $(".down_payment_options").addClass("hide").removeClass("show");
            $("input#down_payment").attr("disabled", false);
        }
    });

    $(document).on("change", ".down_payment_checkbox_flat", function () {
        if (this.checked) {
            $(".down_payment_options_flat").addClass("show").removeClass("hide");
            $("input#calculator_down_payment_flat").attr("disabled", true);
        } else {
            $(".down_payment_options_flat").addClass("hide").removeClass("show");
            $("input#calculator_down_payment_flat").attr("disabled", false);
        }
    });

    $("#searchProperties").on("submit", function (event) {
        event.preventDefault();
        $('#currentSearch').val(1);
        getData($(this).serializeArray());
    });

    $("#searchPropertiesWithFlat").on("submit", function (event) {
        event.preventDefault();
        $('#currentSearch').val(2);
        var data = $(this).serializeArray();
        data.push({name: 'reseller_id', value: $('#reseller_id').val()});
        data.push({name: 'projectType', value: 'Flat'});
        getData(data);
    });

    $("#searchPropertiesWithConstruction").on("submit", function (event) {
        event.preventDefault();
        $('#currentSearch').val(3);
        var data = $(this).serializeArray();
        data.push({name: 'reseller_id', value: $('#reseller_id').val()});
        data.push({name: 'projectType', value: 'Construction'});
        getData(data);
    });

    $(document).on("change", ".down_payment_options_flat .confirmation, .down_payment_options_flat .Booking, .down_payment_options_flat .allocation, .down_payment_options_flat .start_of_work", function () {
        var Booking = $(".down_payment_options_flat input.Booking").val().replace(/,/g, "");
        var allocation = $(".down_payment_options_flat input.allocation").val().replace(/,/g, "");
        var confirmation = $(".down_payment_options_flat input.confirmation").val().replace(/,/g, "");
        var start_of_work = $(".down_payment_options_flat input.start_of_work").val().replace(/,/g, "");
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

        $("#calculator_down_payment_flat").val(addition);
        calculation();
    });

    $(document).on("change", ".down_payment_options .confirmation, .down_payment_options .Booking, .down_payment_options .allocation, .down_payment_options .start_of_work", function () {
        var Booking = $(".down_payment_options input.Booking").val().replace(/,/g, "");
        var allocation = $(".down_payment_options input.allocation").val().replace(/,/g, "");
        var confirmation = $(".down_payment_options input.confirmation").val().replace(/,/g, "");
        var start_of_work = $(".down_payment_options input.start_of_work").val().replace(/,/g, "");
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

    $(document).on('change', '#reseller_id', function (event) {
        event.preventDefault();
        var currentSearch = $('#currentSearch').val();
        if (currentSearch == 2) {
            var data = $("#searchPropertiesWithFlat").serializeArray();
        } else if (currentSearch == 3) {
            var data = $("#searchPropertiesWithConstruction").serializeArray();
        } else {
            var data = $("#searchProperties").serializeArray();
        }
        data.push({name: 'reseller_id', value: $(this).val()});
        getData(data);
    })

    $(document).on('click', '.page_navigation .page-link', function (event) {
        event.preventDefault();
        var currentSearch = $('#currentSearch').val();
        if (currentSearch == 2) {
            var data = $("#searchPropertiesWithFlat").serializeArray();
        } else if (currentSearch == 3) {
            var data = $("#searchPropertiesWithConstruction").serializeArray();
        } else {
            var data = $("#searchProperties").serializeArray();
        }
        data.push({name: 'page', value: parseInt($(this).html())});
        getData(data);
    });

    $('#show_advancefields').on('click', function() {
        $('.toggle-advanced-fields').slideToggle();

        setTimeout(function () {
            $("#more-less-txt").text($(".toggle-advanced-fields").is(':visible') ? 'Hide' : 'More');
        }, 1000)
    });

    $('#searchPropertiesWithFlat, #searchPropertiesWithConstruction').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            downPayment: {
                validators: {
                    notEmpty: {
                        message: 'Down Payment is Required.'
                    }
                }
            }
        }
    })

    // main calculation
    function calculation() {
        const activeForm = $('.active form').serializeArray();
        const construction = activeForm.find(x => x.name === "slabCasting");

        var month, Monthly, Quarterly, Half_Yearly, Yearly, down_payment;

        if (construction) {
            month = $("option:selected", "#duration_month").data('m');
            Monthly = $("option:selected", "#duration_month").data('m');
            Quarterly = $("option:selected", "#duration_month").data('q');
            Half_Yearly = $("option:selected", "#duration_month").data('h');
            Yearly = $("option:selected", "#duration_month").data('y');
            down_payment = $("#down_payment").val();
        } else {
            month = $("option:selected", "#duration_month_flat").data('m');
            Monthly = $("option:selected", "#duration_month_flat").data('m');
            Quarterly = $("option:selected", "#duration_month_flat").data('q');
            Half_Yearly = $("option:selected", "#duration_month_flat").data('h');
            Yearly = $("option:selected", "#duration_month_flat").data('y');
            down_payment = $("#calculator_down_payment_flat").val();
        }

        var Monthly_Installment = (activeForm.find(x => x.name === "monthInstall").value || 0) * Monthly;
        var Quarterly_Installment = (activeForm.find(x => x.name === "quarterlyInstall").value || 0) * Quarterly;
        var Half_Yearly_Installment = (activeForm.find(x => x.name === "halfYearlyInstall").value || 0) * Half_Yearly;
        var Yearly_Installment = (activeForm.find(x => x.name === "yearlyInstall").value || 0) * Yearly;
        var Possession = activeForm.find(x => x.name === "possession").value || 0;

        var down_payment_val = 0;
        var Monthly_Installment_val = 0;
        var Quarterly_Installment_val = 0;
        var Half_Yearly_Installment_val = 0;
        var Yearly_Installment_val = 0;
        var Possession_val = 0;

        if (down_payment !== "") {
            down_payment_val = down_payment;
        }
        if (Monthly_Installment !== "") {
            Monthly_Installment_val = Monthly_Installment;
        }
        if (Quarterly_Installment !== "") {
            Quarterly_Installment_val = Quarterly_Installment;
        }
        if (Half_Yearly_Installment !== "") {
            Half_Yearly_Installment_val = Half_Yearly_Installment;
        }
        if (Yearly_Installment !== "") {
            Yearly_Installment_val = Yearly_Installment;
        }
        if (Possession !== "") {
            Possession_val = Possession;
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

        var totalCalculation = parseInt(down_payment_val) +
            parseInt(Monthly_Installment_val) +
            parseInt(Quarterly_Installment_val) +
            parseInt(Half_Yearly_Installment_val) +
            parseInt(Yearly_Installment_val) +
            parseInt(Possession_val) +
            construction_options_addition;

        if (construction) {
            $('#maxBudgetConstruction').val(totalCalculation);
        } else {
            $('#maxBudgetFlat').val(totalCalculation);
        }
        $("#cal-result").html(new Intl.NumberFormat().format(totalCalculation));
    }

    $(document).on("change", "input[type='number']", calculation);
</script>
