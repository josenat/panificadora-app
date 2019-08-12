<?php

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
        'id'     =>  1,
        'nombre' => 'Solvente',
        'descripcion' => 'Persona que no posee deuda alguna'
        ]); 
        Estado::create([
        'id'     =>  2,
        'nombre' => 'Insolvente',
        'descripcion' => 'Persona que posee una deuda vigente'
        ]); 
        Estado::create([
        'id'     =>  3,
        'nombre' => 'Pagada',
        'descripcion' => 'Deuda saldada'
        ]);  
        Estado::create([
        'id'     =>  4,
        'nombre' => 'Vigente',
        'descripcion' => 'Deuda activa'
        ]);  
        Estado::create([
        'id'     =>  5,
        'nombre' => 'Activo',
        'descripcion' => 'Recurso activado'
        ]);   
        Estado::create([
        'id'     =>  6,
        'nombre' => 'Inactivo',
        'descripcion' => 'Recurso desactivado'
        ]);           
    }
}
