<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\sys_workflow_master;
use Faker\Generator as Faker;

$factory->define(sys_workflow_master::class, function (Faker $faker) {

    return [
        'id' => $faker->word,
        'nama' => $faker->word,
        'kondisi_1' => $faker->word,
        'kondisi_2' => $faker->word,
        'kondisi_3' => $faker->word,
        'kondisi_4' => $faker->word,
        'created_at' => $faker->word,
        'updated_at' => $faker->word
    ];
});
