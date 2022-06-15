<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

trait ReadingTrait
{
    /**
     * @param mixed $request
     * 
     * @return void
     */
    public static function checkReading($request)
    {
        if ($this->isReading($request)) {
            Log::info("Looking for token here 1");
            return true;
        }

        return false;
    }
}
