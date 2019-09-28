<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\detilkonstruksi;
use Faker\Generator as Faker;

$factory->define(detilkonstruksi::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'konstruksi' => $faker->word,
        'bertingkat' => $faker->word,
        'beton' => $faker->word,
        'luasbangunan' => $faker->randomDigitNotNull,
        'alamat' => $faker->word,
        'idkota' => $faker->randomDigitNotNull,
        'idkecamatan' => $faker->randomDigitNotNull,
        'idkelurahan' => $faker->randomDigitNotNull,
        'koordinatlokasi' => $faker->word,
        'koordinattanah' => $faker->word,
        'tglmulai' => $faker->word,
        'tgldokumen' => $faker->word,
        'nodokumen' => $faker->word,
        'luastanah' => $faker->randomDigitNotNull,
        'statustanah' => $faker->word,
        'kodetanah' => $faker->word,
        'keterangan' => $faker->word,
        'dokumen' => $faker->word,
        'foto' => $faker->word
    ];
});
