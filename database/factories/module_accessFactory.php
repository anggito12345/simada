<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\module_access;
use Faker\Generator as Faker;

$factory->define(module_access::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word,
        'pid' => $faker->randomDigitNotNull
    ];
});
