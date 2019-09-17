<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\merkbarang;
use Faker\Generator as Faker;

$factory->define(merkbarang::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull
    ];
});
