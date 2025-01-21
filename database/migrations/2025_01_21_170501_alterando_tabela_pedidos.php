<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterandoTabelaPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("pedidos", function (Blueprint $table) {
            $table->dropColumn("tamanho");
            $table->dropForeign(['sabor_id']);
            $table->dropColumn("sabor_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("pedidos", function (Blueprint $table) {
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->string("tamanho");
        });
    }
}
