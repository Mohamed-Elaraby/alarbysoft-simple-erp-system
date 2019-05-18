<?php

use Faker\Generator as Faker;

$factory->define(App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->text(5),
        'address' => $faker->text(15),
        'phones' => $faker->phoneNumber,
        'user_id' => 1,
    ];
});
