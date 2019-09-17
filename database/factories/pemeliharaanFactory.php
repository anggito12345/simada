<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\pemeliharaan;
use Faker\Generator as Faker;

$factory->define(pemeliharaan::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'tgl' => $faker->word,
        'uraian' => $faker->word,
        'persh' => $faker->word,
        'alamat' => $faker->word,
        'nokontrak' => $faker->word,
        'tglkontrak' => $faker->word,
        'biaya' => $faker->randomDigitNotNull,
        'menambah' => $faker->randomDigitNotNull,
        'keterangan' => $faker->word
    ];
});
