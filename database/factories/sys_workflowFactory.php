<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\sys_workflow;
use Faker\Generator as Faker;

$factory->define(sys_workflow::class, function (Faker $faker) {

    return [
        'nama' => $faker->word,
        'trigger' => $faker->word,
        'pid_user' => $faker->randomDigitNotNull,
        'created_at' => $faker->word,
        'updated_at' => $faker->word,
        'do' => $faker->word,
        'seq_order' => $faker->randomDigitNotNull,
        'data' => $faker->text,
        'data_do' => $faker->word
    ];
});
