<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaClientesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create or replace view cuenta_clientes_v as select fact.id AS id,fact.fecha AS fecha,cli.dni AS dni,cli.nombre AS cliente,pro.nombre AS producto,fac.cantidad AS cantidad,fac.cantidad * fac.precio AS costo,pag.monto AS importe,modo.nombre AS modo,fact.deuda AS deuda from (((((panaderia_db.clientes cli join panaderia_db.facturas fact on(cli.id = fact.cliente_id)) join panaderia_db.factura_productos fac on(fact.id = fac.factura_id)) join panaderia_db.productos pro on(fac.producto_id = pro.id)) left join panaderia_db.pagos pag on(fact.id = pag.factura_id)) left join panaderia_db.modo_pagos modo on(pag.modo_pago_id = modo.id)) where fact.deleted_at is null");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW cuenta_clientes_v");
    }
}
