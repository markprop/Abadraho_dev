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
        <form class="form mt-5" method="POST" action="{{ route('admin_panel.project.update', $project->slug) }}" enctype="multipart/form-data">
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
                      <label class="text-dark font-weight-bold mb-4" style="font-size: 16px; color: #2c3e50;">
                          <i class="fas fa-file-pdf text-danger mr-2"></i>Project Documents
                          <small class="text-muted d-block mt-1" style="font-size: 12px; font-weight: normal;">Upload multiple PDF files for project documentation</small>
                      </label>
                      
                      <!-- Existing Documents Preview -->
                      @if ($project->project_doc)
                          <div class="existing-docs-preview mb-4">
                              <div class="d-flex align-items-center mb-3">
                                  <h6 class="mb-0 text-dark font-weight-bold" style="font-size: 14px;">
                                      <i class="fas fa-folder-open text-primary mr-2"></i>Current Documents
                                  </h6>
                                  <span class="badge badge-light-primary ml-2" id="existing_docs_count">{{ count(explode('|', $project->project_doc)) }}</span>
                              </div>
                              <div class="file-preview-container" style="max-height: 220px; overflow-y: auto; background: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 12px; padding: 15px;">
                                  <div class="d-flex flex-wrap">
                              @php $docs_exploded = explode('|', $project->project_doc); @endphp
                                      @foreach ($docs_exploded as $index => $doc)
                                          <div class="file-card position-relative mr-3 mb-3" style="width: 160px; transition: all 0.3s ease;">
                                              <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; background: white;">
                                                  <!-- PDF Preview -->
                                                  <div class="d-flex flex-column align-items-center justify-content-center p-3" 
                                                       style="height: 120px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px 12px 0 0;">
                                                      <i class="fas fa-file-pdf fa-3x text-danger mb-2" style="filter: drop-shadow(0 2px 4px rgba(220,53,69,0.2));"></i>
                                                      <small class="text-dark text-center font-weight-medium" style="font-size: 11px; line-height: 1.3; word-break: break-word;">
                                                          {{ strlen(basename($doc)) > 20 ? substr(basename($doc), 0, 20) . '...' : basename($doc) }}
                                                      </small>
                                                  </div>
                                                  
                                                  <!-- Action Buttons -->
                                                  <div class="card-body p-2">
                                                      <div class="d-flex justify-content-between align-items-center">
                                                          <a href="{{ asset($doc) }}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size: 11px; padding: 4px 8px;">
                                                              <i class="fas fa-download mr-1"></i>View
                                                          </a>
                                                          <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                  style="width: 28px; height: 28px; padding: 0; border-radius: 50%;"
                                                                  onclick="removeExistingDoc({{ $index }})" title="Remove document">
                                                              <i class="fas fa-times" style="font-size: 10px;"></i>
                                                          </button>
                                                      </div>
                                                  </div>
                                                  
                                                  <!-- Hidden input for existing doc -->
                                                  <input type="hidden" name="existing_project_docs[]" value="{{ $doc }}" id="existing_doc_{{ $index }}">
                                              </div>
                                          </div>
                              @endforeach
                                  </div>
                              </div>
                          </div>
                      @endif
                      
                      <!-- New Documents Upload Area -->
                      <div class="new-docs-upload">
                          <div class="d-flex align-items-center mb-3">
                              <h6 class="mb-0 text-dark font-weight-bold" style="font-size: 14px;">
                                  <i class="fas fa-plus-circle text-success mr-2"></i>Add New Documents
                              </h6>
                          </div>
                          
                          <div class="d-flex flex-wrap" id="new_docs_preview" style="max-height: 220px; overflow-y: auto; background: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 12px; padding: 15px; display: none;">
                              <!-- New documents will be previewed here -->
                          </div>
                          
                          <!-- Upload Button -->
                          <div id="docs_upload_btn">
                              <div class="upload-area" onclick="document.getElementById('project_docs').click()" 
                                   style="height: 120px; border: 2px dashed #cbd3da; border-radius: 12px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); cursor: pointer; transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                  <div class="upload-content">
                                      <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2" style="opacity: 0.7;"></i>
                                      <div class="text-center">
                                          <div class="text-dark font-weight-bold mb-1" style="font-size: 14px;">Upload PDF Documents</div>
                                          <small class="text-muted" style="font-size: 12px;">Click to browse or drag & drop files</small>
                                      </div>
                                  </div>
                                  <div class="upload-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,123,255,0.1) 0%, rgba(0,123,255,0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                              </div>
                          </div>
                          
                          <!-- Hidden file input -->
                          <input type="file" class="form-control form-control-lg d-none" name="project_docs[]" id="project_docs" accept=".pdf" multiple onchange="previewNewDocs(this)">
                      </div>
                      
                      @error('project_docs')
                      <div class="alert alert-danger mt-2" style="font-size: 12px; padding: 8px 12px; border-radius: 8px;">
                          <i class="fas fa-exclamation-triangle mr-1"></i>{{ $errors->first('project_docs') }}
                      </div>
                      @enderror
                      <div class="fv-plugins-message-container"></div>
                  </div>
                </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label class="text-dark font-weight-bold mb-3" style="font-size: 16px; color: #2c3e50;">
                      <i class="fab fa-youtube text-danger mr-2"></i>YouTube Video Link
                      <small class="text-muted d-block mt-1" style="font-size: 12px; font-weight: normal;">Add a promotional video for your project</small>
                  </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text" style="background: #f8f9fa; border-color: #e3e6f0;">
                              <i class="fab fa-youtube text-danger"></i>
                          </span>
                      </div>
                      <input type="url" class="form-control form-control-lg" name="project_video" id="project_video" 
                             placeholder="https://www.youtube.com/watch?v=example" 
                             value="{{ old('project_video', $project->project_video) }}"
                             style="border-color: #e3e6f0; border-left: none;">
                  </div>
                  <small class="form-text text-muted mt-2" style="font-size: 12px;">
                      <i class="fas fa-info-circle mr-1"></i>Paste the complete YouTube URL to embed the video
                  </small>
                  @error('project_video')
                  <div class="alert alert-danger mt-2" style="font-size: 12px; padding: 8px 12px; border-radius: 8px;">
                      <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label class="text-dark font-weight-bold mb-4" style="font-size: 16px; color: #2c3e50;">
                      <i class="fas fa-image text-primary mr-2"></i>Project Cover Image
                      <small class="text-muted d-block mt-1" style="font-size: 12px; font-weight: normal;">Main image displayed for your project</small>
                  </label>
                  
                  <!-- Cover Image Preview Card -->
                  <div class="file-preview-card" id="cover_img_preview" style="display: {{ $project->project_cover_img ? 'block' : 'none' }};">
                      <div class="card position-relative" style="border-radius: 16px; width: 240px; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.12); transition: all 0.3s ease; background: white;">
                          <!-- Image Preview -->
                          <div style="position: relative; overflow: hidden; border-radius: 16px 16px 0 0;">
                              <img id="cover_img_preview_img" src="{{ $project->project_cover_img ? asset($project->project_cover_img) : '' }}" 
                                   alt="Cover Image" class="card-img-top" style="height: 160px; width: 240px; object-fit: cover; transition: transform 0.3s ease;">
                              
                              <!-- Overlay for actions -->
                              <div class="position-absolute" style="top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;">
                                  <div class="d-flex">
                                      <button type="button" class="btn btn-light rounded-circle mr-2" 
                                              style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"
                                              onclick="document.getElementById('project_cover_img').click()" title="Change image">
                                          <i class="fas fa-edit text-primary"></i>
                                      </button>
                                      <button type="button" class="btn btn-light rounded-circle" 
                                              style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"
                                              onclick="removeCoverImage()" title="Remove image">
                                          <i class="fas fa-trash text-danger"></i>
                                      </button>
                                  </div>
                              </div>
                          </div>
                          
                          <!-- Card Footer -->
                          <div class="card-body p-3" style="background: #f8f9fa;">
                              <div class="d-flex align-items-center justify-content-between">
                                  <div>
                                      <h6 class="mb-0 text-dark font-weight-bold" style="font-size: 13px;">Cover Image</h6>
                                      <small class="text-muted" style="font-size: 11px;">Main project image</small>
                                  </div>
                                  <div class="d-flex">
                                      <button type="button" class="btn btn-sm btn-outline-primary mr-1" 
                                              style="font-size: 11px; padding: 4px 8px;"
                                              onclick="document.getElementById('project_cover_img').click()">
                                          <i class="fas fa-edit mr-1"></i>Edit
                                      </button>
                                      <button type="button" class="btn btn-sm btn-outline-danger" 
                                              style="font-size: 11px; padding: 4px 8px;"
                                              onclick="removeCoverImage()">
                                          <i class="fas fa-trash mr-1"></i>Remove
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
                  <!-- File Input (Hidden) -->
                  <input type="file" class="form-control form-control-lg d-none" name="project_cover_img" id="project_cover_img" 
                         accept="image/*" onchange="previewCoverImage(this)">
                  
                  <!-- Upload Button (shown when no file) -->
                  <div id="cover_img_upload_btn" style="display: {{ $project->project_cover_img ? 'none' : 'block' }};">
                      <div class="upload-area" onclick="document.getElementById('project_cover_img').click()" 
                           style="height: 160px; width: 240px; border: 2px dashed #cbd3da; border-radius: 16px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); cursor: pointer; transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                          <div class="upload-content">
                              <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3" style="opacity: 0.6;"></i>
                              <div class="text-center">
                                  <div class="text-dark font-weight-bold mb-1" style="font-size: 14px;">Upload Cover Image</div>
                                  <small class="text-muted" style="font-size: 12px;">Click to browse or drag & drop</small>
                              </div>
                          </div>
                          <div class="upload-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,123,255,0.1) 0%, rgba(0,123,255,0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                      </div>
                  </div>
                  
                  <!-- Hidden input for tracking removal -->
                  <input type="hidden" name="cover_img_removed" id="cover_img_removed" value="0">
                  
                  @error('project_cover_img')
                  <div class="alert alert-danger mt-2" style="font-size: 12px; padding: 8px 12px; border-radius: 8px;">
                      <i class="fas fa-exclamation-triangle mr-1"></i>{{ $errors->first('project_cover_img') }}
                  </div>
                  @enderror
                  <div class="fv-plugins-message-container"></div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="form-group fv-plugins-icon-container">
                  <label class="text-dark font-weight-bold mb-4" style="font-size: 16px; color: #2c3e50;">
                      <i class="fas fa-images text-success mr-2"></i>Project Images
                      <small class="text-muted d-block mt-1" style="font-size: 12px; font-weight: normal;">Upload multiple images showcasing your project</small>
                  </label>
                  
                  <!-- Existing Images Preview -->
                  @if ($project->project_imgs)
                      <div class="existing-images-preview mb-4">
                          <div class="d-flex align-items-center mb-3">
                              <h6 class="mb-0 text-dark font-weight-bold" style="font-size: 14px;">
                                  <i class="fas fa-folder-open text-success mr-2"></i>Current Images
                              </h6>
                              <span class="badge badge-light-success ml-2" id="existing_imgs_count">{{ count(explode('|', $project->project_imgs)) }}</span>
                          </div>
                          <div class="file-preview-container" style="max-height: 220px; overflow-y: auto; background: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 12px; padding: 15px;">
                              <div class="d-flex flex-wrap">
                                  @php $imgs_exploded = explode('|', $project->project_imgs); @endphp
                                  @foreach ($imgs_exploded as $index => $img)
                                      <div class="file-card position-relative mr-3 mb-3" style="width: 160px; transition: all 0.3s ease;">
                                          <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; background: white; overflow: hidden;">
                                              <!-- Image Preview -->
                                              <div style="position: relative; overflow: hidden; height: 120px;">
                                                  <img src="{{ asset($img) }}" alt="Project Image" class="card-img-top" style="height: 120px; width: 160px; object-fit: cover; transition: transform 0.3s ease;">
                                                  
                                                  <!-- Overlay for actions -->
                                                  <div class="position-absolute" style="top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;">
                                                      <button type="button" class="btn btn-light rounded-circle" 
                                                              style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"
                                                              onclick="removeExistingImage({{ $index }})" title="Remove image">
                                                          <i class="fas fa-trash text-danger"></i>
                                                      </button>
                                                  </div>
                                              </div>
                                              
                                              <!-- Card Footer -->
                                              <div class="card-body p-2" style="background: #f8f9fa;">
                                                  <div class="d-flex justify-content-between align-items-center">
                                                      <small class="text-muted" style="font-size: 10px;">Image {{ $index + 1 }}</small>
                                                      <button type="button" class="btn btn-sm btn-outline-danger" 
                                                              style="font-size: 10px; padding: 2px 6px;"
                                                              onclick="removeExistingImage({{ $index }})">
                                                          <i class="fas fa-trash mr-1"></i>Remove
                                                      </button>
                                                  </div>
                                              </div>
                                              
                                              <!-- Hidden input for existing image -->
                                              <input type="hidden" name="existing_project_imgs[]" value="{{ $img }}" id="existing_img_{{ $index }}">
                                          </div>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  @endif
                  
                  <!-- New Images Upload Area -->
                  <div class="new-images-upload">
                      <div class="d-flex align-items-center mb-3">
                          <h6 class="mb-0 text-dark font-weight-bold" style="font-size: 14px;">
                              <i class="fas fa-plus-circle text-success mr-2"></i>Add New Images
                          </h6>
                      </div>
                      
                      <div class="d-flex flex-wrap" id="new_imgs_preview" style="max-height: 220px; overflow-y: auto; background: #f8f9fa; border: 1px solid #e3e6f0; border-radius: 12px; padding: 15px; display: none;">
                          <!-- New images will be previewed here -->
                      </div>
                      
                      <!-- Upload Button -->
                      <div id="imgs_upload_btn">
                          <div class="upload-area" onclick="document.getElementById('project_imgs').click()" 
                               style="height: 120px; border: 2px dashed #cbd3da; border-radius: 12px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); cursor: pointer; transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                              <div class="upload-content">
                                  <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2" style="opacity: 0.7;"></i>
                                  <div class="text-center">
                                      <div class="text-dark font-weight-bold mb-1" style="font-size: 14px;">Upload Project Images</div>
                                      <small class="text-muted" style="font-size: 12px;">Click to browse or drag & drop files</small>
                                  </div>
                              </div>
                              <div class="upload-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,123,255,0.1) 0%, rgba(0,123,255,0.05) 100%); opacity: 0; transition: opacity 0.3s ease;"></div>
                          </div>
                      </div>
                      
                      <!-- Hidden file input -->
                      <input type="file" class="form-control form-control-lg d-none" name="project_imgs[]" id="project_imgs" multiple onchange="previewNewImages(this)">
                  </div>
                  
                  @error('project_imgs')
                  <div class="alert alert-danger mt-2" style="font-size: 12px; padding: 8px 12px; border-radius: 8px;">
                      <i class="fas fa-exclamation-triangle mr-1"></i>{{ $errors->first('project_imgs') }}
                  </div>
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

