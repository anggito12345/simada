<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\barang;
use Faker\Generator as Faker;

$factory->define(barang::class, function (Faker $faker) {

    return [
        'pid' => $faker->randomDigitNotNull,
        'kodetampil' => $faker->word,
        'kode_rek' => $faker->word,
        'nama_rek_aset' => $faker->word,
        'jenis_barang' => $faker->randomDigitNotNull,
        'umur_ekononomis' => $faker->randomDigitNotNull,
        'aset' => $faker->word,
        'obyek' => $faker->word,
        'rincianobyek' => $faker->word,
        'subrincianobyek' => $faker->word
    ];
});
