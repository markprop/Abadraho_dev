// Add Phone Number After Social Login
$("#submitPhoneNumber").click(function (e) {
    e.preventDefault();
    const info = document.querySelector(".alert-info");
    const phoneNumber = phoneInput.getNumber();
    console.log(phoneNumber);
    // info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;

    $.ajax({
        type: "POST",
        url: "/user/phone_number",
        data: $("#form input").serialize() + "&phone=" + phoneNumber,
        error: function (response) {
            info.style.display = "";

            info.innerHTML = response.responseJSON.errors.phone[0];
        },
        success: function (response) {
            // console.log('In Success Function');
            $("#phoneNumberModal").modal("hide");
        },
    });
});

$(document).ready(function () {
    $(".client-logoss").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2,
                },
            },
        ],
    });
});

$(".addressclickable").on("click", function (e) {
    // using this page stop being refreshing
    e.stopPropagation();
    // var lat = $this.text('')
    var lat = $("> .lat", this).text();
    var lon = $("> .lon", this).text();
    // console.log($(this).val());
    // alert('lat: '+ lat + '      Lon: '+lon);
    $("#addressModal").modal("show");
    $("#addressModal #iframe").html(
        "<iframe width='100%' height='450' frameborder='0' style='border:0' src='https://www.google.com/maps/embed/v1/place?q=" +
        lat +
        "," +
        lon +
        "&amp;key=AIzaSyC07CvVyZNLAxycxXkMq64WWif3fkS0LE4'></iframe>"
    );
});

function submit_myform() {
    var frm = document.myform;
    $("form").submit();
}

//Compare JS Start
$(function () {
    $("#btn1").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr1").show();
        } else {
            $("#tr1").hide();
        }
    });
    $("#btn2").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr2").show();
        } else {
            $("#tr2").hide();
        }
    });

    $("#btn3").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr3").show();
        } else {
            $("#tr3").hide();
        }
    });

    $("#btn4").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr4").show();
        } else {
            $("#tr4").hide();
        }
    });

    $("#btn5").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr5").show();
        } else {
            $("#tr5").hide();
        }
    });

    $("#btn6").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr6").show();
        } else {
            $("#tr6").hide();
        }
    });

    $("#btn7").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr7").show();
        } else {
            $("#tr7").hide();
        }
    });

    $("#btn8").click(function () {
        $(".buttonInactive").not(this).removeClass("buttonInactive");
        $(this).toggleClass("buttonActive");
        if ($(this).hasClass("buttonActive")) {
            $("#tr8").show();
        } else {
            $("#tr8").hide();
        }
    });

    jQuery("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        jQuery("#myDIV *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $(".compare_btn1").click(function () {
        $(".compare_btn1").removeClass(".compare_container");
        $(this).addClass(".compare_container2");
    });
});

//---AJAX Call for staffs

$(document).ready(function () {
    $("#project1").click(function () {
        var project1 = $(this);
        $("#myCompare").modal("show");

        $('input[id="check_id"]').on("click", function () {
            var baseurl = window.location.origin;

            $.get(
                baseurl + "/getunits?project_id=" + $(this).val(),
                function (htmlCode) {
                    if ($('input[id="check_id"]:checked').length > 0) {
                        $(".units").empty();

                        //$('#units-'+htmlCode).append($('<ul>').html("Extra Stuff"));
                        var url = baseurl + "/compare";
                        var blah = "<?php echo $units->id;?>";

                        $.each(htmlCode, function (index, value) {
                            $("#units-" + htmlCode[index]["project_id"]).append(
                                $('<button onClick="myFunc(this.id,"");">')
                                    .attr({
                                        id: htmlCode[index]["id"],
                                        class: "unit_type",
                                    })
                                    .html(htmlCode[index]["title"])
                            );
                        });
                    } else {
                        $(".units").empty();
                    }
                }
            );
            //alert ("The element with id " + $(this).val() + " changed.");
        });
        $(document).on("click", ".unit_type", function () {
            var unit_type_id = $(this).attr("id");
            myFunc(unit_type_id, project1);
        });
    });

    $("#project2").click(function () {
        var project2 = $(this);
        $("#myCompare").modal("show");

        $('input[id="check_id"]').on("click", function () {
            var baseurl = window.location.origin;

            $.get(
                baseurl + "/getunits?project_id=" + $(this).val(),
                function (htmlCode) {
                    if ($('input[id="check_id"]:checked').length > 0) {
                        $(".units").empty();

                        //$('#units-'+htmlCode).append($('<ul>').html("Extra Stuff"));
                        var url = baseurl + "/compare";
                        var blah = "<?php echo $units->id; ?>";

                        $.each(htmlCode, function (index, value) {
                            $("#units-" + htmlCode[index]["project_id"]).append(
                                $('<button onClick="myFunc(this.id,"");">')
                                    .attr({
                                        id: htmlCode[index]["id"],
                                        class: "unit_type",
                                    })
                                    .html(htmlCode[index]["title"])
                            );
                        });
                    } else {
                        $(".units").empty();
                    }
                }
            );
            //alert ("The element with id " + $(this).val() + " changed.");
        });
        $(document).on("click", ".unit_type", function () {
            var unit_type_id = $(this).attr("id");
            myFunc(unit_type_id, project2);
        });
    });
});

function myFunc(id, elem) {
    var baseurl = window.location.origin;
    $.get(baseurl + "/getunits?unit_id=" + id, function (htmlCode) {
        if (elem.length > 0) {
            elem.val(htmlCode[0]["title"]);
        }
    });
}


$('#myselect').select2({
    // width: '50%',
    placeholder: "Select an Option",
    allowClear: true
});

$('#myselect1').select2({
    // width: '50%',
    placeholder: "Select an Option",
    allowClear: true
});

$('#myselect2').select2({
    // width: '50%',
    placeholder: "Select an Option",
    allowClear: true
});

$('#myselect3').select2({
    // width: '50%',
    placeholder: "Select an Option",
    allowClear: true
});


//$('.js-example-basic-multiple').select2();

$(window).on('load', function () {
    $('.loaderscreen').fadeOut();
});

jQuery('#calculator_down_payment_flat').keyup("input", function () {
    var dInput = this.value;
    jQuery("#cal-result").html(dInput);
});