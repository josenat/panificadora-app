<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeudasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deudas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->double('monto')->unsigned();
            $table->string('cliente_dni')->unique();
            $table->integer('estado_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_dni')->references('dni')->on('clientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('estado_id')->references('id')->on('estados')
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
        Schema::drop('deudas');
    }
}
