<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clinic;
use Faker\Generator as Faker;

$factory->define(Clinic::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->company(),
        'address' => $faker->address(),
        'latitude' => $faker->randomFloat(6, 0, 1000),
        'longitude' => $faker->randomFloat(6, 0, 1000),
    ];
});
