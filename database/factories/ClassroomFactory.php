<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classroom;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
        'year' => $faker->randomDigit,
        'parallel' => $faker->randomDigit,
        'admin_id' => function() {
            return factory(App\Admin::class)->create()->id;
        },
        'school_id' => function() {
            return factory(App\School::class)->create()->id;
        },
    ];
});
