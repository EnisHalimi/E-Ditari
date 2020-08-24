<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Spatie\Permission\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => 'Drejtor',
        'guard_name' =>'admin',
        'school_id' => function() {
            return factory(App\School::class)->create()->id;
        },
    ];
});
