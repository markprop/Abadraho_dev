@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Broker Details</h5>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column-fluid">
    <div class="container">
      <div class="card card-custom gutter-b example example-compact">
        <div class="card-header" style="padding: 1rem 1.25rem;">
          <h2 class="card-title text-uppercase">Broker Details</h2>
        </div>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>Contact Person Name</th>
              <td>{{ $broker->contact_person_name }}</td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td>{{ $broker->contact_number }}</td>
            </tr>
            <tr>
              <th>Contact Email</th>
              <td>{{ $broker->contact_email }}</td>
            </tr>
            <tr>
              <th>Company Name</th>
              <td>{{ $broker->company_name }}</td>
            </tr>
            <tr>
              <th>Company Address</th>
              <td>{{ $broker->company_address }}</td>
            </tr>
            <tr>
              <th>Broker Since (years)</th>
              <td>{{ $broker->broker_since_years }}</td>
            </tr>
            <tr>
              <th>Deals In</th>
              <td>
                @php $deals = is_array($broker->deals_in) ? $broker->deals_in : []; @endphp
                {{ implode(', ', $deals) }}
              </td>
            </tr>
            <tr>
              <th>Expertise Areas</th>
              <td>
                {{ $broker->areas->pluck('name')->implode(', ') }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection


