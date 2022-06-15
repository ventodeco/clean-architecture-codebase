<?php

declare(strict_types=1);

namespace App\Domains\Tag\Repositories;

use App\Domains\Tag\Models\TagImage;

class TagImageRepository implements TagImageRepositoryInterface
{
    /**
     * @param array $data
     * 
     * @return bool
     */
    public function insertBulk(array $data): bool
    {
        return TagImage::insert($data);
    }
}