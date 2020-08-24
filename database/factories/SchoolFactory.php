<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'level' => $faker->jobTitle,
        'code' =>$faker->postcode,
    ];
});
