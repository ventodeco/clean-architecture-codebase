<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Log;

class VerifyHelper extends BaseVerifier
{
    use ReadingTrait;
    use UnitTestTrait;
    use CheckPassThroughTrait;
    use CheckTokensMatchTrait;
}
