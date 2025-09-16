@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="d-flex align-items-center flex-wrap mr-1">
        <div class="d-flex align-items-baseline flex-wrap mr-5">
          <h5 class="text-dark font-weight-bold my-1 mr-5">User Management</h5>
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
              <a href="" class="text-muted">Agent Listing</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex flex-column-fluid">
    <div class="container">
      <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
          <div class="col-xs-6">
            <div class="card-title">
              <h3 class="card-label">Agents</h3>
            </div>
          </div>
          <div class="col-xs-6 text-xs-right">
            <span class="badge badge-primary" style="font-size:14px; padding:8px 12px;">Total Agents: {{ method_exists($admins, 'total') ? $admins->total() : $admins->count() }}</span>
          </div>
        </div>
        <div class="card-body">
          <div class="mb-7">
            <div class="row align-items-center">
              <div class="col-12 col-lg-12 col-xl-12">
                <div class="card" style="margin-bottom: 3%; margin-top:2%">
                  <div class="card-body">
                    <section class="search-sec">
                      <div class="container">
                        <form method="get" action="/admin/agents">
                          <div class="form-row">
                            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                              <label class="search_heading">Name</label>
                              <input type="text" class="form-control" name="userName" placeholder="Name" value="{{ $searchQuery['name'] }}">
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                              <label class="search_heading">Email</label>
                              <input type="email" class="form-control" name="userEmail" placeholder="Email" value="{{ $searchQuery['email'] }}">
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                              <label class="search_heading">-</label><br>
                              <button type="submit" class="btn admin_ad_btn_red mb-2">Search</button>
                              <a href="/admin/agents/create" class="btn admin_ad_btn mb-2">Add Agent</a>
                            </div>
                          </div>
                        </form>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="table_wrapper">
            <table class="datatable datatable-bordered datatable-head-custom table_wrapper table-bordered text-center" id="kt_datatable">
              <thead>
                <tr>
                  <th style="width:20px">#</th>
                  <th>Contact Person</th>
                  <th>Contact Number</th>
                  <th>Contact Email</th>
                  <th>Company</th>
                  <th>Expertise Areas</th>
                  <th>Date/Time</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $admin->contact_person_name }}</td>
                  <td>{{ $admin->contact_number }}</td>
                  <td>{{ $admin->contact_email }}</td>
                  <td>{{ $admin->company_name }}</td>
                  <td>
                    @php $areaNames = method_exists($admin, 'areas') ? $admin->areas->pluck('name')->implode(', ') : '' @endphp
                    {{ $areaNames }}
                  </td>
                  <td>{{ $admin->created_at }}</td>
                  <td>
                    <a href="/admin/agents/{{ $admin->id }}"><i class="fa fa-eye ml-2"></i></a>
                    <a href="/admin/agents/{{ $admin->id }}/edit"><i class="fa fa-edit ml-2"></i></a>
                    <a onclick="deleteAgent('{{ $admin->id }}')" href="javascript:void(0)">
                      <i class="fa fa-trash ml-2"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('header')
<style>
  .datatable.datatable-default>.datatable-table>.datatable-head .datatable-row>.datatable-cell:nth-child(1)>span,
  .datatable.datatable-default>.datatable-table>.datatable-body .datatable-row>.datatable-cell:nth-child(1)>span {
    width: 20px !important;
  }
  .search_heading { font-weight: 600; }
  .table_wrapper { overflow-x: auto; }
  .admin_ad_btn_red { background: #f64e60; color: #fff; }
  .admin_ad_btn_red:hover { color: #fff; }
  .admin_ad_btn { background: #3699ff; color: #fff; }
  .admin_ad_btn:hover { color: #fff; }
  .text-xs-right { text-align: right; }
</style>
@endsection

@section('footer')
<script src="assets/js/pages/custom/projects/add-project.js"></script>
<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
<script>
  function deleteAgent(agent_id) {
    if (parseInt(broker_id)) {
      ShowSweetAlertConfirm({
        title: "Are you sure ?",
        text: "You want to delete this Agent!",
        icon: "warning",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
      }, function(result) {
        if (result.isConfirmed) {
          let requestRoute = "/admin/agents/delete";
          let requestParams = { agent_id: agent_id };
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
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.agent_id !== "undefined") {
                  ErrorMsg = response.error.agent_id;
                }
              }
              let SweetAlertParams = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 20000,
              };
              ShowSweetAlert(SweetAlertParams);
              HideLoader();
            }
          });
        }
      });
    }
  }
</script>
@endsection


