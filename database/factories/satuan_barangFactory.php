<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\satuan_barang;
use Faker\Generator as Faker;

$factory->define(satuan_barang::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull,
        'bisadibagi' => $faker->randomDigitNotNull
    ];
});
