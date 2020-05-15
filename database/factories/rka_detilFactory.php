<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\rka_detil;
use Faker\Generator as Faker;

$factory->define(rka_detil::class, function (Faker $faker) {

    return [
        'pid' => $faker->word,
        'kode_barang' => $faker->word,
        'nama_barang' => $faker->word,
        'jumlah_rencana' => $faker->word,
        'harga_satuan_rencana' => $faker->randomDigitNotNull,
        'nilai_rencana' => $faker->randomDigitNotNull,
        'jumlah_real' => $faker->word,
        'harga_satuan_real' => $faker->randomDigitNotNull,
        'nilai_kontrak' => $faker->randomDigitNotNull,
        'keterangan' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word
    ];
});
