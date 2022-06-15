<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Domains\UserRole\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $redirectTo = '/';
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    
    /**
     * validator
     *
     * @param  mixed $data
     * @return void
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    protected function create(array $data) {
        return User::create([
            'username' => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
