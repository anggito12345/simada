<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\rka_detil;
use Faker\Generator as Faker;

$factory->define(rka_detil::class, function (Faker $faker) {

    return [
        'pid' => $faker->word,
        'no_rka' => $faker->word,
        'nilai_kontrak' => $faker->randomDigitNotNull,
        'keterangan' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word
    ];
});
