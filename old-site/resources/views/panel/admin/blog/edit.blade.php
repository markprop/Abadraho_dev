@extends('panel.layouts.master1')

@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Update Blog</h5>
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
          <form class="form mt-5" method="POST" action="/admin/blog/{{ $blog->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Blog Name</label>
                <input type="text" class="form-control form-control-lg" name="title" value="{{ $blog->title }}"
                  required>
                <span class="form-text text-muted">Please enter your Blog
                  Name.</span>
                <div class="fv-plugins-message-container"></div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Blog Category</label>
                <select name="category_id" class="form-control form-control-lg">
                  <option disabled selected hidden value="">Select Category...</option>
                  @foreach ($blogcategories as $blogcategory)
                    <option value="{{ $blogcategory->id }}"
                      {{ $blog->category_id == $blogcategory->id ? 'selected' : '' }}>{{ $blogcategory->title }}
                    </option>
                  @endforeach
                </select>
                <span class="form-text text-muted">Please enter the category for the blog.</span>
                <div class="fv-plugins-message-container"></div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Project Details</label>
                {{-- <textarea class="form-control" name="details" id="kt_autosize_1" rows="3"
                        style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;"></textarea> --}}
                <textarea name="description" id="kt-ckeditor-1">{{ $blog->description }}</textarea>
              </div>
            </div>
            <div class="col-xl-12">
              <div>
                <div class="form-group fv-plugins-icon-container">
                  <label>Blog Cover Image</label>
                  <div class="col-lg-9 col-xl-12">
                    <div class="image-input image-input-outline" id="kt_image_4"
                      style="background-image: url(assets/media/users/blank.png)">
                      <div class="image-input-wrapper"
                        style="background-image: url(uploads/blogs/{{ $blog->cover_img }})">
                      </div>
                      <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                        data-action="change" data-toggle="tooltip" title="" data-original-title="Change Picture">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="cover_img" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="cover_img_remove" />
                      </label>
                      <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                        data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                      </span>
                      <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                        data-action="remove" data-toggle="tooltip" title="Remove Picture">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                      </span>
                    </div>
                    <span class="form-text text-muted">After image removal hidden input's value
                      is set to "1"</span>
                  </div>
                </div>
                <!--begin::Code-->
                <div class="example-code">
                  <ul class="example-nav nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-2x">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#example_code_4_html">HTML</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#example_code_4_js">JS</a>
                    </li>
                  </ul>
                  <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                  <div class="tab-content">
                    <div class="tab-pane active" id="example_code_4_html" role="tabpanel">
                      <div class="example-highlight">
                        <pre>
                                                      <code class="language-html">
                                                        &lt;div class="image-input image-input-outline" id="kt_image_4" style="background-image: url(assets/media/&gt;users/blank.png)"&gt;
                                                        &lt;div class="image-input-wrapper" style="background-image: url(&lt;?php echo Page::getMediaPath();?&gt;users/100_1.jpg)"&gt;&lt;/div&gt;

                                                        &lt;label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Picture"&gt;
                                                          &lt;i class="fa fa-pen icon-sm text-muted"&gt;&lt;/i&gt;
                                                          &lt;input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg"/&gt;
                                                          &lt;input type="hidden" name="profile_avatar_remove"/&gt;
                                                        &lt;/label&gt;

                                                        &lt;span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar"&gt;
                                                          &lt;i class="ki ki-bold-close icon-xs text-muted"&gt;&lt;/i&gt;
                                                        &lt;/span&gt;

                                                        &lt;span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Picture"&gt;
                                                          &lt;i class="ki ki-bold-close icon-xs text-muted"&gt;&lt;/i&gt;
                                                        &lt;/span&gt;
                                                        &lt;/div&gt;
                                                      </code>
                                                    </pre>
                      </div>
                    </div>
                    <div class="tab-pane" id="example_code_4_js">
                      <div class="example-highlight">
                        <pre style="height:400px">
                                                      <code class="language-js">
                                                        var avatar4 = new KTImageInput('kt_image_4');
                                                        avatar4.on('cancel', function(imageInput) {
                                                          swal.fire({
                                                            title: 'Image successfully canceled !',
                                                            type: 'success',
                                                            buttonsStyling: false,
                                                            confirmButtonText: 'Awesome!',
                                                            confirmButtonClass: 'btn btn-primary font-weight-bold'
                                                          });
                                                        });

                                                        avatar4.on('change', function(imageInput) {
                                                        swal.fire({
                                                          title: 'Image successfully changed !',
                                                          type: 'success',
                                                          buttonsStyling: false,
                                                          confirmButtonText: 'Awesome!',
                                                          confirmButtonClass: 'btn btn-primary font-weight-bold'
                                                        });
                                                        });

                                                        avatar4.on('remove', function(imageInput) {
                                                        swal.fire({
                                                          title: 'Image successfully removed !',
                                                          type: 'error',
                                                          buttonsStyling: false,
                                                          confirmButtonText: 'Got it!',
                                                          confirmButtonClass: 'btn btn-primary font-weight-bold'
                                                        });
                                                        });
                                                      </code>
                                                    </pre>
                      </div>
                    </div>
                  </div>
                </div>
                <!--end::Code-->
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Meta Title</label>
                <textarea class="form-control" name="meta_title" id="kt_autosize_1" rows="3"
                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $blog->meta_title }}</textarea>
                @error('meta_title')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Meta Description</label>
                <textarea class="form-control" name="meta_description" id="kt_autosize_1" rows="3"
                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $blog->meta_description }}</textarea>
                @error('meta_description')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label class="col-form-label col-lg-12 bolder">Meta Keywords</label>
                <textarea class="form-control" name="meta_keywords" id="kt_autosize_1" rows="3"
                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $blog->meta_keywords }}</textarea>
                @error('meta_keywords')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>status</label>
                <select name="is_active" class="form-control form-control-lg" required>
                  <option value="0" {{ $blog->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                  <option value="1" {{ $blog->is_active == 1 ? 'selected' : '' }}>Active</option>
                </select>
                <span class="form-text text-muted">Please enter the status for the blog.</span>
                <div class="fv-plugins-message-container"></div>
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
  <!--begin::Page Scripts(used by this page)-->
  <script src="assets/js/pages/crud/file-upload/image-input.js"></script>
  <!--end::Page Scripts-->
@endsection
