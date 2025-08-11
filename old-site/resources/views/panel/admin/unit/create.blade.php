@extends('panel.layouts.master1')

@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
          <!--begin::Title-->
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Unit</h5>
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
            <h2 class="card-title text-uppercase">Add Unit To Project</h2>
          </div>
          <!--begin::Form-->
          <form class="form mt-5" id="frmValidate" method="POST" action="/admin/unit" enctype="multipart/form-data">
            @csrf
            <div class="col-xl-12">
              <div class="row">
                <div class="form-group fv-plugins-icon-container d-none">
                  <label>Project ID {{ $project_id }}</label>
                  <div class="col-sm-9">
                    <input type="number" min="0" step="any" class="form-control form-control-lg" name="project_id"
                      value="{{ $project_id }}" required>
                    @error('project_id')
                      <span class="fv-plugins-message-container text-danger">Please specify the area covered by the
                        project.</span>
                    @enderror
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Title *</label>
                    <input type="text" min="0" step="any" class="form-control form-control-lg"
                      value="{{ old('title') }}" name="title" required>
                    @error('title')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                    <div class="fv-plugins-message-container"></div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Rooms</label>
                    <input type="text" min="0" step="any" class="form-control form-control-lg"
                      value="{{ old('rooms') }}" name="rooms">
                    @error('rooms')
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
                        <input type="number" min="0" step="any" class="form-control form-control-lg"
                          value="{{ old('covered_area') }}" name="covered_area">
                        @error('covered_area')
                          <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-sm-5">
                        <select name="measurement_type" class="form-control form-control-lg">
                          <option disabled selected hidden value="">Select Measurement Type...</option>
                          @foreach ($measurements as $measurement)
                            <option value="{{ $measurement->id }}"
                              {{ old('measurement_type') == $measurement->id ? 'selected' : '' }}>
                              {{ $measurement->name }}</option>
                          @endforeach
                        </select>
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
                    <select name="unit_type_id" class="form-control form-control-lg" required>
                      <option disabled selected hidden value="">Select Project Type...</option>
                      @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('unit_type_id') == $type->id ? 'selected' : '' }}>
                          {{ $type->title }}</option>
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
                    <input type="number" min="0" step="any" class="form-control form-control-lg"
                      value="{{ old('price') }}" name="price" required>
                    @error('price')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Loan Amount *</label>
                    <input type="number" min="0" step="any" class="form-control form-control-lg"
                      value="{{ old('loan_amount') }}" name="loan_amount">
                    @error('loan_amount')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Down Payment *</label>
                    <input type="number" min="0" step="any" class="form-control form-control-lg"
                      value="{{ old('down_payment') }}" name="down_payment" required>
                    @error('down_payment')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label>Monthly Installment *</label>
                  <div class="form-group fv-plugins-icon-container">
                    <input type="number" min="0" step="any" class="form-control form-control-lg"
                      value="{{ old('monthly_installment') }}" name="monthly_installment" required>
                    @error('monthly_installment')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-xl-6">
                  <label>Installment Type *</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <select name="installment_type" class="form-control form-control-lg">
                        <option disabled selected hidden value="">Select Installment Type...</option>
                        @foreach ($installments as $installment)
                          <option value="{{ $installment->id }}"
                            {{ old('installment_type') == $installment->id ? 'selected' : '' }}>
                            {{ $installment->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    
                    <div class="col-sm-6">
                      
                      <div class="form-group fv-plugins-icon-container">
                      
                        <input type="number" min="0" step="any" class="form-control form-control-lg"
                          value="{{ old('installment') }}" name="installment" placeholder="Installment Length*">
                      </div>
                    </div>
                    @error('installment_type')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                    @error('installment')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-xl-6">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Payment Plan Image</label>
                    <input type="file" class="form-control form-control-lg" name="payment_plan_img" id="project_doc">
                    @error('payment_plan_img')
                      <span class="fv-plugins-message-container text-danger">Please upload the project Cover Image.
                        {{ $errors->first('payment_plan_img') }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Floor Plan Image</label>
                    <input type="file" class="form-control form-control-lg" name="floor_plan_img">
                    @error('floor_plan_img')
                      <span class="fv-plugins-message-container text-danger">Please upload the project Images.
                        {{ $errors->first('floor_plan_img') }}</span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-12">
                  <div class="form-group fv-plugins-icon-container">
                    <label>Unit Description</label>
                    <textarea class="form-control" name="description" id="kt_autosize_1" rows="3"
                      style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ old('description') }}</textarea>
                    @error('description')
                      <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <div class="row">
                
                <div class="col-6 col-lg-6 text-left">
                  <a href="{{ Request::get('cancel') }}" type="reset" class="btn btn-secondary">Cancel</a>
                </div>
                <div class="col-6 col-lg-6 text-right">
                  <button onclick="FormSubmit()" type="button" class="btn admin_ad_btn mr-2">Save</button>
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
  <!-- <script src="assets/js/pages/custom/projects/add-project.js"></script> -->
  <!--end::Page Scripts-->

  <script>
    function FormSubmit(){
      if (SubmitForm("frmValidate")) {
        ShowLoader();
        $("#frmValidate").submit();
      }
    }

    // alert("S");
    // ShowSuccess("ssss");
  </script>

@endsection
