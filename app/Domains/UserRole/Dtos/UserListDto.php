<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Dtos;

use App\Domains\Shared\Dtos\PageMeta;
use App\Domains\Shared\Dtos\SuccessResponse;
use App\Domains\UserRole\Dtos\Partials\UserListDataSection;

class UserListDto
{    
    /**
     * build
     *
     * @param  mixed $users
     * @param  mixed $base_path
     * @return void
     */
    public static function build(
        $users,
        $base_path = '/products'
    ) {
        $userListDataSection = UserListDataSection::build(
                                PageMeta::build($users, $base_path),
                                $users->items()
                            );

        return array_merge(SuccessResponse::build(), [
            'data' => $userListDataSection
        ]);
    }
}