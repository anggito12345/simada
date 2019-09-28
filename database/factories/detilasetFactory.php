<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\detilaset;
use Faker\Generator as Faker;

$factory->define(detilaset::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'buku_judul' => $faker->word,
        'buku_spesifikasi' => $faker->word,
        'seni_asal' => $faker->word,
        'seni_pencipta' => $faker->word,
        'seni_bahan' => $faker->word,
        'ternak_jenis' => $faker->word,
        'ternak_ukuran' => $faker->word,
        'keterangan' => $faker->word,
        'dokumen' => $faker->word,
        'foto' => $faker->word
    ];
});
