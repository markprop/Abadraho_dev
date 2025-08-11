@extends('panel.layouts.master1')



@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Subheader-->

  <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">

    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

      <!--begin::Info-->

      <div class="d-flex align-items-center flex-wrap mr-1">

        <!--begin::Page Heading-->

        <div class="d-flex align-items-baseline flex-wrap mr-5">

          <!--begin::Page Title-->

          <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>

          <!--end::Page Title-->

          <!--begin::Breadcrumb-->

          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item text-muted">

              <a href="" class="text-muted">Blogs</a>

            </li>

          </ul>

          <!--end::Breadcrumb-->

        </div>

        <!--end::Page Heading-->

      </div>

      <!--end::Info-->

    </div>

  </div>

  <!--end::Subheader-->

  <!--begin::Entry-->

  <div class="d-flex flex-column-fluid">

    <!--begin::Container-->

    <div class="container">

      <!--begin::Notice-->



      <!--end::Notice-->

      <!--begin::Card-->

      <div class="card card-custom">

        <div class="card-header flex-wrap border-0 pt-6 pb-0">

          <div class="col-xs-6">

            <div class="card-title">

              <h3 class="card-label">Blog</h3>

            </div>

          </div>

          <div class="col-xs-6 text-xs-right">

            <a href="/admin/blog/create" type="button" class="btn admin_ad_btn_red mr-2">Add Blog</a>

          </div>

        </div>

        <div class="card-body">

          <!--begin: Search Form-->

          <!--begin::Search Form-->

          <div class="mb-7">

            <div class="row align-items-center">

              <div class="col-lg-9 col-xl-8">



              </div>

              <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">

                {{-- <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> --}}

                <div class="input-icon" style="float: right">

                  <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />

                  <span>

                    <i class="flaticon2-search-1 text-muted"></i>

                  </span>

                </div>

              </div>

            </div>

          </div>

          <!--end::Search Form-->

          <!--end: Search Form-->

          <!--begin: Datatable-->

          <table class="datatable datatable-bordered datatable-head-custom table-bordered text-center" id="kt_datatable">

            <thead>

              <tr>

                <th title="Field #1" style="width:20px">#</th>

                <th title="Field #2">Blog Name</th>

                <th title="Field #3">Category</th>

                <th title="Field #3">Blog Description</th>

                <th title="Field #9">Actions</th>

              </tr>

            </thead>

            <tbody>

              @foreach ($blogs as $blog)

              <tr>

                <td>{{ $loop->index + 1 }}</td>

                <td>{{ $blog->title }}</td>

                <td>{{ optional($blog->category)->title }}</td>

                <td> {!! Str::limit($blog->description, 90) !!}</td>

                <td>

                  <a href="/admin/blog/{{ $blog->id }}/edit"><i class="fa fa-edit ml-2"></i></a>

                  <a href="javascript:void(0)" onclick="deletetIsArchive('{{$blog->id}}')">

                    <i class="fa fa-trash ml-2"></i>

                  </a>

                </td>

              </tr>

              @endforeach

            </tbody>

          </table>

          <!--end: Datatable-->

        </div>

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

{{-- <link href="{{ asset('assets/css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" /> --}}

<!--end::Page Custom Styles-->

<style>

  .datatable.datatable-default>.datatable-table>.datatable-head .datatable-row>.datatable-cell:nth-child(1)>span,

  .datatable.datatable-default>.datatable-table>.datatable-body .datatable-row>.datatable-cell:nth-child(1)>span {

    width: 20px !important;

  }

</style>

@endsection



@section('footer')

<!--begin::Page Scripts(used by this page)-->

<!-- <script src="assets/js/pages/custom/projects/add-project.js"></script> -->

<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>

<!--end::Page Scripts-->

<script>

  $(function() {

    //  alert("sss");

  });



  function deletetIsArchive(blog_id) {

    // let objProject = JSON.parse(project);

    // console.log("deletetIsArchive -> project -> id -> ", blog_id);

    // ShowSweetAlert({

    //   title: 'Shortlisted!',

    //   text: 'Candidates are successfully shortlisted!',

    //   icon: 'success'

    // });

    if (parseInt(blog_id)) {

      ShowSweetAlertConfirm({

        title: "Are you sure ?",

        text: "You want to delete this blog!",

        icon: "warning",

        showDenyButton: true,

        showCancelButton: true,

        confirmButtonText: `Yes`,

        denyButtonText: `No`,

      }, function(result) {

        if (result.isConfirmed) {

          let requestRoute = "/admin/blog/delete";

          let requestParams = {

            blog_id: blog_id

          }

          CallLaravelAction(requestRoute, requestParams, function(response) {

            if (response.status) {

              let SweetAlertParams = {

                icon: "success",

                title: response.message,

                showConfirmButton: true,

                timer: 10000,

              };

              ShowSweetAlert(SweetAlertParams);

              location.reload();

              // ShowSuccess(response.message);

              HideLoader();

            } else {

              var ErrorMsg = response.message;

              if (typeof response.error !== "undefined") {

                if (typeof response.error.blog_id !== "undefined") {

                  ErrorMsg = response.error.blog_id;

                }

              }

              let SweetAlertParams = {

                icon: "error",

                title: ErrorMsg,

                showConfirmButton: true,

                timer: 20000,

              };

              ShowSweetAlert(SweetAlertParams);

              // ShowError(ErrorMsg);

              HideLoader();

            }

          });

        }

      });

    }

  }

</script>

@endsection