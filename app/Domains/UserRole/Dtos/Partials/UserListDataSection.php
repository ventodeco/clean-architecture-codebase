<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Dtos\Partials;

class UserListDataSection
{    
    /**
     * build
     *
     * @param  mixed $pageMeta
     * @param  mixed $users
     * @return void
     */
    public static function build($pageMeta, $users)
    {
        $userDtos = [];
        foreach ($users as $key => $user) {
            $userDtos[] = UserOnlyUsernameDto::build($user);
        }
        return [
            'page_meta' => $pageMeta,
            'users' => $userDtos
        ];
    }
}