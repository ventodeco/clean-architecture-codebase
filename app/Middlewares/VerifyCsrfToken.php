<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Support\Facades\Log;

use Closure;
use Illuminate\Session\TokenMismatchException;


class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        'subscribe',
        'subscribe/*',
        'stripe/*'
    ];

    /**
     * @param mixed $request
     * @param Closure $next
     * 
     * @return void
     */
    public function handle($request, Closure $next)
    {
        Log::info("Looking for token");

        $verify = [];

        $verify[] = VerifyHelper::checkReading($request);
        $verify[] = VerifyHelper::checkUnitTest();
        $verify[] = VerifyHelper::checkPassThrough($request);
        $verify[] = VerifyHelper::checkTokensMatch($request);

        if (in_array(true, $verify)) {
            return $this->addCookieToResponse($request, $next($request));
        }

        Log::info("Looking for token here 1");
        return $this->addCookieToResponse($request, $next($request));

        throw new TokenMismatchException;
    }

}
