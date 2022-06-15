<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Requests;

use App\Domains\Shared\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'username' => 'required|min:2|max:500',
            'password' => 'required|min:2|max:500'
        ];
    }
}