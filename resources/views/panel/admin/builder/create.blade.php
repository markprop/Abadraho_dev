@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Details-->
      <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Builder</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter builder details and
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
          <h2 class="card-title text-uppercase">Add Builder</h2>
        </div>
        <!--begin::Form-->
        <form class="form mt-5 ml-10 mr-10" method="POST" action="/admin/builder" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Full Name</label>
                <input type="text" class="form-control form-control-lg" name="full_name" required>
                <span class="form-text text-muted">Please enter the builder's
                  Name.</span>
                @error('full_name')
                <div class="fv-plugins-message-container">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-12">
              <div class="form-group fv-plugins-icon-container">
                <label>Contact Person Name</label>
                <input type="text" class="form-control form-control-lg" name="contact_person_name">
                <span class="form-text text-muted">Please enter the contact person's
                  Name.</span>
                @error('contact_person_name')
                <div class="fv-plugins-message-container">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-8">
              <div class="form-group fv-plugins-icon-container">
                <label class="d-block">Select User</label>
                <select name="contact_person_email" class="form-control" required>
                  <option selected value="">Select User</option>
                  @foreach($builders as $builder)
                  <option value="{{ $builder->id }}" >
                    {{ $builder->email }}
                  </option>
                  @endforeach
                </select>
                <span class="form-text text-muted">Please select builder email from user.</span>
                @error('contact_person_email')
                <div class="fv-plugins-message-container">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-xl-4">
              <div class="form-group fv-plugins-icon-container">
                <label class="d-block">Phone</label>
                {{-- <input type="text" class="form-control form-control-lg" name="full_name" required> --}}
                <input id="contact_person_phone_number" type="tel" class="form-control form-control-lg" name="contact_person_phone_number" style="width:100% !important" />
                <span class="form-text text-muted">Please enter the contact person's Phone Number.</span>
                @error('contact_person_phone_number')
                <div class="fv-plugins-message-container">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
            <div class="col-6 col-lg-6 text-left">
                <a href="/admin/builder" type="reset" class="btn btn-secondary">Cancel</a>
              </div>

              <div class="col-6 col-lg-6 text-right">
                <button type="submit" id="submitBuilderForm" class="btn admin_ad_btn mr-2">Save</button>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@endsection

@section('footer')
<!--begin::Page Scripts(used by this page)-->
<script src="assets/js/pages/custom/projects/add-project.js"></script>
<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<!--end::Page Scripts-->
<script>
  const phoneInputField = document.querySelector("#contact_person_phone_number");

  function getIp(callback) {
    fetch('https://ipinfo.io/json?token=<your token>', {
        headers: {
          'Accept': 'application/json'
        }
      })
      .then((resp) => resp.json())
      .catch(() => {
        return {
          country: 'pk',
        };
      })
      .then((resp) => callback(resp.country));
  }
  const phoneInput = window.intlTelInput(phoneInputField, {
    initialCountry: "pk",
    geoIpLookup: getIp,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
  });

  $('#submitBuilderForm').bind('click', function(e) {
    const phoneNumber = phoneInput.getNumber();
    $('#contact_person_phone_number').val(phoneNumber);
  });
</script>
@endsection