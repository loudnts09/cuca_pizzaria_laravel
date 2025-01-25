<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterandoColunaSaborParachaveEstrangeiraParaTabelaSabores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("pedidos", function (Blueprint $table){
            $table->unsignedBigInteger('sabor_id')->nullable()->after('tamanho');
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
        Schema::table("pedidos", function (Blueprint $table){
            $table->dropForeign(["sabor_id"]);
            $table->dropColumn("sabor_id");
        });
    }
}
