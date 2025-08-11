// const { get } = require("jquery");

var LoaderCount = 0;
$(function () {
    ValiadteInputs();
    $("#divError .close").on("click", function () {
        $("#divError").modal("hide");
    });
    $("#divSuccess .close").on("click", function () {
        $("#divSuccess").modal("hide");
    });
    // $('.pickerdate').datepicker({
    //     dateFormat: 'dd-mm-yy'
    //  });
    // $(".column-select-box > h3").on("click", function (event) {
    //     event.stopPropagation();
    //     if ($(this).next(".columns").is(":visible"))
    //         $(this).next(".columns").slideUp();
    //     else
    //         $(this).next(".columns").slideDown();
    // });
    BindColumnSelectBox();
    $(document).click(function () {
        $(".column-select-box > .columns").slideUp();
    });
});
function BindHtmlEditor() {
    $(document).ready(function () {
        $('textarea.htmleditor').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true
        });
    });
}
function BindColumnSelectBox() {
    $(".column-select-box > .evt").remove();
    $(".column-select-box").prepend("<div class='evt'></div>");
    $(".column-select-box > .evt").off("click").on("click", function (event) {
        event.stopPropagation();
        if ($(this).next().next(".columns").is(":visible"))
            $(this).next().next(".columns").slideUp();
        else
            $(this).next().next(".columns").slideDown();
    });
}
function DestroyDatatable(tblId) {
    var tbls;
    if ((tblId || "") == "")
        tbls = $(".tblJqueryDataTable");
    else
        tbls = $("#" + tblId + ".tblJqueryDataTable");
    tbls.each(function () {
        var tbl = $(this);
        if ($.fn.DataTable.isDataTable(tbl)) {
            tbl.DataTable().destroy();
        }
    });
}

function AttachDatatable(tblId) {
    // Setup - add a text input to each footer cell
    $('table.' + tblId + ' tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input class="form-control col-md-12 m-t-10" type="text" placeholder="' + title + '" />');
    });

    // DataTable
    var table = $('table.' + tblId).DataTable();

    // Apply the search
    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change clear', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
}

