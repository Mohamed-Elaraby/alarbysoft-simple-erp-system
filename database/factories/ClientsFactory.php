<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'balance' => $faker->numberBetween(-200,500),
        'phones' => $faker->phoneNumber,
        'user_id' => 1,
    ];
});
