<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('modo_pago_id')->unsigned();
            $table->double('monto')->unsigned();
            $table->string('observacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('factura_id')->references('id')->on('facturas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('modo_pago_id')->references('id')->on('modo_pagos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagos');
    }
}
