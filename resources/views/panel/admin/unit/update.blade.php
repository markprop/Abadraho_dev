@extends('panel.layouts.master1')

@section('content')
<!-- Main content container -->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- Subheader section -->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!-- Subheader details -->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit Unit</h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Enter Unit details and submit</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content entry -->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <!-- Card for form -->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header" style="padding: 1rem 1.25rem;">
                    <h2 class="card-title text-uppercase">Edit Unit of the Project</h2>
                </div>

                <!-- Form for updating unit details -->
                <form class="form mt-5" id="frmValidate" method="POST" action="/admin/unit/{{ $unit->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xl-12">
                        <!-- Hidden Project ID -->
                        <div class="form-group fv-plugins-icon-container d-none">
                            <label>Project ID {{ $unit->project_id }}</label>
                            <div class="col-sm-9">
                                <input type="number" min="0" step="any" class="form-control form-control-lg" name="project_id" value="{{ old('project_id', $unit->project_id) }}" required>
                                @error('project_id')
                                    <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <!-- Title input -->
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Title *</label>
                                    <input type="text" class="form-control form-control-lg" name="title" value="{{ old('title', $unit->title) }}" required>
                                    @error('title')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Rooms input -->
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Rooms</label>
                                    <input type="text" class="form-control form-control-lg" name="rooms" value="{{ old('rooms', $unit->rooms) }}">
                                    @error('rooms')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Covered Area input -->
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Covered Area</label>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <input type="number" min="0" step="any" class="form-control form-control-lg" name="covered_area" value="{{ old('covered_area', $unit->covered_area ? round($unit->covered_area / $measurements[$unit->measurement_type - 1]->convertor, 5) : '') }}">
                                            @error('covered_area')
                                                <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-5">
                                            <select name="measurement_type" class="form-control form-control-lg">
                                                <option disabled selected hidden value="">Select Measurement Type...</option>
                                                @foreach ($measurements as $measurement)
                                                    <option value="{{ $measurement->id }}" {{ old('measurement_type', $unit->measurement_type) == $measurement->id ? 'selected' : '' }}>
                                                        {{ $measurement->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('measurement_type')
                                                <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Unit Type selection -->
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Unit Type *</label>
                                    <select name="unit_type_id" class="form-control form-control-lg" required>
                                        <option disabled selected hidden value="">Select Unit Type...</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}" {{ old('unit_type_id', $unit->unit_type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_type_id')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Price input -->
                            <div class="col-xl-4">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Price *</label>
                                    <input type="number" min="0" step="any" class="form-control form-control-lg" name="price" value="{{ old('price', round($unit->price, 2)) }}" required>
                                    @error('price')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Loan Amount input -->
                            <div class="col-xl-4">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Loan Amount</label>
                                    <input type="number" min="0" step="any" class="form-control form-control-lg" name="loan_amount" value="{{ old('loan_amount', round($unit->loan_amount, 2)) }}">
                                    @error('loan_amount')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Down Payment input -->
                            <div class="col-xl-4">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Down Payment *</label>
                                    <input type="number" min="0" step="any" class="form-control form-control-lg" name="down_payment" value="{{ old('down_payment', round($unit->down_payment, 2)) }}" required>
                                    @error('down_payment')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Monthly Installment input -->
                            <div class="col-sm-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Monthly Installment *</label>
                                    <input type="number" min="0" step="any" class="form-control form-control-lg" name="monthly_installment" value="{{ old('monthly_installment', round($unit->monthly_installment, 2)) }}" required>
                                    @error('monthly_installment')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Installment Type and Length -->
                            <div class="col-xl-6">
                                <label>Installment Type *</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <select name="installment_type" class="form-control form-control-lg">
                                            <option disabled selected hidden value="">Select Installment Type...</option>
                                            @foreach ($installments as $installment)
                                                <option value="{{ $installment->id }}" {{ old('installment_type', $unit->installment_type) == $installment->id ? 'selected' : '' }}>
                                                    {{ $installment->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('installment_type')
                                            <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group fv-plugins-icon-container">
                                            <input type="number" min="0" step="any" class="form-control form-control-lg" name="installment" value="{{ old('installment', round($unit->installment, 2)) }}" placeholder="Installment Length in Months*" required>
                                            @error('installment')
                                                <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Image Upload Sections -->
                        <div class="row">
                            <!-- Payment Plan Section -->
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label class="text-dark font-weight-bold mb-3">Payment Plan</label>
                                    
                                    <!-- File Preview Card -->
                                    <div class="file-preview-card" id="payment_plan_preview" style="display: {{ $unit->payment_plan_img ? 'block' : 'none' }};">
                                        <div class="card position-relative" style="border-radius: 8px; width: 150px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                            <!-- Image Preview (for image files) -->
                                            <img id="payment_plan_preview_img" src="{{ $unit->payment_plan_img && in_array(strtolower(pathinfo($unit->payment_plan_img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']) ? asset('uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id . '/' . $unit->payment_plan_img) : '' }}" 
                                                 alt="Payment Plan" class="card-img-top" style="height: 100px; width: 150px; object-fit: cover; display: {{ $unit->payment_plan_img && in_array(strtolower(pathinfo($unit->payment_plan_img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']) ? 'block' : 'none' }};">
                                            
                                            <!-- PDF Preview (for PDF files) -->
                                            <div id="payment_plan_preview_pdf" class="d-flex flex-column align-items-center justify-content-center" 
                                                 style="height: 100px; width: 150px; background-color: #f8f9fa; display: {{ $unit->payment_plan_img && strtolower(pathinfo($unit->payment_plan_img, PATHINFO_EXTENSION)) == 'pdf' ? 'flex' : 'none' }};">
                                                <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                                <small class="text-muted text-center px-2">{{ $unit->payment_plan_img ? pathinfo($unit->payment_plan_img, PATHINFO_FILENAME) : '' }}</small>
                                                <a href="{{ $unit->payment_plan_img ? asset('uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id . '/' . $unit->payment_plan_img) : '#' }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                            
                                            <!-- Edit Icon -->
                                            <div class="position-absolute" style="top: 5px; right: 5px;">
                                                <button type="button" class="btn btn-sm btn-light rounded-circle" 
                                                        style="width: 30px; height: 25px; display: flex; align-items: center; justify-content: center;"
                                                        onclick="document.getElementById('payment_plan_img').click()">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                            </div>
                                            
                                            <!-- Remove Icon -->
                                            <div class="position-absolute" style="bottom: 5px; right: 5px;">
                                                <button type="button" class="btn btn-sm btn-light rounded-circle" 
                                                        style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;"
                                                        onclick="removePaymentPlanImage()">
                                                    <i class="fas fa-times text-danger"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">After image removal hidden input's value is set to "l"</small>
                                        </div>
                                    </div>
                                    
                                    <!-- File Input (Hidden) -->
                                    <input type="file" class="form-control form-control-lg d-none" name="payment_plan_img" id="payment_plan_img" 
                                           accept="image/*,.pdf" onchange="previewPaymentPlanImage(this)">
                                    
                                    <!-- Upload Button (shown when no file) -->
                                    <div id="payment_plan_upload_btn" style="display: {{ $unit->payment_plan_img ? 'none' : 'block' }};">
                                        <button type="button" class="btn btn-outline-primary btn-block" 
                                                style="height: 100px; border: 2px dashed #007bff;"
                                                onclick="document.getElementById('payment_plan_img').click()">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i><br>
                                            <span>Click to upload Payment Plan<br><small class="text-muted">(Images or PDF)</small></span>
                                        </button>
                                    </div>
                                    
                                    <!-- Hidden input for tracking removal -->
                                    <input type="hidden" name="payment_plan_removed" id="payment_plan_removed" value="0">
                                    
                                    @error('payment_plan_img')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Floor Plan Section -->
                            <div class="col-xl-6">
                                <div class="form-group fv-plugins-icon-container">
                                    <label class="text-dark font-weight-bold mb-3">Floor Plan</label>
                                    
                                    <!-- File Preview Card -->
                                    <div class="file-preview-card" id="floor_plan_preview" style="display: {{ $unit->floor_plan_img ? 'block' : 'none' }};">
                                        <div class="card position-relative" style="border-radius: 8px; width: 150px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                            <!-- Image Preview (for image files) -->
                                            <img id="floor_plan_preview_img" src="{{ $unit->floor_plan_img && in_array(strtolower(pathinfo($unit->floor_plan_img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']) ? asset('uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id . '/' . $unit->floor_plan_img) : '' }}" 
                                                 alt="Floor Plan" class="card-img-top" style="height: 100px; width: 150px; object-fit: cover; display: {{ $unit->floor_plan_img && in_array(strtolower(pathinfo($unit->floor_plan_img, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']) ? 'block' : 'none' }};">
                                            
                                            <!-- PDF Preview (for PDF files) -->
                                            <div id="floor_plan_preview_pdf" class="d-flex flex-column align-items-center justify-content-center" 
                                                 style="height: 100px; width: 150px; background-color: #f8f9fa; display: {{ $unit->floor_plan_img && strtolower(pathinfo($unit->floor_plan_img, PATHINFO_EXTENSION)) == 'pdf' ? 'flex' : 'none' }};">
                                                <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                                <small class="text-muted text-center px-2">{{ $unit->floor_plan_img ? pathinfo($unit->floor_plan_img, PATHINFO_FILENAME) : '' }}</small>
                                                <a href="{{ $unit->floor_plan_img ? asset('uploads/project_images/project_' . $unit->project_id . '/unit_' . $unit->id . '/' . $unit->floor_plan_img) : '#' }}" 
                                                   target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                            
                                            <!-- Edit Icon -->
                                            <div class="position-absolute" style="top: 5px; right: 5px;">
                                                <button type="button" class="btn btn-sm btn-light rounded-circle" 
                                                        style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"
                                                        onclick="document.getElementById('floor_plan_img').click()">
                                                    <i class="fas fa-edit text-primary"></i>
                                                </button>
                                            </div>
                                            
                                            <!-- Remove Icon -->
                                            <div class="position-absolute" style="bottom: 5px; right: 5px;">
                                                <button type="button" class="btn btn-sm btn-light rounded-circle" 
                                                        style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;"
                                                        onclick="removeFloorPlanImage()">
                                                    <i class="fas fa-times text-danger"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-muted">After image removal hidden input's value is set to "l"</small>
                                        </div>
                                    </div>
                                    
                                    <!-- File Input (Hidden) -->
                                    <input type="file" class="form-control form-control-lg d-none" name="floor_plan_img" id="floor_plan_img" 
                                           accept="image/*,.pdf" onchange="previewFloorPlanImage(this)">
                                    
                                    <!-- Upload Button (shown when no file) -->
                                    <div id="floor_plan_upload_btn" style="display: {{ $unit->floor_plan_img ? 'none' : 'block' }};">
                                        <button type="button" class="btn btn-outline-primary btn-block" 
                                                style="height: 100px; border: 2px dashed #007bff;"
                                                onclick="document.getElementById('floor_plan_img').click()">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-2"></i><br>
                                            <span>Click to upload Floor Plan<br><small class="text-muted">(Images or PDF)</small></span>
                                        </button>
                                    </div>
                                    
                                    <!-- Hidden input for tracking removal -->
                                    <input type="hidden" name="floor_plan_removed" id="floor_plan_removed" value="0">
                                    
                                    @error('floor_plan_img')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Unit Description textarea -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group fv-plugins-icon-container">
                                    <label>Unit Description</label>
                                    <textarea class="form-control" name="description" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">{{ old('description', $unit->description) }}</textarea>
                                    @error('description')
                                        <span class="fv-plugins-message-container text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form footer with buttons -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 col-lg-6 text-left">
                                <a href="{{ Request::get('cancel') }}" type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                            <div class="col-6 col-lg-6 text-right">
                                <button onclick="FormSubmit()" type="button" class="btn admin_ad_btn mr-2">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('header')
<!-- Page-specific CSS -->
<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
@endsection

@section('footer')
<!-- Page-specific JavaScript -->
<script>
    function FormSubmit() {
        if (SubmitForm("frmValidate")) {
            ShowLoader();
            $("#frmValidate").submit();
        }
    }

    // Payment Plan File Functions
    function previewPaymentPlanImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const isImage = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension);
            const isPdf = fileExtension === 'pdf';
            
            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('payment_plan_preview_img').src = e.target.result;
                    document.getElementById('payment_plan_preview_img').style.display = 'block';
                    document.getElementById('payment_plan_preview_pdf').style.display = 'none';
                    document.getElementById('payment_plan_preview').style.display = 'block';
                    document.getElementById('payment_plan_upload_btn').style.display = 'none';
                    document.getElementById('payment_plan_removed').value = '0';
                }
                reader.readAsDataURL(file);
            } else if (isPdf) {
                document.getElementById('payment_plan_preview_img').style.display = 'none';
                document.getElementById('payment_plan_preview_pdf').style.display = 'flex';
                document.getElementById('payment_plan_preview').style.display = 'block';
                document.getElementById('payment_plan_upload_btn').style.display = 'none';
                document.getElementById('payment_plan_removed').value = '0';
                
                // Update PDF preview content
                const pdfPreview = document.getElementById('payment_plan_preview_pdf');
                const fileName = file.name.replace(/\.[^/.]+$/, ""); // Remove extension
                pdfPreview.querySelector('small').textContent = fileName;
                pdfPreview.querySelector('a').href = URL.createObjectURL(file);
            }
        }
    }

    function removePaymentPlanImage() {
        document.getElementById('payment_plan_preview').style.display = 'none';
        document.getElementById('payment_plan_upload_btn').style.display = 'block';
        document.getElementById('payment_plan_img').value = '';
        document.getElementById('payment_plan_removed').value = '1';
    }

    // Floor Plan File Functions
    function previewFloorPlanImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const isImage = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(fileExtension);
            const isPdf = fileExtension === 'pdf';
            
            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('floor_plan_preview_img').src = e.target.result;
                    document.getElementById('floor_plan_preview_img').style.display = 'block';
                    document.getElementById('floor_plan_preview_pdf').style.display = 'none';
                    document.getElementById('floor_plan_preview').style.display = 'block';
                    document.getElementById('floor_plan_upload_btn').style.display = 'none';
                    document.getElementById('floor_plan_removed').value = '0';
                }
                reader.readAsDataURL(file);
            } else if (isPdf) {
                document.getElementById('floor_plan_preview_img').style.display = 'none';
                document.getElementById('floor_plan_preview_pdf').style.display = 'flex';
                document.getElementById('floor_plan_preview').style.display = 'block';
                document.getElementById('floor_plan_upload_btn').style.display = 'none';
                document.getElementById('floor_plan_removed').value = '0';
                
                // Update PDF preview content
                const pdfPreview = document.getElementById('floor_plan_preview_pdf');
                const fileName = file.name.replace(/\.[^/.]+$/, ""); // Remove extension
                pdfPreview.querySelector('small').textContent = fileName;
                pdfPreview.querySelector('a').href = URL.createObjectURL(file);
            }
        }
    }

    function removeFloorPlanImage() {
        document.getElementById('floor_plan_preview').style.display = 'none';
        document.getElementById('floor_plan_upload_btn').style.display = 'block';
        document.getElementById('floor_plan_img').value = '';
        document.getElementById('floor_plan_removed').value = '1';
    }
</script>
@endsection