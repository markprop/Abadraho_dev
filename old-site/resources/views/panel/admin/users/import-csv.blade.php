@extends('panel.layouts.master1')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Project</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter project details and
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
                        <h2 class="card-title text-uppercase">Add Project</h2>
                    </div>
                    <!--begin::Form-->
                    <form class="form mt-5" method="POST" action="/admin/project/import" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-xl-12">
                            <div class="row">
                              
                                <div class="col-xl-6">
                                    <div class="form-group fv-plugins-icon-container">
                                        <label style="font-size: 20px">Import Projects ( .csv Format )</label>
                                        <input type="file" class="form-control form-control-lg" name="projects" id="projects">
                                        @error('projects')
                                        <span class="form-text text-muted">Please upload the project document in .csv format. {{ $errors->first('project_doc') }}</span>
                                        @enderror
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                                <div class="col-lg-6 text-lg-right">
                                    <button type="submit" class="btn btn-primary mr-2">Save</button>
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
