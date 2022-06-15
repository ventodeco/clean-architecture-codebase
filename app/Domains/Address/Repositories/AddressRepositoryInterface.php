<?php

declare(strict_types=1);

namespace App\Domains\Address\Repositories;

use App\Domains\Address\Models\Address;
use Illuminate\Database\Eloquent\Builder;

interface AddressRepositoryInterface
{
    public function findById(int $id): Address;
    public function create(array $data): Address;
    public function getByUserId(int $userId): Builder;
}