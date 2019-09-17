<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\satuanbarang;
use Faker\Generator as Faker;

$factory->define(satuanbarang::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull,
        'bisadibagi' => $faker->randomDigitNotNull,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
