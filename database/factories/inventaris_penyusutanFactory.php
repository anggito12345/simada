<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\inventaris_penyusutan;
use Faker\Generator as Faker;

$factory->define(inventaris_penyusutan::class, function (Faker $faker) {

    return [
        'deskripsi' => $faker->word,
        'beban_penyusutan_perbulan' => $faker->word,
        'masa_manfaat_sd_akhir_tahun' => $faker->randomDigitNotNull,
        'penyusutan_sd_tahun_sebelumnya' => $faker->word,
        'running_penyesutan' => $faker->word,
        'running_sd_bulan' => $faker->randomDigitNotNull,
        'penyusutan_tahun_sekarang' => $faker->word,
        'penyusutan_sd_tahun_sekarang' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