function ValiadteInputs() {
    $("input:enabled[data-maxlength],input:enabled[numtxt],input:enabled[decimaltxt],input:enabled[nospacetxt]").on("keypress", function (e) {
        var charCode = (e.which) ? e.which : e.keyCode;
        var keychar = String.fromCharCode(charCode);
        keychar = keychar.toLowerCase();
        var mod = 0;
        if (typeof (e.ctrlKey) !== 'undefined') {
            if (e.ctrlKey) mod |= 1;
            if (e.shiftKey) mod |= 2;
        } else {
            if (e.modifiers & Event.CONTROL_MASK) mod |= 1;
            if (e.modifiers & Event.SHIFT_MASK) mod |= 2;
        }

        var numtxt = $(this).attr("numtxt");
        var decimaltxt = $(this).attr("decimaltxt");
        var nospacetxt = $(this).attr("nospacetxt");
        if ((typeof nospacetxt !== typeof undefined && nospacetxt !== false) || (typeof numtxt !== typeof undefined && numtxt !== false) || (typeof decimaltxt !== typeof undefined && decimaltxt !== false))
            if (charCode == 32)
                return false;
        if (charCode == 32 || charCode == 8 || charCode == 9 || (charCode >= 35 && charCode <= 40 && mod != 2)) {
            return true;
        }
        if (typeof numtxt !== typeof undefined && numtxt !== false) {
            if (!(("0123456789").indexOf(keychar) > -1)) {
                return false;
            }
        }
        if (typeof decimaltxt !== typeof undefined && decimaltxt !== false) {
            if (!(("0123456789.").indexOf(keychar) > -1)) {
                return false;
            }
            else if ($(this).val().indexOf('.') > -1) {
                if (!(("0123456789").indexOf(keychar) > -1)) {
                    return false;
                }
            }
        }
        var charLength = $(this).val().length;
        var charLimit = $(this).attr("data-maxlength");
        if (typeof charLimit !== typeof undefined && charLimit !== false) {
            if (charLength < charLimit) {
                return true;
            }
            $(this).val($(this).val().substring(0, charLimit));
        }
        return false;
    });
}
function SubmitForm(FormID) {
    $("#" + FormID + " .form-group").removeClass('error');
    $("#" + FormID + " .form-group").find('.has-error').removeClass('has-error');
    $("#" + FormID + " .error").remove();

    $("#" + FormID + " input:enabled").each(function (i, e) {
        if ($(e).is(":visible")) {
            var required = $(e).attr('required');
            if ((typeof required !== typeof undefined && required !== false) && ($(e).val() || "") == "") {
                $(e).parents('.form-group').addClass('error');
                $(("<div ><label class='error text-red' for='" + $(e).attr("name") + "'>This field is required.</label></div>")).hide().insertAfter($(e).parents('.form-group').first()).fadeIn('slow');
            }
            else {
                var maxlength = $(e).attr('data-maxlength');
                if (typeof maxlength !== typeof undefined && maxlength !== false) {
                    if ($(e).val().length > parseInt(maxlength)) {
                        $(e).parents('.form-group').addClass('error');
                        $(("<label class='error text-red' for='" + $(e).attr("name") + "'>This field should not be greater than " + maxlength + ".</label>")).hide().insertAfter($(e).parents('.form-group').first()).fadeIn('slow');
                    }
                }
            }
        }
    });
    $("#" + FormID + " select:enabled[required]").each(function (i, e) {
        if ($(e).is(":visible")) {
            if (($(e).val() || "") == "") {
                if ($(e).parents('.form-group').find(".select2-container")) {
                    $(e).parents('.form-group').find(".select2-container").addClass('has-error');
                }
                $(e).parents('.form-group').addClass('error');
                $(("<label class='error text-red' for='" + $(e).attr("name") + "'>This field is required.</label>")).hide().insertAfter($(e).parents('.form-group').first()).fadeIn('slow');
            }
        }
    });

    $("#" + FormID + " v-select").each(function (i, e) {
        if ($(e).is(":visible")) {
            alert(JSON.stringify($(e).val()));
            if (($(e).val() || "") == "") {
                $(e).parents('.form-group').addClass('error');
                $(("<label class='error' for='" + $(e).attr("name") + "'>This field is required.</label>")).hide().insertAfter($(e).parents('.form-group').first()).fadeIn('slow');
            }
        }
    });

    // $("#" + FormID + " v-select:enabled[required]").each(function (i, e) {
    //     if ($(e).is(":visible")) {
    //         if (($(e).val() || "") == "") {
    //             $(e).child('.dropdown-toggle').addClass('error-v-select');
    //             $(("<label class='error' for='" + $(e).attr("name") + "'>This field is required.</label>")).hide().insertAfter($(e).child('.dropdown-toggle').first()).fadeIn('slow');
    //         }
    //     }
    // });

    $("#" + FormID + " textarea:enabled").each(function (i, e) {
        if ($(e).is(":visible")) {
            var required = $(e).attr('required');
            if ((typeof required !== typeof undefined && required !== false) && ($(e).val() || "") == "") {
                $(e).parents('.form-group').addClass('error');
                $(("<label class='error' for='" + $(e).attr("name") + "'>This field is required.</label>")).hide().insertAfter($(e).parents('.form-group').first()).fadeIn('slow');
            }
            else {
                var maxlength = $(e).attr('data-maxlength');
                if (typeof maxlength !== typeof undefined && maxlength !== false) {
                    if ($(e).val().length > parseInt(maxlength)) {
                        $(e).parents('.form-group').addClass('error');
                        $(("<label class='error' for='" + $(e).attr("name") + "'>This field should not be greater than " + maxlength + ".</label>")).hide().insertAfter($(e).parents('.form-group').first()).fadeIn('slow');
                    }
                }
            }
        }
    });
    if ($("#" + FormID + " .form-group.error").length > 0)
        return false;
    else
        return true;
}
function ShowError(ErrorMsg, ClosesCallbackFunction) {
    $("#lblError").html(ErrorMsg);
    $("#divError").modal({
        show: true,
        backdrop: true
    }).off("hide.bs.modal").on("hide.bs.modal", function () {
        if (ClosesCallbackFunction !== undefined)
            ClosesCallbackFunction();
    });
}
function ShowSuccess(SuccessMsg, ClosesCallbackFunction) {
    $("#lblSuccess").html(SuccessMsg);
    $("#divSuccess").modal({
        show: true,
        backdrop: true
    }).off("hide.bs.modal").on("hide.bs.modal", function () {
        if (ClosesCallbackFunction !== undefined)
            ClosesCallbackFunction();
    });
}
function GetUniqueValues(value, index, self) {
    return self.indexOf(value) === index;
}

