<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\penghapusan;
use Faker\Generator as Faker;

$factory->define(penghapusan::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'noreg' => $faker->word,
        'tglhapus' => $faker->word,
        'kriteria' => $faker->word,
        'kondisi' => $faker->word,
        'harga_apprisal' => $faker->word,
        'dokumen' => $faker->word,
        'foto' => $faker->word,
        'nosk' => $faker->word,
        'tglsk' => $faker->word,
        'keterangan' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word
    ];
});
