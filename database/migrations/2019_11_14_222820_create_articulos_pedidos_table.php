<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos_pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('idArticulo');
            $table->foreign('idArticulo')->references('id')->on('articulos');
            $table->unsignedBigInteger('idPedido');
            $table->foreign('idPedido')->references('id')->on('pedidos');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulos_pedidos');
    }
}
