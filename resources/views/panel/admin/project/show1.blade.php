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
          <h5 class="text-dark font-weight-bold my-1 mr-5">
            <a href="/admin/project">Project</a>
          </h5>
          <!--end::Page Title-->
          <!--begin::Breadcrumb-->
          <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item text-muted">
              <a href="javascript:void(0)" class="text-muted">{{ $project->name }}</a>
              <!-- <input type="text" name="thousand" class="thousand" id="thousand"> -->
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

      @if(Session::has('message'))
      <div class="alert alert-success">
        {{ Session::get('message') }}
      </div>
      @endif

      @if(Session::has('successMsg'))
      <div class="alert alert-success">
        {{ Session::get('successMsg') }}
      </div>

      @elseif(Session::has('errorMsg'))
      <div class="alert alert-danger">
        {{ Session::get('errorMsg') }}
      </div>

      @endif
      <!-- <div class="col-md-12">
        <button class="btn btn-danger">
          Back to project
        </button>
      </div> -->
      <!-- begin::Card-->
      <div class="card card-custom overflow-hidden">
        <div class="card-body p-0">
          <!-- begin: Invoice-->
          <!-- begin: Invoice header-->
          <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url({{ asset('assets/media/bg/bg-15.png') }});">
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
                  <span class="opacity-70">
                    @foreach ($project->areas as $p_area)
                    {{ $p_area->area ? $p_area->area->name : "" }} {{ !$loop->last ? ', ' : '' }}
                    @endforeach
                  </span>
                </div>
                <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolder mb-2">PROGRESS</span>
                  <span class="opacity-70">{{ $project->progress }}</span>
                </div>
                <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolder mb-2">PDF Document</span>
                  {{-- <span class="opacity-70">{{ $project->progress }}</span> --}}
                  @if ($project->project_doc)
                  <span class="opacity-70"><a class="c-yellow" href="/uploads/project_documents/project_{{ $project->id }}/{{ $project->project_doc }}" target="_blank">{{ $project->slug }}.pdf</a></span>
                  @else
                  <span class="opacity-70">No Document Found</span>
                  @endif
                </div>
                <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolder mb-2">Installment Length</span>
                  <span class="opacity-70">{{ $length }}</span>
                </div>
              </div>

              <!-- Start Project Amenities -->
              <!-- @if($project->ProjectAmenities->count() > 0)
              <div class="row m-t-20">
                <div class="text-white b-600 text-uppercase col-md-12">Amenities</div><br>
                @foreach ($project->ProjectAmenities as $ProjectAmenity)
                <div class="col-md-3">
                  <div class="text-white opacity-70">
                    <span>{{$loop->index + 1}}.</span>
                    <span>
                      {{ $ProjectAmenity->Amenity ? $ProjectAmenity->Amenity->amenity_name : "-" }}
                    </span>
                  </div>
                </div>
                @endforeach
              </div>
              @endif -->
              <!-- End Project Amenities -->

              <!-- Start Project Amenities -->
              <!-- @if($project->ProjectUtils->count() > 0)
              <div class="row m-t-20">
                <div class="text-white b-600 text-uppercase col-md-12">Utilities</div><br>
                @foreach ($project->ProjectUtils as $ProjectUtility)
                <div class="col-md-3">
                  <div class="text-white opacity-70">
                    <span>{{$loop->index + 1}}.</span>
                    <span>
                      {{ $ProjectUtility->Utility ? $ProjectUtility->Utility->utility_name : "-" }}
                    </span>
                  </div>
                </div>
                @endforeach
              </div>
              @endif -->
              <!-- End Project Amenities -->

            </div>
          </div>
          <!-- end: Invoice header-->
          <div id="section_unit_rooms">
            @if ($project->units->count())
            <div class="card card-custom">
              <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                  <ul class="nav nav-tabs nav-bold nav-tabs-line">
                    @foreach ($project->units as $unit)
                    <li class="nav-item">
                      <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" data-toggle="tab" href="#kt_tab_pane_{{ $loop->index }}" onclick="changeUnitRoomTab(this)">
                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                        <span class="nav-text">{{ $unit->title ? $unit->title : 'TYPE ' . $letter[$loop->index] }}</span>
                      </a>
                    </li>
                    @endforeach
                    <li class="nav-item">
                      <a type="button" href="/admin/unit/create?id={{ $project->id }}&cancel={{url()->current()}}" class="nav-link ml-md-10 mb-10 font-weight-bold" style="color:background-color: #800000;">+ Add Unit</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  @foreach ($project->units as $unit)
                  <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="kt_tab_pane_{{ $loop->index }}" role="tabpanel" aria-labelledby="kt_tab_pane_{{ $loop->index }}">
                    <div class="row pb-10">
                      <!--begin::Info-->
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Rooms</span>
                          <span class="text-muted font-weight-bolder font-size-lg">{{ $unit->rooms }}</span>
                        </div>
                      </div>
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Area</span>
                          <span class="text-muted font-weight-bolder font-size-lg">
                            @if ($unit->covered_area)
                            {{ round($unit->covered_area / $unit->measurement->convertor, 5) }}
                            {{ $unit->measurement->symbol }}
                            @else
                            -
                            @endif
                          </span>
                        </div>
                      </div>
                      @if ($unit->type)
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Unit
                            Type</span>
                          <span class="text-muted font-weight-bolder font-size-lg">

                            {{ $unit->type->title }}

                          </span>
                        </div>
                      </div>
                      @endif

                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Down
                            Payment</span>
                          <span class="text-muted font-weight-bolder font-size-lg">Rs.
                            {{ number_format($unit->down_payment, 0, '.', ',') }}</span>
                        </div>
                      </div>


                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Price</span>
                          <span class="text-muted font-weight-bolder font-size-lg">Rs.
                            {{ number_format($unit->price, 0, '.', ',') }}</span>
                        </div>
                      </div>

                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Loan
                            Payment</span>
                          <span class="text-muted font-weight-bolder font-size-lg">Rs.
                            {{ number_format($unit->loan_amount, 0, '.', ',') }}</span>
                        </div>
                      </div>

                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Installment Plan</span>
                          <span class="text-muted font-weight-bolder font-size-lg d-none">
                            Rs. {{ number_format($unit->monthly_installment, 0, '.', ',') }}
                            @if ($unit->installments)
                            ({{ $unit->installments->name }})
                            @endif
                          </span>
                          <span class="text-muted font-weight-bold font-size-lg">
                            Type:
                            {{ $unit->installments->name }}


                          </span>


                          <span class="text-muted font-weight-bold font-size-lg">
                            Monthly Instalm: {{ number_format($unit->monthly_installment, 0, '.', ',') }}

                          </span>

                          <span class="text-muted font-weight-bold font-size-lg">
                            Length:
                            {{ number_format($unit->installment, 0, '.', ',') }}

                          </span>

                          <span class="text-muted font-weight-bold font-size-lg">

                            Total Instalm:
                            {{ number_format($unit->monthly_installment * $project->installment_length, 0, '.', ',') }}
                          </span>


                          <span class="text-muted font-weight-bold font-size-lg">

                            Total Amount:
                            {{ number_format(($unit->installment / $unit->installments->value) * $project->installment_length, 0, '.', ',') }}
                          </span>

                        </div>
                      </div>

                      <!--end::Info-->

                      <div class="col-md-12 mt-5">
                        <h4>Unit Details</h4>
                        <hr>
                        @if ($unit->UnitRooms->count())
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="pl-0 font-weight-bold text-muted text-uppercase">
                                  SNo.
                                </th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">
                                  Name
                                </th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">
                                  Dimensions
                                </th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">
                                  Covered Area
                                </th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">
                                  No. of
                                </th>
                                <!-- <th class="text-left font-weight-bold text-muted text-uppercase">
                                  DISPLAY
                                </th> -->
                                <th class="text-left font-weight-bold text-muted text-uppercase">
                                  Actions
                                </th>
                              </tr>

                            </thead>
                            {{-- dd($unit->UnitRooms->toArray()) --}}
                            {{-- dd($unit->UnitRooms[0]->RoomType->toArray()) --}}
                            {{--dd($unit->id)--}}
                            <tbody id="table_data">
                              <?php $totalCoveredArea = 0; ?>
                              @foreach ($unit->UnitRooms as $room)
                              <tr class="font-weight-boldest font-size-lg">
                                <td class="pl-0 pt-7">
                                  {{ $loop->index + 1 }}
                                </td>
                                <td class="text-left pt-7">
                                  {{ $room->RoomType ? $room->RoomType->name : '-' }}
                                </td>
                                {{-- <td class="text-left pt-7">{{ number_format($room->getOriginal('pivot_width')) }}'x{{ number_format($room->getOriginal('pivot_length')) }}'</td> --}}
                                <td class="text-left pt-7">
                                  @if (($room->width_feet == 0 || $room->width_feet == null) && ($room->length_feet == 0 || $room->length_feet == null))
                                  No Dimensions Provided
                                  @else

                                  <span>{{$room->width_feet ? $room->width_feet : '0'}}.{{$room->width_inches ? $room->width_inches : '0'}}</span>
                                  <span> x </span>
                                  <span>{{$room->length_feet ? $room->length_feet : '0'}}.{{$room->length_inches ? $room->length_inches : '0'}}</span>
                                  @endif
                                </td>
                                <td class="text-left pt-7">
                                  <?php $totalCoveredArea += $room->covered_area; ?>
                                  <span> {{ $room->covered_area ? $room->covered_area : '0' }}</span> <span>Sq.Ft</span>
                                </td>
                                <td class="text-left pt-7">
                                  <span> {{ $room->extras ? $room->extras : '0' }}</span>
                                </td>
                                <!-- <td class="text-left pt-7">
                                  <span class='{{$room->is_display_on_listing ? "text-green" : "text-red"}}'> {{ $room->is_display_on_listing ? "Yes" : "No" }}</span>
                                </td> -->
                                <td class="text-left pt-7">
                                  <a class="font-weight-bold cursor-pointer" data-toggle="modal" data-target="#update_room_{{ $room->id }}"><i class="fa fa-edit ml-2"></i></a>
                                  <a class="font-weight-bold cursor-pointer" onclick="deleteUnitRoomIsArchive('{{$room->id}}')">
                                    <i class="fa fa-trash ml-2"></i>
                                  </a>
                                </td>

                              </tr>
                              <div class="modal fade" id="update_room_{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="updateRoom" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="updateRoom">Updatessss Room</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                      </button>
                                    </div>

                                    <form id="frmUpdateUnitRoom">
                                      @csrf
                                      <div class="modal-body">

                                        <input type="number" class="d-none" name="unit_id" value="{{ $unit->id }}">
                                        <input type="number" class="d-none" name="table_id" value="{{ $room->id }}">
                                        <input type="number" class="d-none" name="project_id" value="{{ $room->project_id }}">
                                        <div class="row">
                                          <div class="col-xl-12 mb-10">
                                            <div class="form-check">
                                              <input id="updateDetailCheckbox3" class="form-check-input updateDetailCheckbox3" type="checkbox" value="">

                                              <label class="form-check-label" for="updateDetailCheckbox3" style="position: relative; top: 2px; left: 5px;">

                                                <strong>Detailed Room Sizes</strong>
                                              </label>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row" id="simpleSize-{{ $room->id }}">
                                          <div class="col-lg-3">
                                            <div class="form-group">
                                              <label>Room type</label>
                                              <select name="room_type_id" class="form-control form-control-lg room_type_id2" required onchange="changeRoomType(this , 'updateLblRoomType' , 'room_type_id2' , 'update_room_{{ $room->id }}')">
                                                <option disabled hidden value="" selected>
                                                  Select Room Type...
                                                </option>
                                                @foreach ($roomTypes as $roomType)
                                                <option value="{{ $roomType->id }}" {{ $room->room_type_id == $roomType->id ? 'selected' : '' }}>
                                                  {{ $roomType->name }}
                                                </option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-lg-3">
                                            <div class="form-group">
                                              <label class="">No Of <span class="updateLblRoomType"></span> <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="extras" value="{{ $room->extras }}" style="height: 45px;" required numtxt data-maxlength="10">
                                            </div>
                                          </div>
                                          <!-- <div class="col-lg-3">
                                            <div class="form-group">
                                              <label class="">Display on list <span class="text-danger">*</span></label>
                                              <select name="is_display_on_listing" class="form-control form-control-lg is_display_on_listing" required>
                                                <option value="">Select Display</option>
                                                <option value="1" {{ $room->is_display_on_listing == 1 ? 'selected' : ''}}>Yes</option>
                                                <option value="0" {{ $room->is_display_on_listing == 0 ? 'selected' : ''}}>No</option>
                                              </select>
                                            </div>
                                          </div> -->
                                          <div class="col-lg-3 updateSimpleSize3" id="updateSimpleSize3">
                                            <div class="form-group fv-plugins-icon-container">
                                              <label class="">Size in SqFt</label>
                                              <input type="number" step="any" class="form-control form-control-lg covered_area" id="update_unit_room_covered_area" name="covered_area" disabled value="{{ $room->covered_area }}" required>
                                              <div class="fv-plugins-message-container">
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row updateDetailSection3" id="detailedSizes-{{ $room->id }}">
                                          <div class="col-md-6">
                                            <label class="" style="font-size: 20px;font-weight: 600;">Width</label>
                                            <hr>
                                            <div class="row">
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Feet</label>
                                                  <input type="number" step="any" class="form-control form-control-lg width_feet" id="update_unit_room1_width_feet" oninput="UpdateCalcSquareFeet3('update_room_{{ $room->id }}')" name="width_feet" value="{{ floor($room->width_feet) }}" required numtxt data-maxlength="6">
                                                  {{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Inches</label>
                                                  <input type="number" step="any" min="0" max="11" class="form-control form-control-lg width_inches" id="update_unit_room1_width_inches" oninput="UpdateCalcSquareFeet3('update_room_{{ $room->id }}')" name="width_inches" value="{{ floor($room->width_inches) }}" numtxt data-maxlength="6">
                                                  {{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <label class="" style="font-size: 20px;font-weight: 600;">Length</label>
                                            <hr>
                                            <div class="row">
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Feet</label>
                                                  <input type="number" step="any" class="form-control form-control-lg length_feet" id="update_unit_room1_length_feet" oninput="UpdateCalcSquareFeet3('update_room_{{ $room->id }}')" name="length_feet" value="{{ floor($room->length_feet) }}" required numtxt data-maxlength="6">
                                                  {{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Inches</label>
                                                  <input type="number" step="any" min="0" max="11" class="form-control form-control-lg length_inches" id="update_unit_room1_length_inches" oninput="UpdateCalcSquareFeet3('update_room_{{ $room->id }}')" name="length_inches" value="{{ floor($room->length_inches) }}" numtxt data-maxlength="6">
                                                  {{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn project_room_btn font-weight-bold" onclick="SubmitUpdateUnitRoomForm('/admin/unit/{{ $unit->id }}/edit/room' , 'update_room_{{ $room->id }}')">
                                          Save
                                        </button>
                                        <button type="button" class="btn project_room_btn font-weight-bold" data-dismiss="modal">
                                          Close
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                              <tr class="font-weight-boldest font-size-lg" style="font-size:17px;">
                                <td colspan="3" align="right">
                                  <span class="text-red">Total Covered Area :</span>
                                </td>
                                <td colspan="3">
                                  <span class="text-red">{{$totalCoveredArea}}</span> <span class="text-red">Sq.Ft</span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          {{-- <a id="addRecord" href="admin/unit/{{ $room->id }}/room" class="btn btn-dark font-weight-bold">Add Room</a> --}}
                          <!-- Button trigger modal -->
                          <a class="btn project_room_btn font-weight-bold cursor-pointer" data-toggle="modal" data-target="#addRoom-{{ $unit->id }}" style="background-color: #E01E26; color:#fff; margin-bottom:5%;">Add a Room</a>


                        </div>
                        @else
                        <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
                          <div class="alert-icon"><i class="flaticon-warning"></i>
                          </div>
                          <div class="alert-text">
                            No Rooms added to the unit!
                            <a class="font-weight-bold pl-md-10 cursor-pointer" data-toggle="modal" onclick="openAddRoomModal('addRoom-{{ $unit->id }}')">Add a Room</a>
                          </div>
                        </div>


                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="addRoom-{{ $unit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                              </div>

                              <form id="frmAddUnitRoom">
                                @csrf
                                <div class="modal-body">
                                  <input type="number" class="d-none" name="unit_id" value="{{ $unit->id }}">
                                  <input type="number" class="d-none" name="project_id" value="{{ $project->id }}">
                                  <div class="row">
                                    <div class="col-xl-12 mb-10">
                                      <div class="form-check">
                                        <input id="detailCheckbox1" class="form-check-input detailCheckbox1" type="checkbox" value="">
                                        <label class="form-check-label" for="addRmChkDetail" style="position: relative; top: 2px; left: 5px;">
                                          <strong>Detailed Room Sizes</strong>
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row" id="">
                                    <div class="col-lg-3">
                                      <div class="form-group">
                                        <label>Room type <span class="text-danger">*</span> </label>
                                        <select name="room_type_id" class="form-control form-control-lg room_type_id1" required onchange="changeRoomType(this , 'addLblRoomType1' , 'room_type_id1' , 'addRoom-{{ $unit->id }}')">
                                          <option disabled hidden value="" selected>
                                            Select
                                            Room Type...
                                          </option>
                                          @foreach ($roomTypes as $roomType)
                                          <option value="{{ $roomType->id }}">
                                            {{ $roomType->name }}
                                          </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-3">
                                      <div class="form-group">
                                        <label class="">No Of <span class="addLblRoomType1"></span> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="extras" rows="3" required numtxt data-maxlength="2">
                                      </div>
                                    </div>
                                    <!-- <div class="col-lg-3">
                                      <div class="form-group">
                                        <label class="">Display on list <span class="text-danger">*</span></label>
                                        <select name="is_display_on_listing" class="form-control form-control-lg is_display_on_listing" required>
                                          <option value="">Select Display</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                        </select>
                                      </div>
                                    </div> -->
                                    <div class="col-lg-3 simpleSize1" id="simpleSize1">
                                      <div class="form-group fv-plugins-icon-container">
                                        <label class="">Size in SqFt <span class="text-danger">*</span></label>
                                        <input type="number" step="any" class="form-control form-control-lg covered_area" id="add_rm_covered_area" name="covered_area" disabled>
                                        <!-- <span class="form-text text-muted">Please specify the size of the room.</span> -->
                                        <div class="fv-plugins-message-container"></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row detailedSizes1" id="detailAddSection1">
                                    <div class="col-xl-6">
                                      <label class="" style="font-weight: 600;font-size: 20px;">Width</label>
                                      <hr>
                                      <div class="row">
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Feet <span class="text-danger">*</span></label>
                                            <input type="number" step="any" min="1" class="form-control form-control-lg" id="add_rm_width_feet" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="width_feet" required numtxt data-maxlength="6">
                                            {{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
                                            <div class="fv-plugins-message-container"></div>
                                          </div>
                                        </div>
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Inches</label>
                                            <input type="number" step="any" min="1" max="11" class="form-control form-control-lg" id="add_rm_width_inches" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="width_inches" numtxt data-maxlength="6">
                                            {{-- <span class="form-text text-muted">Please specify the width of the room.</span> --}}
                                            <div class="fv-plugins-message-container"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-xl-6">
                                      <label class="" style="font-weight: 600;font-size: 20px;">Length</label>
                                      <hr>
                                      <div class="row">
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Feet <span class="text-danger">*</span></label>
                                            <input type="number" min="1" step="any" class="form-control form-control-lg" id="add_rm_length_feet" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="length_feet" required numtxt data-maxlength="6">
                                            {{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
                                            <div class="fv-plugins-message-container"></div>
                                          </div>
                                        </div>
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Inches</label>
                                            <input type="number" step="any" min="1" max="11" class="form-control form-control-lg" id="add_rm_length_inches" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="length_inches" numtxt data-maxlength="6">
                                            {{-- <span class="form-text text-muted">Please specify the length of the room.</span> --}}
                                            <div class="fv-plugins-message-container">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <!-- type="submit" href="/admin/unit/{{ $unit->id }}/room" -->
                                  <button onclick="SubmitAddUnitRoomForm('/admin/unit/{{ $unit->id }}/room' , 'addRoom-{{ $unit->id }}')" type="button" class="btn btn-primary font-weight-bold">Save</button>
                                  <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <hr>
                        <h3>Payment Plan</h3>
                        <hr>
                        @if ($unit->payment_plan_img)
                        <img class="img-thumbnail" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->payment_plan_img }}" target="_blank">
                        @else
                        <div class="alert admin_payment_btn">No Payment Plan Image Found
                        </div>
                        @endif
                      </div>
                      <div class="col-sm-6">
                        <hr>
                        <h3>Floor Plan</h3>
                        <hr>
                        @if ($unit->floor_plan_img)
                        <img class="img-thumbnail" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->floor_plan_img }}" target="_blank">
                        @else
                        <div class="alert admin_payment_btn">No Floor Plan Image Found
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 mt-5">
                      <a style="float: left" type="btn" class="btn admin_ad_btn font-weight-bold mr-2" href="/admin/unit/{{ $unit->id }}/edit?cancel={{url()->current()}}">Edit Unit</a>
                      <!-- <a style="float: left" type="btn" class="btn btn-secondary font-weight-bold mr-2" href="/admin/unit/{{ $unit->id }}/delete">Delete Unit</a> -->
                      <a style="float: right" type="btn" class="btn btn-secondary font-weight-bold mr-2" onclick="deleteProjectUnitIsArchive('{{ $unit->id }}')">Delete Unit</a>
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
                  <a type="button" href="/admin/unit/create?id={{ $project->id }}&cancel={{url()->current()}}" class="btn btn-dark font-weight-bold">Add Unit</a>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
      <!-- end::Card-->

      <div class="container">
        <div class="row">
          <!-- Amenities Section Start -->
          <div class="col-md-12 card card-custom overflow-hidden" style="margin-top: 30px;">
            <div class="card-body">
              <div class="row">

                <div class="col-12">
                  <h3>Amenities</h3>
                  <hr>
                </div>
                <div class="col-12">
                  <?php
                  $existingProjectAmenitiesIds = [];
                  for ($i = 0; $i < count($project->ProjectAmenities); $i++) {
                    array_push($existingProjectAmenitiesIds, $project->ProjectAmenities[$i]->amenity_id);
                  }
                  ?>
                  <form action="/admin/project/update/amenities" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="row">
                      @foreach ($amenities as $amenity)

                      <div class="col-6 col-lg-3 col-md-3 form-check amenities_checkbox">
                        @if(in_array($amenity->id, $existingProjectAmenitiesIds))
                        <input class="form-check-input" name="projectAmeniies[]" type="checkbox" id="amenity_{{ $amenity->id}}" value="{{ $amenity}}" checked />
                        <label class="form-check-label" for="amenity_{{ $amenity->id}}">{{ $amenity->amenity_name}}</label>
                        @else
                        <input class="form-check-input" name="projectAmeniies[]" type="checkbox" id="amenity_{{ $amenity->id}}" value="{{ $amenity}}" />
                        <label class="form-check-label" for="amenity_{{ $amenity->id}}">{{ $amenity->amenity_name}}</label>
                        @endif
                      </div>

                      @endforeach
                    </div>
                    <div class="col-md-12 text-right" style="margin-top: 3%;">
                      <button type="submit" class="btn btn-secondary" onclick="ShowLoader();">
                        Update
                      </button>
                    </div>
                  </form>
                </div>


              </div>
            </div>
          </div>
          <!-- Amenities Section End -->



          <!-- Utilities Section Start -->
          <div class="col-12 card card-custom overflow-hidden" style="margin-top: 30px;">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <h3>Utilities</h3>
                  <hr>
                </div>
                <div class="col-12">
                  <?php
                  $existingProjectUtilityIds = [];
                  for ($i = 0; $i < count($project->ProjectUtils); $i++) {
                    array_push($existingProjectUtilityIds, $project->ProjectUtils[$i]->utility_id);
                  }
                  ?>

                  <form action="/admin/project/update/utilities" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="row">
                      @foreach ($utilities as $utility)

                      <div class="col-6 col-lg-3 col-md-3 form-check">
                        @if(in_array($utility->id, $existingProjectUtilityIds))
                        <input class="form-check-input" type="checkbox" name="projectUtilities[]" id="utility_{{ $utility->id}}" value="{{ $utility }}" checked />
                        <label class="form-check-label" for="utility_{{ $utility->id}}">{{ $utility->utility_name}}</label>
                        @else
                        <input class="form-check-input" type="checkbox" name="projectUtilities[]" id="utility_{{ $utility->id}}" value="{{ $utility }}" />
                        <label class="form-check-label" for="utility_{{ $utility->id}}">{{ $utility->utility_name}}</label>
                        @endif
                      </div>

                      @endforeach
                    </div>
                    <div class="col-md-12 text-right" style="margin-top: 3%;">
                      <button type="submit" class="btn btn-secondary" onclick="ShowLoader();">
                        Update
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Utilities Section End -->
        </div>
      </div>


    </div>
    <!--end::Container-->
  </div>
  <!--end::Entry-->
</div>
@endsection

@section('header')
<style>
  #addRoomModal {
    padding-right: 0 !important;
  }

  .text-muted {
    color: #040404 !important;
  }

  .text-dark.font-weight-bold.mb-4 {
    font-size: 18px;
  }

  a.c-yellow {
    color: #fff;
  }

  a.c-yellow:hover {
    color: yellow;
  }
</style>
@endsection

@section('footer')
<script>
  $(document).ready(function() {

    // alert('inside');

    $('#addRecord').click(function() {
      event.preventDefault();
      // alert('working');
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type: "GET",
        url: "/admin/unit/" + $unit_id + "/room",
        data: jQuery.param({
          _token: CSRF_TOKEN,
          project_id: $project_id,
          unit_id: $unit_id,
          room_type_id: $room_type_id,
          width: $width,
          length: $length,
          extras: $extras
        }),
        dataType: "dataType",
        success: function(response) {
          alert('wok');
          var html = '<tr class="font-weight-boldest font-size-lg">';
          html += '<td class="pl-0 pt-7">1</td>';
          html += '<td class="text-left pt-7">' + $roomType + '</td>';
          html += '<td class="text-left pt-7">' + $width + 'x' + $length +
            '</td>';
          html += '<td class="text-left pt-7">' + $extras + '</td>';
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
  $(document).ready(function() {
    GetRedirectUrlAfterSuccess();
    // new AutoNumeric('.thousand', {
    //   currencySymbol: '$'
    // });

    // $(".thousand").change(function() {
    //   console.log('$(".thousand").val() -> ',$(".thousand").val());
    // })

    // $(".detailedSizes1").hide();
    // $(".simpleSize1").hide();
    $(".detailCheckbox1").change(function() {
      $(".detailedSizes1").toggle();
      $(".simpleSize1").toggle();
    });

    // $(".detailedSizes2").hide();
    // $(".simpleSize2").hide();
    $(".detailCheckbox2").change(function() {
      $(".detailedSizes2").toggle();
      $(".simpleSize2").toggle();
    });

    // $(".updateDetailSection3").hide();
    // $(".updateSimpleSize3").hide();
    $(".updateDetailCheckbox3").change(function() {
      // alert($(".updateDetailCheckbox3").prop("checked") );
      $(".updateDetailSection3").toggle();
      $(".updateSimpleSize3").toggle();
    });
  });

  let globalRoomWidth = 0;
  let globalRoomLength = 0;

  function changeUnitRoomTab(self) {
    window.location.search = 'selectedTab=' + $(self).attr("href");
  }

  function GetRedirectUrlAfterSuccess() {
    // location.href += '?ts=true';  
    if ($("#section_unit_rooms").find(".nav-tabs").length > 0) {
      // alert($("#section_unit_rooms").find(".nav-tabs").find(".nav-link:visible").attr("href"));
      // parseQueryStringParams -> helper.js function 
      var getQueryParams = parseQueryStringParams();
      // console.log("parseQueryStringParams -> ", getQueryParams);
      if ((typeof getQueryParams.selectedTab === "undefined")) {} else {
        // alert(JSON.stringify(getQueryParams.selectedTab));
        $('.nav-tabs a[href="' + getQueryParams.selectedTab + '"]').tab('show');
      }
    }

  }

  function addParameterToURL(param) {
    _url = location.href;
    _url += (_url.split('?')[1] ? '&' : '?') + param;
    return _url;
  }


  function SubmitUpdateUnitRoomForm(URL, modalId) {
    UpdateCalcSquareFeet3();

    ShowLoader();
    let covered_area = $("#" + modalId + " #update_unit_room_covered_area").val();
    let params = $("#" + modalId + " #frmUpdateUnitRoom").serialize() + "&covered_area=" + covered_area + "&width=" + globalRoomWidth + "&length=" + globalRoomLength;

    if (SubmitForm('frmUpdateUnitRoom')) {
      CallLaravelAction(URL, params, function(response) {
        if (response.status) {
          let SweetAlertParams = {
            icon: "success",
            title: response.message,
            showConfirmButton: true,
            timer: 20000,
          };
          ShowSweetAlert(SweetAlertParams);
          // ShowSuccess(response.message);
          location.reload();
          HideLoader();
        } else {
          var ErrorMsg = response.message;
          if (typeof response.error !== "undefined") {
            if (typeof response.error.unit_id !== "undefined") {
              ErrorMsg = response.error.unit_id;
            }
            if (typeof response.error.project_id !== "undefined") {
              ErrorMsg = response.error.project_id;
            }
            if (typeof response.error.width_feet !== "undefined") {
              ErrorMsg = response.error.width_feet;
            }
            if (typeof response.error.width_inches !== "undefined") {
              ErrorMsg = response.error.width_inches;
            }
            if (typeof response.error.length_feet !== "undefined") {
              ErrorMsg = response.error.length_feet;
            }
            if (typeof response.error.length_inches !== "undefined") {
              ErrorMsg = response.error.length_inches;
            }
            if (typeof response.error.room_type_id !== "undefined") {
              ErrorMsg = response.error.room_type_id;
            }
            if (typeof response.error.extras !== "undefined") {
              ErrorMsg = response.error.extras;
            }
          }
          let SweetAlertParams = {
            icon: "error",
            title: ErrorMsg,
            showConfirmButton: true,
            timer: 20000,
          };
          ShowSweetAlert(SweetAlertParams);
          // ShowError(ErrorMsg);
          HideLoader();
        }
      });
    }
  }

  function SubmitAddUnitRoomForm(URL, modalId, addNewFirst = false) {
    // alert(modalId);
    // return;
    let params;
    let covered_area = $("#" + modalId + " #add_rm_covered_area").val();
    if (addNewFirst) {
      params = {
        width_feet: $("#add_new_unit_room1_width_feet").val(),
        width_inches: $("#add_new_unit_room1_width_inches").val(),
        length_feet: $("#add_new_unit_room1_length_feet").val(),
        length_inches: $("#add_new_unit_room1_length_inches").val(),
        unit_id: $("#add_new_unit_room_unit_id").val(),
        project_id: $("#add_new_unit_room_project_id").val(),
        covered_area: $("#add_new_unit_room_covered_area").val(),
        room_type_id: $("#add_new_unit_room_type_id").val(),
        extras: $("#add_new_unit_room_extras").val(),

      }
    } else {
      params = $("#" + modalId + " #frmAddUnitRoom").serialize() + "&covered_area=" + covered_area + "&width=" + globalRoomWidth + "&length=" + globalRoomLength;
    }
    console.log('$("#frmAddUnitRoom").serialize()', params);
    if (SubmitForm('frmAddUnitRoom')) {
      ShowLoader();
      CallLaravelAction(URL, params, function(response) {
        if (response.status) {
          let SweetAlertParams = {
            icon: "success",
            title: response.message,
            showConfirmButton: true,
            timer: 20000,
          };
          ShowSweetAlert(SweetAlertParams);
          // ShowSuccess(response.message);
          location.reload();
          HideLoader();
        } else {
          var ErrorMsg = response.message;
          if (typeof response.error !== "undefined") {
            if (typeof response.error.unit_id !== "undefined") {
              ErrorMsg = response.error.unit_id;
            }
            if (typeof response.error.project_id !== "undefined") {
              ErrorMsg = response.error.project_id;
            }
            if (typeof response.error.width_feet !== "undefined") {
              ErrorMsg = response.error.width_feet;
            }
            if (typeof response.error.width_inches !== "undefined") {
              ErrorMsg = response.error.width_inches;
            }
            if (typeof response.error.length_feet !== "undefined") {
              ErrorMsg = response.error.length_feet;
            }
            if (typeof response.error.length_inches !== "undefined") {
              ErrorMsg = response.error.length_inches;
            }
            if (typeof response.error.room_type_id !== "undefined") {
              ErrorMsg = response.error.room_type_id;
            }
            if (typeof response.error.extras !== "undefined") {
              ErrorMsg = response.error.extras;
            }
          }
          let SweetAlertParams = {
            icon: "error",
            title: ErrorMsg,
            showConfirmButton: true,
            timer: 20000,
          };
          ShowSweetAlert(SweetAlertParams);
          // ShowError(ErrorMsg);
          HideLoader();
        }
      });
    }
  }

  function CalcSquareFeet1(modalId) {

    let width_feet = $('#' + modalId + ' #add_rm_width_feet').val() ? $('#' + modalId + ' #add_rm_width_feet').val() : 0;
    let width_inches = $('#' + modalId + ' #add_rm_width_inches').val() ? $('#' + modalId + ' #add_rm_width_inches').val() : 0;
    let length_feet = $('#' + modalId + ' #add_rm_length_feet').val() ? $('#' + modalId + ' #add_rm_length_feet').val() : 0;
    let length_inches = $('#' + modalId + ' #add_rm_length_inches').val() ? $('#' + modalId + ' #add_rm_length_inches').val() : 0;
    // console.log("width_feet -> ", width_feet);
    // console.log("width_inches -> ", width_inches);
    // console.log("length_feet -> ", length_feet);
    // console.log("length_inches -> ", length_inches);
    let width = parseFloat(width_feet + "." + width_inches);
    let length = parseFloat(length_feet + "." + length_inches);
    globalRoomWidth = width;
    globalRoomLength = length;
    $("#" + modalId + " #add_rm_covered_area").val(parseFloat(width * length).toFixed(2));
    console.log("parseFloat(width * length)", parseFloat(width * length));
  }

  function CalcSquareFeet2() {

    let width_feet = $('#add_new_unit_room1_width_feet').val() ? $('#add_new_unit_room1_width_feet').val() : 0;
    let width_inches = $('#add_new_unit_room1_width_inches').val() ? $('#add_new_unit_room1_width_inches').val() : 0;
    let length_feet = $('#add_new_unit_room1_length_feet').val() ? $('#add_new_unit_room1_length_feet').val() : 0;
    let length_inches = $('#add_new_unit_room1_length_inches').val() ? $('#add_new_unit_room1_length_inches').val() : 0;
    // console.log("width_feet -> ", width_feet);
    // console.log("width_inches -> ", width_inches);
    // console.log("length_feet -> ", length_feet);
    // console.log("length_inches -> ", length_inches);
    let width = parseFloat(width_feet + "." + width_inches);
    let length = parseFloat(length_feet + "." + length_inches);

    globalRoomWidth = width;
    globalRoomLength = length;

    $("#add_new_unit_room_covered_area").val(parseFloat(width * length).toFixed(2));
    // console.log("parseFloat(width * length)", parseFloat(width * length));
  }

  function UpdateCalcSquareFeet3(modalId) {

    let width_feet = $('#' + modalId + ' #update_unit_room1_width_feet').val() ? $('#' + modalId + ' #update_unit_room1_width_feet').val() : 0;
    let width_inches = $('#' + modalId + ' #update_unit_room1_width_inches').val() ? $('#' + modalId + ' #update_unit_room1_width_inches').val() : 0;
    let length_feet = $('#' + modalId + ' #update_unit_room1_length_feet').val() ? $('#' + modalId + ' #update_unit_room1_length_feet').val() : 0;
    let length_inches = $('#' + modalId + ' #update_unit_room1_length_inches').val() ? $('#' + modalId + ' #update_unit_room1_length_inches').val() : 0;
    console.log("width_feet -> ", width_feet);
    console.log("width_inches -> ", width_inches);
    console.log("length_feet -> ", length_feet);
    console.log("length_inches -> ", length_inches);
    let width = parseFloat(width_feet + "." + width_inches);
    let length = parseFloat(length_feet + "." + length_inches);

    globalRoomWidth = width;
    globalRoomLength = length;

    $('#' + modalId + " #update_unit_room_covered_area").val(parseFloat(width * length).toFixed(2));
    // console.log("parseFloat(width * length)", parseFloat(width * length));
  }

  function changeRoomType(ths, lbl, ddlRmType, modalId) {
    $("#" + modalId + " ." + lbl).text("");
    let dynamicLabel = $("#" + modalId + " ." + ddlRmType + " :selected").text().trim();
    $("#" + modalId + " ." + lbl).text(dynamicLabel);

    // $(ths).text();
    // console.log("$(ths).text(); -> ", $(ths + " option").filter(":selected").text());
    // console.log("$(ths).val() -> ", $("." + ddlRmType + " :selected").text().trim());
    // console.log("$(ths).text() -> ", $("." + ddlRmType + " :selected").text().trim());
    // console.log("$(ths) -> ", $("." + ddlRmType).find(":selected").text() );
    // console.log("$(ths) -> ", $("." + ddlRmType + " :selected"));
  }

  function deleteProjectUnitIsArchive(unit_id) {
    // let objProject = JSON.parse(project);
    console.log("deleteProjectUnitIsArchive -> projectUnit -> id -> ", unit_id);
    // ShowSweetAlert({
    //   title: 'Shortlisted!',
    //   text: 'Candidates are successfully shortlisted!',
    //   icon: 'success'
    // });
    if (parseInt(unit_id)) {
      ShowSweetAlertConfirm({
        title: "Are you sure ?",
        text: "You want to delete this project unit!",
        icon: "warning",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
      }, function(result) {
        if (result.isConfirmed) {
          let requestRoute = "/admin/unit/" + unit_id + "/delete";
          let requestParams = {
            unit_id: unit_id
          }
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
              // ShowSuccess(response.message);
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.unit_id !== "undefined") {
                  ErrorMsg = response.error.unit_id;
                }
                // if (typeof response.error.phone_number !== "undefined") {
                //   ErrorMsg = response.error.phone_number;
                // }
              }
              let SweetAlertParams = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 20000,
              };
              ShowSweetAlert(SweetAlertParams);
              // ShowError(ErrorMsg);
              HideLoader();
            }
          });
        }
      });
    }
  }

  function openAddRoomModal(modalId) {
    $('#' + modalId).modal('show')
  }

  function deleteUnitRoomIsArchive(unitRoomId) {
    // let objProject = JSON.parse(project);
    console.log("deleteUnitRoomIsArchive -> unit room -> id -> ", unitRoomId);
    // ShowSweetAlert({
    //   title: 'Shortlisted!',
    //   text: 'Candidates are successfully shortlisted!',
    //   icon: 'success'
    // });
    if (parseInt(unitRoomId)) {
      ShowSweetAlertConfirm({
        title: "Are you sure ?",
        text: "You want to delete this unit room!",
        icon: "warning",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `No`,
      }, function(result) {
        if (result.isConfirmed) {
          let requestRoute = "/admin/unit_room/delete/trash";
          let requestParams = {
            unit_room_id: unitRoomId
          }
          ShowLoader();
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
              // ShowSuccess(response.message);
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.unit_room_id !== "undefined") {
                  ErrorMsg = response.error.unit_room_id;
                }
                // if (typeof response.error.phone_number !== "undefined") {
                //   ErrorMsg = response.error.phone_number;
                // }
              }
              let SweetAlertParams = {
                icon: "error",
                title: ErrorMsg,
                showConfirmButton: true,
                timer: 20000,
              };
              ShowSweetAlert(SweetAlertParams);
              // ShowError(ErrorMsg);
              HideLoader();
            }
          });
        }
      });
    }
  }
</script>

@endsection