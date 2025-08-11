@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Details-->
      <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Update Voucher</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Update vouchers details and
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
          <h2 class="card-title text-uppercase">Update Voucher</h2>
        </div>
        <!--begin::Form-->

        <!-- enctype="multipart/form-data" remove by Shahbaz raza -->
        <div class="card-body">
          <form class="form mt-5" method="POST" action="/admin/voucher/{{ $voucher->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                  <label>Voucher Name<span class="text-red">*</span></label>
                  <input type="text" class="form-control form-control-lg" name="name" value="{{ $voucher->name }}" required>
                  <span class="form-text text-muted">Voucher Name</span>
                  @error('name')
                      <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
              </div>
            </div>
            {{-- <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                  <label>Voucher Code<span class="text-red">*</span></label>
                  <input type="text" class="form-control form-control-lg" name="code" value="{{ $voucher->code }}" required readonly>
                  <span class="form-text text-muted">Voucher Code</span>
                  @error('code')
                      <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
              </div>
            </div> --}}
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                  <label>Project Name<span class="text-red">*</span></label>
                  <select id="project_id" class="form-control form-control-lg" name="project_id" required>
                      <option disabled selected hidden value="">Please select Project</option>
                      @foreach ($projects as $project)
                          <option value="{{ $project->id }}" {{ $voucher->project_id == $project->id ? 'selected' : '' }}
                            {{ !empty($project->ProjectVoucher->code) && $voucher->project_id != $project->id ? 'disabled' : '' }}>{{ $project->name }}</option>
                      @endforeach
                  </select>
                  <span class="form-text text-muted">Project Name</span>
                  @error('project_id')
                      <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                  <label>Discount Apply<span class="text-red">*</span></label>
                  <div class="row">
                      <div class="col-md-3">
                          <div class="custom-control custom-radio" style="padding-top: 20px">
                              <input type="radio" class="custom-control-input" id="project" name="discount_applied"
                                value="project" required {{ $voucher->discount_applied == 'project' ? 'checked' : '' }}>
                              <label class="custom-control-label" for="project">Project</label>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="custom-control custom-radio" style="padding-top: 20px">
                              <input type="radio" class="custom-control-input" id="unit"
                                  name="discount_applied" value="unit" {{ $voucher->discount_applied == 'unit' ? 'checked' : '' }} required>
                              <label class="custom-control-label" for="unit">Units</label>
                          </div>
                      </div>
                      <div class="col-md-6 unit-container">
                          <div class="form-group fv-plugins-icon-container">
                              <label>Select Units<span class="text-red">*</span></label>
                              <select class="form-control select2" id="kt_select2_33" name="units[]" aria-placeholder="Select Units" multiple="multiple">
                                @foreach ( $voucher->project->units as $unit )
                                 <?=$selected = 0;
                                 foreach ( $voucher->units_voucher as $selected_unit)
                                  {
                                    $selected = 0;
                                    if($selected_unit->unit_id == $unit->id)
                                    {
                                      $selected = 1;
                                      break;
                                    }
                                  }?>
                                <option value="{{ $unit->id }}" {{ ($selected == 1) ? 'selected' : '' }}>{{ $unit->title }}</option>  
                                @endforeach
                              </select>
                              <span class="form-text text-muted">Please enter project units.</span>
                              <div class="fv-plugins-message-container text-danger"></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                  <label>Discount<span class="text-red">*</span></label>
                  <div class="row">
                      <div class="col-md-3">
                          <div class="custom-control custom-radio" style="padding-top: 20px">
                              <input type="radio" class="custom-control-input" id="amount" name="discount_by"
                                value="amount" required {{ $voucher->discount_by == 'amount' ? 'checked' : '' }}>
                              <label class="custom-control-label" for="amount">Discount by Amount</label>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="custom-control custom-radio" style="padding-top: 20px">
                              <input type="radio" class="custom-control-input" id="percentage"
                                  name="discount_by" value="percentage" required {{ $voucher->discount_by == 'percentage' ? 'checked' : '' }}>
                              <label class="custom-control-label" for="percentage">Discount by
                                  Percentage</label>
                          </div>
                      </div>
                      <div class="col-md-4 discount-container" style="display: none;{{ ($voucher->discount_value !== null) ? 'display:block !important;' : ''}}">
                          <div class="form-group fv-plugins-icon-container">
                              <label>Disount Value<span class="text-red">*</span></label>
                              <input type="number" min="0" class="form-control form-control-lg" name="discount_value" required value="{{ $voucher->discount_value }}">
                              <span class="form-text text-muted">Discount Value</span>
                              @error('discount_value')
                                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                  <label>Expiry Date<span class="text-red">*</span></label>
                  <input type="data" id="datepicker" class="form-control form-control-lg"
                      name="expires_date" autocomplete="no" required value=" {{ $voucher->expires_at }}">
                  <span class="form-text text-muted">Voucher Expiry Date</span>
                  @error('expires_date')
                      <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group">
                  <div class="">
                      <div class="form-group fv-plugins-icon-container">
                          <label>Status</label>
                          <select name="status" class="form-control form-control-lg" required>
                              <option disabled selected hidden value="">Status...</option>
                              <option value="1" {{ $voucher->status == '1' ? 'selected' : '' }}>Active</option>
                              <option value="2" {{ $voucher->status == '0' ? 'selected' : '' }}>Disable</option>
                          </select>
                          <span class="form-text text-muted">Please specify the status
                              of the voucher.</span>
                          <div class="fv-plugins-message-container"></div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6 col-lg-6 text-left">
                  <a href="/admin/voucher" class="btn btn-secondary">Cancel</a>
                </div>
                <div class="col-6 col-lg-6 text-right">
                  <button type="submit" class="btn admin_ad_btn mr-2">Update</button>
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
</div>
@endsection

<!-- <div class="col-md-8" style="line-height: 26px; font-size: 16px; color:#4d4a49; font-family: 'Open Sans', sans-serif"> -->

@section('header')
<!--begin::Page Custom Styles(used by this page)-->
<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<!--end::Page Custom Styles-->
@endsection

@section('footer')

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

    <script>

        $(document).ready(function() {

            $('#project_id').on('change', function() {
                $("#project").attr("disabled", false);
                let value = $('#project_id').find(":selected").val();
                $.ajax({
                    url: 'getprojectunits/' + value,
                    type: 'GET',
                    dataType: "json",
                    success: function(data) {
                        $('#kt_select2_33').find('option').remove();
                        $.each(data, function(key, unit) {
                            let isDisabled = (unit.unit_voucher && unit.unit_voucher.voucher_id !== null) ? 'disabled' : '';
                            if (isDisabled !== '') {
                                $("#project").prop('checked', false);
                                $("#project").attr("disabled", true);
                            }
                            $("#kt_select2_33").append('<option value="'+unit.id+'" '+ isDisabled +'>'+unit.title+'</option>');
                        });
                        $("#kt_select2_33").selectpicker('refresh');
                    }
                });
            });

            $('input[name="discount_applied"]').change( function(){
                if ($('#unit').is(':checked')) {
                    $('#kt_select2_33'). prop('required',true);
                    $('.unit-container').show()
                    $("#kt_select2_33").selectpicker('refresh');
                }
                else{
                    $('#kt_select2_33'). prop('required',false);
                    $('.unit-container').hide();
                }
            });

            $('input[name="discount_by"]').change( function(){
                if ($('input[name="discount_by"]').is(':checked')) {
                    $('.discount-container').show();
                }
                else{
                    $('.discount-container').hide();
                }
            });
        });    
    </script>


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

@endsection