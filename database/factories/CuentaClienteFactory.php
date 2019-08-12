<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CuentaCliente;
use Faker\Generator as Faker;

$factory->define(CuentaCliente::class, function (Faker $faker) {

    return [
        'fecha' => $faker->word,
        'dni' => $faker->word,
        'cliente' => $faker->word,
        'producto' => $faker->word,
        'cantidad' => $faker->randomDigitNotNull,
        'costo' => $faker->word,
        'importe' => $faker->word,
        'modo' => $faker->word,
        'deuda' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
