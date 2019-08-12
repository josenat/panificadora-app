<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadosTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(ModoPagosTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
    }
}
