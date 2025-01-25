<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfis extends Model
{
    protected $fillabel = ['tipo_perfil'];

    function users(){
        return $this->hasMany(User::class);
    }
}
