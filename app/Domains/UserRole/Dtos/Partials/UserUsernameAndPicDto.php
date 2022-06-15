<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Dtos\Partials;

use App\Domains\UserRole\Models\User;

class UserUsernameAndPicDto
{
    /**
     * @param User $user
     * 
     * @return array
     */
    public static function build(User $user): array
    {
        return [
            'id'       => $user->id,
            'username' => $user->username
        ];
    }
}
