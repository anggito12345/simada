<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\setting;
use Faker\Generator as Faker;

$factory->define(setting::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'nilai' => $faker->word,
        'aktif' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
