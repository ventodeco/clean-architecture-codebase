<?php

namespace App\Http\Controllers\AuthApi;

use App\Domains\UserRole\Repositories\UserRepository;
use App\Domains\UserRole\Requests\RegisterRequest;
use App\Http\Controllers\BaseController;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends BaseController
{    
    /**
     * Register user
     *
     * @param  RegisterRequest $request
     * @return void
     */
    public function __invoke(RegisterRequest $request)
    {
        if ($request->failedValidator) {
            return $this->sendError(implode(", ", $request->failedValidator->errors()->all()));
        }

        $user = app(UserRepository::class)->create([
            'username'   => $request->username,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => bcrypt($request->get('password'))
        ]);

        JWTAuth::fromUser($user);
        return $this->sendSuccessResponse(null, "User registered successfully");
    }
}