<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\mitra;
use Faker\Generator as Faker;

$factory->define(mitra::class, function (Faker $faker) {

    return [
        'npwp' => $faker->word,
        'siup_tdp' => $faker->word,
        'nama' => $faker->word,
        'alamat' => $faker->word,
        'telp' => $faker->word,
        'email' => $faker->word,
        'jenis_usaha' => $faker->word,
        'pic' => $faker->word,
        'jabatan_pic' => $faker->word,
        'hp_pic' => $faker->word,
        'email_pic' => $faker->word,
        'aktf' => $faker->randomDigitNotNull
    ];
});
