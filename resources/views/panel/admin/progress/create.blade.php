@extends('panel.layouts.master1')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
  .icon-select select {
    font-family: fontAwesome
  }

</style>
@section('content')

  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Progress</h5>
          <!--end::Title-->
          <!--begin::Separator-->
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
          <!--end::Separator-->
          <!--begin::Search Form-->
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter Progress and
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
            <h2 class="card-title text-uppercase">Add Progress</h2>
          </div>
          <!--begin::Form-->
          <form class="form mt-5 ml-10 mr-10" method="POST" action="/admin/progress" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-lg" value="{{ old('progress_status_name') }}" name="progress_status_name" required>
                  <span class="form-text text-muted">Please enter the progress Name.</span>
                  @error('progress_status_name')
                    <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="form-group fv-plugins-icon-container icon-select">
                  <label>Show</label>
                  <select name="isActive" id="" class="form-control form-control-lg" required>
                    <option value="">Please Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <span class="form-text text-muted">Please select progress
                    on lisitng page.</span>
                  @error('isActive')
                    <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6 col-lg-6 text-left">
                  <a href="/admin/progress" type="reset" class="btn btn-secondary">Cancel</a>
                </div>
                <div class="col-6 col-lg-6 text-right">
                  <button type="submit" class="btn admin_ad_btn mr-2">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!--end::Form-->
      </div>
      <!--end::Card-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Entry-->
@endsection

@section('header')
  <!--begin::Page Custom Styles(used by this page)-->
  <link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
  <!--end::Page Custom Styles-->
@endsection

@section('footer')
  <!--begin::Page Scripts(used by this page)-->
  <script src="assets/js/pages/custom/projects/add-project.js"></script>
  <script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
@endsection
