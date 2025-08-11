<?php

namespace App\Http\Controllers\API;

use App\Models\Measurement;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class UnitController extends BaseController
{
    public function all()
    {
        $data = Unit::all();

        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found!');
        }
    }

    public function measurements(Request $request)
    {

        $unit = Unit::where('id', $request->unit_id)->first();
        $measurement = Measurement::where('id', $unit->measurement_type)->first();
        $covered_area = round($unit->covered_area / $measurement->convertor, 5);
        $data = $covered_area . ' ' . $measurement->symbol;
        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found!');
        }
    }
}
