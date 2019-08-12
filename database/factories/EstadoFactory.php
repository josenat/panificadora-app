<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Estado;
use Faker\Generator as Faker;

$factory->define(Estado::class, function (Faker $faker) {

    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
