<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\detiltanah;
use Faker\Generator as Faker;

$factory->define(detiltanah::class, function (Faker $faker) {

    return [
        'pidinventaris' => $faker->randomDigitNotNull,
        'luas' => $faker->randomDigitNotNull,
        'alamat' => $faker->word,
        'idkota' => $faker->randomDigitNotNull,
        'idkecamatan' => $faker->randomDigitNotNull,
        'idkelurahan' => $faker->randomDigitNotNull,
        'koordinatlokasi' => $faker->word,
        'koordinattanah' => $faker->word,
        'hak' => $faker->word,
        'status_sertifikat' => $faker->word,
        'tgl_sertifikat' => $faker->word,
        'nama_sertifikat' => $faker->word,
        'penggunaan' => $faker->word,
        'keterangan' => $faker->word,
        'dokumen' => $faker->word,
        'foto' => $faker->word
    ];
});
