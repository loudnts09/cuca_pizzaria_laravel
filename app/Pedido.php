<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'tamanho', 'sabor', 'observacao', 'status_pedido'];

    protected $date;

    function user(){
        return $this->belongsTo(User::class);
    }
}
