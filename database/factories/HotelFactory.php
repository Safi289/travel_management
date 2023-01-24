<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hotel;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    static $number = 1;
    return [
        'hotel_name' => 'Hotel ' . $number++,
        'cost' => $faker->numberBetween($min = 10000, $max = 50000),
    ];
});
