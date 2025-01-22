<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionandoObservacaoEmItemPedidoERetirandoDePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("itens_pedido", function (Blueprint $table){
            $table->string("observacao")->after("quantidade");
        });

        Schema::table("pedidos", function (Blueprint $table){
            $table->dropColumn("observacao");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("itens_pedido", function (Blueprint $table){
            $table->dropColumn("observacao");
        });

        Schema::table("pedidos", function (Blueprint $table){
            $table->string("observacao")->after("user_id");
        });
    }
}
