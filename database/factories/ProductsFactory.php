<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'purchasing_price' => $faker->numberBetween(10,19),
        'dealer_price' => $faker->numberBetween(20,28),
        'selling_price' => $faker->numberBetween(30,50),
        'quantity' => $faker->numberBetween(5,10),
        'invoice_no' => $faker->numberBetween(500,1000),
        'serial_id' => 1,
        'user_id' => 1,
        'category_id' => $faker->numberBetween(1,5),
        'store_id' => 1,
        'supplier_id' => 1,
    ];
});
