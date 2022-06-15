<?php

declare(strict_types=1);

namespace App\Domains\Tag\Repositories;

use App\Domains\Tag\Models\Tag;

interface TagImageRepositoryInterface
{
    public function insertBulk(array $data): bool;
}