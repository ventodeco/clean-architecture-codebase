<?php

use App\Domains\Category\Models\Category;

$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->sentence
    ];
});


