<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\mutasi_detil;
use Faker\Generator as Faker;

$factory->define(mutasi_detil::class, function (Faker $faker) {

    return [
        'pid' => $faker->randomDigitNotNull,
        'inventaris' => $faker->randomDigitNotNull,
        'keterangan' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word
    ];
});
