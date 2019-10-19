<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\jabatan;
use Faker\Generator as Faker;

$factory->define(jabatan::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'jenis' => $faker->randomDigitNotNull,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
