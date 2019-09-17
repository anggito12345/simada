<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\lokasi;
use Faker\Generator as Faker;

$factory->define(lokasi::class, function (Faker $faker) {

    return [
        'pid' => $faker->randomDigitNotNull,
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
