<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos=DB::select('SELECT P.id, P.num_orden, P.nombre_pr, P.medida_id, P.inicial,
        IFNULL(E.total_entradas, 0) entradas,
        IFNULL(S.total_salidas, 0) salidas,
        P.stock 
        FROM productos P
        LEFT JOIN
        (SELECT producto_id, SUM(cant_entrada_val) total_entradas FROM entradas
        GROUP BY producto_id) E
        ON P.id = E.producto_id
        LEFT JOIN
        (SELECT producto_id, SUM(cant_salida_val) total_salidas FROM salidas
         GROUP BY producto_id) S
         ON P.id = S.producto_id;
        ');
        $entradas=DB::select('SELECT * from entradas ');
        // $datos['productos']=Producto::paginate(10);
        // $datas['categoria']=Categoria::all();
        // return view('producto.index',$datos );

        // $productos= DB::select('SELECT productos.id, productos.nombre_pr, productos.num_orden, productos.stock , COUNT(entradas.id) as mira from entradas
        // INNER JOIN productos ON entradas.producto_id =productos.id
        //  GROUP BY producto_id');

        // dd($productos);

        return view('kardex.index', compact('productos'));
    }

    public function entradashoy(){
        $entradashoy=DB::select('SELECT productos.num_orden, productos.nombre_pr, entradas.cant_entrada_val,  entradas.obs_entrada from entradas
        INNER JOIN productos ON entradas.producto_id =productos.id WHERE entradas.fecha_entrada=CURDATE()');
        $num=1;
        return view('kardex.entradashoy', compact('entradashoy', 'num'));
    }

    public function salidashoy(){
        $salidashoy=DB::select('SELECT productos.num_orden, productos.nombre_pr, salidas.cant_salida_val,  salidas.obs_salida from salidas
        INNER JOIN productos ON salidas.producto_id =productos.id WHERE salidas.fecha_salida=CURDATE()');
        $num=1;
        // dd($salidashoy);
        return view('kardex.salidashoy', compact('salidashoy', 'num'));
    }

    public function pocostock(){

        $pocos=DB::select('SELECT productos.num_orden, productos.nombre_pr, medidas.nombre_medida, categorias.nombre_categoria, productos.stock from productos
        INNER JOIN medidas ON productos.medida_id =medidas.id
        INNER JOIN categorias ON productos.categoria_id =categorias.id
        WHERE stock<100');
        $num=1;
        
        return view('kardex.pocostock', compact('pocos', 'num'));
        
    }

}
