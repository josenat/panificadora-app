<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoClientesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create or replace view estado_clientes_v as select cli.id AS id,cli.dni AS dni,cli.nombre AS nombre,cli.apellido AS apellido,cli.telefono AS telefono,cli.correo AS correo,case when (select deu.monto from panaderia_db.deudas deu where cli.dni = deu.cliente_dni and deu.estado_id = 4 and deu.deleted_at is null) > 0 then (select panaderia_db.estados.nombre from panaderia_db.estados where panaderia_db.estados.id = 2) else (select panaderia_db.estados.nombre from panaderia_db.estados where panaderia_db.estados.id = 1) end AS estado,(select deu.monto from panaderia_db.deudas deu where cli.dni = deu.cliente_dni and deu.estado_id = 4 and deu.deleted_at is null) AS deuda from (panaderia_db.clientes cli left join panaderia_db.estados est on(cli.estado_id = est.id)) where cli.deleted_at is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW estado_clientes_v");
    }
}
