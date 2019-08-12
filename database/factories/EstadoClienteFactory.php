<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EstadoCliente;
use Faker\Generator as Faker;

$factory->define(EstadoCliente::class, function (Faker $faker) {

    return [
        'dni' => $faker->word,
        'nombre' => $faker->word,
        'telefono' => $faker->word,
        'correo' => $faker->word,
        'deuda' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
