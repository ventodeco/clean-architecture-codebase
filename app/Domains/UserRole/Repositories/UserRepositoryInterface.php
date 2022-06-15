<?php

declare(strict_types=1);

namespace App\Domains\UserRole\Repositories;

use App\Domains\Address\Models\Address;
use App\Domains\UserRole\Models\User;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): ?User;
    public function create(array $data): User;
}