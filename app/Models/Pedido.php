<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $guarded = []; 
     
    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }
    public function semana(){
        return $this->belongsTo('App\Models\Semana');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function medida(){
        return $this->belongsTo('App\Models\Medida');
    }
}
