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

}
