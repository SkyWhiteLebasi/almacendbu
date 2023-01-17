<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $cantidadproductos=DB::select('SELECT * from productos where stock>0 ');
        $count=count($cantidadproductos);

        $cantidadentradashoy=DB::select('SELECT * from entradas WHERE fecha_entrada=CURDATE()');
        $entradas=count($cantidadentradashoy);

        $cantidadsalidashoy=DB::select('SELECT * from salidas WHERE fecha_salida=CURDATE() AND contador_salida=1');
        $salidas=count($cantidadsalidashoy);

        $productospocos= DB::select('SELECT * from productos where stock<100');
        $num=count($productospocos);
                // SELECT * from entradas WHERE fecha_entrada=CURDATE()
        return view('dashboard', compact('count', 'entradas', 'salidas', 'num'));
    }
}
