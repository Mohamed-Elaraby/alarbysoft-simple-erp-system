<?php

use Faker\Generator as Faker;

$factory->define(App\Serial::class, function (Faker $faker) {
    return [
        'serial' => $faker->creditCardNumber,
        'product_id'=> $faker->numberBetween(1,10),
        'user_id'=> 1
    ];
});
