<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\detiljalan;
use Faker\Generator as Faker;

$factory->define(detiljalan::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'konstruksi' => $faker->word,
        'panjang' => $faker->randomDigitNotNull,
        'lebar' => $faker->randomDigitNotNull,
        'luas' => $faker->randomDigitNotNull,
        'alamat' => $faker->word,
        'idkota' => $faker->randomDigitNotNull,
        'idkecamatan' => $faker->randomDigitNotNull,
        'idkelurahan' => $faker->randomDigitNotNull,
        'koordinatlokasi' => $faker->word,
        'koordinattanah' => $faker->word,
        'tgldokumen' => $faker->word,
        'nodokumen' => $faker->word,
        'luastanah' => $faker->word,
        'statustanah' => $faker->word,
        'kodetanah' => $faker->word,
        'keterangan' => $faker->word,
        'dokumen' => $faker->word,
        'foto' => $faker->word
    ];
});
