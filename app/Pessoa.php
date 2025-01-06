<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillabel = [$foto, $nome, $email, $senha, $cpf, $telefone, $perfil_id];

    function perfis(){
        return $this->belongsTo(Perfis::class);
    }

    function pedidos(){
        return $this->hasMany(Pedido::class);
    }

}
