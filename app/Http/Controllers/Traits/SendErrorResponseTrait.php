<?php

namespace App\Http\Controllers\Traits;

trait SendErrorResponseTrait
{    
    /**
     * sendError
     *
     * @param  mixed $error
     * @param  mixed $errorMessages
     * @param  mixed $code
     * @return void
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['date'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
