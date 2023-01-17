<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Medida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:producto.index')->only('index');
        $this->middleware('can:producto.create')->only('create','create2','store');
        $this->middleware('can:producto.edit')->only('edit','update');
        $this->middleware('can:producto.destroy')->only('destroy');

    }
    public function index()
    {
  
        $datos['productos']=Producto::query()
        ->with('medida')
        ->with('categoria')
        ->when(request('search'), function($query){
            return $query->where('nombre_pr', 'like', '%' .request('search') . '%')
            ->orwhere('num_orden', 'like', '%' .request('search') . '%')
            ->orWhereHas('medida', function($q){
                $q->where('nombre_medida', 'like', '%' .request('search') . '%');
            })
            ->orWhereHas('categoria', function($q){
                $q->where('nombre_categoria', 'like', '%' .request('search') . '%');
            });
        })
        ->get()->sortDesc();
        $num=1;
 
        return view('producto.index',$datos, compact('num') );
    }

    public function pdf()
    {
  
        $productos=Producto::all();
        $num=1;
        $pdf = Pdf::loadView('producto.pdf', ['productos'=>$productos], compact('num'));

        return $pdf->stream();
    }
    
    public function create()
    {
        $categ=Categoria::all();
        $med=Medida::all();
        return view('producto.create', compact('categ', 'med'));
    }
    public function create2()
    {
       
        return view('producto.import-excel');
    }

    public function store(Request $request)
    {
        if($request->hasFile('import_file')){ //excel
            $file= $request->file('import_file');
            Excel::import(new ProductsImport, $file);
            // dd($file);
            return redirect()->route('producto.index')->with('success', 'Productos importados exitosamente');
        }
        

        $inv = request('inicial');
        $campos=[
            'num_orden' =>'required|string',
            'nombre_pr' =>'required|string',
            'foto' =>'nullable|max:10000|mimes:jpeg,png,jpg,jfif',
            'stock' =>'required|int',
            'inicial' =>'nullable|int',
            'desc_pr' =>'nullable|string',
            'medida_id' =>'required|string',
            'categoria_id' =>'required|string',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        

        $this->validate($request, $campos,$mensaje);

        $datosProducto = request()->except('_token'); //trae los datos excepto el token
        
        if($request->hasFile('foto')){ //ára traerme la foto
            $datosProducto['foto']=$request->file('foto')->store('uploads','public'); 
            $datosProducto['inicial']=$request->stock;
        }
        
        Producto::insert($datosProducto);
        
        return redirect('producto')->with('guardar', 'ok');
        // Alert::success('Success Title', 'Success Message');
    }

    public function show(Producto $producto)
    {
        return view('producto.add', compact('producto'));
    }

    
    public function edit($id)
    {
        $producto=Producto::findOrFail($id);
        $categ=Categoria::all();
        $med=Medida::all();

        return view('producto.edit', compact('producto', 'categ','med'));
    }

    public function add($id)
    {
        $producto=Producto::findOrFail($id);

        return view('producto.add', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $campos=[
            
            'num_orden' =>'required|string|max:100',
            'nombre_pr' =>'required|string|max:100',
            'stock' =>'required|int|max:100000',
            'desc_pr' =>'nullable|string',
            'medida_id' =>'required|string',
            'categoria_id' =>'required|string',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        if($request->hasFile('foto')){
             $campos=['foto' =>'required|max:10000|mimes:jpeg,png,jpg,jfif'];
             $mensaje=['foto.required'=>'La foto requerida'];
        }
        $this->validate($request, $campos,$mensaje);

        //
        $datosProducto = request()->except('_token','_method');//quitamos el token y metodo

        if($request->hasFile('foto')){ //ára traerme la foto
            $producto=Producto::findOrFail($id);
            Storage::delete('public/'.$producto->foto);
            $datosProducto['foto']=$request->file('foto')->store('uploads','public'); 
        }

        Producto::where('id','=',$id)->update($datosProducto);
        $producto=Producto::findOrFail($id);
        return redirect('producto')->with('editar', 'ok');
    }


    public function destroy($id)
    {
        // $producto=Producto::findOrFail($id);
        // if(Storage::delete('public/'.$producto->foto)){
            Producto::destroy($id);
        // }

        return redirect('producto')->with('eliminar', 'ok');
    }
}
