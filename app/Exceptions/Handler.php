<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];
    
    /**
     * report
     *
     * @param  mixed $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    
    /**
     * render
     *
     * @param  mixed $request
     * @param  mixed $exception
     * @return void
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
