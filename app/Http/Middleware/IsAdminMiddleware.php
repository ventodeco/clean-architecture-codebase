<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
{
    /**
     * @param mixed $request
     * @param Closure $next
     * 
     * @return void
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guest() || !Auth::user()->isAdmin())
            return redirect('/', 301)->with('message', 'You need to be admin to see this page.');

        return $next($request);
    }
}