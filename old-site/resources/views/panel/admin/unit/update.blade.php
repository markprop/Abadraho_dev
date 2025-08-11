@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Details-->
      <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit Unit</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter Unit details and
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
          <h2 class="card-title text-uppercase">Edit Unit of the Project</h2>
        </div>
        <!--begin::Form-->
        <form class="form mt-5" method="POST" action="/admin/unit/{{ $unit->id }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="col-xl-12">
            <div class="row">

              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Title *</label>
                  <input type="text" min="0" step="any" class="form-control form-control-lg" name="title" value="{{ $unit->title }}">
                  @error('title')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Rooms</label>
                  <input type="text" min="0" step="any" class="form-control form-control-lg" name="rooms" value="{{ $unit->rooms }}">
                  @error('covered_area')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Covered Area</label>
                  <div class="row">
                    <div class="col-sm-7">
                      @if ($unit->covered_area)
                      <input type="number" min="0" step="any" class="form-control form-control-lg" name="covered_area" value="{{ round($unit->covered_area / $measurements[$unit->measurement_type - 1]->convertor, 5) }}">
                      @else
                      <input type="number" min="0" step="any" class="form-control form-control-lg" name="covered_area" value="">
                      @endif
                    </div>
                    <div class="col-sm-5">
                      <select name="measurement_type" class="form-control form-control-lg">
                        <option disabled selected hidden value="">Select Measurement Type...</option>
                        @foreach ($measurements as $measurement)
                        <option value="{{ $measurement->id }}" {{ $measurement->id == $unit->measurement_type ? 'selected' : '' }}>
                          {{ $measurement->name }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-12">
                      @error('covered_area')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                      @enderror
                      @error('measurement_type')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Unit Type *</label>
                  <select name="unit_type_id" class="form-control form-control-lg">
                    <option disabled selected hidden value="">Select Unit Type...</option>
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $unit->unit_type_id == $type->id ? 'selected' : '' }}>
                      {{ $type->title }}
                    </option>
                    @endforeach
                  </select>
                  @error('unit_type_id')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label>Price *</label>
                  <input type="number" min="0" step="any" class="form-control form-control-lg" name="price" value="{{ round($unit->price, 2) }}">
                  @error('price')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label>Loan Amount *</label>
                  <input type="number" min="0" step="any" class="form-control form-control-lg" name="loan_amount" value="{{ round($unit->loan_amount, 2) }}">
                  @error('loan_amount')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label>Down Payment *</label>
                  <input type="number" min="0" step="any" class="form-control form-control-lg" name="down_payment" value="{{ round($unit->down_payment, 2) }}">
                  @error('down_payment')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Monthly Installment *</label>
                  <input type="number" min="0" step="any" class="form-control form-control-lg" name="monthly_installment" value="{{ round($unit->monthly_installment, 2) }}">
                  @error('monthly_installment')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6">
                <label>Installment Type *</label>
                <div class="row">
                  <div class="col-sm-5">
                    <select name="installment_type" class="form-control form-control-lg">
                      <option disabled selected hidden value="">Select Installment Type...</option>
                      @foreach ($installments as $installment)
                      <option value="{{ $installment->id }}" {{ $installment->id == $unit->installment_type ? 'selected' : '' }}>
                        {{ $installment->name }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-7">
                    <div class="form-group fv-plugins-icon-container">
                      <input type="number" min="0" step="any" class="form-control form-control-lg" name="installment" value="{{ round($unit->installment, 2) }}" placeholder="Installment Length*">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    @error('installment_type')
                    <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                    @error('installment')
                    <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-6">
                <div>
                  <div class="form-group fv-plugins-icon-container">
                    <label>Payment Plan</label>
                    <div class="col-lg-9 col-xl-12">
                      <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url(assets/media/users/blank.png)">
                        <div class="image-input-wrapper" style="background-image: url(uploads/project_images/project_{{ $unit->project_id }}/unit_{{ $unit->id }}/{{ $unit->payment_plan_img }})">
                        </div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Picture">
                          <i class="fa fa-pen icon-sm text-muted"></i>
                          <input type="file" name="payment_plan_img" accept=".png, .jpg, .jpeg" />
                          <input type="hidden" name="payment_plan_img_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Picture">
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
              <div class="col-xl-6">
                <div>
                  <div class="form-group fv-plugins-icon-container">
                    <label>Floor Plan</label>
                    <div class="col-lg-9 col-xl-12">
                      <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url(assets/media/users/blank.png)">
                        <div class="image-input-wrapper" style="background-image: url(uploads/project_images/project_{{ $unit->project_id }}/unit_{{ $unit->id }}/{{ $unit->floor_plan_img }})">
                        </div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Picture">
                          <i class="fa fa-pen icon-sm text-muted"></i>
                          <input type="file" name="floor_plan_img" accept=".png, .jpg, .jpeg" />
                          <input type="hidden" name="floor_plan_img_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Picture">
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
                              &lt;div class="image-input image-input-outline" id="kt_image_5" style="background-image: url(assets/media/&gt;users/blank.png)"&gt;
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
                              var avatar5 = new KTImageInput('kt_image_5');
                              console.log(JSON.stringify(avatar5));
                              avatar5.on('cancel', function(imageInput) {
                                swal.fire({
                                  title: 'Image successfully canceled !',
                                  type: 'success',
                                  buttonsStyling: false,
                                  confirmButtonText: 'Awesome!',
                                  confirmButtonClass: 'btn btn-primary font-weight-bold'
                                });
                              });

                              avatar5.on('change', function(imageInput) {
                              swal.fire({
                                title: 'Image successfully changed !',
                                type: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Awesome!',
                                confirmButtonClass: 'btn btn-primary font-weight-bold'
                              });
                              });

                              avatar5.on('remove', function(imageInput) {
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
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label>Unit Description</label>
                  <textarea class="form-control" name="description" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $unit->description }}</textarea>
                  @error('description')
                  <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                  @enderror
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
            </div>
          </div>


          <div class="card-footer">
            <div class="row">
              
              <div class="col-6 col-lg-6 text-left">
                <!-- <button type="reset" class="btn" style="background-color:#E01E26; color:#fff;">Cancel</button> -->
                <a href="{{ Request::get('cancel') }}" type="reset" class="btn admin_ad_btn_red">Cancel</a>
              </div>
              <div class="col-6 col-lg-6 text-right">
                <button type="submit" class="btn mr-2 admin_ad_btn">Update</button>
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
<script src="assets/js/pages/crud/file-upload/image-input.js"></script>
<!--end::Page Scripts-->
@endsection