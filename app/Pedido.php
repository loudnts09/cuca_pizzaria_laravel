<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'observacao', 'status_pedido'];

    protected $date;

    function user(){
        return $this->belongsTo(User::class);
    }

    function item_pedido(){
        return $this->hasMany(Item_pedido::class);
    }
}
