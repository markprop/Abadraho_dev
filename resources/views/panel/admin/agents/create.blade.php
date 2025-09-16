@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Add Agent</h5>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column-fluid">
    <div class="container">
      <div class="card card-custom gutter-b example example-compact">
        <div class="card-header" style="padding: 1rem 1.25rem;">
          <h2 class="card-title text-uppercase">Add Agent</h2>
        </div>
        <form class="form mt-5" method="POST" action="/admin/agents">
          @csrf
          <div class="col-xl-12">
            <div class="form-group">
              <label>Contact Person Name</label>
              <input type="text" class="form-control form-control-lg" name="contact_person_name" required>
            </div>
            <div class="form-group">
              <label>Contact Number</label>
              <input type="text" class="form-control form-control-lg" name="contact_number" required>
            </div>
            <div class="form-group">
              <label>Contact Email</label>
              <input type="email" class="form-control form-control-lg" name="contact_email" required>
            </div>
            <div class="form-group">
              <label>Login Password</label>
              <input type="password" class="form-control form-control-lg" name="login_password" required>
            </div>
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" class="form-control form-control-lg" name="company_name">
            </div>
            <div class="form-group">
              <label>Company Address</label>
              <textarea class="form-control form-control-lg" name="company_address" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label>Agent Since (Year)</label>
              <input type="number" class="form-control form-control-lg" name="agent_since_years" min="1950" max="2025" placeholder="e.g., 1990, 1980, 2001">
              <small class="form-text text-muted">Enter the year since you joined as an agent (e.g., 1990, 1980, 2001, etc.)</small>
            </div>
            <div class="form-group">
              <label>Deals in</label>
              <div class="checkbox-list">
                <label class="checkbox">
                  <input type="checkbox" name="deals_in[]" value="Under Construction / Off Plan Projects">
                  <span></span> Under Construction / Off Plan Projects
                </label>
                <label class="checkbox">
                  <input type="checkbox" name="deals_in[]" value="Commercial">
                  <span></span> Commercial
                </label>
                <label class="checkbox">
                  <input type="checkbox" name="deals_in[]" value="Shops">
                  <span></span> Shops
                </label>
                <label class="checkbox">
                  <input type="checkbox" name="deals_in[]" value="Residential">
                  <span></span> Residential
                </label>
                <label class="checkbox">
                  <input type="checkbox" name="deals_in[]" value="Plots">
                  <span></span> Plots
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>Expertise Areas</label>
              <select class="form-control selectpicker" name="expertise_areas[]" multiple data-live-search="true">
                @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-6 col-lg-6 text-left">
                <a href="/admin/agents" class="btn btn-secondary">Cancel</a>
              </div>
              <div class="col-6 col-lg-6 text-right">
                <button type="submit" class="btn admin_ad_btn mr-2">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


