<?php

namespace App\Http\Controllers\Traits;

trait SendSuccessResponseTrait
{    
    /**
     * sendSuccessResponse
     *
     * @param  mixed $result
     * @param  mixed $messages
     * @return void
     */
    public function sendSuccessResponse($result = [], $messages = null)
    {
        $response = array_merge(['success' => true], $result ?? []);

        if (is_string($messages)) {
            $response['full_messages'] = [$messages];
        }

        return response()->json($response, 200);
    }
}
