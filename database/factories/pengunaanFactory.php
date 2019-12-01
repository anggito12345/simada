<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\pengunaan;
use Faker\Generator as Faker;

$factory->define(pengunaan::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
