<?php

namespace App\Http\Middleware;


use Closure;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    // php artisan make:middleware JwtMiddleware
    /**
     * @param mixed $request
     * @param Closure $next
     * @param null $optional
     * 
     * @return void
     */
    public function handle($request, Closure $next, $optional = null)
    {

        try {
            // $user = JWTAuth::parseToken()->authenticate();
            if (!$user = $this->auth->parseToken('token')->authenticate()) {
                return response()->json(['success' => false, 'full_messages' => ['JWT error: User not found']]);
            }
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'full_messages' => ['Invalid Token / Expired token']]);
        }

        return $next($request);
    }

    /**
     * @param mixed $message
     * 
     * @return void
     */
    protected function respondError($message)
    {
        return response()->json([
            'errors' => [
                'message' => $message,
                'status_code' => 401
            ]
        ], 401);
    }
}
