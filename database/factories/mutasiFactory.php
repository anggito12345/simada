<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\mutasi;
use Faker\Generator as Faker;

$factory->define(mutasi::class, function (Faker $faker) {

    return [
        'opd_asal' => $faker->randomDigitNotNull,
        'opd_tujuan' => $faker->randomDigitNotNull,
        'no_bast' => $faker->word,
        'tgl_bast' => $faker->word,
        'idpegawai' => $faker->randomDigitNotNull,
        'alasan_mutasi' => $faker->word,
        'keterangan' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word
    ];
});
