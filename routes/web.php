<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\SemanaController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\SalidaNutricionController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('can:home')->name('home');

Route::resource('user', UserController::class)->middleware('auth')->names('user');

Route::get('/producto/pdf',[ProductoController::class, 'pdf'])->name('producto.pdf');

Route::get('/producto/import-excel',[ProductoController::class, 'create2'])->name('producto.import-excel');

Route::resource('producto', ProductoController::class)->middleware('auth')->names('producto');

Route::get('/pedido/pdf',[PedidoController::class, 'pdf'])->name('pedido.pdf');

Route::get('/pedido/import-excel',[PedidoController::class, 'create2'])->name('pedido.import-excel');

Route::resource('pedido', PedidoController::class)->middleware('auth')->names('pedido');

Route::resource('semana', SemanaController::class)->middleware('auth')->names('semana');

Route::get('/entrada/import-excel',[EntradaController::class, 'importentrada'])->name('entrada.import-excel');

Route::get('/entrada/pdf',[EntradaController::class, 'pdf'])->name('entrada.pdf');
Route::get('/entrada/show',[EntradaController::class, 'show'])->name('entrada.show');
Route::resource('entrada', EntradaController::class)->middleware('auth')->except('show')->names('entrada');

Route::get('/salida/import-excel-alm',[SalidaController::class, 'importalmacen'])->name('salida.import-excel-alm');
Route::get('/salida/{id}/editdos',[SalidaController::class, 'editdos'])->name('salida.editdos');
// Route::get('/salida/import-excel',[SalidaController::class, 'create3'])->name('salida.import-excel');
Route::get('/salida/pdf',[SalidaController::class, 'pdf'])->name('salida.pdf');
Route::get('/salida/pdf_nutricion',[SalidaController::class, 'pdf_nutricion'])->name('salida.pdf_nutricion');
Route::get('/salida/nutricion',[SalidaController::class, 'nutri'])->name('salida.nutricion');
// Route::get('/salida/salidadiaria',[SalidaController::class, 'create2'])->name('salida.salidadiaria');
Route::get('/salida/show',[SalidaController::class, 'show'])->name('salida.show');
Route::resource('salida', SalidaController::class)->middleware('auth')->except('show')->names('salida');

Route::get('/salidanutricion/pdf_nutricion',[SalidaNutricionController::class, 'pdf_nutricion'])->name('salidanutricion.pdf_nutricion');
Route::get('/salidanutricion/import-excel',[SalidaNutricionController::class, 'importexcel'])->name('salidanutricion.import-excel');
Route::resource('salidanutricion', SalidaNutricionController::class)->middleware('auth')->except('show')->names('salidanutricion');

Route::resource('medida', MedidaController::class)->middleware('auth')->names('medida');

Route::resource('categoria', CategoriaController::class)->middleware('auth')->names('categoria');

Route::get('/kardex', [App\Http\Controllers\KardexController::class, 'index'])->name('kardex.index');