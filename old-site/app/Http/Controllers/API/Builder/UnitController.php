<?php

namespace App\Http\Controllers\API\Builder;

use App\Models\Unit;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class UnitController extends BaseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unit = Unit::create(request()->validate([
            'title' => 'required',
            'rooms' => 'required',
            'covered_area' => '',
            'project_id' => 'required',
            'price' => 'required',
            'down_payment' => 'required',
            'monthly_installment' => 'required',
            'description' => '',
        ]));

        // Begin For Payment Plan
        if ($request->payment_plan_img) {
            $payment_plan_img_name = 'payment_plan_' . time() . '.' . $request->payment_plan_img->extension();
            $request->payment_plan_img->move(public_path('uploads/project_images/project_' . $request->project_id . '/unit_' . $unit->id), $payment_plan_img_name);
            $unit->payment_plan_img = $payment_plan_img_name;
        }
        // End For Payment Plan

        // Begin For Documents
        if ($request->floor_plan_img) {
            $floor_plan_img_name = 'floor_plan_' . time() . '.' . $request->floor_plan_img->extension();
            $request->floor_plan_img->move(public_path('uploads/project_images/project_' . $request->project_id . '/unit_'  . $unit->id), $floor_plan_img_name);
            $unit->floor_plan_img = $floor_plan_img_name;
        }
        // End For Documents

        $unit->save();
        $project = Project::where('id', $request->project_id)->first();
        if ($project->min_price == 0 || $project->min_price > $request->price) {
            $project->min_price = $request->price;
            $project->save();
        }

        $unit = Unit::with('project', 'room')->where('id', $unit->id)->first();

        $response = [
            'data' => $unit,
            'success' => true,
            'response'    => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        $data = Unit::with('project', 'room')->where('id', $unit->id)->first();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'No Data Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        request()->validate([
            'title' => 'required',
            'rooms' => 'required',
            'covered_area' => '',
            'project_id' => 'required',
            'price' => 'required',
            'down_payment' => 'required',
            'monthly_installment' => 'required',
            'description' => 'required',
        ]);

        $unit->title = $request->title;
        $unit->rooms = $request->rooms;
        $unit->covered_area = $request->covered_area;
        $unit->price = $request->price;
        $unit->monthly_installment = $request->monthly_installment;
        $unit->down_payment = $request->down_payment;
        $unit->description = $request->description;

        // Begin For Payment Plan
        if ($request->payment_plan_img) {
            $payment_plan_img_name = 'payment_plan_' . time() . '.' . $request->payment_plan_img->extension();
            $request->payment_plan_img->move(public_path('uploads/project_images/project_' . $request->project_id . '/unit_' . $unit->id), $payment_plan_img_name);
            $unit->payment_plan_img = $payment_plan_img_name;
        }
        // End For Payment Plan

        // Begin For Documents
        if ($request->floor_plan_img) {
            $floor_plan_img_name = 'floor_plan_' . time() . '.' . $request->floor_plan_img->extension();
            $request->floor_plan_img->move(public_path('uploads/project_images/project_' . $request->project_id . '/unit_'  . $unit->id), $floor_plan_img_name);
            $unit->floor_plan_img = $floor_plan_img_name;
        }
        // End For Documents

        $unit->save();
        $project = Project::where('id', $request->project_id)->first();
        if ($project->min_price == 0 || $project->min_price > $request->price) {
            $project->min_price = $request->price;
            $project->save();
        }

        $unit = Unit::with('project', 'room')->where('id', $unit->id)->first();

        $response = [
            'data' => $unit,
            'success' => true,
            'response'    => '200',
            'message' => 'Success',
        ];
        return $this->sendResponse($response, 'Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $data = $unit->delete();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'No Data Found');
    }

    /**
     * Add a room to the unit
     */
    public function add_room(Unit $unit, Request $request)
    {
        $requestData = request()->validate([
            'room_type_id' => 'required',
            'unit_id' => 'required',
            'size' => 'min:0',
            'width_feet' => 'min:0',
            'width_inches' => 'min:0|max:11',
            'length_feet' => 'min:0',
            'length_inches' => 'min:0|max:11',
            'covered_area' => 'min:0',
            'extras' => '',
        ]);

        $width = (12 * $request->width_feet) + $request->width_inches;
        $length = (12 * $request->length_feet) + $request->length_inches;
        if ($request->covered_area) {
            $covered_area = $request->covered_area;
        } else {
            $covered_area = $width * $length;
        }
        $unitRoom = $unit->room()->attach(['room_type_id' => $request->room_type_id], array('unit_id' => $request->unit_id, 'width' => $width, 'length' => $length, 'covered_area' => $covered_area, 'extras' => $request->extras));

        $data = Unit::with('project', 'room')->where('id', $request->unit_id)->first();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'No Data Found');
    }
    public function updateRoom(Unit $unit, Request $request)
    {
        //        return $request->all();
        $requestData = request()->validate([
            'room_type_id' => 'required',
            'unit_id' => 'required',
            'size' => 'min:0',
            'width_feet' => 'min:0',
            'width_inches' => 'min:0|max:11',
            'length_feet' => 'min:0',
            'length_inches' => 'min:0|max:11',
            'covered_area' => 'min:0',
            'extras' => '',
        ]);

        $width = (12 * $request->width_feet) + $request->width_inches;
        $length = (12 * $request->length_feet) + $request->length_inches;
        if ($request->covered_area) {
            $covered_area = $request->covered_area;
        } else {
            $covered_area = $width * $length;
        }
        $unit->room()->detach(60);
        $unitRoom = $unit->room()->attach(['room_type_id' => $request->room_type_id], array('unit_id' => $request->unit_id, 'width' => $width, 'length' => $length, 'covered_area' => $covered_area, 'extras' => $request->extras));
        $unitRoom = $unit->room()->updateExistingPivot([]);

        $data = Unit::with('project', 'room')->where('id', $request->unit_id)->first();

        if ($data) {
            $response = [
                'data' => $data,
                'success' => true,
                'response'    => '200',
                'message' => 'Success',
            ];
            return $this->sendResponse($response, 'Successfully.');
        } else
            return $this->sendResponse($data, 'No Data Found');
    }
}
