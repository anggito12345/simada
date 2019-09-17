<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\detilmesin;
use Faker\Generator as Faker;

$factory->define(detilmesin::class, function (Faker $faker) {

    return [
        'id' => $faker->randomDigitNotNull,
        'pidinventaris' => $faker->randomDigitNotNull,
        'merk' => $faker->randomDigitNotNull,
        'ukuran' => $faker->word,
        'bahan' => $faker->word,
        'nopabrik' => $faker->word,
        'norangka' => $faker->word,
        'nomesin' => $faker->word,
        'nopol' => $faker->word,
        'bpkb' => $faker->word,
        'keterangan' => $faker->word,
        'dokumen' => $faker->word,
        'foto' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
