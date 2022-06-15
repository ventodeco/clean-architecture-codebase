<?php

namespace App\Domains\Ordering\Dtos\Partials;

use App\Domains\Ordering\Models\Order;
use App\Domains\UserRole\Dtos\Partials\UserOnlyUsernameDto;

class OrderSummaryDto
{    
    /**
     * build
     *
     * @param  mixed $order
     * @param  mixed $includeUser
     * @return void
     */
    public static function build($order, $includeUser = false)
    {
        $data = [
            'id'                => $order->id,
            'tracking_number'   => $order->tracking_number,
            'order_status'      => Order::status_choices[$order->order_status | 0],
            'order_items_count' => $order->orderItems()->count(),
            'total'             => $order->totalPrice()
        ];

        if ($includeUser)
            $data['user'] = UserOnlyUsernameDto::build($order->user);

        return $data;
    }
}