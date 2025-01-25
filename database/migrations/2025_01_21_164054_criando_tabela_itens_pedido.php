<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaItensPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('sabor_id');
            $table->enum('tamanho', ['pequena', 'media', 'grande', 'familia']);
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('sabor_id')->references('id')->on('sabores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itens_pedido', function (Blueprint $table) {
            $table->dropForeign(['pedido_id']);
            $table->dropForeign(['sabor_id']);
        });

        Schema::dropIfExists('itens_pedido');
    }
}
