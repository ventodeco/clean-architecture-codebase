<?php

use App\Domains\Address\Models\Address;
use App\Domains\UserRole\Models\User;

$factory->define(Address::class, function ($faker) {
    $user = $faker->boolean(80) ? User::inRandomOrder()->first() : null;

    return [
        'first_name' => $user ? $user->first_name : $faker->firstName,
        'last_name' => $user ? $user->last_name : $faker->lastName,
        'user_id' => $user ? $user->id : null,
        'city' => $faker->city,
        'country' => $faker->country,
        'address' => $faker->streetAddress, // $faker->address
        'zip_code' => $faker->postcode,
        'phone_number' => $faker->phoneNumber
    ];
});
