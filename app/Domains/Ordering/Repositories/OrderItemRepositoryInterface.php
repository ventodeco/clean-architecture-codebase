<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Repositories;

interface OrderItemRepositoryInterface
{
    public function bulkInsert(array $data): bool;
}