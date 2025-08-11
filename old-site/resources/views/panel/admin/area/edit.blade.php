@extends('panel.layouts.master1')

@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit Area</h5>
          <!--end::Title-->
          <!--begin::Separator-->
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
          <!--end::Separator-->
          <!--begin::Search Form-->
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter area details and
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
            <h2 class="card-title text-uppercase">Edit Area</h2>
          </div>
          <!--begin::Form-->
          <form class="form mt-5" method="POST" action="/admin/area/{{ $area->id }}">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Area Name</label>
                <input type="text" class="form-control form-control-lg" name="name" value="{{ $area->name }}">
                <span class="form-text text-muted">Please enter your Area
                  Name.</span>
                @error('name')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Slug Name</label>
                <input type="text" class="form-control form-control-lg" name="slug" value="{{ $area->slug }}">
                <span class="form-text text-muted">Please enter your Slug
                  Name.</span>
                @error('slug')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6 col-lg-6 text-left">
                  <a href="/admin/area" type="button" class="btn btn-secondary">Cancel</a>
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
  <script src="assets/js/pages/custom/projects/add-project.js"></script>
  <script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
  <!--end::Page Scripts-->
@endsection
