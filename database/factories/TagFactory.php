<?php


$factory->define(App\Domains\Tag\Models\Tag::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'slug' => $faker->word,
        'description' => $faker->sentence
    ];
});