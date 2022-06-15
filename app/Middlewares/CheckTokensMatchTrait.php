<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

trait CheckTokensMatchTrait
{
    /**
     * @param mixed $request
     * 
     * @return void
     */
    public function checkTokensMatch($request)
    {
        return $this->tokensMatch($request);

        if($this->tokensMatch($request)) {
            Log::info("Looking for token here 1");
            return true;
        }

        return false;
    }
}
