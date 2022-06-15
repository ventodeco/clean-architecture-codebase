<?php

declare(strict_types=1);

namespace App\Domains\Tag\Repositories;

use App\Domains\Tag\Models\Tag;

interface TagRepositoryInterface
{
    public function findOrCreate(array $data): Tag;
}