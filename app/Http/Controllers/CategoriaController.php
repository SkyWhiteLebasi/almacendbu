<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categoria.create')->only('create','store');
        $this->middleware('can:categoria.destroy')->only('destroy');

    }

    public function index()
    {
        $datos['categorias']=Categoria::all()->sortDesc();;
        $num=1;
        return view('categoria.index',$datos,compact('num'));
    }

   
    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $campos=[
            'nombre_categoria' =>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);
        $datosCategoria = request()->except('_token'); //trae los datos excepto el token

        
        Categoria::insert($datosCategoria);
        return redirect('categoria')->with('guardar', 'ok');
    }

    public function show(Categoria $categoria)
    {
        //
    }

   
    public function edit(Categoria $categoria)
    {
        //
    }

   
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect('categoria')->with('eliminar', 'ok');
    }
}
