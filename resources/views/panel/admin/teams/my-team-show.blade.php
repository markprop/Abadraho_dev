@extends('panel.layouts.master1');

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
          <h5 class="text-dark font-weight-bold my-1 mr-5"><a href="/admin/project/">My Teams</a></h5>
          <!--end::Page Title-->
          <!--begin::Breadcrumb-->
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
              <a href="" class="text-muted">{{ $team->name }}</a>
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
          <div class="card-title">
            <h3 class="card-label">My Team
            {{-- <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span></h3> --}}
          </div>
        </div>
        <div class="card-body">
          <!--begin: Search Form-->
          <!--begin::Search Form-->
          <div class="mb-7">
            <div class="row align-items-center">
              <div class="col-lg-9 col-xl-8">
                <div class="row align-items-center">
                  {{-- <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                      <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                      <span>
                        <i class="flaticon2-search-1 text-muted"></i>
                      </span>
                    </div>
                  </div> --}}
                  {{-- <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                      <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                      <select class="form-control" id="kt_datatable_search_status">
                        <option value="">All</option>
                        <option value="1">Pending</option>
                        <option value="2">Delivered</option>
                        <option value="3">Canceled</option>
                        <option value="4">Success</option>
                        <option value="5">Info</option>
                        <option value="6">Danger</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                      <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                      <select class="form-control" id="kt_datatable_search_type">
                        <option value="">All</option>
                        <option value="1">Online</option>
                        <option value="2">Retail</option>
                        <option value="3">Direct</option>
                      </select>
                    </div>
                  </div> --}}
                </div>
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

          <h2>Team Name</h2>
          <h4>{{ $team->name }}</h4>
          <h2>Team ID</h2>
          <h4>{{ $team->id }}</h4>
          <h2>Team Builder Members</h2>
          <h4>
            @foreach ($team->builders as $builder)
            @if ($builder->getOriginal('pivot_status'))
              {{ $builder->getOriginal('pivot_status')}} | {{ $builder->name }} <br>
            @endif
            @endforeach
          </h4>
          <h2>Team User Members</h2>
          <h4>
            @foreach ($team->users as $user)
              @if ($user->getOriginal('pivot_status'))
              {{ $user->getOriginal('pivot_status') }} | {{ $user->name }} <br>
              @endif
            @endforeach
          </h4>
          <hr>
          <table class="datatable datatable-bordered datatable-head-custom mt-4" id="kt_datatable">
            <thead>
              <tr>
                <th title="Field #1">#</th>
                {{-- <th title="Field #2">Team Name</th> --}}
                <th title="Field #3">Project Name</th>
                <th title="Field #4">Project Id</th>
                <th title="Field #5">Project Builders</th>
                <th>Project Users</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($team->projects as $project)
              <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->id }}</td>
                <td>
                  @foreach ($project->owners as $owner)
                      {{ $owner->name }} <strong>|</strong>
                  @endforeach
                </td>
                <td>
                  @foreach ($project->users as $user)
                      {{ $user->name }} <strong>|</strong>
                  @endforeach
                </td>
                {{-- <td>{{ $review->review }}</td> --}}
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
    
@endsection

@section('footer')
    <!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
		<!--end::Page Scripts-->
@endsection