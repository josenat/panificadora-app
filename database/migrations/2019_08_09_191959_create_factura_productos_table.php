<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturaProductosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->double('precio')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('factura_id')->references('id')->on('facturas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')
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
        Schema::drop('factura_productos');
    }
}
