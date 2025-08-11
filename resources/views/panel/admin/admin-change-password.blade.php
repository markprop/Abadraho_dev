@extends('panel.layouts.master1')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Admin Change Password</h5>


                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>


                <!--end::Separator-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Subheader-->

    <div class="container" style="margin-top: 10%;">
        <div class="row" id="frmPasswordChange">
            <div class="col-md-4"></div>
             <div class="col-md-6">
                <div class="panel">
                <div class="panel-title">
                 <strong class="">Change Password</strong>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Old password</label>
                        <input type="password" class="form-control" id="old_password" placeholder="Enter Old Password" required>
                     </div>
                    <div class="form-group">
                        <label>New password</label>
                        <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" required>
                     </div>
                     <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" required>
                    </div>
                        <button onclick="SubmitChangePasswordForm()" class="btn admin_ad_btn_red"> Update Password </button>
                 </div>
            </div>
            </div>
            </div>
        </div>


    </div>

    @section('footer')
<script>
	$(document).ready(function() {
		// alert("ready");
		ValiadteInputs();
		// $('[name="first_name"]').val("shahbaz");
		// $('[name="last_name"]').val("raza");
		// $('[name="phone_number"]').val("03242901739");
		// $('[name="user_email"]').val("shahbaz2@gmail.com");
		// $('[name="registerPassword"]').val("12345678");
		// $('[name="registerConfirm_password"]').val("12345678");
	});

function SubmitChangePasswordForm() {
		// using this page stop being refreshing
		//   e.preventDefault();
		if (SubmitForm("frmPasswordChange")) {
			ShowLoader();
			var params = {
				old_password: $('#old_password').val(),
				new_password: $('#new_password').val(),
				confirm_password: $('#confirm_password').val(),
			};

			if(params.new_password != params.confirm_password){
				ShowError("The new password and confirm password does not match.");
				HideLoader();
				return;
			}

			CallLaravelAction("/update-admin-password", params, function(response) {
				if (response.status) {
					ShowSuccess(response.message, function() {
						// console.log("CallLaravelActionCallLaravelActionCallLaravelAction");
						location.reload()
					});
					HideLoader();
				} else {
					var ErrorMsg = response.message;
					if (typeof response.error !== "undefined") {
						if (typeof response.error.old_password !== "undefined") {
							ErrorMsg = response.error.old_password;
						}
						if (typeof response.error.new_password !== "undefined") {
							ErrorMsg = response.error.new_password;
						}
						if (typeof response.error.confirm_password !== "undefined") {
							ErrorMsg = response.error.confirm_password;
						}
					}
					ShowError(ErrorMsg);
					HideLoader();
				}
			});
		}
		// const phoneNumber = phoneInput.getNumber();
		// $('#phone').val(phoneNumber);
	}
</script>    


@endsection