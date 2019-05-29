<?php

use Faker\Generator as Faker;

$factory->define(App\Sales::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'price' => $faker-> numberBetween(20, 100),
        'quantity' => $faker-> numberBetween(1, 47),
        'method' => 0,
        'discount' => 0,
        'user_id' => 1,
        'store_id' => $faker-> numberBetween(1,7),
        'client_id' => $faker->numberBetween(1,20),
    ];
});
