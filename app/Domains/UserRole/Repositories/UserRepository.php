<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Repositories;

use App\Domains\Address\Models\Address;
use App\Domains\UserRole\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $username
     * 
     * @return User|null
     */
    public function findByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    /**
     * @param array $data
     * 
     * @return User
     */
    public function create(array $data): User
    {
        $user = new User;
        $user->username   = $data['username'];
        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->email      = $data['email'];
        $user->password   = $data['password'];

        // $user->save();

        return $user;
    }
}