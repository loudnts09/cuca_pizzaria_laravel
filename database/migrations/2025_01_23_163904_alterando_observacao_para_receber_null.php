<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterandoObservacaoParaReceberNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("itens_pedido", function (Blueprint $table){
            $table->dropColumn("observacao");
        });

        Schema::table("itens_pedido", function (Blueprint $table){
            $table->string("observacao")->nullable()->after("quantidade");
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

        Schema::create("itens_pedido", function (Blueprint $table){
        $table->dropColumn("observacao")->after("quantidade");            
        });
    }
}
