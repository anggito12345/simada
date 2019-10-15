<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\pemanfaatan;
use Faker\Generator as Faker;

$factory->define(pemanfaatan::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'peruntukan' => $faker->word,
        'umur' => $faker->randomDigitNotNull,
        'no_perjanjian' => $faker->word,
        'tgl_mulai' => $faker->word,
        'tgl_akhir' => $faker->word,
        'mitra' => $faker->randomDigitNotNull,
        'tipe_kontribusi' => $faker->word,
        'jumlah_kontribusi' => $faker->word,
        'pegawai' => $faker->randomDigitNotNull,
        'aktif' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
