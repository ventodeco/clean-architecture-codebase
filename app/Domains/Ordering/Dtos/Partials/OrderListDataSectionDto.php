<?php

namespace App\Domains\Ordering\Dtos\Partials;

class OrderListDataSectionDto
{    
    /**
     * build
     *
     * @param  mixed $pageMeta
     * @param  mixed $orders
     * @param  mixed $includeOrderUser
     * @return void
     */
    public static function build(
        $pageMeta,
        $orders,
        $includeOrderUser = false
    ) {
        $orderSummaryDtos = [];
        foreach ($orders as $key => $order) {
            $orderSummaryDtos[] = OrderSummaryDto::build($order, $includeOrderUser);
        }

        return [
            'page_meta' => $pageMeta,
            'orders' => $orderSummaryDtos
        ];
    }
}