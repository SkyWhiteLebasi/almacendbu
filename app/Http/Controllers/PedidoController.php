<?php

namespace App\Http\Controllers;

use App\Imports\PedidosImport;
use App\Models\Pedido;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\User;
use App\Models\Semana;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pedido.index')->only('index');
        $this->middleware('can:pedido.create')->only('create','create2','store');
        $this->middleware('can:pedido.edit')->only('edit','update');
        $this->middleware('can:pedido.pdf')->only('pdf');
        $this->middleware('can:pedido.destroy')->only('destroy');

    }
    public function index()
    {
        $datos['pedidos']=Pedido::all()->sortDesc();
        $med=Medida::all();
        $produc=Producto::all();
        $semana=Semana::all();
        $num=1;
        return view('pedido.index',$datos, compact('med', 'produc','semana', 'num') );
    }

    public function pdf()
    {
  
        $pedidos=Pedido::all();
        
        
        $pdf = Pdf::loadView('pedido.pdf', ['pedidos'=>$pedidos]);
        

        return $pdf->stream();
    }

    public function create()
    {
        $med=Medida::all();
        $produc=Producto::all();
        $semana=Semana::all();
        return view('pedido.create', compact('med', 'produc','semana'));
    }

    public function create2()
    {
        return view('pedido.import-excel');
    }

    public function store(Request $request)
    {
        if($request->hasFile('import_file')){ //ára traerme la foto
            $file= $request->file('import_file');
            Excel::import(new PedidosImport, $file);
            return redirect()->route('pedido.index')->with('guardar', 'ok');
        }

        $campos=[
            'primera_entrega' =>'nullable|string|max:100000',
            'segunda_entrega' =>'nullable|string|max:100000',
            'total_entrega' =>'required',
            'producto_id' =>'required|string',
            'medida_id' =>'required|string',
            'semana_id' =>'required',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        $this->validate($request, $campos,$mensaje);

        $datosPedido = request()->except('_token'); //trae los datos excepto el token

        
        Pedido::insert($datosPedido);
        return redirect('pedido')->with('guardar', 'ok');
    }

    public function show(Pedido $pedido)
    {
        
    }

    
    public function edit($id)
    {
        $pedido=Pedido::findOrFail($id);
        $semana=Semana::all();
        $produc=Producto::all();
        $med=Medida::all();
        
        return view('pedido.edit', compact('pedido', 'semana','produc','med'));
    }

   
    public function update(Request $request, $id)
    {
        $campos=[
            'primera_entrega' =>'required|string|max:100000',
            'segunda_entrega' =>'required|string|max:100000',
            'total_entrega ' =>'nullable|string|max:100000',
            'producto_id' =>'required|string',
            'medida_id' =>'required|string',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];
        if($request->hasFile('foto')){
            $campos=['foto' =>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['foto.required'=>'La foto requerida'];
       }
       $this->validate($request, $campos,$mensaje);

       $datosPedido = request()->except('_token','_method');//quitamos el token y metodo


       Pedido::where('id','=',$id)->update($datosPedido);
       $pedido=Pedido::findOrFail($id);

       return redirect('pedido')->with('editar', 'ok');

    }

 
    public function destroy($id)
    {
        Pedido::destroy($id);
        return redirect('pedido')->with('eliminar', 'ok');
    }
}
