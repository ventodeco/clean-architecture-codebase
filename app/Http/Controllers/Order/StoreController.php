<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Domains\Address\Models\Address;
use App\Domains\Address\Repositories\AddressRepository;
use App\Domains\Ordering\Dtos\Partials\OrderSummaryDto;
use App\Domains\Ordering\Models\Order;
use App\Domains\Ordering\Repositories\OrderRepository;
use App\Domains\Ordering\Requests\StoreRequest;
use App\Domains\Product\Services\ProductOrderService;
use App\Http\Controllers\BaseController;

class StoreController extends BaseController
{    
    /**
     * Store the order
     *
     * @param  StoreRequest $request
     * @return void
     */
    public function __invoke(StoreRequest $request)
    {
        if ($request->failedValidator) {
            return $this->sendError(implode(", ", $request->failedValidator->errors()->all()));
        }

        $this->middleware('jwt.check');

        $address = $request->getAddress();

        if (! $address instanceof Address) {
            $params = [
                'address'      => $request->address,
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'zip_code'     => $request->zip_code,
                'city'         => $request->city,
                'country'      => $request->country,
                'phone_number' => $request->phone_number,
                'user_id'      => optional(auth()->user())->id,
            ];

            $address = app(AddressRepository::class)->create($params);
        }

        $orderParams = [
            'address_id'   => $address->id,
            'order_status' => Order::ORDERED,
            'user_id'      => optional(auth()->user())->id,
        ];

        $order = app(OrderRepository::class)->create($orderParams);

        app(ProductOrderService::class)->insertProducts($request->cart_items, $order->id);

        return $this->sendSuccessResponse(OrderSummaryDto::build($order));
    }
}