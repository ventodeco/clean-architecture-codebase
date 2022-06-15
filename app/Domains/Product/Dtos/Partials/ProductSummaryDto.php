<?php

namespace App\Domains\Product\Dtos\Partials;

use App\Domains\Product\Models\Product;

class ProductSummaryDto
{    
    /**
     * build
     *
     * @param  Product $product
     * @return void
     */
    public static function build(Product $product)
    {
        return [
            'id'             => $product->id,
            'name'           => $product->name,
            'slug'           => $product->slug,
            'price'          => (int)$product->price,
            'stock'          => (int)$product->stock,
            'comments_count' => (int)$product->comments_count,
            'image_urls'     => $product->images->pluck('file_path')
        ];
    }
}
