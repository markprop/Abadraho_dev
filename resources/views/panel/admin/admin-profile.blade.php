@extends('panel.layouts.master1')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Admin Profile</h5>


                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>


                <!--end::Separator-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Subheader-->

    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <div class="">
            <h2 class="title-bar">Edit: System Admin</h2><br>
            </div>
        </div>
        @if(Session::has('success'))
			<div class="alert alert-success">
			    {{ Session::get('success') }}
			</div>
		@endif
    <form action="{{ url('my-admin-profile-update') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
       
            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-title"><strong>User Info</strong></div>
                        <div class="panel-body">
                            <div class="row">
        

                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" id="formGroupExampleInput1" value="{{Auth::user()->username}}" placeholder="abc" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" name="email" id="formGroupExampleEmail" readonly value="{{Auth::user()->email}}" placeholder="abc@gmail.com" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" class="form-control" name="first_name" id="formGroupExampleInput3" value="{{Auth::user()->first_name}}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="last_name" id="formGroupExampleInput4" value="{{Auth::user()->last_name}}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" id="formGroupExampleInput8" value="{{Auth::user()->phone_number}}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city" id="formGroupExampleInput10" value="{{Auth::user()->city}}" required="">
                                     </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="Address" class="form-control" id="formGroupExampleInput13" value="{{Auth::user()->Address}}" required="">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <div class="col-12">
                                <textarea class="form-control" required="" name="about_me" id="exampleFormControlTextarea1" value="{{Auth::user()->about_me}}" rows="7">{{Auth::user()->about_me}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- <div class="panel">
                        <div class="panel-title"><strong>Publish</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select required="" class="custom-select" name="status">
                                    <option value="">-- Select --</option>
                                    <option selected="" value="publish">Publish</option>
                                    <option value="blocked">Blocked</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select required="" class="custom-select" name="role_id">
                                    <option value="">-- Select --</option>
                                    <option value="1">Agent</option>
                                    <option value="2">Customer</option>
                                    <option value="3" selected="">Administrator</option>
                                    </select>
                                </div>
                            </div>
                    </div> -->
                    <!-- <div class="panel"> -->
                        <!-- <div class="panel-title"><strong>Agent</strong></div> -->
                            <!-- <div class="panel-body"> -->
                                <!-- <div class="form-group"> -->
                                    <!-- <label>Agent Commission Type</label> -->
                                <!-- <div class="form-controls">
                                     <select name="vendor_commission_type" class="form-control">
                                        <option value="">Default</option>
                                        <option value="percent">Percent</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                 </div> -->
                            <!-- </div> -->
                                <!-- <div class="form-group">
                                    <label>Agent commission value</label>
                                    <div class="form-controls">
                                        <input type="text" class="form-control" name="vendor_commission_amount" value="">
                                    </div>
                                </div> -->
                            <!-- </div> -->
                        <!-- </div> -->
                        <div class="panel">
                            <div class="panel-title"><strong>Avatar</strong></div>
                                 <div class="panel-body">
                                     <div class="form-group">
                                        <div class="dungdt-upload-box dungdt-upload-box-normal" data-val="1">
                                        <div class="upload-box" v-show="!value">
                                        <img src="{{ asset('uploads/profile/'.Auth::user()->image) }}" onerror="this.src='/assets/images/profile_image_insert.jpg'"  width="250" height="250"><br>
												<br><input type="file" name="image" class="form-control"><br>
                                    </div>
                                <div class="attach-demo" title="Change file">
                                    <img src="" class="image-responsive"> </div>
                                    <div class="upload-actions justify-content-between" v-show="value">
                                     <span></span>
                                        <!-- <a class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span></span>
                <button class="btn admin_ad_btn_red" type="submit">Save Change</button>
            </div>
         
        </div>

    </form> 
    </div>
    



@endsection