function CallAction(RequestUri, Params, CallbackFunction, IsGet, IsContent) {
    try {
        $.ajax({
            type: ((IsGet == true) ? "GET" : "POST"),
            url: RequestUri,
            data: ((IsGet == true) ? "" : JSON.stringify(Params)),
            contentType: "application/json; charset=utf-8",
            dataType: ((IsContent == true) ? "html" : "json"),
            async: true,
            timeout: (1000 * 60 * 4),
            success: function (data) {
                CallbackFunction(data);
            },
            error: function (xhr) {
                ShowError("Something went wrong, please try again later or reload the page.");
            }
        });
    }
    catch (Err) {
        ShowError(Err);
    }
}
function ShowLoader() {
    LoaderCount++;
    $(".preloader").addClass("transparency").show();
}
function HideLoader() {
    if (LoaderCount < 2) {
        $(".preloader").removeClass("transparency").hide();
        LoaderCount = 0;
    }
    else
        LoaderCount--;
}
function GetFileUploadData(file, CallBack, AllowedSizeInMB) {
    try {
        AllowedSizeInMB = (AllowedSizeInMB || 2);
        if (file.size > ((1 * 1024 * 1024) * AllowedSizeInMB)) {
            ShowError("Allowed file size is less or equal to " + AllowedSizeInMB + " MB");
            CallBack("");
            return;
        }
        ShowLoader();
        var fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.onload = (e) => {
            try {
                HideLoader();
                CallBack(e.target.result);
            } catch (Err) {
                ShowError(Err);
                HideLoader();
            }
        };
    } catch (Err) {
        ShowError(Err);
        HideLoader();
    }

}


function CallLaravelAction(RequestUri, Params, CallbackFunction, IsGet = false) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: ((IsGet == true) ? "GET" : "POST"),
            url: RequestUri,
            data: Params,
            datatype: 'JSON',
            async: true,
            success: function (response) {
                CallbackFunction(response);
            },
            error: function (xhr) {
                // var ErrorMsg;
                // if (typeof response.msg !== 'undefined')
                // {
                //     ErrorMsg = response.msg;
                // }
                // else if (typeof response.message !== 'undefined')
                // {
                //     ErrorMsg = response.message;
                // }

                var ErrorResponse = {
                    errorMsg: "Error Occurred while calling an Action, Error : " + JSON.stringify(xhr),
                    xhr: xhr

                };
                CallbackFunction(ErrorResponse);
            }
        });
    }
    catch (Err) {
        var ErrorResponse = {
            errorMsg: "Error Occurred while calling an Action, Error Msg : " + JSON.stringify(Err)
        };
        CallbackFunction(ErrorResponse);
    }
}




function isEmpty(str) {
    return (!str || 0 === str.length);
}

function GetFormattedDate(date, is_timestamp = false) {

    var todayTime = new Date(date);
    var month = todayTime.getMonth() + 1;
    var day = todayTime.getDate();
    var year = todayTime.getFullYear();
    var hours = todayTime.getHours();
    var minutes = todayTime.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    // var strTime = hours + ':' + minutes + ' ' + ampm;
    if (is_timestamp) {
        var newDateFormat = day + "-" + month + "-" + year + " " + hours + ":" + minutes + " " + ampm;
    }
    else {
        var newDateFormat = day + "-" + month + "-" + year;
    }
    return newDateFormat;

}


function time_difference(starttime, endtime) {

    var a = starttime.split(':'); // split it at the colons
    var b = endtime.split(':');

    var diffa = ((+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]));
    var diffb = ((+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2]));

    // minutes are worth 60 seconds. Hours are worth 60 minutes.
    var difference = Math.abs(((+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2])) - ((+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2])));
    var result = [Math.floor(difference / 3600), Math.floor((difference % 3600) / 60)];

    result = result.map(function (v) {
        return v < 10 ? '0' + v : v;
    }).join(':');

    return result;
}

function time_difference_without_seconds(starttime, endtime) {
    var a = starttime.split(':'); // split it at the colons
    var b = endtime.split(':');

    // var diffa = ((+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]));
    // var diffb = ((+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2]));

    var diffa = ((+a[0]) * 60 * 60 + (+a[1] * 60));
    var diffb = ((+b[0]) * 60 * 60 + (+b[1] * 60));
    // alert(JSON.stringify(diffa));

    // minutes are worth 60 seconds. Hours are worth 60 minutes.
    // var difference = Math.abs(((+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]))-((+b[0]) * 60 * 60 + (+b[1]) * 60 + (+b[2])));
    var difference = Math.abs(((+a[0]) * 60 * 60 + (+a[1]) * 60) - ((+b[0]) * 60 * 60 + (+b[1]) * 60));
    var result = [Math.floor(difference / 3600), Math.floor((difference % 3600) / 60)];

    result = result.map(function (v) {
        return v < 10 ? '0' + v : v;
    }).join(':');
    // alert(result);
    return result;
}

