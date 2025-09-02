<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    // Add any common functionality here, e.g., response helpers
    public function sendResponse($result, $message)
    {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message,
        ]);
    }

    public function sendError($error, $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $error,
        ], $code);
    }
}