<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\alamat;
use Faker\Generator as Faker;

$factory->define(alamat::class, function (Faker $faker) {

    return [
        'pid' => $faker->randomDigitNotNull,
        'nama' => $faker->word,
        'jenis' => $faker->word,
        'kodepos' => $faker->word
    ];
});
