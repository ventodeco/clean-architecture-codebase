<?php

namespace App\Domains\Ordering\Dtos;

use App\Domains\Ordering\Dtos\Partials\OrderListDataSectionDto;
use App\Domains\Shared\Dtos\PageMeta;
use App\Domains\Shared\Dtos\SuccessResponse;

class OrderListDto
{    
    /**
     * build
     *
     * @param  mixed $products
     * @param  mixed $base_path
     * @param  mixed $includeOrderUser
     * @return void
     */
    public static function build(
        $products,
        $base_path = '/orders',
        $includeOrderUser = false
    ) {
        $productListDataSection = OrderListDataSectionDto::build(
                                    PageMeta::build($products, $base_path), 
                                    $products->items(), 
                                    $includeOrderUser
                                );
        return array_merge(SuccessResponse::build(), [
            'data' => $productListDataSection
        ]);
    }
}