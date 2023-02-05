<?php

namespace App\Http\Controllers;

use App\Models\Semana;
use Illuminate\Http\Request;

class SemanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:semana.index')->only('index');
        $this->middleware('can:semana.create')->only('create','store');
        $this->middleware('can:semana.destroy')->only('destroy');

    }
    public function index()
    {
        //
        $datos['semanas']=Semana::all()->sortDesc();
        $num=1;
        return view('semana.index',$datos, compact('num') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('semana.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'nombre_semana' =>'required|string|max:100',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);
        $datosSemana = request()->except('_token'); //trae los datos excepto el token

        
        Semana::insert($datosSemana);
        return redirect('semana')->with('guardar', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semana  $semana
     * @return \Illuminate\Http\Response
     */
    public function show(Semana $semana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semana  $semana
     * @return \Illuminate\Http\Response
     */
    public function edit(Semana $semana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semana  $semana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semana $semana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semana  $semana
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Semana::destroy($id);
        return redirect('semana')->with('eliminar', 'ok');
    }
}
