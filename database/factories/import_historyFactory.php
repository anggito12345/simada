<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\import_history;
use Faker\Generator as Faker;

$factory->define(import_history::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word,
        'deleted_at' => $faker->word
    ];
});
