

<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

trait CheckPassThroughTrait
{
    /**
     * @param mixed $request
     * 
     * @return void
     */
    public function checkPassThrough($request)
    {
        if($this->shouldPassThrough($request)) {
            Log::info("Looking for token here 1");
            return true;
        }

        return false;
    }
}
