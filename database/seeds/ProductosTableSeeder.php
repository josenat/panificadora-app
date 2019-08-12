<?php

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'categoria_id' => 1,
            'codigo'       => '',
            'nombre'       => 'PAN FRANCES',
            'precio'       => 0.125,
            'stock'        => 2400,         
        ]);
    }
}
