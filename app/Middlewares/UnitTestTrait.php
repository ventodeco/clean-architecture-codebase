<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;

trait UnitTestTrait
{
    /**
     * @return void
     */
    public function checkUnitTest()
    {
        if ($this->runningUnitTests()) {
            Log::info("Looking for token here 1");
            return true;
        }

        return false;
    }
}
