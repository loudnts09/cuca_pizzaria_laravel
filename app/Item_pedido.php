<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_pedido extends Model
{
    protected $table = "itens_pedido";

    protected $fillabel = ['pedido_id', 'tamanho', 'sabor_id', 'quantidade'];

    function pedido(){
        return $this->belongsTo(Pedido::class);
    }

    function sabor(){
        return $this->belongsTo(Sabor::class);
    }
}
