<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\FormasPagoController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CarritoController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth'])->group(function(){ 
    
Route::get('/facturas/buscar', 'FacturasController@buscar')->name('facturas.buscar');

Route::resource('perfiles', PerfilesController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('facturas', FacturasController::class);
Route::resource('formaspago', FormasPagoController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('carrito', ['as' => 'carrito', 'uses' => 'App\Http\Controllers\CarritoController@show']);
Route::get('carrito/agregar/{id}', ['as' => 'carrito-agregar', 'uses' => 'App\Http\Controllers\CarritoController@add']);
Route::get('carrito', [CarritoController::class, 'show'])->name('carrito.index');
Route::get('carrito/borrar/{id}', ['as' => 'carrito-borrar', 'uses' => 'App\Http\Controllers\CarritoController@delete']);
Route::get('carrito/vaciar', ['as' => 'carrito-vaciar', 'uses' => 'App\Http\Controllers\CarritoController@trash']);
Route::get('carrito/actualizar/{id}/{cantidad?}', ['as' => 'carrito-actualizar', 'uses' => 'App\Http\Controllers\CarritoController@update']);
Route::get('ordenar', ['as' => 'ordenar', 'uses' => 'App\Http\Controllers\CarritoController@guardarPedido']);
Route::resource('productos', ProductosController::class);   

