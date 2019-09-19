<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\system_upload;
use Faker\Generator as Faker;

$factory->define(system_upload::class, function (Faker $faker) {

    return [
        'uid' => $faker->word,
        'name' => $faker->word,
        'type' => $faker->word,
        'size' => $faker->randomDigitNotNull,
        'path' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
