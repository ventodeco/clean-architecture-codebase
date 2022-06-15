<?php

namespace App\Http\Controllers\Traits;

trait SendPaginateResponseTrait
{    
    /**
     * sendPaginated
     *
     * @param  mixed $result
     * @param  mixed $message
     * @return void
     */
    public function sendPaginated($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message
        ];
        return response()->json($response, 200);
    }
}