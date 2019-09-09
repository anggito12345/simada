<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\detilbangunan;
use Faker\Generator as Faker;

$factory->define(detilbangunan::class, function (Faker $faker) {

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
        'tgldokumen' => $faker->word,
        'nodokumen' => $faker->word,
        'luastanah' => $faker->randomDigitNotNull,
        'statustanah' => $faker->word,
        'kodetanah' => $faker->word,
        'dokumen' => $faker->word,
        'keterangan' => $faker->word,
        'foto' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
