<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Symptom;
use Faker\Generator as Faker;

$factory->define(Symptom::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->randomElement([1, 2]),
        'name' => $faker->word(),
        'description' => $faker->text(100),
        'date_recorded' => $faker->date('Y-m-d', 'now'),
    ];
});
