<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\UserSearchHistory;
use Illuminate\Http\Request;

class UserSearchHistoryController extends BaseController
{
    public function search(Request $request)
    {


      $data =  UserSearchHistory::create([
            'user_id' => $request->user_id,
            'hash' => $request->hash,
            'json' => serialize([
                'area' => $request->area,
                'progress' => $request->progress,
                'type' => $request->type,
                'admin' => $request->builder,
                'minDP' => $request->minDP,
                'maxDP' => $request->maxDP,
                'minMI' => $request->minMI,
                'maxMI' => $request->maxMI,
                'minPrice' => $request->minPrice,
                'maxPrice' => $request->maxPrice,
            ]),
        ]);

        if ($data) {
            return $this->sendResponse($data, 'Successfully.');
        } else {
            return $this->sendResponse($data, 'No Data Found!');
        }
    }
}
