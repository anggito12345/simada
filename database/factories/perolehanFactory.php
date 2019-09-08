<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\perolehan;
use Faker\Generator as Faker;

$factory->define(perolehan::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'aktif' => $faker->randomDigitNotNull,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
