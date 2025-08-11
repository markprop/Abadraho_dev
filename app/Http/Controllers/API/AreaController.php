<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class AreaController extends BaseController
{
    public function all()
    {
        $data = Area::all();

        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found!');
        }
    }
}
