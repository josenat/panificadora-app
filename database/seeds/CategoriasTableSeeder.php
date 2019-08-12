<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // por defecto creamos los siguientes registros
        Categoria::create([
        	'nombre'      => 'PAN',
			'descripcion' => 'El pan es un alimento básico que forma parte de la dieta tradicional en Europa, Medio Oriente, India, América y Oceanía. Se suele preparar mediante el horneado de una masa, elaborada fundamentalmente con harina de cereales, sal y agua.'				
        ]);
    }
}
