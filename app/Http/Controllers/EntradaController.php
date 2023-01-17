<?php

namespace App\Http\Controllers;

use App\Imports\EntradasImport;
use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class EntradaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:entrada.index')->only('index');
        $this->middleware('can:entrada.create')->only('create','importentrada','store');
        $this->middleware('can:entrada.edit')->only('edit','update');
        $this->middleware('can:entrada.show')->only('show');
        $this->middleware('can:entrada.pdf')->only('pdf');
        $this->middleware('can:entrada.destroy')->only('destroy');

    }
    public function index()
    {
        $datos['entradas']=Entrada::all()->sortDesc();
        $num=1;

        return view('entrada.index',$datos, compact('num') );
    }

    public function pdf()
    {
        $entradas=Entrada::all();
        $pdf = Pdf::loadView('entrada.pdf', ['entradas'=>$entradas]);
        return $pdf->stream();
    }

    public function create()
    {
        $produc=Producto::all();
        
        return view('entrada.create', compact('produc'));

    }

    public function importentrada()
    {
        return view('entrada.import-excel');
    }

    public function store(Request $request)
    {
        if($request->hasFile('import_file')){ 
            $file= $request->file('import_file');
            Excel::import(new EntradasImport, $file);
            return redirect()->route('entrada.index')->with('success', 'entradas importadas exitosamente');
            
        }
        $campos=[
            'producto_id' =>'required|integer',
            'cant_entrada_val' =>'required|integer',
            'obs_entrada' =>'nullable|string|max:100000',
            'fecha_entrada' =>'required',
            'validador' =>'nullable',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $datosEntrada = request()->except('_token'); //trae los datos excepto el token

        $entras=request('cant_entrada_val');
        $stockeado=request('producto_id');
        $product=Producto::FindOrFail($stockeado);
        $suma=0;
        $suma= $product->stock+$entras;
        $product->stock =$suma;
        $product->save();
        
        Entrada::insert($datosEntrada);
        
        return redirect('entrada')->with('guardar', 'ok');

    }

    
    public function show()
    {
        $consulta= Entrada::query()
            ->with('producto')
            ->select(DB::raw('count(*) as mira , producto_id'))
            // ->whereRaw('validador=0')
            ->groupBy('producto_id')
            ->get()->sortDesc();
        $num=1;

        return view('entrada.show', compact('consulta', 'num'));
    }

    public function edit($id)
    {
        $entrada=Entrada::findOrFail($id);
        $produc=Producto::all();
        
        return view('entrada.edit', compact('entrada', 'produc'));
    }

    public function update(Request $request, $id)
    {
        $campos=[
            'producto_id' =>'required|integer',
            'cant_entrada' =>'required|integer',
            'obs_entrada' =>'nullable|string|max:100000',
            'fecha_entrada' =>'nullable|string|max:100000',
            'validador' =>'nullable|string|max:100000',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);
        $datosEntrada = request()->except('_token','_method');//quitamos el token y metodo
        $nuevo=request('cant_entrada_val');
        $entras=request('cant_entrada');
        $temp=0;
        if($entras>$nuevo){ //ára traerme la foto
            $temp=$entras-$nuevo;
            $datosEntrada['cant_entrada_val']=$request->cant_entrada_val + $temp;
        }else if($entras<$nuevo){ //ára traerme la foto
            $temp=$entras-$nuevo;
            $datosEntrada['cant_entrada_val']=$request->cant_entrada_val + $temp;
        }

        $stockeado=request('producto_id');
        $product=Producto::FindOrFail($stockeado);
        $suma=0;
        $suma= $product->stock+$temp;
        $product->stock =$suma;
        $product->save();

        Entrada::where('id','=',$id)->update($datosEntrada);

        return redirect('entrada')->with('editar', 'ok');
        
    }

    public function destroy($id)
    {
        $you=Entrada::find($id);
        $me=Producto::find($you->producto_id);
        $stock= $me->stock - $you->cant_entrada_val;
        // if($me->stock >= $stock){
            $me->stock=$stock;
            $me->save();  
        // }
       
        Entrada::destroy($id);
        return redirect('entrada')->with('eliminar', 'ok');
    }
}