function create_UUID() {
    var dt = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = (dt + Math.random() * 16) % 16 | 0;
        dt = Math.floor(dt / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
    return uuid;
}

function OpenLoginRegisterModal(redirectUrl) {
    window.event.stopImmediatePropagation();
    console.log("OpenLoginRegisterModal -> redirectUrl -> ", redirectUrl);
    if ((redirectUrl || "") != "") {
        $("#afterSuccessRedirectUrl").val(window.location.origin + redirectUrl);
    }
    else {
        // afterSuccessRedirectUrl = (redirectUrl || "") != "" ? redirectUrl : window.location.href;
        $("#afterSuccessRedirectUrl").val(window.location.href);
    }


    // console.log("afterSuccessRedirectUrl -> ", window.location.origin + afterSuccessRedirectUrl);
    $("#authenticationModal").modal("show");
}

function ThousandSeparator(Number) {
    Number = Math.floor(Number);
    var components = Number.toString().split(".");
    if (components.length === 1)
        components[0] = Number.toString();
    components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (components.length === 2)
        components[1] = components[1].replace(/\D/g, "");
    return components.join(".");
}

function isNormalInteger(str) {
    return /^\+?(0|[1-9]\d*)$/.test(str);
}
function ShowSweetAlert(params) {
    Swal.fire(params);
    // {
    //     icon: "success",
    //     title: "You're request has been submitted!",
    //     showConfirmButton: true,
    //     timer: 2000,
    // }
}
function ShowSweetAlertConfirm(params, CallbackFunction) {
    Swal.fire(params).then(result => CallbackFunction(result));
    // {
    //     icon: "success",
    //     title: "You're request has been submitted!",
    //     showConfirmButton: true,
    //     timer: 2000,
    // }
}

function parseQueryStringParams(url) {
    var href = url ? url : window.location.href;
    var qs = href.substring(href.indexOf('?') + 1).split('&');
    for (var i = 0, result = {}; i < qs.length; i++) {
        qs[i] = qs[i].split('=');
        result[qs[i][0]] = decodeURIComponent(qs[i][1]);
    }
    return result;
}
function ConvertAmountToHalfWord(amount) {
    let number = amount;
    // console.log("number -> ", number);
    // console.log("number -> length -> ", number.toString().length);
    // Convert Price to Crores or Lakhs or Thousands
    let length = number.toString().length;
    let currency = 'Rs. ';
    let ext = "";
    if (length == 3) {
        // Thousand
        number = number / 1000;
        // console.log("number = number / 1000; -> " , number);
        checkStrLength = number.toString().substring(0, 4);
        number = checkStrLength.includes(".") ? number.toString().substring(0, 4) : number.toString().substring(0, 2);
        ext = "Thousand";
        currency = number + " " + ext;
    } else if (length == 4 || length == 5) {
        // Thousand
        number = number / 1000;
        // console.log("number = number / 1000; -> " , number);
        checkStrLength = number.toString().substring(0, 4);
        number = checkStrLength.includes(".") ? number.toString().substring(0, 4) : number.toString().substring(0, 2);
        ext = "Thousand";
        currency = number + " " + ext;
    } else if (length == 6 || length == 7) {
        // Lakhs
        number = number / 100000;
        // console.log("number = number / 100000; -> " , number);
        checkStrLength = number.toString().substring(0, 4);
        number = checkStrLength.includes(".") ? number.toString().substring(0, 4) : number.toString().substring(0, 2);
        ext = "Lacs";
        currency = number + " " + ext;
    } else if (length == 8 || length == 9) {
        // Crores
        number = number / 10000000;
        // console.log("number = number / 10000000; -> " , number);
        checkStrLength = number.toString().substring(0, 4);
        number = checkStrLength.includes(".") ? number.toString().substring(0, 4) : number.toString().substring(0, 2);
        ext = "Cr";
        currency = number + ' ' + ext;
    }
    else if (length == 10 || length == 11) {
        // Crores
        number = number / 1000000000;
        // console.log("number = number / 1000000000; -> " , number);
        checkStrLength = number.toString().substring(0, 4);
        number = checkStrLength.includes(".") ? number.toString().substring(0, 4) : number.toString().substring(0, 2);
        ext = "Arab";
        currency = number + ' ' + ext;
    }

    return currency;
}


function amountInWords(num) {
    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
    return str;
}

