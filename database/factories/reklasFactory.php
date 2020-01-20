<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\reklas;
use Faker\Generator as Faker;

$factory->define(reklas::class, function (Faker $faker) {

    return [
        'as' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
