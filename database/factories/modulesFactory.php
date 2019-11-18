<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\modules;
use Faker\Generator as Faker;

$factory->define(modules::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'updated_at' => $faker->word,
        'created_at' => $faker->word
    ];
});
