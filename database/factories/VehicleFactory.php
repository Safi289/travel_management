<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    static $number = 101;
    return [
        'vehicle_name' => 'Airline ' . $number++,
        'cost' => $faker->numberBetween($min = 10000, $max = 50000),
    ];
});
