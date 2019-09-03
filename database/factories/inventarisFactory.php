<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\inventaris;
use Faker\Generator as Faker;

$factory->define(inventaris::class, function (Faker $faker) {

    return [
        'noreg' => $faker->word,
        'pidbarang' => $faker->randomDigitNotNull,
        'pidopd' => $faker->word,
        'pidlokasi' => $faker->randomDigitNotNull,
        'tgl_perolehan' => $faker->word,
        'tgl_sensus' => $faker->word,
        'volume' => $faker->randomDigitNotNull,
        'pembagi' => $faker->randomDigitNotNull,
        'satuan' => $faker->word,
        'harga_satuan' => $faker->randomDigitNotNull,
        'perolehan' => $faker->word,
        'kondisi' => $faker->word,
        'lokasi_detil' => $faker->word,
        'umur_ekonomis' => $faker->randomDigitNotNull,
        'keterangan' => $faker->word
    ];
});
