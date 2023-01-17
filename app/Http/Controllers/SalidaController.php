<?php

namespace App\Http\Controllers;

use App\Imports\SalidasImport;
use App\Imports\Salidas2Import;
use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SalidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:salida.index')->only('index');
        // $this->middleware('can:salida.create')->only('create','importalmacen','store');
        // $this->middleware('can:salida.edit')->only('edit','edit2','update');
        $this->middleware('can:salida.show')->only('show');
        // // $this->middleware('can:salida.nutricion')->only('nutri');
        // $this->middleware('can:salida.nutri')->only('nutricion');
        // $this->middleware('can:salida.salidadiaria')->only('create2','store');
        // $this->middleware('can:salida.salida.create3')->only('import-excel','store');
        // $this->middleware('can:salida.pdf_nutricion')->only('pdf_nutricion');
        $this->middleware('can:salida.destroy')->only('destroy');

    }
    public function index()
    {

        $datos['salidas']=Salida::query()
        ->with('producto')
        ->whereraw('contador_salida=1')
        ->when(request('search'), function($query){
            return $query->where('nombre_pr', 'like', '%' .request('search') . '%')
            ->orwhere('num_orden', 'like', '%' .request('search') . '%');
        })
        ->get()->sortDesc();
        $num=1;
        return view('salida.index', $datos,compact('num'));
    }
    public function pdf()
    {
        $salidas= DB::select('SELECT salidas.id, productos.nombre_pr, salidas.cant_salida_val, salidas.fecha_salida, salidas.contador_salida, salidas.obs_salida from salidas
        INNER JOIN productos ON salidas.producto_id =productos.id
         WHERE salidas.contador_salida=1');
        $pdf = Pdf::loadView('salida.pdf', ['salidas'=>$salidas]);
        return $pdf->stream();
    }
    public function pdf_nutricion()
    {
        $nutricion= DB::select('SELECT salidas.id, productos.nombre_pr, salidas.cant_salida, salidas.fecha_salida, salidas.contador_salida, salidas.obs_salida from salidas
        INNER JOIN productos ON salidas.producto_id =productos.id
         WHERE salidas.contador_salida=0');


        $pdf = Pdf::loadView('salida.pdf_nutricion', ['nutricion'=>$nutricion]);
        return $pdf->stream();
    }

    public function nutri()
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
        return view('salida.nutricion', $datos,compact('num'));
    }

    public function create()
    {
        $produc=Producto::all();
        
        return view('salida.create', compact('produc'));
    }

    public function create2()
    {
        $produc=Producto::all(); 
        return view('salida.salidadiaria', compact('produc'));
    }

    public function create3()
    {
        return view('salida.import-excel');
    }
    public function importalmacen()
    {
        return view('salida.import-excel-alm');
    }

    public function store(Request $request)
    {
        if($request->hasFile('import_file')){ 
            $file= $request->file('import_file');
            Excel::import(new SalidasImport, $file);
            return redirect()->route('salida.nutricion')->with('success', 'salidas importados exitosamente');
        }

        if($request->hasFile('import_file_alm')){ 
            $file= $request->file('import_file_alm');
            Excel::import(new Salidas2Import, $file);
            return redirect()->route('salida.index')->with('success', 'salidas importados exitosamente');
        }

        $campos=[
            'producto_id' =>'required|integer',
            'cant_salida_val' =>'required|integer',
            'obs_salida' =>'nullable|string|max:100000',
            'fecha_salida' =>'required',
            'contador_salida ' =>'nullable|string|max:100000',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $datosSalida = request()->except('_token'); //trae los datos excepto el token
        $validadorSalida = request('contador_salida');
        $sal=request('cant_salida_val');
        $sales=request('cant_salida');
        $stockeado=request('producto_id');
        $product=Producto::FindOrFail($stockeado);
        if($product->stock>=$sales){
            $datosSalida['cant_salida_val']=$request->cant_salida;
        }
        // $stockeado=request('producto_id');
        // $product=Producto::FindOrFail($stockeado);
        $resta=0;
        $resta= $product->stock - $sales;
        if($validadorSalida==1 && $resta>=0){
            $product->stock =$resta;
            $product->save();  
             
        }
        Salida::insert($datosSalida); 
        
        $sed = DB::statement('SELECT producto_id FROM salidas;');
        if($validadorSalida==1){
            return redirect('salida')->with('guardar', 'ok');
        }else{
            return redirect('salida/nutricion')->with('guardar', 'ok');
        }
        
    }

    public function show()
    {
        
        $salidas= Salida::query()
            ->with('producto')
            ->select(DB::raw('count(*) as mira , producto_id'))
            // ->where('producto_id', '<>', 1)
            ->whereRaw('contador_salida=1')
            ->groupBy('producto_id')
            ->get()->sortDesc();
        $num=1;

        return view('salida.show', compact('salidas','num'));
    }

    public function edit($id)
    {
        $salida=Salida::findOrFail($id);
        $produc=Producto::all();
        
        return view('salida.edit', compact('salida', 'produc'));
    }
    public function editdos($id)
    {
        $salida=Salida::findOrFail($id);
        $produc=Producto::all();
        
        return view('salida.editdos', compact('salida', 'produc'));
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
        // $datosSalida = request()->except('_token'); //trae los datos excepto el token
        $nuevo=request('cant_salida_val');
        $sales=request('cant_salida');
        $temp=0;
        $validadorSalida = request('contador_salida');
        if($validadorSalida==1 && $sales>$nuevo){ //ára traerme la foto
            $temp=$sales-$nuevo;
            $datosSalida['cant_salida_val']=$request->cant_salida_val + $temp;
        }else if($validadorSalida==1 && $sales<$nuevo){ //ára traerme la foto
            $temp=$sales-$nuevo;
            $datosSalida['cant_salida_val']=$request->cant_salida_val + $temp;
        }

        $stockeado=request('producto_id');
        $product=Producto::FindOrFail($stockeado);
        $resta=0;
        $resta= $product->stock - $temp;
        if($validadorSalida==1 && $resta>=0 ){
            $product->stock=$resta;
            $product->save();  
             
        }

        Salida::where('id','=',$id)->update($datosSalida);

        return redirect('salida')->with('editar', 'ok');
    }

    public function destroy($id)
    {

        $you=Salida::find($id);
        $me=Producto::find($you->producto_id);
        $stock= $me->stock + $you->cant_salida_val;
        $me->stock=$stock;
        $me->save();  
        Salida::destroy($id);
        // dd($me);
        return redirect('salida/nutricion')->with('eliminar', 'ok');
    }

}
