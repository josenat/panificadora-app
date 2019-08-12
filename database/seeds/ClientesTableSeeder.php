<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // por defecto creamos los siguientes registros
        Cliente::create([
	        'dni' => '22830966',
	        'nombre' => 'Jhonder',
	        'apellido' => 'Natera',
	        'direccion' => 'Distrito Comas, Ciudad de Lima',
	        'telefono' => '956582963',
	        'correo' => 'jhonder.natera@gmail.com',
            'estado_id' => 5 // activo	
        ]);  
          
        Cliente::create([
	        'dni' => '25841963',
	        'nombre' => 'Carlos',
	        'apellido' => 'Gutierrez',
	        'direccion' => 'Distrito Comas, Ciudad de Lima',
	        'telefono' => '911582963',
	        'correo' => 'carlos.gutierrez@gmail.com',
            'estado_id' => 5 // activo		
        ]);             
    }
}
