<?php

namespace App\Domains\Ordering\Dtos;

use App\Domains\Ordering\Dtos\Partials\OrderSummaryDto;
use App\Domains\Ordering\Models\Order;

class OrderDetailsDto
{
    /**
     * @param Order $order
     * 
     * @return array
     */
    public static function build(Order $order): array
    {
        return [
            'success' => true,
            'order'   => OrderSummaryDto::build($order, false)
        ];
    }
}
