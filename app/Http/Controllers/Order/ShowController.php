<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Domains\Ordering\Dtos\Partials\OrderSummaryDto;
use App\Domains\Ordering\Models\Order;
use App\Domains\Ordering\Repositories\OrderRepository;
use App\Http\Controllers\BaseController;

class ShowController extends BaseController
{    
    /**
     * show the order by id
     *
     * @param  int $id
     * @return void
     */
    public function __invoke(int $id)
    {
        $this->middleware('jwt.check');

        $order = app(OrderRepository::class)->findById($id);

        if (! $order instanceof Order) {
            return $this->sendError('Product was not found');
        }

        return $this->sendSuccessResponse(OrderSummaryDto::build($order));
    }
}