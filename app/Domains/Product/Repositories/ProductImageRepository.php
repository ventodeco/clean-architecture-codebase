<?php

declare(strict_types=1);

namespace App\Domains\Product\Repositories;

use App\Domains\Product\Models\ProductImage;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    /**
     * @param array|null $data
     * 
     * @return bool
     */
    public function bulkInsert(?array $data): bool
    {
        return ProductImage::insert($data);
    }
}