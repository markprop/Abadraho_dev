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
						<h5 class="text-dark font-weight-bold my-1 mr-5">Projects</h5>
						<!--end::Page Title-->
						<!--begin::Breadcrumb-->
						<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
							<li class="breadcrumb-item text-muted">
								<a href="" class="text-muted">Show</a>
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
				<!-- begin::Card-->
				<div class="card card-custom overflow-hidden">
					<div class="card-body p-0">
						<!-- begin: Invoice-->
						<!-- begin: Invoice header-->
						<div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0"
							style="background-image: url({{ asset('assets/media/bg/bg-6.jpg') }});">
							<div class="col-md-9">
								<div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
									<h1 class="display-4 text-white font-weight-boldest mb-10">{{ $project->name }}</h1>
									<div class="d-flex flex-column align-items-md-end px-0">
										<!--begin::Logo-->
										<a href="#" class="mb-5">
											{{-- <img src="{{ asset('assets/media/logos/logo-light.png') }}" alt=""> --}}
										</a>
										<!--end::Logo-->
										<span class="text-white d-flex flex-column align-items-md-end opacity-70">
											<span>{{ $project->address }}</span>
											{{-- <span>Mississippi 96522</span> --}}
										</span>
									</div>
								</div>
								<div class="border-bottom w-100 opacity-20"></div>
								<div class="d-flex justify-content-between text-white pt-6">
									<div class="d-flex flex-column flex-root">
										<span class="font-weight-bolder mb-2">AREA</span>
										<span class="opacity-70">{{ $project->location->name }}</span>
									</div>
									<div class="d-flex flex-column flex-root">
										<span class="font-weight-bolder mb-2">PROJECT TYPE</span>
										<span class="opacity-70">{{ $project->type->title }}</span>
									</div>
									<div class="d-flex flex-column flex-root">
										<span class="font-weight-bolder mb-2">PROGRESS</span>
										<span class="opacity-70">{{ $project->progress }}</span>
									</div>
									<div class="d-flex flex-column flex-root">
										<span class="font-weight-bolder mb-2">Document</span>
										{{-- <span class="opacity-70">{{ $project->progress }}</span> --}}
										@if ($project->project_doc)
										<span class="opacity-70"><a class="c-yellow" href="/uploads/project_documents/project_{{ $project->id }}/{{ $project->project_doc }}" target="_blank">{{ $project->slug }}.pdf</a></span>
										@else
										<span class="opacity-70">No Document Found</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<!-- end: Invoice header-->
						@if ($project->units->count())
							<div class="card card-custom">
								<div class="card-header card-header-tabs-line">
									<div class="card-toolbar">
										<ul class="nav nav-tabs nav-bold nav-tabs-line">
											@foreach ($project->units as $unit)
												<li class="nav-item">
													<a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
														data-toggle="tab" href="#kt_tab_pane_{{ $loop->index }}">
														<span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
														<span class="nav-text">{{ $unit->title ? $unit->title : 'TYPE '.$letter[$loop->index] }}</span>
													</a>
												</li>
											@endforeach
											<li class="nav-item">
												<a type="button" href="/admin/unit/create?id={{ $project->id }}" class="nav-link ml-md-10 mb-10 font-weight-bold" style="color:blueviolet">+ Add Unit</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="card-body">
									<div class="tab-content">
										@foreach ($project->units as $unit)
											<div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
												id="kt_tab_pane_{{ $loop->index }}" role="tabpanel"
												aria-labelledby="kt_tab_pane_{{ $loop->index }}">
												<div class="row pb-10">
														<!--begin::Info-->
														<div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Rooms</span>
																{{-- <span class="text-muted font-weight-bolder font-size-lg">
																@if ($unit->room->count())
																{{ $a=0,$b=0,$c=0,$d=0,$e=0,$f=0 }}
																	@foreach ($unit->room as $room)
																		@switch($room->id)
																			@case(1)
																				@php $a++ @endphp
																				@break
																			@case(2)
																				@php $b++ @endphp
																				@break
																			@case(3)
																				@php $c++ @endphp
																				@break
																			@case(4)
																				@php $d++ @endphp
																				@break
																			@case(5)
																				@php $e++ @endphp
																				@break
																			@case(6)
																				@php $f++ @endphp
																				@break
																			@default

																		@endswitch
																	@endforeach

																@else
																	{{ $unit->rooms }}
																@endif
																</span> --}}
																<span class="text-muted font-weight-bolder font-size-lg">{{ $unit->rooms }}</span>
															</div>
														</div>
														<div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Area</span>
																<span class="text-muted font-weight-bolder font-size-lg">
																	@if ($unit->covered_area)
																	{{ number_format($unit->covered_area, 0,'.',',') }} SQFT
																	@else
																	-
																	@endif
																</span>
															</div>
														</div>
														<div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Price</span>
																<span class="text-muted font-weight-bolder font-size-lg">Rs. {{ number_format($unit->price,0, '.', ',') }}</span>
															</div>
														</div>
														<div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Down Payment</span>
																<span class="text-muted font-weight-bolder font-size-lg">Rs. {{ number_format($unit->down_payment,0,'.',',') }}</span>
															</div>
														</div>
														<div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Monthly Installment</span>
																<span class="text-muted font-weight-bolder font-size-lg">Rs. {{ number_format($unit->monthly_installment,0,'.',',') }}</span>
															</div>
														</div>
														{{-- <div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Installment Length</span>
																<span class="text-muted font-weight-bolder font-size-lg">{{ $unit->installment_length }}</span>
															</div>
														</div> --}}


														{{-- <div class="col-6 col-md-4">
															<div class="mb-8 d-flex flex-column">
																<span class="text-dark font-weight-bold mb-4">Possession</span>
																<span class="text-muted font-weight-bolder font-size-lg">{{ $unit->possession }}</span>
															</div>
														</div> --}}
														<!--end::Info-->

													<div class="col-md-12 mt-5">
														<h4>Unit Details</h4>
														<hr>
														@if ($unit->room->count())
														<div class="table-responsive">
															<table class="table">
																<thead>
																	<tr>
																		<th class="pl-0 font-weight-bold text-muted text-uppercase">No</th>
																		<th class="text-left font-weight-bold text-muted text-uppercase">Name</th>
																		<th class="text-left font-weight-bold text-muted text-uppercase">Dimensions</th>
																		<th class="text-left font-weight-bold text-muted text-uppercase">Covered Area</th>
																		<th class="text-left font-weight-bold text-muted text-uppercase">Extras</th>
																	</tr>
																</thead>
																<tbody id="table_data">
																	@foreach ($unit->room as $room)
																	<tr class="font-weight-boldest font-size-lg">
																		<td class="pl-0 pt-7">{{ $loop->index+1 }}</td>
																		<td class="text-left pt-7">{{ $room->name }}</td>
																		{{-- <td class="text-left pt-7">{{ number_format($room->getOriginal('pivot_width')) }}'x{{ number_format($room->getOriginal('pivot_length')) }}'</td> --}}
																		<td class="text-left pt-7">
																			@if ($room->getOriginal('pivot_width')==0 && $room->getOriginal('pivot_length')==0)
																			No Dimensions Provided
																			@else
																			{{ floor($room->getOriginal('pivot_width') / 12) }}' {{ $room->getOriginal('pivot_width') % 12 }}'' x {{ floor($room->getOriginal('pivot_length') /12 ) }}' {{ $room->getOriginal('pivot_length') % 12 }}''
																			@endif
																		</td>
																		<td class="text-left pt-7">{{ number_format($room->getOriginal('pivot_covered_area') / 144) }} SqFt</td>
																		<td class="text-left pt-7">{{ $room->getOriginal('pivot_extras') === null ? 'No Record' : $room->getOriginal('pivot_extras') }}</td>
																	</tr>
																	@endforeach
																</tbody>
															</table>
															{{-- <a id="addRecord" href="admin/unit/{{ $room->id }}/room" class="btn btn-dark font-weight-bold">Add Room</a> --}}
															<!-- Button trigger modal -->
															<a class="font-weight-bold cursor-pointer" data-toggle="modal" data-target="#exampleModal">Add a Room</a>

															<!-- Modal -->
															<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<i aria-hidden="true" class="ki ki-close"></i>
																			</button>
																		</div>
																		<form action="/admin/unit/{{ $unit->id }}/room" method="POST">
																			@csrf
																			<div class="modal-body">
																				<input type="number" class="d-none" name="unit_id" value="{{ $unit->id }}">
																				<div class="row">
																					<div class="col-xl-12 mb-10">
																						<div class="form-check">
																							<input id="detailCheckbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
																							<label class="form-check-label" for="flexCheckDefault" style="    position: relative;
																							top: 2px;
																							left: 5px;">
																							  <strong>Detailed Room Sizes</strong>
																							</label>
																						  </div>
																					</div>
																				</div>
																				<div class="row" id="simpleSize">
																					<div class="col-xl-12">
																						<div class="form-group fv-plugins-icon-container">
																							<label class="">Size in SqFt</label>
																							<input type="number" step="any" class="form-control form-control-lg" name="covered_area">
																							<span class="form-text text-muted">Please specify the size of the room.</span>
																							<div class="fv-plugins-message-container"></div>
																						</div>
																					</div>
																				</div>
																				<div class="row" id="detailedSizes">
																					<div class="col-xl-12">
																						<label class="">Width</label>
																						<hr>
																						<div class="row">
																							<div class="col-xl-6">
																								<div class="form-group fv-plugins-icon-container">
																									<label class="">Feet</label>
																									<input type="number" step="any" class="form-control form-control-lg" name="width_feet">
																									{{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
																									<div class="fv-plugins-message-container"></div>
																								</div>
																							</div>
																							<div class="col-xl-6">
																								<div class="form-group fv-plugins-icon-container">
																									<label class="">Inches</label>
																									<input type="number" step="any" min="0" max="11" class="form-control form-control-lg" name="width_inches">
																									{{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
																									<div class="fv-plugins-message-container"></div>
																								</div>
																							</div>
																						</div>
																					</div>
																					<div class="col-xl-12">
																						<label class="">Length</label>
																						<hr>
																						<div class="row">
																							<div class="col-xl-6">
																								<div class="form-group fv-plugins-icon-container">
																									<label class="">Feet</label>
																									<input type="number" step="any" class="form-control form-control-lg" name="length_feet">
																									{{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
																									<div class="fv-plugins-message-container"></div>
																								</div>
																							</div>
																							<div class="col-xl-6">
																								<div class="form-group fv-plugins-icon-container">
																									<label class="">Inches</label>
																									<input type="number" step="any" min="0" max="11" class="form-control form-control-lg" name="length_inches">
																									{{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
																									<div class="fv-plugins-message-container"></div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="row">
																					<div class="col-xl-12">
																						<label>Room type</label>
																						<select name="room_type_id" class="form-control form-control-lg" required>
																							<option disabled selected hidden value="">Select Room Type...</option>
																							@foreach ($roomTypes as $roomType)
																								<option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
																							@endforeach
																						</select>
																					</div>
																				</div>
																				<div class="form-group row">
																					<label class="col-form-label col-lg-12">No of#</label>
																					<div class="col-lg-12">
																						<input type="text" class="form-control" name="extras" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="submit" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																				<button type="submit" href="/admin/unit/{{ $unit->id }}/room" type="button" class="btn btn-primary font-weight-bold">Save</button>
																			</div>
																	</form>
																	</div>
																</div>
															</div>
														</div>
														@else
														<div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
							  <div class="alert-icon">
								<i class="flaticon-warning"></i>
							  </div>
							  <div class="alert-text">
																No Rooms added to the unit!
																<a class="font-weight-bold pl-md-10 cursor-pointer" data-toggle="modal" data-target="#addRoomModal">Add a Room</a>
															</div>
							</div>
														<!-- Modal-->
														<div class="modal fade" id="addRoomModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<i aria-hidden="true" class="ki ki-close"></i>
																		</button>
																	</div>
																	<form action="/admin/unit/{{ $unit->id }}/room" method="POST">
																		@csrf
																		<div class="modal-body">
																			<input type="number" class="d-none" name="unit_id" value="{{ $unit->id }}">
																			<div class="row">
																				<div class="col-xl-12 mb-10">
																					<div class="form-check">
																						<input id="detailCheckbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
																						<label class="form-check-label" for="flexCheckDefault" style="    position: relative;
																						top: 2px;
																						left: 5px;">
																						  <strong>Detailed Room Sizes</strong>
																						</label>
																					  </div>
																				</div>
																			</div>
																			<div class="row" id="simpleSize">
																				<div class="col-xl-12">
																					<div class="form-group fv-plugins-icon-container">
																						<label class="">Size in SqFt</label>
																						<input type="number" step="any" class="form-control form-control-lg" name="covered_area">
																						<span class="form-text text-muted">Please specify the size of the room.</span>
																						<div class="fv-plugins-message-container"></div>
																					</div>
																				</div>
																			</div>
																			<div class="row" id="detailedSizes">
																				<div class="col-xl-12">
																					<label class="">Width</label>
																					<hr>
																					<div class="row">
																						<div class="col-xl-6">
																							<div class="form-group fv-plugins-icon-container">
																								<label class="">Feet</label>
																								<input type="number" step="any" class="form-control form-control-lg" name="width_feet">
																								{{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
																								<div class="fv-plugins-message-container"></div>
																							</div>
																						</div>
																						<div class="col-xl-6">
																							<div class="form-group fv-plugins-icon-container">
																								<label class="">Inches</label>
																								<input type="number" step="any" min="0" max="11" class="form-control form-control-lg" name="width_inches">
																								{{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
																								<div class="fv-plugins-message-container"></div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-xl-12">
																					<label class="">Length</label>
																					<hr>
																					<div class="row">
																						<div class="col-xl-6">
																							<div class="form-group fv-plugins-icon-container">
																								<label class="">Feet</label>
																								<input type="number" step="any" class="form-control form-control-lg" name="length_feet">
																								{{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
																								<div class="fv-plugins-message-container"></div>
																							</div>
																						</div>
																						<div class="col-xl-6">
																							<div class="form-group fv-plugins-icon-container">
																								<label class="">Inches</label>
																								<input type="number" step="any" min="0" max="11" class="form-control form-control-lg" name="length_inches">
																								{{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
																								<div class="fv-plugins-message-container"></div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-xl-12">
																					<label>Room type</label>
																					<select name="room_type_id" class="form-control form-control-lg" required>
																						<option disabled selected hidden value="">Select Room Type...</option>

																						@foreach ($roomTypes as $roomType)
																							<option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
																						@endforeach
																					</select>
																				</div>
																			</div>
																			<div class="form-group row">
																				<label class="col-form-label col-lg-12">No of#</label>
																				<div class="col-lg-12">
																					<input class="form-control" type="text" name="extras" id="kt_autosize_1" rows="3" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 76px;">
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="submit" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
																			<button type="submit" href="/admin/unit/{{ $unit->id }}/room" type="button" class="btn btn-primary font-weight-bold">Save</button>
																		</div>
																</form>
																</div>
															</div>
														</div>
														@endif
													</div>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<hr>
														<h3>Payment Plan</h3>
														<hr>
														@if($unit->payment_plan_img)
														<img class="img-thumbnail" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->payment_plan_img }}" target="_blank">
														@else
															<div class="alert alert-danger">No Payment Plan Image Found</div>
														@endif
													</div>
													<div class="col-sm-6">
														<hr>
														<h3>Floor Plan</h3>
														<hr>
														@if ($unit->floor_plan_img)
														<img class="img-thumbnail" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->floor_plan_img }}" target="_blank">
														@else
															<div class="alert alert-danger">No Floor Plan Image Found</div>
														@endif
													</div>
												</div>
												<div class="col-sm-12 mt-5">
													<a style="float: right" type="btn" class="btn btn-success font-weight-bold mr-2" href="/admin/unit/{{ $unit->id }}/edit">Edit Unit</a>
												</div>
											</div>

										@endforeach
									</div>

								</div>
							</div>
						@else
							<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
								<div class="col-md-9">
									<div class="d-flex justify-content-between alert alert-custom alert-warning">
										<div class="alert-text">
											No Units added to the Project
										</div>
										<a type="button" href="/admin/unit/create?id={{ $project->id }}" class="btn btn-dark font-weight-bold">Add Unit</a>
									</div>
								</div>
							</div>
						@endif
						{{-- Start add --}}
						{{-- <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
							<div class="col-md-9">
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
									<button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>
								</div>
							</div>
						</div> --}}
						{{-- End add --}}
						<!-- begin: Invoice footer-->
						{{-- <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
							<div class="col-md-9">
								<div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
									<div class="d-flex flex-column mb-10 mb-md-0">
										<div class="font-weight-bolder font-size-lg mb-3">BANK TRANSFER</div>
										<div class="d-flex justify-content-between mb-3">
											<span class="mr-15 font-weight-bold">Account Name:</span>
											<span class="text-right">Barclays UK</span>
										</div>
										<div class="d-flex justify-content-between mb-3">
											<span class="mr-15 font-weight-bold">Account Number:</span>
											<span class="text-right">1234567890934</span>
										</div>
										<div class="d-flex justify-content-between">
											<span class="mr-15 font-weight-bold">Code:</span>
											<span class="text-right">BARC0032UK</span>
										</div>
									</div>
									<div class="d-flex flex-column text-md-right">
										<span class="font-size-lg font-weight-bolder mb-1">TOTAL AMOUNT</span>
										<span class="font-size-h2 font-weight-boldest text-danger mb-1">$20.600.00</span>
										<span>Taxes Included</span>
									</div>
								</div>
							</div>
						</div> --}}
						<!-- end: Invoice footer-->
						<!-- begin: Invoice action-->
						{{-- <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
							<div class="col-md-9">
								<div class="d-flex justify-content-between">
									<button type="button" class="btn btn-light-primary font-weight-bold"
										onclick="window.print();">Download Invoice</button>
									<button type="button" class="btn btn-primary font-weight-bold"
										onclick="window.print();">Print Invoice</button>
								</div>
							</div>
						</div> --}}
						<!-- end: Invoice action-->
						<!-- end: Invoice-->

					</div>
				</div>
				<!-- end::Card-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Entry-->
	</div>
@endsection

@section('header')
 <style>
	 #addRoomModal{
		 padding-right: 0 !important;
	 }
	 .text-muted{
		 color:#040404 !important;
	 }
	 .text-dark.font-weight-bold.mb-4{
		 font-size: 18px;
	 }
	 a.c-yellow{ color: #fff;}
	 a.c-yellow:hover{color: yellow;}
 </style>
@endsection

@section('footer')
<script>

	$(document).ready(function(){

	// alert('inside');

	$('#addRecord').click(function(){
		event.preventDefault();
		// alert('working');
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var $unit_id = 4;
		var $room_type_id = 1;
		var $width = 7;
		var $length = 14;
		var $extras = 'From Form 3';
		// var $roomType = $('#room_id').val();
		// var $width = $('#width').val();
		// var $length = $('#length').val();
		// var $extras = $('#extras').val();
		$.ajax({
			type: "GET",
			url: "/admin/unit/"+$unit_id+"/room",
			data: jQuery.param({_token: CSRF_TOKEN,unit_id: $unit_id,room_type_id: $room_type_id,width: $width, length: $length, extras: $extras}),
			dataType: "dataType",
			success: function (response) {
				alert('wok');
				var html = '<tr class="font-weight-boldest font-size-lg">';
				html += '<td class="pl-0 pt-7">1</td>';
				html += '<td class="text-left pt-7">'+$roomType+'</td>';
				html += '<td class="text-left pt-7">'+$width+'x'+$length+'</td>';
				html += '<td class="text-left pt-7">'+$extras+'</td>';
				html += '</tr>';
				$('#table_data').prepend(html);
			}
			// alert('a');
		});
	});
});
// var html = '<tr class="font-weight-boldest font-size-lg">';
// html += '<td class="pl-0 pt-7">1</td>';
// html += '<td class="text-left pt-7">name</td>';
// html += '<td class="text-left pt-7">4x7</td>';
// html += '<td class="text-left pt-7">sample data</td>';
// html += '</tr>';
// $('#table_data').prepend(html);
// $('#add_details')[0].reset();
</script>
<!--begin::Page Scripts(used by this page)-->
{{-- <script src="assets/js/pages/crud/ktdatatable/child/data-local.js"></script> --}}
<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
<!--end::Page Scripts-->

<script>
	$(document).ready(function () {
		$("#detailedSizes").hide();
		$("#detailCheckbox").change(function () {
			$("#detailedSizes").toggle();
			$("#simpleSize").toggle();
		});
	});
</script>

@endsection
