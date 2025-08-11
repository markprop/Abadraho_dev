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
        <form class="form mt-5" method="POST" action="/admin/manage_users/{{ $admin->id }}/edit" enctype="multipart/form-data">
          @csrf

          <div class="col-xl-12">
            <div class="form-group fv-plugins-icon-container">
              <label>User Name *</label>
              <input type="text" class="form-control form-control-lg" name="name" value="{{ $admin->name }}">
              <span class="form-text text-muted">Please enter your User
                Name.</span>
              @error('name')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group fv-plugins-icon-container">
              <label>User Email *</label>
              <input type="email" class="form-control form-control-lg" name="email" value="{{ $admin->email }}">
              <span class="form-text text-muted">Please enter your user email.</span>
              @error('address')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group fv-plugins-icon-container">
              <label>Role</label>
              <select name="role_id" class="form-control form-control-lg" required>
                <option disabled selected hidden value="">{{ $status[$admin->role_id - 1] }}</option>
                <option value="2">Admin</option>
                <option value="3">Manager</option>
                <option value="4">Data Entry</option>
              </select>
              <span class="form-text text-muted">Please specify the Role
                of the User.</span>
              <div class="fv-plugins-message-container"></div>
            </div>



            <div class="card-footer">
              <div class="row">
                <div class="col-lg-6">
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
                <div class="col-lg-6 text-lg-right">
                  <button type="submit" class="btn btn-primary mr-2">Save</button>
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
    alert("Ss");
    // setTimeout(function() {
    //   $('[name="email"]').val('');
    //   $('[name="password"]').val('');
    // }, 2000);
  });

  function AddNewUser() {
    // using this page stop being refreshing
    //   e.preventDefault();
    ValiadteInputs();
    if (SubmitForm("frmValidate")) {
      ShowLoader();
      var params = {
        first_name: $('[name="first_name"]').val(),
        last_name: $('[name="last_name"]').val(),
        user_type_id: $('[name="user_type_id"]').val(),
        email: $('[name="email"]').val(),
        password: $('[name="password"]').val(),
      };
      CallLaravelAction("/admin/add-new-user", params, function(response) {
        if (response.status) {
          ShowSuccess(response.message);
          location.reload()
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

<!--begin::Page Scripts(used by this page)-->
<script src="assets/js/pages/custom/projects/add-project.js"></script>
<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
<!--end::Page Scripts-->
<!--begin::Page Vendors(used by this page)-->
<script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="assets/js/pages/crud/forms/editors/ckeditor-classic.js"></script>
<!--end::Page Scripts-->
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"></script>
@endsection