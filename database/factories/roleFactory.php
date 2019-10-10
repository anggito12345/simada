<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\role;
use Faker\Generator as Faker;

$factory->define(role::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'level' => $faker->randomDigitNotNull,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
