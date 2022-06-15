<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\Traits\SendErrorResponseTrait;
use App\Http\Controllers\Traits\SendPaginateResponseTrait;
use App\Http\Controllers\Traits\SendSuccessResponseTrait;

class BaseController extends Controller
{
    use SendPaginateResponseTrait;
    use SendErrorResponseTrait;
    use SendSuccessResponseTrait;

    /**
     * sendResponse
     *
     * @param  mixed $result
     * @param  mixed $message
     * @return void
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }

    /**
     * sendSuccess
     *
     * @param  mixed $data
     * @param  mixed $statusCode
     * @param  mixed $headers
     * @return void
     */
    protected function sendSuccess($data, $statusCode = 200, $headers = []) {
        return response()->json($data, $statusCode, $headers);
    }
}