<?php

use Faker\Generator as Faker;

$factory->define(App\ShortUrl::class, function (Faker $faker) {
    return [
        'short' => $faker->unique()->lexify('??????'),
        'long' => $faker->url,
    ];
});
