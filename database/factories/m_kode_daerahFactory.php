<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\m_kode_daerah;
use Faker\Generator as Faker;

$factory->define(m_kode_daerah::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
