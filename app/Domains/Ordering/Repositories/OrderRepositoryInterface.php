<?php

declare(strict_types=1);

namespace App\Domains\Ordering\Repositories;

use App\Domains\Ordering\Models\Order;
use Illuminate\Database\Eloquent\Builder;

interface OrderRepositoryInterface
{
    public function findById(int $id): Order;
    public function getByUserId(int $id): Builder;
}