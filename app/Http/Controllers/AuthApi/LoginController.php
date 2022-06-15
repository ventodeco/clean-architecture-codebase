<?php

namespace App\Http\Controllers\AuthApi;

use App\Domains\UserRole\Requests\LoginRequest;
use App\Domains\UserRole\Services\UserService;
use App\Http\Controllers\BaseController;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends BaseController
{    
    /**
     * Login Controller
     *
     * @param  LoginRequest $request
     * @return void
     */
    public function __invoke(LoginRequest $request)
    {
        if ($request->failedValidator) {
            return $this->sendError(implode(", ", $request->failedValidator->errors()->all()));
        }

        list($user, $error) = app(UserService::class)->checkLoginValidation(
                                $request->username,
                                $request->password
                            );

        if (! is_null($error)) {
            return response()->json(['error' => $error], 401);
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'error' => 'could not create token'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'token'   => $token,
            'user'    => [
                'id'       => $user->id,
                'username' => $user->username,
                'email'    => $user->email,
                'roles'    => array_map(function ($role) {
                    return $role['name'];
                }, $user->roles->toArray()),
            ],
        ]);

    }
}