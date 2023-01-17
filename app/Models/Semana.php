<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semana extends Model
{
    use HasFactory;
    //relacion uno a muchos
    public function pedidos(){
        return $this->hasMany('App\Models\Pedido');
    }
}
