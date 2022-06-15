<?php

declare(strict_types=1);

namespace App\Domains\Product\Repositories;

interface ProductImageRepositoryInterface
{
    public function bulkInsert(array $data): bool;
}