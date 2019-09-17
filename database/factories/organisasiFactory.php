<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\organisasi;
use Faker\Generator as Faker;

$factory->define(organisasi::class, function (Faker $faker) {

    return [
        'pid' => $faker->randomDigitNotNull,
        'nama' => $faker->word,
        'jenis' => $faker->word,
        'alamat' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
