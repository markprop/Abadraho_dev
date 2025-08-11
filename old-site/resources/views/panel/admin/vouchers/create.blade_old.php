@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Details-->
      <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Create Voucher</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter vouchers details and
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
          <h2 class="card-title text-uppercase">Create Voucher</h2>
        </div>
        <!--begin::Form-->

        <!-- enctype="multipart/form-data" remove by Shahbaz raza -->

        <form class="form mt-5" method="POST" action="/admin/voucher/" enctype="multipart/form-data">
          @csrf
         
          <div class="col-xl-12">
            <div class="form-group fv-plugins-icon-container">
              <label>Voucher Code <span class="text-red">*</span></label>
              <input type="text" class="form-control form-control-lg" name="code" required>
              <span class="form-text text-muted">Customer Voucher Code</span>
              @error('code')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Customer Name<span class="text-red">*</span></label>
              <input type="text" class="form-control form-control-lg" name="user_full_name" required>
              <span class="form-text text-muted">Please enter Customer Name</span>
              @error('data')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group fv-plugins-icon-container">
              <label>Customer Phone<span class="text-red">*</span></label>
              <input type="number" class="form-control form-control-lg" name="user_phone" required>
              <span class="form-text text-muted">Please enter Customer Phone</span>
              @error('data')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Customer Email<span class="text-red">*</span></label>
              <input type="email" class="form-control form-control-lg" name="user_email" required>
              <span class="form-text text-muted">Please enter Customer Email</span>
              @error('data')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Project Name<span class="text-red">*</span></label>
              <input type="text" class="form-control form-control-lg" name="project_name" required>
              <span class="form-text text-muted">Project Name</span>
              @error('data')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Project Discount Price<span class="text-red">*</span></label>
              <!-- <input type="text" class="form-control form-control-lg" name="data" readonly required> -->
              <input type="text" class="form-control form-control-lg" name="data" required>
              <span class="form-text text-muted">Project Discount Price</span>
              @error('data')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Expiry<span class="text-red">*</span></label>
              <input type="data" id="datepicker" autocomplete="no" class="form-control form-control-lg" name="expires_at" required>
              <span class="form-text text-muted">Voucher Expiry</span>
              @error('expires_at')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="form-group">
              <div class="">
                <div class="form-group fv-plugins-icon-container">
                  <label>Status</label>
                  <select name="status" class="form-control form-control-lg" required>
                    <option disabled selected hidden value="">Status...</option>
                    <option value="1">Active
                    </option>
                    <option value="2">
                      Redeemed
                    </option>

                  </select>
                  <span class="form-text text-muted">Please specify the status
                    of the voucher.</span>
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
            </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-6 col-lg-6 text-left">
                <a href="/admin/voucher" class="btn btn-secondary">Cancel</a>
              </div>
              <div class="col-6 col-lg-6 text-right">
                  <button type="submit" class="btn admin_ad_btn mr-2">Save</button>
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
<!--begin::Page Scripts(used by this page)-->
<!-- <script src="assets/js/pages/crud/forms/editors/summernote.js"></script> -->
<!-- <script src="assets/js/pages/custom/projects/add-project.js"></script> -->
<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
<!--end::Page Scripts-->
<!--begin::Page Vendors(used by this page)-->
<script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
<script src="assets/js/pages/crud/forms/editors/ckeditor-classic.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<!--end::Page Scripts-->
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script type="text/javascript">
      $(document).ready(function() {
          var dt = new Date();

          $("#datepicker").datepicker({
              constrainInput: false,
              dateFormat: 'yy-mm-dd',
              onSelect: function(dateText, inst) {
                  this.value = this.value + ' ' + dt.getHours() + ":" + dt.getMinutes() + ":" + dt
                      .getSeconds();
              }
          });
      });
  </script>

@endsection