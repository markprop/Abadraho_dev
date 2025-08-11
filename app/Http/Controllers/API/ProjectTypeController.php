<?php

namespace App\Http\Controllers\API;

use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectTypeController extends BaseController
{
    public function all()
    {
        $data = ProjectType::select('id', 'title AS name')->get();

        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found!');
        }
    }

    public function byId(Request $request){
        $data = ProjectType::where('id', $request->id)->first();

        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found!');
        }
    }
}
