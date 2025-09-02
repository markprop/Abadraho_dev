@extends('panel.layouts.master1')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Subheader-->
  <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Details-->
      <div class="d-flex align-items-center flex-wrap mr-2">
        <!--begin::Title-->
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Update Project</h5>
        <!--end::Title-->
        <!--begin::Separator-->
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
        <!--end::Separator-->
        <!--begin::Search Form-->
        <div class="d-flex align-items-center" id="kt_subheader_search">
          <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter project details and submit</span>
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
          <h2 class="card-title text-uppercase">Update Project</h2>
        </div>
        <!--begin::Form-->
        <form class="form mt-5" method="POST" action="/admin/project/{{ $project->id }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="col-xl-12">
            <div class="row" style="display: flex;">
              <div class="col-md-8">
                <div class="form-group fv-plugins-icon-container">
                  <label>Project Name *</label>
                  <input type="text" class="form-control form-control-lg" name="name" value="{{ $project->name }}">
                  <span class="form-text text-muted">Please enter your Project Name.</span>
                  @error('name')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class='col-md-4'>
                <div class="form-group fv-plugins-icon-container">
                  <label>Project Discount Price *</label>
                  <input type="number" min="0" class="form-control form-control-lg" name="discount_price" value="{{ number_format($project->discount_price, 0, '.', '') }}">
                  <span class="form-text text-muted">Please enter your Project Discount Price.</span>
                  @error('discount_price')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Location Address *</label>
              <input type="text" class="form-control form-control-lg" name="address" value="{{ $project->address }}">
              <span class="form-text text-muted">Please enter your Address.</span>
              @error('address')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group fv-plugins-icon-container">
              <label>Areas *</label>
              @if (count($project->areas))
              <select class="form-control select2" id="kt_select2_4" name="areas[]" aria-placeholder="Select Areas" multiple="multiple">
                <optgroup label="Select Potential areas from the list">
                  @foreach ($areas as $key => $area)
                  <option value="{{ $area->id }}" @foreach ($project->areas as $selectedProjectArea) {{ $selectedProjectArea->area_id == $area->id ? 'selected' : '' }} @endforeach>
                    {{ $area->name }}
                  </option>
                  @endforeach
                </optgroup>
              </select>
              @else
              <select class="form-control select2" id="kt_select2_4" name="areas[]" aria-placeholder="Select Areas" multiple="multiple">
                <optgroup label="Select Potential areas from the list">
                  @foreach ($areas as $area)
                  <option value="{{ $area->id }}" {{ $project->area == $area->id ? 'selected' : '' }}>
                    {{ $area->name }}
                  </option>
                  @endforeach
                </optgroup>
              </select>
              @endif
              <span class="form-text text-muted">Please enter your Area for the project.</span>
              @error('areas')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="row">
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Latitude *</label>
                  <input type="number" min="0" step="any" class="form-control form-control-lg" name="latitude" value="{{ $project->latitude }}">
                  <span class="form-text text-muted">Please specify the latitude.</span>
                  @error('latitude')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Longitude *</label>
                  <input type="number" min="0" step="any" class="form-control form-control-lg" name="longitude" value="{{ $project->longitude }}">
                  <span class="form-text text-muted">Please specify the longitude.</span>
                  @error('longitude')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-6 d-none">
                <div class="form-group fv-plugins-icon-container">
                  <label>Project Type</label>
                  <select name="project_type_id" class="form-control form-control-lg">
                    <option disabled selected hidden value="">Select Project Type...</option>
                    @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $project->project_type_id == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                    @endforeach
                  </select>
                  <span class="form-text text-muted">Please specify the project Type.</span>
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Progress *</label>
                  <select name="progress_status_id" class="form-control form-control-lg">
                    <option disabled selected hidden value="">Progress...</option>
                    @foreach ($progressStatus as $prog)
                    <option value="{{ $prog->id }}" {{ $project->progress_status_id == $prog->id ? 'selected' : '' }}>{{ $prog->progress_status_name }}</option>
                    @endforeach
                  </select>
                  <span class="form-text text-muted">Please specify the status of the project.</span>
                  @error('progress')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6" style="display: none;">
                <div class="form-group fv-plugins-icon-container">
                  <label>Rooms</label>
                  <input type="text" class="form-control form-control-lg" name="rooms" value="{{ $project->rooms }}">
                  <span class="form-text text-muted">Please enter the rooms included in the project.</span>
                  @error('rooms')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                      <label>Project Documents (Multiple .pdf Files) (If you Previous one then leave it Blank or add new ones.)</label>
                      @if ($project->project_doc)
                          <div class="existing-docs">
                              <p><strong>Current Documents:</strong></p>
                              @php $docs_exploded = explode('|', $project->project_doc); @endphp
                              @foreach ($docs_exploded as $doc)
                                  <p>{{ basename($doc) }} <small>(Will be retained unless replaced)</small></p>
                                  <input type="hidden" name="existing_project_docs[]" value="{{ $doc }}">
                              @endforeach
                          </div>
                      @endif
                      <input type="file" class="form-control form-control-lg" name="project_docs[]" id="project_docs" accept=".pdf" multiple>
                      @error('project_docs')
                      <span class="form-text text-muted">Please upload project documents in .pdf format. {{ $errors->first('project_docs') }}</span>
                      @enderror
                      <div class="fv-plugins-message-container"></div>
                  </div>
                </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>YouTube Video Link</label>
                  <input type="url" class="form-control form-control-lg" name="project_video" id="project_video" placeholder="Paste YouTube URL (e.g., https://www.youtube.com/watch?v=example)" value="{{ old('project_video', $project->project_video) }}">
                  <span class="form-text text-muted">Please paste the YouTube video URL (e.g., https://www.youtube.com/watch?v=example).</span>
                  @error('project_video')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Project Cover Img</label>
                  <input type="file" class="form-control form-control-lg" name="project_cover_img" id="project_cover_img">
                  @if ($project->project_cover_img)
                  <img src="{{ asset($project->project_cover_img) }}" width="25%" />
                  @endif
                  @error('project_cover_img')
                  <span class="form-text text-muted">Please upload the project Cover Image. {{ $errors->first('project_cover_img') }}</span>
                  @enderror
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Project Images (Can Add Multiple)</label>
                  <input type="file" class="form-control form-control-lg" name="project_imgs[]" multiple>
                  @if ($project->project_imgs)
                  @foreach (explode('|', $project->project_imgs) as $img)
                  <img src="{{ asset($img) }}" width="25%" />
                  @endforeach
                  @endif
                  @error('project_imgs')
                  <span class="form-text text-muted">Please upload the project Images. {{ $errors->first('project_imgs') }}</span>
                  @enderror
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
            </div>

            @if(Auth::user()->user_type_id != Config::get("constants.UserTypeIds.Builder"))
            <div class="form-group row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label>Select Builders</label>
                  <select class="form-control select2" id="kt_select2_3" name="owners[]" aria-placeholder="Select Owners" multiple="multiple">
                    <optgroup label="Select Potential owners from the list">
                      @foreach ($builders as $builder)
                      <option value="{{ $builder->id }}" @if ($project->owners->contains($builder->id)) selected @endif>
                        {{ $builder->full_name }} {{ $builder->last_name }}
                      </option>
                      @endforeach
                    </optgroup>
                  </select>
                </div>
              </div>
            </div>
            @endif

            <div class="form-group row">
              <div class="col-xl-12">
                <label class="col-form-label col-lg-12 bolder">Project Details</label>
                <textarea name="details" id="kt-ckeditor-1">{{ $project->details }}</textarea>
              </div>
              @error('details')
              <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="row">
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Main Heading *</label>
                  <input type="text" class="form-control form-control-lg" name="main_heading" value="{{ $project->project_info->main_heading ?? '' }}">
                  @error('main_heading')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Sub Heading *</label>
                  <input type="text" class="form-control form-control-lg" name="sub_heading" value="{{ $project->project_info->sub_heading ?? '' }}">
                  @error('sub_heading')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Bullet 1 *</label>
                  <input type="text" class="form-control form-control-lg" name="bullet_1" value="{{ $project->project_info->bullet_1 ?? '' }}">
                  @error('bullet_1')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Bullet 2 *</label>
                  <input type="text" class="form-control form-control-lg" name="bullet_2" value="{{ $project->project_info->bullet_2 ?? '' }}">
                  @error('bullet_2')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Bullet 3 *</label>
                  <input type="text" class="form-control form-control-lg" name="bullet_3" value="{{ $project->project_info->bullet_3 ?? '' }}">
                  @error('bullet_3')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Bullet 4 *</label>
                  <input type="text" class="form-control form-control-lg" name="bullet_4" value="{{ $project->project_info->bullet_4 ?? '' }}">
                  @error('bullet_4')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Bullet 5</label>
                  <input type="text" class="form-control form-control-lg" name="bullet_5" value="{{ $project->project_info->bullet_5 ?? '' }}">
                </div>
              </div>
              <div class="col-xl-4">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12">Bullet 6</label>
                  <input type="text" class="form-control form-control-lg" name="bullet_6" value="{{ $project->project_info->bullet_6 ?? '' }}">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label>Status</label>
                  <select name="status" class="form-control form-control-lg" required>
                    <option disabled selected hidden value="">Status...</option>
                    <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>Live</option>
                    <option value="2" {{ $project->status == 2 ? 'selected' : '' }}>Pending</option>
                    <option value="3" {{ $project->status == 3 ? 'selected' : '' }}>Declined</option>
                  </select>
                  <span class="form-text text-muted">Please specify the status of the project.</span>
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label>Marketed By</label>
                  <input type="text" class="form-control form-control-lg" name="marketed_by" value="{{ $project->marketed_by }}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Customized Added Time</label>
                  <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                    <input type="text" name="added_time" class="form-control datetimepicker-input" placeholder="Select date &amp; time" data-target="#kt_datetimepicker_2" value="{{ $project->added_time ?? '' }}" style="height: 44px">
                    <div class="input-group-append" data-target="#kt_datetimepicker_2" data-toggle="datetimepicker">
                      <span class="input-group-text">
                        <i class="ki ki-calendar"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12 bolder">Meta Title *</label>
                  <textarea class="form-control" name="meta_title" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $project->meta_title }}</textarea>
                  @error('meta_title')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12 bolder">Meta Description *</label>
                  <textarea class="form-control" name="meta_description" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $project->meta_description }}</textarea>
                  @error('meta_description')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="form-group fv-plugins-icon-container">
                  <label class="col-form-label col-lg-12 bolder">Meta Keywords *</label>
                  <textarea class="form-control" name="meta_tags" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ $project->meta_tags }}</textarea>
                  @error('meta_tags')
                  <div class="fv-plugins-message-container text-danger">{{ $message }}</div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="form-group fv-plugins-icon-container">
              <label>Select Tags</label>
              <select class="form-control select2" id="kt_select2_333" name="tags[]" aria-placeholder="Select Owners" multiple="multiple">
                <optgroup label="Select Potential owners from the list">
                  @foreach ($tags as $key => $tag)
                  <option value="{{ $tag->id }}" @foreach ($project->tags as $projectTag) {{ $projectTag->id == $tag->id ? 'selected' : '' }} @endforeach>
                    {{ $tag->name }}
                  </option>
                  @endforeach
                </optgroup>
              </select>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-6 col-lg-6 text-left">
                <a href="/admin/project" class="btn btn-secondary">Cancel</a>
              </div>
              <div class="col-6 col-lg-6 text-right">
                <button type="submit" class="btn admin_ad_btn mr-2">Update</button>
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
<script src="assets/js/pages/crud/forms/widgets/select2.js"></script>
<!--end::Page Scripts-->
<!--begin::Page Vendors(used by this page)-->
<script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="assets/js/pages/crud/forms/editors/ckeditor-classic.js"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js"></script>
@endsection