<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AdicionandodColunasNaTabelaUsersEApagandoTabelaPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("users", function (Blueprint $table){
            $table->string("foto")->nullable()->after("id");
            $table->string("cpf")->after("remember_token");
            $table->string("telefone")->after("cpf");
            $table->unsignedBigInteger("perfil_id")->after("telefone");
            $table->foreign("perfil_id")->references("id")->on("perfis")->onDelete("cascade");
        });




        Schema::table("pedidos", function (Blueprint $table){
            $table->dropForeign(["pessoa_id"]);
        });
           
        DB::statement("ALTER TABLE pedidos CHANGE pessoa_id user_id BIGINT UNSIGNED");
        
        Schema::table("pedidos", function (Blueprint $table){
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });

        Schema::dropIfExists("pessoas");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("users", function (Blueprint $table){
            $table->dropForeign(["perfil_id"]);
            $table->dropColumn("foto", "cpf", "telefone", "perfil_id");
        });

        Schema::create("pessoas", function(Blueprint $table){
            $table->id();
            $table->string("foto")->nullable();
            $table->string("nome");
            $table->string("email")->unique();
            $table->string("senha");
            $table->string("cpf");
            $table->string("telefone");
            $table->bigInteger("perfil_id");
            $table->foreign("perfil_id")->references("id")->on("perfis")->onDelete("cascade");
        });

        Schema::table("pedidos", function (Blueprint $table){
            $table->unsignedBigInteger("pessoa_id");
            $table->foreign("pessoa_id")->references("id")->on("pessoas")->onDelete("cascade");
        });

        DB::statement("ALTER TABLE pedidos CHANGE user_id pessoa_id BIGINT UNSIGNED");
    }
}
