<?php

declare(strict_types=1);

namespace App\Domains\Category\Repositories;

use App\Domains\Category\Models\Category;

interface CategoryRepositoryInterface
{
    public function findOrCreate(array $data): Category;
}