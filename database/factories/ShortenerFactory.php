<?php

use Faker\Generator as Faker;

$factory->define(App\Shortener::class, function (Faker $faker) {
    return [
        'short' => $faker->unique()->lexify('??????'),
        'long' => $faker->url,
    ];
});
