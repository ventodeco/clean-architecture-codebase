<?php

declare(strict_types=1);

namespace App\Domains\Product\Dtos\Partials;

use App\Domains\Product\Models\Product;

class ProductElementalDto
{
    /**
     * @param Product $product
     * 
     * @return array
     */
    public static function build(Product $product): array
    {
        return [
            'id'   => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
        ];
    }
}