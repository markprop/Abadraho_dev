@extends('panel.layouts.master1')

@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Blog</h5>
          <!--end::Title-->
          <!--begin::Separator-->
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
          <!--end::Separator-->
          <!--begin::Search Form-->
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter Blog details and
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
            <h2 class="card-title text-uppercase">Add Blog</h2>
          </div>
          <!--begin::Form-->
          <form class="form mt-5" method="POST" action="/admin/blog" enctype="multipart/form-data">
            @csrf

            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Blog Name *</label>
                <input type="text" class="form-control form-control-lg" value="{{ old('title') }}" name="title">
                <span class="form-text text-muted">Please enter your Blog Name.</span>
                @error('title')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Blog Category</label>
                <select name="category_id" class="form-control form-control-lg">
                  <option disabled selected hidden value="">Select Category...</option>
                  @foreach ($blogcategories as $blogcategory)
                    <option value="{{ $blogcategory->id }}"
                      {{ collect(old('category_id'))->contains($blogcategory->id) ? 'selected' : '' }}>
                      {{ $blogcategory->title }}</option>
                  @endforeach
                </select>
                <span class="form-text text-muted">Please enter the category for the blog.</span>
                @error('category_id')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Project Details *</label>
                {{-- <textarea class="form-control" name="details" id="kt_autosize_1" rows="3"
                        style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;"></textarea> --}}
                <textarea name="description" id="kt-ckeditor-1">{{ old('description') }}</textarea>
                @error('dedcription')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Cover Image</label>
                <input type="file" class="form-control form-control-lg" name="cover_img">
                @error('cover_img')
                  <span class="form-text text-muted">Please upload the Cover Image.
                    {{ $errors->first('cover_img') }}</span>
                @enderror
                @error('cover_img')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>status *</label>
                <select name="is_active" class="form-control form-control-lg" required>
                  <option selected value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
                <span class="form-text text-muted">Please enter the status for the blog.</span>
                @error('is_active')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Meta Title *</label>
                <textarea class="form-control" name="meta_title" id="kt_autosize_1" rows="3"
                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ old('meta_title') }}</textarea>
                @error('meta_title')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Meta Description *</label>
                <textarea class="form-control" name="meta_description" id="kt_autosize_1" rows="3"
                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Meta Keywords *</label>
                <textarea class="form-control" name="meta_keywords" id="kt_autosize_1" rows="3"
                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ old('meta_keywords') }}</textarea>
                @error('meta_keywords')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6 col-lg-6 text-left">
                  <a href="/admin/blog" type="reset" class="btn btn-secondary">Cancel</a>
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
  <script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
  <script src="assets/js/pages/crud/forms/editors/ckeditor-classic.js"></script>
@endsection
