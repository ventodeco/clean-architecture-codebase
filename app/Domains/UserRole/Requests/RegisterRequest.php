<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Requests;

use App\Domains\Shared\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{    
    /**
     * authorize
     * @return void
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * rules
     * @return void
     */
    public function rules()
    {
        return [
            'username'   => 'required|unique:users',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required',
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
        ];
    }
}