<?php

namespace App\Http\Controllers;

use App\Models\Medida;
use Illuminate\Http\Request;

class MedidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:medida.create')->only('create','store');
        $this->middleware('can:medida.destroy')->only('destroy');

    }
    public function index()
    {
        $datos['medidas']=Medida::all()->sortDesc();
        return view('medida.index',$datos );
    }

    public function create()
    {
        return view('medida.create');
    }

    public function store(Request $request)
    {
        $campos=[
            'nombre_medida' =>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);
        $datosMedida = request()->except('_token'); //trae los datos excepto el token

        
        Medida::insert($datosMedida);
        return redirect('medida')->with('guardar', 'ok');
    }

    
    public function show(Medida $medida)
    {
        //
    }

    public function edit(Medida $medida)
    {
        //
    }

    
    public function update(Request $request, Medida $medida)
    {
        //
    }

    
    public function destroy($id)
    {
        Medida::destroy($id);
        return redirect('medida')->with('eliminar', 'ok');
    }
}
