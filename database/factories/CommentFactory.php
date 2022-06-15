<?php


use App\Domains\Product\Models\Product;

$factory->define(App\Domains\Comment\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'rating' => $faker->boolean(80) ? $faker->numberBetween($min = 1, $max = 5) : null,
        'content' => $faker->paragraph,
        'product_id' => function () {
            return Product::inRandomOrder()->first()->id;
            // return factory(Product::class)->create()->id;
        },
        'user_id' => function () {
            // return factory(User::class)->create()->id;
            return \App\Domains\UserRole\Models\User::inRandomOrder()->get()->first()->id;
        }
    ];
});
