<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\rka;
use Faker\Generator as Faker;

$factory->define(rka::class, function (Faker $faker) {

    return [
        'no_spk' => $faker->word,
        'no_bast' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
