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
      <!-- begin::Card-->
      <div class="card card-custom overflow-hidden">
        <div class="card-body p-0">
          <!-- begin: Invoice header-->
          <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url({{ asset('assets/media/bg/bg-15.png') }});">
            <div class="col-md-9">
              <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                <h1 class="display-4 text-white font-weight-boldest mb-10">{{ $project->name }}</h1>
                <div class="d-flex flex-column align-items-md-end px-0">
                  <a href="/admin/project/{{ $project->slug }}/edit" class="btn btn-warning font-weight-bold mb-3" style="background:#ffb100; border:none; color:#1f1f1f;">
                    <i class="fa fa-edit mr-2"></i> Edit Project
                  </a>
                  <span class="text-white d-flex flex-column align-items-md-end opacity-70">
                    <span>{{ $project->address }}</span>
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
                    @if ($project->project_doc)
                        <span class="opacity-70"><a class="c-yellow" href="{{ asset($project->project_doc) }}" target="_blank">{{ $project->slug }}.pdf</a></span>
                    @else
                        <span class="opacity-70">No Document Found</span>
                    @endif
                </div>
                <div class="d-flex flex-column flex-root">
                  <span class="font-weight-bolder mb-2">Installment Length</span>
                  <span class="opacity-70">{{ $length }}</span>
                </div>
              </div>
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
                          <span class="text-dark font-weight-bold mb-4">Unit Type</span>
                          <span class="text-muted font-weight-bolder font-size-lg">
                            {{ $unit->type->title }}
                          </span>
                        </div>
                      </div>
                      @endif
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Down Payment</span>
                          <span class="text-muted font-weight-bolder font-size-lg">Rs. {{ number_format($unit->down_payment, 0, '.', ',') }}</span>
                        </div>
                      </div>
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Price</span>
                          <span class="text-muted font-weight-bolder font-size-lg">Rs. {{ number_format($unit->price, 0, '.', ',') }}</span>
                        </div>
                      </div>
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Loan Payment</span>
                          <span class="text-muted font-weight-bolder font-size-lg">Rs. {{ number_format($unit->loan_amount, 0, '.', ',') }}</span>
                        </div>
                      </div>
                      <div class="col-6 col-md-3">
                        <div class="mb-8 d-flex flex-column">
                          <span class="text-dark font-weight-bold mb-4">Installment Plan</span>
                          <span class="text-muted font-weight-bold font-size-lg">
                            Type: {{ $unit->installments->name }}
                          </span>
                          <span class="text-muted font-weight-bold font-size-lg">
                            Monthly Instalm: {{ number_format($unit->monthly_installment, 0, '.', ',') }}
                          </span>
                          <span class="text-muted font-weight-bold font-size-lg">
                            Length: {{ number_format($unit->installment, 0, '.', ',') }}
                          </span>
                          <span class="text-muted font-weight-bold font-size-lg">
                            Total Instalm: {{ number_format($unit->monthly_installment * $project->installment_length, 0, '.', ',') }}
                          </span>
                          <span class="text-muted font-weight-bold font-size-lg">
                            Total Amount: {{ number_format(($unit->installment / $unit->installments->value) * $project->installment_length, 0, '.', ',') }}
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
                                <th class="pl-0 font-weight-bold text-muted text-uppercase">SNo.</th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">Name</th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">Dimensions</th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">Covered Area</th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">No. of</th>
                                <th class="text-left font-weight-bold text-muted text-uppercase">Actions</th>
                              </tr>
                            </thead>
                            <tbody id="table_data">
                            <?php
                            $mergedRooms = [];
                            $totalCoveredArea = 0;

                            // Group similar rooms based on Name and Dimensions
                            foreach ($unit->UnitRooms as $room) {
                              $dimension = ($room->width_feet ?? 0) . '.' . ($room->width_inches ?? 0) . 'x' . ($room->length_feet ?? 0) . '.' . ($room->length_inches ?? 0);
                              $key = $room->RoomType->name . '|' . $dimension;
                              if (!isset($mergedRooms[$key])) {
                                $mergedRooms[$key] = [
                                  'name' => $room->RoomType->name ?? '-',
                                  'dimension' => $dimension,
                                  'covered_area' => 0,
                                  'extras' => 0,
                                  'room_ids' => [$room->id],
                                  'room_type_id' => $room->room_type_id, // Added for correct room type selection in edit
                                  'width_feet' => floor($room->width_feet ?? 0), // Added for edit values
                                  'width_inches' => floor($room->width_inches ?? 0), // Added for edit values
                                  'length_feet' => floor($room->length_feet ?? 0), // Added for edit values
                                  'length_inches' => floor($room->length_inches ?? 0), // Added for edit values
                                ];
                              } else {
                                $mergedRooms[$key]['room_ids'][] = $room->id;
                              }
                              $mergedRooms[$key]['extras'] += $room->extras ?? 0;
                              $mergedRooms[$key]['covered_area'] += ($room->covered_area ?? 0);
                              $totalCoveredArea += $room->covered_area ?? 0;
                            }
                            $sno = 1;
                            ?>

                              @foreach ($mergedRooms as $mergedRoom)
                              <tr class="font-weight-boldest font-size-lg">
                                <td class="pl-0 pt-7">{{ $sno++ }}</td>
                                <td class="text-left pt-7">{{ $mergedRoom['name'] }}</td>
                                <td class="text-left pt-7">
                                  @if ($mergedRoom['dimension'] == '0.0x0.0')
                                    No Dimensions Provided
                                  @else
                                    {{ $mergedRoom['dimension'] }}
                                  @endif
                                </td>
                                <td class="text-left pt-7">{{ $mergedRoom['covered_area'] }} Sq.Ft</td>
                                <td class="text-left pt-7">{{ $mergedRoom['extras'] }}</td>
                                <td class="text-left pt-7">
                                  <a class="font-weight-bold cursor-pointer" data-toggle="modal" data-target="#update_room_{{ $mergedRoom['room_ids'][0] }}"><i class="fa fa-edit ml-2"></i></a>
                                  @php
                                    $roomDetails = [];
                                    foreach ($unit->UnitRooms as $r) {
                                      if (in_array($r->id, $mergedRoom['room_ids'])) {
                                        $roomDetails[] = [
                                          'id' => $r->id,
                                          'extras' => $r->extras ?? 1,
                                          'covered_area' => $r->covered_area ?? 0,
                                        ];
                                      }
                                    }
                                    $roomDetailsJson = base64_encode(json_encode($roomDetails));
                                  @endphp
                                  <a class="font-weight-bold cursor-pointer" onclick="deleteUnitRoomGroup('{{ implode(',', $mergedRoom['room_ids']) }}','{{ $mergedRoom['name'] }}','{{ $mergedRoom['dimension'] }}', {{ $mergedRoom['width_feet'] ?? 0 }}, {{ $mergedRoom['width_inches'] ?? 0 }}, {{ $mergedRoom['length_feet'] ?? 0 }}, {{ $mergedRoom['length_inches'] ?? 0 }}, '{{ $roomDetailsJson }}')"><i class="fa fa-trash ml-2"></i></a>
                                </td>
                              </tr>

                              <div class="modal fade" id="update_room_{{ $mergedRoom['room_ids'][0] }}" tabindex="-1" role="dialog" aria-labelledby="updateRoom" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="updateRoom">Update Room</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                      </button>
                                    </div>
                                    <form id="frmUpdateUnitRoom">
                                      @csrf
                                      <div class="modal-body">
                                        <input type="number" class="d-none" name="unit_id" value="{{ $unit->id }}">
                                        <input type="number" class="d-none" name="table_id" value="{{ $mergedRoom['room_ids'][0] }}">
                                        <input type="number" class="d-none" name="project_id" value="{{ $unit->project_id }}"> <!-- Changed to $unit->project_id since $room is removed -->
                                        <div class="row">
                                          <div class="col-xl-12 mb-10">
                                            <div class="form-check">
                                              <input id="updateDetailCheckbox3-{{ $mergedRoom['room_ids'][0] }}" class="form-check-input updateDetailCheckbox3" type="checkbox" value="">
                                              <label class="form-check-label" for="updateDetailCheckbox3-{{ $mergedRoom['room_ids'][0] }}" style="position: relative; top: 2px; left: 5px;">
                                                <strong>Detailed Room Sizes</strong>
                                              </label>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row" id="simpleSize-{{ $mergedRoom['room_ids'][0] }}">
                                          <div class="col-lg-3">
                                            <div class="form-group">
                                              <label>Room type</label>
                                              <select name="room_type_id" class="form-control form-control-lg room_type_id2" required onchange="changeRoomType(this, 'updateLblRoomType', 'room_type_id2', 'update_room_{{ $mergedRoom['room_ids'][0] }}')">
                                                <option disabled hidden value="" selected>Select Room Type...</option>
                                                @foreach ($roomTypes as $roomType)
                                                <option value="{{ $roomType->id }}" {{ $mergedRoom['room_type_id'] == $roomType->id ? 'selected' : '' }}>
                                                  {{ $roomType->name }}
                                                </option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-lg-3">
                                            <div class="form-group">
                                              <label class="">No Of <span class="updateLblRoomType"></span> <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control extras" name="extras" value="{{ $mergedRoom['extras'] }}" style="height: 45px;" required numtxt data-maxlength="10">
                                            </div>
                                          </div>
                                          <div class="col-lg-3 updateSimpleSize3" id="updateSimpleSize3">
                                            <div class="form-group fv-plugins-icon-container">
                                              <label class="">Size in SqFt</label>
                                              <input type="number" step="any" class="form-control form-control-lg covered_area" id="update_unit_room_covered_area" name="covered_area" disabled value="{{ $mergedRoom['covered_area'] }}" required>
                                              <div class="fv-plugins-message-container"></div>
                                            </div>
                                          </div>
                                        </div>
                                        <input type="hidden" name="room_ids" value="{{ implode(',', $mergedRoom['room_ids']) }}">
                                        <div class="row updateDetailSection3" id="detailedSizes-{{ $mergedRoom['room_ids'][0] }}" style="display:none;">
                                          <div class="col-md-6">
                                            <label class="" style="font-size: 20px;font-weight: 600;">Width</label>
                                            <hr>
                                            <div class="row">
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Feet</label>
                                                  <input type="number" step="any" class="form-control form-control-lg width_feet" id="update_unit_room1_width_feet" oninput="UpdateCalcSquareFeet3('update_room_{{ $mergedRoom['room_ids'][0] }}')" name="width_feet" value="{{ $mergedRoom['width_feet'] }}" required numtxt data-maxlength="6">
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Inches</label>
                                                  <input type="number" step="any" min="0" max="11" class="form-control form-control-lg width_inches" id="update_unit_room1_width_inches" oninput="UpdateCalcSquareFeet3('update_room_{{ $mergedRoom['room_ids'][0] }}')" name="width_inches" value="{{ $mergedRoom['width_inches'] }}" numtxt data-maxlength="6">
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
                                                  <input type="number" step="any" class="form-control form-control-lg length_feet" id="update_unit_room1_length_feet" oninput="UpdateCalcSquareFeet3('update_room_{{ $mergedRoom['room_ids'][0] }}')" name="length_feet" value="{{ $mergedRoom['length_feet'] }}" required numtxt data-maxlength="6">
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                              <div class="col-xl-6">
                                                <div class="form-group fv-plugins-icon-container">
                                                  <label class="">Inches</label>
                                                  <input type="number" step="any" min="0" max="11" class="form-control form-control-lg length_inches" id="update_unit_room1_length_inches" oninput="UpdateCalcSquareFeet3('update_room_{{ $mergedRoom['room_ids'][0] }}')" name="length_inches" value="{{ $mergedRoom['length_inches'] }}" numtxt data-maxlength="6">
                                                  <div class="fv-plugins-message-container"></div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn project_room_btn font-weight-bold" onclick="SubmitUpdateUnitRoomForm('/admin/unit/{{ $unit->id }}/edit/room', 'update_room_{{ $mergedRoom['room_ids'][0] }}')">
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
                                  <span class="text-red">{{ $totalCoveredArea }}</span> <span class="text-red">Sq.Ft</span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <a class="btn project_room_btn font-weight-bold cursor-pointer" data-toggle="modal" data-target="#addRoom-{{ $unit->id }}" style="background-color: #E01E26; color:#fff; margin-bottom:5%;">Add a Room</a>
                        </div>
                        @else
                        <div class="alert alert-custom alert-notice alert-light-warning fade show mb-5" role="alert">
                          <div class="alert-icon"><i class="flaticon-warning"></i></div>
                          <div class="alert-text">
                            No Rooms added to the unit!
                            <a class="font-weight-bold pl-md-10 cursor-pointer" data-toggle="modal" onclick="openAddRoomModal('addRoom-{{ $unit->id }}')">Add a Room</a>
                          </div>
                        </div>
                        @endif
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
                                        <input id="detailCheckbox-{{ $unit->id }}" class="form-check-input detailCheckbox1" type="checkbox" value="">
                                        <label class="form-check-label" for="detailCheckbox-{{ $unit->id }}" style="position: relative; top: 2px; left: 5px;">
                                          <strong>Detailed Room Sizes</strong>
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-3">
                                      <div class="form-group">
                                        <label>Room type <span class="text-danger">*</span></label>
                                        <select name="room_type_id" class="form-control form-control-lg room_type_id1" required onchange="changeRoomType(this, 'addLblRoomType1', 'room_type_id1', 'addRoom-{{ $unit->id }}')">
                                          <option disabled hidden value="" selected>Select Room Type...</option>
                                          @foreach ($roomTypes as $roomType)
                                          <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-3">
                                      <div class="form-group">
                                        <label class="">No Of <span class="addLblRoomType1"></span> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control extras" name="extras" rows="3" required numtxt data-maxlength="2">
                                      </div>
                                    </div>
                                    <div class="col-lg-3 simpleSize1" id="simpleSize1">
                                      <div class="form-group fv-plugins-icon-container">
                                        <label class="">Size in SqFt <span class="text-danger">*</span></label>
                                        <input type="number" step="any" class="form-control form-control-lg covered_area" id="add_rm_covered_area" name="covered_area" disabled>
                                        <div class="fv-plugins-message-container"></div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row detailedSizes1" id="detailAddSection1" style="display:none;">
                                    <div class="col-xl-6">
                                      <label class="" style="font-weight: 600;font-size: 20px;">Width</label>
                                      <hr>
                                      <div class="row">
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Feet <span class="text-danger">*</span></label>
                                            <input type="number" step="any" min="1" class="form-control form-control-lg" id="add_rm_width_feet" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="width_feet" required numtxt data-maxlength="6">
                                            <div class="fv-plugins-message-container"></div>
                                          </div>
                                        </div>
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Inches</label>
                                            <input type="number" step="any" min="0" max="11" class="form-control form-control-lg" id="add_rm_width_inches" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="width_inches" numtxt data-maxlength="6">
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
                                            <div class="fv-plugins-message-container"></div>
                                          </div>
                                        </div>
                                        <div class="col-xl-6">
                                          <div class="form-group fv-plugins-icon-container">
                                            <label class="">Inches</label>
                                            <input type="number" step="any" min="0" max="11" class="form-control form-control-lg" id="add_rm_length_inches" oninput="CalcSquareFeet1('addRoom-{{ $unit->id }}')" name="length_inches" numtxt data-maxlength="6">
                                            <div class="fv-plugins-message-container"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button onclick="SubmitAddUnitRoomForm('/admin/unit/{{ $unit->id }}/room', 'addRoom-{{ $unit->id }}')" type="button" class="btn btn-primary font-weight-bold">Save</button>
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
                        <div class="alert admin_payment_btn">No Payment Plan Image Found</div>
                        @endif
                      </div>
                      <div class="col-sm-6">
                        <hr>
                        <h3>Floor Plan</h3>
                        <hr>
                        @if ($unit->floor_plan_img)
                        <img class="img-thumbnail" src="/uploads/project_images/project_{{ $project->id }}/unit_{{ $unit->id }}/{{ $unit->floor_plan_img }}" target="_blank">
                        @else
                        <div class="alert admin_payment_btn">No Floor Plan Image Found</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-12 mt-5">
                      <a style="float: left" type="btn" class="btn admin_ad_btn font-weight-bold mr-2" href="/admin/unit/{{ $unit->id }}/edit?cancel={{url()->current()}}">Edit Unit</a>
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
                  <div class="alert-text">No Units added to the Project</div>
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
                      <button type="submit" class="btn btn-secondary" onclick="ShowLoader();">Update</button>
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
                      <button type="submit" class="btn btn-secondary" onclick="ShowLoader();">Update</button>
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
      var unit_id = $('#unit_id').val(); // Replace with actual ID selector
      var project_id = $('#project_id').val(); // Replace with actual ID selector
      var room_type_id = $('#room_type_id').val(); // Replace with actual ID selector
      var width = globalRoomWidth; // Use global variable
      var length = globalRoomLength; // Use global variable
      var extras = $('#extras').val() || 1; // Replace with actual ID selector

      $.ajax({
        type: "GET",
        url: "/admin/unit/" + unit_id + "/room",
        data: jQuery.param({
          _token: CSRF_TOKEN,
          project_id: project_id,
          unit_id: unit_id,
          room_type_id: room_type_id,
          width: width,
          length: length,
          extras: extras
        }),
        dataType: "dataType",
        success: function(response) {
          alert('wok');
          var html = '<tr class="font-weight-boldest font-size-lg">';
          html += '<td class="pl-0 pt-7">1</td>';
          html += '<td class="text-left pt-7">' + (response.roomType || 'N/A') + '</td>';
          html += '<td class="text-left pt-7">' + width + 'x' + length + '</td>';
          html += '<td class="text-left pt-7">' + extras + '</td>';
          html += '</tr>';
          $('#table_data').prepend(html);
        },
        error: function(xhr, status, error) {
          console.log('AJAX Error: ' + error);
        }
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

    // Trigger calculations on input changes
    $('.width_feet, .width_inches, .length_feet, .length_inches, .extras').on('input', function() {
      var modalId = $(this).closest('.modal').attr('id');
      if (modalId && modalId.startsWith('addRoom-')) {
        CalcSquareFeet1(modalId);
      } else if (modalId && modalId.startsWith('update_room_')) {
        UpdateCalcSquareFeet3(modalId);
      }
    });

    $(document).on('change', '.detailCheckbox1', function() {
      var modalId = $(this).closest('.modal').attr('id');
      if ($(this).is(':checked')) {
        $(".detailedSizes1", '#' + modalId).show();
      } else {
        $(".detailedSizes1", '#' + modalId).hide();
      }
      $(".simpleSize1", '#' + modalId).show();
      CalcSquareFeet1(modalId);
    });

    $(document).on('change', '.updateDetailCheckbox3', function() {
      var modalId = $(this).closest('.modal').attr('id');
      if ($(this).is(':checked')) {
        $(".updateDetailSection3", '#' + modalId).show();
      } else {
        $(".updateDetailSection3", '#' + modalId).hide();
      }
      $(".updateSimpleSize3", '#' + modalId).show();
      UpdateCalcSquareFeet3(modalId);
    });

    $(".detailCheckbox2").change(function() {
      $(".detailedSizes2").toggle();
      $(".simpleSize2").toggle();
    });
  });

  let globalRoomWidth = 0;
  let globalRoomLength = 0;

  function changeUnitRoomTab(self) {
    window.location.search = 'selectedTab=' + $(self).attr("href");
  }

  function GetRedirectUrlAfterSuccess() {
    if ($("#section_unit_rooms").find(".nav-tabs").length > 0) {
      var getQueryParams = parseQueryStringParams();
      if (getQueryParams.selectedTab) {
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
    UpdateCalcSquareFeet3(modalId); // Ensure latest calculation
    ShowLoader();
    let covered_area = $('#' + modalId + ' #update_unit_room_covered_area').val() || 0;
    let params = $('#' + modalId + ' #frmUpdateUnitRoom').serialize() + '&covered_area=' + covered_area + '&width=' + globalRoomWidth + '&length=' + globalRoomLength;

    if (SubmitForm('frmUpdateUnitRoom')) {
      CallLaravelAction(URL, params, function(response) {
        if (response.status) {
          let SweetAlertParams = { icon: "success", title: response.message, showConfirmButton: true, timer: 20000 };
          ShowSweetAlert(SweetAlertParams);
          location.reload();
          HideLoader();
        } else {
          var ErrorMsg = response.message || 'An error occurred';
          if (response.error) {
            ErrorMsg = response.error.unit_id || response.error.project_id || response.error.width_feet || response.error.width_inches || response.error.length_feet || response.error.length_inches || response.error.room_type_id || response.error.extras || ErrorMsg;
          }
          let SweetAlertParams = { icon: "error", title: ErrorMsg, showConfirmButton: true, timer: 20000 };
          ShowSweetAlert(SweetAlertParams);
          HideLoader();
        }
      });
    }
  }

  function SubmitAddUnitRoomForm(URL, modalId, addNewFirst = false) {
    CalcSquareFeet1(modalId); // Ensure latest calculation
    let params;
    let covered_area = $('#' + modalId + ' #add_rm_covered_area').val() || 0;
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
      };
    } else {
      params = $('#' + modalId + ' #frmAddUnitRoom').serialize() + '&covered_area=' + covered_area + '&width=' + globalRoomWidth + '&length=' + globalRoomLength;
    }
    console.log('$("#frmAddUnitRoom").serialize()', params);
    if (SubmitForm('frmAddUnitRoom')) {
      ShowLoader();
      CallLaravelAction(URL, params, function(response) {
        if (response.status) {
          let SweetAlertParams = { icon: "success", title: response.message, showConfirmButton: true, timer: 20000 };
          ShowSweetAlert(SweetAlertParams);
          location.reload();
          HideLoader();
        } else {
          var ErrorMsg = response.message || 'An error occurred';
          if (response.error) {
            ErrorMsg = response.error.unit_id || response.error.project_id || response.error.width_feet || response.error.width_inches || response.error.length_feet || response.error.length_inches || response.error.room_type_id || response.error.extras || ErrorMsg;
          }
          let SweetAlertParams = { icon: "error", title: ErrorMsg, showConfirmButton: true, timer: 20000 };
          ShowSweetAlert(SweetAlertParams);
          HideLoader();
        }
      });
    }
  }

  function CalcSquareFeet1(modalId) {
    let width_feet = $('#' + modalId + ' #add_rm_width_feet').val() || 0;
    let width_inches = $('#' + modalId + ' #add_rm_width_inches').val() || 0;
    let length_feet = $('#' + modalId + ' #add_rm_length_feet').val() || 0;
    let length_inches = $('#' + modalId + ' #add_rm_length_inches').val() || 0;
    let extras = $('#' + modalId + ' input[name="extras"]').val() || 1;
    let width = parseFloat(width_feet) + (parseFloat(width_inches) / 12);
    let length = parseFloat(length_feet) + (parseFloat(length_inches) / 12);
    globalRoomWidth = width;
    globalRoomLength = length;
    let baseArea = width * length;
    let totalArea = baseArea * parseInt(extras);
    $('#' + modalId + ' #add_rm_covered_area').val(totalArea.toFixed(2));
    console.log("Total Area (width * length * extras):", totalArea);
  }

  function CalcSquareFeet2() {
    let width_feet = $('#add_new_unit_room1_width_feet').val() || 0;
    let width_inches = $('#add_new_unit_room1_width_inches').val() || 0;
    let length_feet = $('#add_new_unit_room1_length_feet').val() || 0;
    let length_inches = $('#add_new_unit_room1_length_inches').val() || 0;
    let extras = $('#add_new_unit_room_extras').val() || 1;
    let width = parseFloat(width_feet) + (parseFloat(width_inches) / 12);
    let length = parseFloat(length_feet) + (parseFloat(length_inches) / 12);
    globalRoomWidth = width;
    globalRoomLength = length;
    let baseArea = width * length;
    let totalArea = baseArea * parseInt(extras);
    $("#add_new_unit_room_covered_area").val(totalArea.toFixed(2));
    console.log("Total Area (width * length * extras):", totalArea);
  }

  function UpdateCalcSquareFeet3(modalId) {
    let width_feet = $('#' + modalId + ' #update_unit_room1_width_feet').val() || 0;
    let width_inches = $('#' + modalId + ' #update_unit_room1_width_inches').val() || 0;
    let length_feet = $('#' + modalId + ' #update_unit_room1_length_feet').val() || 0;
    let length_inches = $('#' + modalId + ' #update_unit_room1_length_inches').val() || 0;
    let extras = $('#' + modalId + ' input[name="extras"]').val() || 1;
    let width = parseFloat(width_feet) + (parseFloat(width_inches) / 12);
    let length = parseFloat(length_feet) + (parseFloat(length_inches) / 12);
    globalRoomWidth = width;
    globalRoomLength = length;
    let baseArea = width * length;
    let totalArea = baseArea * parseInt(extras);
    $('#' + modalId + ' #update_unit_room_covered_area').val(totalArea.toFixed(2));
    console.log("Total Area (width * length * extras):", totalArea);
  }

  function changeRoomType(ths, lbl, ddlRmType, modalId) {
    $("#" + modalId + " ." + lbl).text("");
    let dynamicLabel = $("#" + modalId + " ." + ddlRmType + " :selected").text().trim();
    $("#" + modalId + " ." + lbl).text(dynamicLabel);
  }

  function deleteProjectUnitIsArchive(unit_id) {
    console.log("deleteProjectUnitIsArchive -> projectUnit -> id -> ", unit_id);
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
          let requestParams = { unit_id: unit_id }
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
                if (typeof response.error.unit_id !== "undefined") {
                  ErrorMsg = response.error.unit_id;
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

  function openAddRoomModal(modalId) {
    $('#' + modalId).modal('show')
  }

  function deleteUnitRoomIsArchive(unitRoomId) {
    console.log("deleteUnitRoomIsArchive -> unit room -> id -> ", unitRoomId);
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
          let requestParams = { unit_room_id: unitRoomId }
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
              HideLoader();
            } else {
              var ErrorMsg = response.message;
              if (typeof response.error !== "undefined") {
                if (typeof response.error.unit_room_id !== "undefined") {
                  ErrorMsg = response.error.unit_room_id;
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
  function deleteUnitRoomGroup(roomIds, name, dimension, wFeet, wInches, lFeet, lInches, roomDetailsB64) {
  console.log("deleteUnitRoomGroup -> unit room ids -> ", roomIds);
  if (!roomIds) return;
  const ids = String(roomIds).split(',').filter(Boolean);
  if (ids.length <= 1) {
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
        let requestParams = { unit_room_ids: ids.join(',') };
        ShowLoader();
        CallLaravelAction(requestRoute, requestParams, function(response) {
          if (response.status) {
            ShowSweetAlert({ icon: "success", title: response.message, showConfirmButton: true, timer: 10000 });
            location.reload();
            HideLoader();
          } else {
            let ErrorMsg = response.message;
            if (response.error && response.error.unit_room_ids) { ErrorMsg = response.error.unit_room_ids; }
            ShowSweetAlert({ icon: "error", title: ErrorMsg, showConfirmButton: true, timer: 20000 });
            HideLoader();
          }
        });
      }
    });
    return;
  }

  var w = (parseFloat(wFeet || 0) + (parseFloat(wInches || 0) / 12));
  var l = (parseFloat(lFeet || 0) + (parseFloat(lInches || 0) / 12));
  var singleArea = (w * l).toFixed(2);

  var perRow = [];
  try {
    if (roomDetailsB64) {
      perRow = JSON.parse(atob(roomDetailsB64));
    }
  } catch (e) { perRow = []; }

  var headerInfo = '' +
    '<div class="mb-3 p-3 rounded" style="background:#f9fafb;border:1px solid #eef1f5;">' +
    '<div style="display:flex;flex-wrap:wrap;gap:16px;">' +
    '<div><strong>Name:</strong> ' + (name || '-') + '</div>' +
    '<div><strong>Dimensions:</strong> ' + (dimension || (wFeet + '.' + (wInches||0) + 'x' + lFeet + '.' + (lInches||0))) + '</div>' +
    '<div><strong>Per-room Area:</strong> ' + singleArea + ' Sq.Ft</div>' +
    '<div><strong>Merged Count:</strong> ' + ids.length + '</div>' +
    '</div>' +
    '</div>';

  var rowsHtml = '<div class="table-responsive">' + headerInfo + '<div class="mb-3">' +
                 '<button type="button" class="btn btn-sm btn-primary mr-2" id="btnDelSelectAll">Select All</button>' +
                 '<button type="button" class="btn btn-sm btn-secondary" id="btnDelDeselectAll">Deselect All</button>' +
                 '</div><table class="table table-bordered" style="min-width:820px"><thead><tr>'+
                 '<th style="width:40px"></th>'+
                 '<th style="width:70px">SNo.</th>'+
                 '<th>Name</th>'+
                 '<th>Dimensions</th>'+
                 '<th>Covered Area</th>'+
                 '<th>No. of</th>'+
                 '</tr></thead><tbody>';
  for (var i = 0; i < ids.length; i++) {
    var thisRow = perRow[i] || {};
    var rowExtras = (thisRow.extras != null ? thisRow.extras : 1);
    var rowArea = (thisRow.covered_area != null ? parseFloat(thisRow.covered_area) : parseFloat(singleArea));
    rowsHtml += '<tr>' +
      '<td><input type="checkbox" class="delRowChk" value="' + ids[i] + '" checked></td>' +
      '<td>' + (i + 1) + '</td>' +
      '<td>' + (name || '-') + '</td>' +
      '<td>' + (dimension || (wFeet + '.' + (wInches||0) + 'x' + lFeet + '.' + (lInches||0))) + '</td>' +
      '<td>' + rowArea.toFixed(2) + ' Sq.Ft</td>' +
      '<td>' + rowExtras + '</td>' +
    '</tr>';
  }
  rowsHtml += '</tbody></table></div>';

  Swal.fire({
    title: 'Select rows to delete',
    html: rowsHtml,
    width: '980px',
    showCancelButton: true,
    confirmButtonText: 'Delete',
    didOpen: function() {
      var el = Swal.getHtmlContainer();
      var chks = el.querySelectorAll('.delRowChk');
      var btnAll = el.querySelector('#btnDelSelectAll');
      var btnNone = el.querySelector('#btnDelDeselectAll');
      if (btnAll) btnAll.addEventListener('click', function(){ chks.forEach(function(c){ c.checked = true; }); });
      if (btnNone) btnNone.addEventListener('click', function(){ chks.forEach(function(c){ c.checked = false; }); });
    }
  }).then(function(result){
    if (!result.isConfirmed) return;
    var el = Swal.getHtmlContainer();
    var selected = Array.from(el.querySelectorAll('.delRowChk'))
      .filter(function(c){ return c.checked; })
      .map(function(c){ return c.value; });
    if (selected.length === 0) return;
    let requestRoute = "/admin/unit_room/delete/trash";
    let requestParams = { unit_room_ids: selected.join(',') };
    ShowLoader();
    CallLaravelAction(requestRoute, requestParams, function(response) {
      if (response.status) {
        ShowSweetAlert({ icon: "success", title: response.message, showConfirmButton: true, timer: 10000 });
        location.reload();
        HideLoader();
      } else {
        let ErrorMsg = response.message;
        if (response.error && response.error.unit_room_ids) { ErrorMsg = response.error.unit_room_ids; }
        ShowSweetAlert({ icon: "error", title: ErrorMsg, showConfirmButton: true, timer: 20000 });
        HideLoader();
      }
    });
  });
}
</script>

@endsection