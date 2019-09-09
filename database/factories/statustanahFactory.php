<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\statustanah;
use Faker\Generator as Faker;

$factory->define(statustanah::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
