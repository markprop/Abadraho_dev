@extends('panel.layouts.master1')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!--begin::Page Custom Styles(used by this page)-->
<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
  .icon-select select {
    font-family: 'FontAwesome', sans-serif;
  }
  .select2-container .select2-selection--single {
    height: calc(2.25rem + 2px); /* Match form-control-lg height */
    padding: 0.3rem 1.6rem 0rem;
    border: 1px solid #ced4da; /* Match input border */
    border-radius: 0.25rem; /* Match input border radius */
    background-color: #fff; /* Match input background */
    display: flex;
    align-items: center;
    font-weight: 400; /* Match placeholder font weight */
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: normal;
    color: #495057; /* Match input text color */
    font-weight: 500; /* Match selected text font weight */
    display: flex;
    align-items: center;
  }
  .select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d; /* Match muted placeholder color */
    font-weight: 400; /* Match placeholder font weight */
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: calc(2.25rem + 2px);
    top: 0;
    right: 0.5rem;
  }
  .select2-results__option {
    padding: 0.5rem 1rem;
    font-weight: 600; /* Bolder text in dropdown options */
    display: flex;
    align-items: center;
    color: #495057; /* Match option text color */
  }
  .select2-results__option i {
    margin-right: 10px;
    font-size: 1.2rem; /* Slightly larger icons for visibility */
    color: #495057; /* Match icon color with text */
  }
  .select2-container--default .select2-search--dropdown .select2-search__field {
    padding: 0.5rem 1rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    font-size: 1rem; /* Match input font size */
    color: #495057; /* Match input text color */
  }
  .select2-container--default .select2-results__option--highlighted {
    background-color: #007bff;
    color: #fff;
  }
  .select2-container--default .select2-results__option--highlighted i {
    color:rgb(6, 6, 6);
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
          <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Room Type</h5>
          <!--end::Title-->
          <!--begin::Separator-->
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
          <!--end::Separator-->
          <!--begin::Search Form-->
          <div class="d-flex align-items-center" id="kt_subheader_search">
            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter Room Type name and
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
            <h2 class="card-title text-uppercase">Add Room Type</h2>
          </div>
          <!--begin::Form-->
          <form class="form mt-5 ml-10 mr-10" method="POST" action="/admin/room_type" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-lg" value="{{ old('name') }}" name="name">
                  <span class="form-text text-muted">Please enter the room type's Name.</span>
                  @error('name')
                    <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group fv-plugins-icon-container icon-select">
  <label>Icon</label>
  <select name="icon" id="icon-select" class="form-control form-control-lg">
    <option value="">Please Select</option>
    @foreach ($icon_arr as $icon)
      <option 
        value="{{ $icon['class'] }}" 
        data-icon="{{ $icon['class'] }}" 
        data-unicode="{{ str_replace('\\', '', $icon['unicode']) }}"
      >
        {{ $icon['name'] }}
      </option>
    @endforeach
  </select>
  <span class="form-text text-muted">Please select the room type's icon.</span>
  @error('icon')
    <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
  @enderror
</div>
                
                <!-- Check and test icon library -->
                <!-- <div class="">
                  <label>Icon Icon Icon Icon</label>
                  <select name="icon" id="" class="form-control form-control-lg">
                    <option value="">Please Select</option>
                    <option class="fab" style="font-size:25px"> &#xf3bd; fab fa-laravel</option>
                    @foreach ($icon_arr as $icon)
                      <option data-icon="fa {{$icon['class']}}" data-subtext="{{$icon['class']}}" value="{{ $icon['class'] }}">
                        &#x{{ str_replace('\\', '', $icon['unicode']) }}; 
                        <i class="fa {{$icon['class']}}"></i>
                        {{ $icon['name'] }}
                      </option>
                    @endforeach
                  </select>
                  <span class="form-text text-muted">Please enter the room type's
                    icon.</span>
                  @error('icon')
                    <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div> -->

                <div class="form-group fv-plugins-icon-container icon-select">
                  <label>Show</label>
                  <select name="to_show" id="" class="form-control form-control-lg">
                    <option value="">Please Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  <span class="form-text text-muted">Please select room type's
                    on lisitng page.</span>
                  @error('to_show')
                    <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6 col-lg-6 text-left">
                  <a href="/admin/room_type" type="reset" class="btn btn-secondary">Cancel</a>
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
  <!-- Select2 JS (ensure this is the correct path or use CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#icon-select').select2({
        placeholder: "Please Select",
        allowClear: true,
        minimumResultsForSearch: 0, // Always show search box
        templateResult: formatIcon,
        templateSelection: formatIcon
      });

      // Function to format the dropdown options and selected option
      function formatIcon(icon) {
        if (!icon.id) {
          return $('<span style="color: #6c757d; font-weight: 400;">' + icon.text + '</span>'); // Match placeholder style
        }
        var unicode = $(icon.element).data('unicode');
        var iconClass = $(icon.element).data('icon');
        var $icon = $(
          '<span style="font-weight: 600;"><i class="fa ' + iconClass + '"></i> ' + icon.text + '</span>'
        );
        return $icon;
      }
    });
  </script>
  <!--end::Page Scripts-->
@endsection
