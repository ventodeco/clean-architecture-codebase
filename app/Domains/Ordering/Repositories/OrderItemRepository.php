<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Repositories;

use App\Domains\Ordering\Models\OrderItem;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    /**
     * @param array|null $data
     * 
     * @return bool
     */
    public function bulkInsert(?array $data): bool
    {
        return OrderItem::insert($data);
    }
}