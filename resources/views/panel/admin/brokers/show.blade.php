@extends('panel.layouts.master1')

@section('content')
<!-- Main content container -->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- Subheader section -->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Broker Details</h5>
            </div>
        </div>
    </div>

    <!-- Main content body -->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <!-- Broker details card -->
            <div class="card card-custom gutter-b example example-compact">
                <!-- Card header -->
                <div class="card-header" style="padding: 1rem 1.25rem;">
                    <h2 class="card-title text-uppercase">Broker Details</h2>
                </div>

                <!-- Broker details table -->
                <table class="table table-bordered">
                    <tbody>
                        <!-- Contact Person Name -->
                        <tr>
                            <th>Contact Person Name</th>
                            <td>{{ $broker->contact_person_name ?? 'N/A' }}</td>
                        </tr>
                        <!-- Contact Number -->
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $broker->contact_number ?? 'N/A' }}</td>
                        </tr>
                        <!-- Contact Email -->
                        <tr>
                            <th>Contact Email</th>
                            <td>{{ $broker->contact_email ?? 'N/A' }}</td>
                        </tr>
                        <!-- Login Password with toggle visibility -->
                        <tr>
                            <th>Login Password</th>
                            <td>
                                @if ($broker->password)
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordField" value="{{ $broker->password }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="text-muted">*Displayed value is hashed for security</small>
                                @else
                                    <span class="text-muted">Not available</span>
                                @endif
                            </td>
                        </tr>
                        <!-- Company Name -->
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $broker->company_name ?? 'N/A' }}</td>
                        </tr>
                        <!-- Company Address -->
                        <tr>
                            <th>Company Address</th>
                            <td>{{ $broker->company_address ?? 'N/A' }}</td>
                        </tr>
                        <!-- Broker Since (Years) -->
                        <tr>
                            <th>Broker Since (years)</th>
                            <td>{{ $broker->broker_since_years ?? 'N/A' }}</td>
                        </tr>
                        <!-- Deals In -->
                        <tr>
                            <th>Deals In</th>
                            <td>
                                @php
                                    // Ensure deals_in is an array before imploding
                                    $deals = is_array($broker->deals_in) ? $broker->deals_in : [];
                                @endphp
                                {{ implode(', ', $deals) ?: 'N/A' }}
                            </td>
                        </tr>
                        <!-- Expertise Areas -->
                        <tr>
                            <th>Expertise Areas</th>
                            <td>
                                {{ $broker->areas->pluck('name')->implode(', ') ?: 'N/A' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for toggling password visibility -->
<script>
    /**
     * Toggles the visibility of the password field
     * Switches between password and text input types
     * Updates the eye icon accordingly
     */
    function togglePassword() {
        const passwordField = document.getElementById('passwordField');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        }
    }
</script>

<!-- Custom styles for password input group -->
<style>
    /* Limit the width of the password input group */
    .input-group {
        max-width: 300px;
    }

    /* Style for the eye icon container */
    .input-group-text {
        background-color: #f5f5f5;
    }
</style>
@endsection