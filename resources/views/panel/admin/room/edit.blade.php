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
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit Room Type</h5>
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
                        <h2 class="card-title text-uppercase">Edit Tag</h2>
                    </div>
                    <!--begin::Form-->
                    <form class="form mt-5 ml-10 mr-10" method="POST" action="/admin/room_type/{{ $roomType->id }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Tag Name</label>
                                    <input type="text" class="form-control form-control-lg" name="name"
                                        value="{{ $roomType->name }}">
                                    <span class="form-text text-muted">Please enter the room type'sName.</span>
                                    @error('name')
                                        <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group fv-plugins-icon-container icon-select">
                                    <label>Icon</label>
                                    <select name="icon" id="" class="form-control form-control-lg" data-live-search="true">
                                        <option value="">Please Select</option>
                                        @foreach ($icon_arr as $key => $icon)
                                            <option value="{{ $icon['class'] }}"
                                                {{ $icon['class'] == $roomType->icon ? 'selected' : '' }}>
                                                &#x{{ str_replace('\\', '', $icon['unicode']) }}; {{ $icon['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-muted">Please enter the room type's
                                        icon.</span>
                                    @error('icon')
                                        <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group fv-plugins-icon-container icon-select">
                                    <label>Show</label>
                                    <select name="to_show" id="" class="form-control form-control-lg">
                                        <option value="">Please Select</option>
                                        <option value="1" {{ $roomType->to_show == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $roomType->to_show == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    <span class="form-text text-muted">Please enter the room type's
                                        icon.</span>
                                    @error('icon')
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
@endsection
