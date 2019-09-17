<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\kondisi;
use Faker\Generator as Faker;

$factory->define(kondisi::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
