<?php

use App\Domains\Product\Models\Product;
use App\Domains\Ordering\Models\Order;
use App\Domains\Ordering\Models\OrderItem;

$factory->define(OrderItem::class, function ($faker) {
    $product = Product::inRandomOrder()->first();
    return [
        'order_id' => Order::inRandomOrder()->first()->id,
        'product_id' => $product->id,
        'quantity' => $faker->numberBetween(1, 10),
        'name' => $product->name,
        'slug' => $product->slug,
        //'price' => $faker->randomFloat($maxDecimals=2, $min=-20.0, $max=30.0)
        'price' => min(5, $product->price + ($faker->numberBetween(-20, 20)))
    ];
});