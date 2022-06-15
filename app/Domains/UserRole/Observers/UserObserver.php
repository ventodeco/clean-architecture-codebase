<?php

namespace App\Domains\UserRole\Observers;

use App\Domains\UserRole\Models\Role;
use App\Domains\UserRole\Models\User;

class UserObserver
{    
    /**
     * created
     *
     * @param  mixed $user
     * @return void
     */
    public function created(User $user): void
    {
        if ($user->roles()->count() == 0)
            $user->roles()->attach(Role::where('name', Role::ROLE_USER)->first());
    }

    /**
     * updating
     *
     * @param  mixed $user
     * @return void
     */
    public function updating(User $user): void
    {
        if ($user->roles()->count() == 0)
            $user->roles()->attach(Role::whereName(Role::ROLE_USER)->first());
    }
}