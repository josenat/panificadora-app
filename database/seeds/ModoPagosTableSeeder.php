<?php

use Illuminate\Database\Seeder;
use App\Models\ModoPago;

class ModoPagosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModoPago::create([
        	'nombre' => 'CAJA'
        ]);
        ModoPago::create([
        	'nombre' => 'PAGO'
        ]);        
    }
}
