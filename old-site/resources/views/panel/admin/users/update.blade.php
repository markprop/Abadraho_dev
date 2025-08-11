@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Details-->
      <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Update Project</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter project details and
            submit</span>
        </div>
        <!--end::Search Form-->
      </div>
      <!--end::Details-->
    </div>
  </div>
  <!--end::Subheader-->
  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Card-->
      <div class="card card-custom gutter-b example example-compact">
        <div class="card-header" style="padding: 1rem 1.25rem;">
          <h2 class="card-title text-uppercase">Update User</h2>
        </div>

        <!--begin::Form-->
        <!-- <form class="form mt-5" id="frmValidate" method="POST" action="/admin/manage_users" enctype="multipart/form-data"> -->
        <form class="form mt-5" id="frmValidate">
          @csrf
          <div class="col-xl-12">
            <div class="form-group fv-plugins-icon-container">
              <label>First Name</label>
              <input type="text" class="form-control form-control-lg" name="first_name" value="{{ $admin->first_name }}" required>
              <span class="form-text text-muted">Please enter your First Name.</span>
              <div class="fv-plugins-message-container"></div>
            </div>
            <div class="form-group fv-plugins-icon-container">
              <label>Last Name</label>
              <input type="text" class="form-control form-control-lg" name="last_name" value="{{ $admin->last_name }}" required>
              <span class="form-text text-muted">Please enter your Last Name.</span>
              <div class="fv-plugins-message-container"></div>
            </div>
            <div class="form-group fv-plugins-icon-container">
              <label>Email</label>
              <input type="email" class="form-control form-control-lg" name="email" value="{{ $admin->email }}" required>
              <span class="form-text text-muted">Please enter your email.</span>
              <div class="fv-plugins-message-container"></div>
            </div>
            <!-- <div class="form-group fv-plugins-icon-container">
                                <label>Role</label>
                                <select name="role_id" class="form-control form-control-lg" required>
                                    <option disabled selected hidden value="">User Role...</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Manager</option>
                                    <option value="4">Data Entry</option>
                                </select>
                                <span class="form-text text-muted">Please specify the Role
                                    of the User.</span>
                                <div class="fv-plugins-message-container"></div>
                            </div> -->
            <div class="form-group fv-plugins-icon-container">
              <label>User Type</label>
              <select name="user_type_id" class="form-control form-control-lg" required>
                <option disabled selected hidden value="">User Type...</option>
                @foreach ($UserTypes as $type)
                <option value="{{ $type->id }}" {{ $admin->user_type_id == $type->id ? 'selected' : '' }}>{{ $type->user_type_name }}</option>
                @endforeach
              </select>
              <span class="form-text text-muted">Please specify the user type
                of the User.</span>
              <div class="fv-plugins-message-container"></div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              
              <div class="col-6 col-lg-6 text-left">
                <a href="/admin/manage_users" type="reset" class="btn btn-secondary">Cancel</a>
              </div>

              <div class="col-6 col-lg-6 text-right">
                <button type="button" onclick="UpdateUser()" class="btn admin_ad_btn  mr-2">Update</button>
              </div>

            </div>
          </div>
        </form>
        <!--end::Form-->

      </div>
      <!--end::Card-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Entry-->
</div>
@endsection

@section('header')
<!--begin::Page Custom Styles(used by this page)-->
<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles-->
@endsection

@section('footer')
<script>
  $(document).ready(function() {
    // alert("Ss");

  });

  function UpdateUser() {
    ValiadteInputs();
    if (SubmitForm("frmValidate")) {
      ShowLoader();
      var params = {
        id: "<?php echo $admin->id; ?>",
        first_name: $('[name="first_name"]').val(),
        last_name: $('[name="last_name"]').val(),
        user_type_id: $('[name="user_type_id"]').val(),
        email: $('[name="email"]').val(),
        isUpdateUser: true,
      };
      CallLaravelAction("/admin/add-new-user", params, function(response) {
        if (response.status) {
          ShowSuccess(response.message);
          // location.reload()
          location.href = "/admin/manage_users";
          HideLoader();
        } else {
          var ErrorMsg = response.message;
          if (typeof response.error !== "undefined") {
            if (typeof response.error.email !== "undefined") {
              ErrorMsg = response.error.email;
            }
            if (typeof response.error.user_type_id !== "undefined") {
              ErrorMsg = response.error.user_type_id;
            }
            if (typeof response.error.password !== "undefined") {
              ErrorMsg = response.error.password;
            }
            if (typeof response.error.password_confirmation !== "undefined") {
              ErrorMsg = response.error.password_confirmation;
            }
          }
          ShowError(ErrorMsg);
          HideLoader();
        }
      });
    }
  }
</script>
@endsection