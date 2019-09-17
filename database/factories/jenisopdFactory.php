<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\jenisopd;
use Faker\Generator as Faker;

$factory->define(jenisopd::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
