<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $guarded = [];  
    
    /*relacion uno a muchos (inversa)*/
    //varios productos pertenecen a una medida
    public function medida(){
        return $this->belongsTo('App\Models\Medida');
    }
    //varios productos pertenecen a una categoria
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

    //relacion uno a muchos
    public function pedidos(){
        return $this->hasMany('App\Models\Pedido');
    }

    //una entrada se encuentra en varios productos
    public function entradas(){
        return $this->hasMany('App\Models\Entrada');
    }

    //una salida se encuentra en varios productos
    public function salidas(){
        return $this->hasMany('App\Models\Salida');
    }
}
