<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;
    protected $guarded = []; 
    //varias entradas tienen un producto
    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
}
