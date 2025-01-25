<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sabor extends Model
{
    protected $table = 'sabores';

    function item_pedido(){
        return $this->HasMany(Item_pedido::class);
    }
}
