<?php

use Faker\Generator as Faker;

$factory->define(App\ShortUrl::class, function (Faker $faker) {
    return [
        'short' => App\ShortUrl::makeShortLink(),
        'long' => $faker->url,
    ];
});
