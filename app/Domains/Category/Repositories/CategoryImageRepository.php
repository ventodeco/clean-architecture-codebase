<?php

declare(strict_types=1);

namespace App\Domains\Category\Repositories;

use App\Domains\Category\Models\CategoryImage;

class CategoryImageRepository implements CategoryImageRepositoryInterface
{
    /**
     * @param array $data
     * 
     * @return bool
     */
    public function insertBulk(array $data): bool
    {
        return CategoryImage::insert($data);
    }
}