<!-- Custom CSS for enhanced file preview -->
<style>
    .file-card:hover {
        transform: translateY(-2px);
    }
    
    .file-card .card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .file-card:hover .position-absolute {
        opacity: 1 !important;
    }
    
    .upload-area:hover {
        border-color: #007bff !important;
        background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%) !important;
    }
    
    .upload-area:hover .upload-overlay {
        opacity: 1 !important;
    }
    
    .file-preview-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .file-preview-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    .file-preview-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    .file-preview-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    .badge {
        font-size: 10px;
        padding: 4px 8px;
        border-radius: 12px;
    }
    
    .btn-sm {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 6px;
    }
    
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    
    .input-group-text {
        border-color: #e3e6f0;
        background-color: #f8f9fa;
    }
</style>
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

<!-- Custom JavaScript for file preview functionality -->
<script>
    // Cover Image Functions
    function previewCoverImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const isImage = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension);
            
            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('cover_img_preview_img').src = e.target.result;
                    document.getElementById('cover_img_preview').style.display = 'block';
                    document.getElementById('cover_img_upload_btn').style.display = 'none';
                    document.getElementById('cover_img_removed').value = '0';
                }
                reader.readAsDataURL(file);
            }
        }
    }

    function removeCoverImage() {
        document.getElementById('cover_img_preview').style.display = 'none';
        document.getElementById('cover_img_upload_btn').style.display = 'block';
        document.getElementById('project_cover_img').value = '';
        document.getElementById('cover_img_removed').value = '1';
    }

    // New Documents Functions
    function previewNewDocs(input) {
        if (input.files && input.files.length > 0) {
            const previewContainer = document.getElementById('new_docs_preview');
            const uploadBtn = document.getElementById('docs_upload_btn');
            
            previewContainer.innerHTML = '';
            previewContainer.style.display = 'block';
            uploadBtn.style.display = 'none';
            
            Array.from(input.files).forEach((file, index) => {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (fileExtension === 'pdf') {
                    const cardDiv = document.createElement('div');
                    cardDiv.className = 'file-card position-relative mr-3 mb-3';
                    cardDiv.style.cssText = 'width: 160px; transition: all 0.3s ease;';
                    
                    cardDiv.innerHTML = `
                        <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; background: white;">
                            <div class="d-flex flex-column align-items-center justify-content-center p-3" style="height: 120px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 12px 12px 0 0;">
                                <i class="fas fa-file-pdf fa-3x text-danger mb-2" style="filter: drop-shadow(0 2px 4px rgba(220,53,69,0.2));"></i>
                                <small class="text-dark text-center font-weight-medium" style="font-size: 11px; line-height: 1.3; word-break: break-word;">
                                    ${file.name.length > 20 ? file.name.substring(0, 20) + '...' : file.name}
                                </small>
                            </div>
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="#" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size: 11px; padding: 4px 8px;">
                                        <i class="fas fa-download mr-1"></i>View
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            style="width: 28px; height: 28px; padding: 0; border-radius: 50%;"
                                            onclick="removeNewDoc(${index})" title="Remove document">
                                        <i class="fas fa-times" style="font-size: 10px;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    previewContainer.appendChild(cardDiv);
                }
            });
        }
    }

    function removeNewDoc(index) {
        const previewContainer = document.getElementById('new_docs_preview');
        const cards = previewContainer.children;
        if (cards.length === 1) {
            previewContainer.style.display = 'none';
            document.getElementById('docs_upload_btn').style.display = 'block';
            document.getElementById('project_docs').value = '';
        } else {
            cards[index].remove();
        }
    }

    // New Images Functions
    function previewNewImages(input) {
        if (input.files && input.files.length > 0) {
            const previewContainer = document.getElementById('new_imgs_preview');
            const uploadBtn = document.getElementById('imgs_upload_btn');
            
            previewContainer.innerHTML = '';
            previewContainer.style.display = 'block';
            uploadBtn.style.display = 'none';
            
            Array.from(input.files).forEach((file, index) => {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                const isImage = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension);
                
                if (isImage) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const cardDiv = document.createElement('div');
                        cardDiv.className = 'file-card position-relative mr-3 mb-3';
                        cardDiv.style.cssText = 'width: 160px; transition: all 0.3s ease;';
                        
                        cardDiv.innerHTML = `
                            <div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); transition: all 0.3s ease; background: white; overflow: hidden;">
                                <div style="position: relative; overflow: hidden; height: 120px;">
                                    <img src="${e.target.result}" alt="Project Image" class="card-img-top" style="height: 120px; width: 160px; object-fit: cover; transition: transform 0.3s ease;">
                                    
                                    <div class="position-absolute" style="top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;">
                                        <button type="button" class="btn btn-light rounded-circle" 
                                                style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"
                                                onclick="removeNewImage(${index})" title="Remove image">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="card-body p-2" style="background: #f8f9fa;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted" style="font-size: 10px;">New Image ${index + 1}</small>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                style="font-size: 10px; padding: 2px 6px;"
                                                onclick="removeNewImage(${index})">
                                            <i class="fas fa-trash mr-1"></i>Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        previewContainer.appendChild(cardDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    }

    function removeNewImage(index) {
        const previewContainer = document.getElementById('new_imgs_preview');
        const cards = previewContainer.children;
        if (cards.length === 1) {
            previewContainer.style.display = 'none';
            document.getElementById('imgs_upload_btn').style.display = 'block';
            document.getElementById('project_imgs').value = '';
        } else {
            cards[index].remove();
        }
    }

    // Existing Documents Functions
    function removeExistingDoc(index) {
        const docElement = document.getElementById('existing_doc_' + index);
        if (docElement) {
            docElement.value = ''; // Mark for removal
            docElement.closest('.card').style.display = 'none';
        }
    }

    // Existing Images Functions
    function removeExistingImage(index) {
        const imgElement = document.getElementById('existing_img_' + index);
        if (imgElement) {
            imgElement.value = ''; // Mark for removal
            imgElement.closest('.card').style.display = 'none';
        }
    }
</script>
@endsection