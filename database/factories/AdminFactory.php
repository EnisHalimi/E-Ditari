<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'fathers_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $faker->randomElement($array = array ('F','M')),
        'address' => $faker->address,
        'city' => $faker->city,
        'residence' => $faker->city,
        'phone_nr' => $faker->randomNumber($nbDigits = 9, $strict = true),
        'photo' => 'no-image.png',
        'grade' => $faker->name,
        'school_id' => function() {
            return factory(App\School::class)->create()->id;
        },
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
