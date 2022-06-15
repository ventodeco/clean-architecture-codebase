<?php

declare(strict_types=1);

namespace App\Domains\Product\Services;

use App\Domains\Ordering\Repositories\OrderItemRepository;
use App\Domains\Product\Repositories\ProductRepository;
use Exception;

class ProductOrderService
{
    /**
     * @param ProductRepository $repository
     * @param OrderItemRepository $orderItermRepository
     */
    public function __construct(ProductRepository $repository, OrderItemRepository $orderItermRepository)
    {
        $this->repository           = $repository;
        $this->orderItermRepository = $orderItermRepository;
    }

    /**
     * @param array $cartItems
     * @param int $orderId
     * 
     * @return void
     */
    public function insertProducts(array $cartItems, int $orderId): void
    {
        $productIds = array_map(function ($cartItem) {
            return $cartItem['id'];
        }, $cartItems);

        $products = app(ProductRepository::class)->findByIds($productIds);

        if (count($products) != count($cartItems)) {
            throw new Exception('Please make sure all products are still available');
        }

        $data = [];
        foreach ($products as $index => $product) {
            $datum = [
                'order_id'   => $orderId,
                'product_id' => $product->id,
                'quantity'   => $cartItems[$index]['quantity'],
                'name'       => $product->name,
                'slug'       => $product->slug,
                'price'      => $product->price,
            ];

            $data[] = $datum;
        }

        app(OrderItemRepository::class)->bulkInsert($data);

        return;
    }
}