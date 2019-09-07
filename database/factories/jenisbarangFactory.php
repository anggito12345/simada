<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\jenisbarang;
use Faker\Generator as Faker;

$factory->define(jenisbarang::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
