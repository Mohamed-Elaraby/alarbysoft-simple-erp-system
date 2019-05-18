<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->text(7),
        'description' => $faker->text(15),
        'type' => 0,
        'user_id' => 1,
    ];
});
