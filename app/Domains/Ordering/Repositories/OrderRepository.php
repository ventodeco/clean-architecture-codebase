<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Repositories;

use App\Domains\Ordering\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository implements OrderRepositoryInterface
{    
    /**
     * findById
     *
     * @param  int $id
     * @return Order
     */
    public function findById(int $id): Order
    {
        return Order::find($id);
    }

    /**
     * get By User Id
     *
     * @param  int $id
     * @return Builder
     */
    public function getByUserId(int $id): Builder
    {
        return Order::where('user_id', $id);
    }
    
    /**
     * create
     *
     * @param  mixed $data
     * @return Order
     */
    public function create(array $data): Order
    {
        $order               = new Order;
        $order->address_id   = $data['address_id'];
        $order->order_status = $data['order_status'];
        $order->user_id      = $data['user_id'] ?? null;

        $order->save();

        return $order;
    }
}