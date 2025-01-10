<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillabel = [$pessoa_id, $tamanho, $sabor, $observacao, $status_pedido];

    function pessoa(){
        return $this->belongsTo(User::class);
    }
}
