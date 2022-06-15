<?php

namespace App\Domains\Product\Dtos;

use App\Domains\Product\Dtos\Partials\ProductSummaryDto;
use App\Domains\Shared\Dtos\PageMeta;
use App\Domains\Shared\Dtos\SuccessResponse;

class ProductListDto
{    
    /**
     * build
     *
     * @param  mixed $products
     * @param  mixed $base_path
     * @return void
     */
    public static function build($products, $base_path = '/products')
    {
        $pageMeta = PageMeta::build($products, $base_path);
        $productDtos = [];
        foreach ($products->items() as $key => $product) {
            $productDtos[] = ProductSummaryDto::build($product);
        }

        return array_merge(SuccessResponse::build(), [
            'page_meta' => $pageMeta,
            'products' => $productDtos
        ]);
    }
}
