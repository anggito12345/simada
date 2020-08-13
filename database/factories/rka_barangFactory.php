<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\rka_barang;
use Faker\Generator as Faker;

$factory->define(rka_barang::class, function (Faker $faker) {

    return [
        'kode_organisasi' => $faker->word,
        'nama_organisasi' => $faker->word,
        'tahun_rka' => $faker->word,
        'kode_barang' => $faker->word,
        'nama_barang' => $faker->word,
        'jumlah' => $faker->randomDigitNotNull,
        'harga_satuan' => $faker->word,
        'nilai' => $faker->word
    ];
});
