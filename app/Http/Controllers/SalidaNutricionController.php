<?php

namespace App\Http\Controllers;

use App\Imports\SalidasImport;
// use App\Imports\Salidas2Import;
use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SalidaNutricionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:salidanutricion.index')->only('index');
        $this->middleware('can:salidanutricion.create')->only('create','importexcel','store');
        $this->middleware('can:salidanutricion.edit')->only('edit','update');
        // $this->middleware('can:salida.show')->only('show');
        // // // $this->middleware('can:salida.nutricion')->only('nutri');
        // // $this->middleware('can:salida.nutri')->only('nutricion');
        // // $this->middleware('can:salida.salidadiaria')->only('create2','store');
        // // $this->middleware('can:salida.salida.create3')->only('import-excel','store');
        // // $this->middleware('can:salida.pdf_nutricion')->only('pdf_nutricion');
        $this->middleware('can:salidanutricion.destroy')->only('destroy');

    }
    public function index()
    {

        $datos['nutricion']=Salida::query()
        ->with('producto')
        ->whereraw('contador_salida=0')
        ->when(request('search'), function($query){
            return $query->where('nombre_pr', 'like', '%' .request('search') . '%')
            ->orwhere('num_orden', 'like', '%' .request('search') . '%');
        })
        ->get()->sortDesc();
        $num=1;
        return view('salidanutricion.index', $datos,compact('num'));
    }

    // public function pdf_nutricion()
    // {
    //     $nutricion= DB::select('SELECT salidas.id, productos.nombre_pr, salidas.cant_salida, salidas.fecha_salida, salidas.contador_salida, salidas.obs_salida from salidas
    //     INNER JOIN productos ON salidas.producto_id =productos.id
    //      WHERE salidas.contador_salida=0');


    //     $pdf = Pdf::loadView('salidanutricion.pdf_nutricion', ['nutricion'=>$nutricion]);
    //     return $pdf->stream();
    // }

    public function create()
    {
        $produc=Producto::all(); 
        return view('salidanutricion.create', compact('produc'));
    }

    public function importexcel()
    {
        return view('salidanutricion.import-excel');
    }
   

    public function store(Request $request)
    {
        if($request->hasFile('import_file')){ 
            $file= $request->file('import_file');
            Excel::import(new SalidasImport, $file);
            return redirect()->route('salida.nutricion')->with('success', 'salidas importados exitosamente');
        }

        $campos=[
            'producto_id' =>'required|integer',
            'cant_salida' =>'required|integer',
            'obs_salida' =>'nullable|string|max:100000',
            'fecha_salida' =>'required',
            'contador_salida ' =>'nullable|string|max:100000',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $datosSalida = request()->except('_token'); //trae los datos excepto el token
       
        Salida::insert($datosSalida); 
        
       
        return redirect('salidanutricion')->with('guardar', 'ok');
        
        
    }



    public function edit($id)
    {
        $salida=Salida::findOrFail($id);
        $produc=Producto::all();
        
        return view('salidanutricion.edit', compact('salida', 'produc'));
    }

    public function update(Request $request, $id)
    {
        $campos=[
            'producto_id' =>'required|integer',
            'cant_salida' =>'required|integer',
            'obs_salida' =>'nullable|string|max:100000',
            'fecha_salida' =>'required|string',
            'contador_salida' =>'nullable|string',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);
        $datosSalida = request()->except('_token','_method');//quitamos el token y metodo

        Salida::where('id','=',$id)->update($datosSalida);

        return redirect('salidanutricion')->with('editar', 'ok');
    }

    public function destroy($id)
    {
        Salida::destroy($id);
        return redirect('salidanutricion')->with('eliminar', 'ok');
    }
}
