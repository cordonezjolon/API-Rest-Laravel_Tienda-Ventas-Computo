<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AtributoController;
use App\Http\Controllers\AtributoProductoController;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\RolPantallaController;
use App\Http\Controllers\RolUsuarioController;
use App\Http\Controllers\PantallaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\TipoPagoController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Producto
Route::get('producto',[ProductoController::class,'index']);
Route::get('producto/{productoid}',[ProductoController::class,'show']);
Route::get('producto/{productoid}/categoria',[ProductoController::class,'CategoriasProducto']);
Route::get('producto/{productoid}/atributo',[ProductoController::class,'AtributosProducto']);
Route::get('producto/categoria/{categoriaid}',[ProductoController::class,'indexCategoria']);
Route::post('producto',[ProductoController::class,'store']);

//Autenticacion 
Route::post('register', [UsuarioController::class,'register']);
Route::post('login', [UsuarioController::class,'authenticate']);
Route::get('categoria',[CategoriaController::class,'indexActivo']);
Route::get('inventario/producto/{productoid}',[InventarioController::class,'existenciaProducto']);
Route::get('inventario/tienda/{tiendaid}',[InventarioController::class,'existenciaProducto']);
//Route::get('producto',[ProductoController::class,'index']);

//Fin Autenticacion 

   Route::get('showbyemail/{email}', [UsuarioController::class,'showbyemail']);
//Middleware para usuarios autorizados JWT API
Route::group(['middleware' => ['jwt.verify']], function() {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::post('autenticateduser', [UsuarioController::class,'getAuthenticatedUser']);
 
    
//Rutas Usuario
Route::put('user/{usuario}', [UsuarioController::class,'update']);
Route::get('user/{usuario}', [UsuarioController::class,'show']);
Route::get('user', [UsuarioController::class,'index']);
Route::post('user',[UsuarioController::class,'store']);
Route::delete('user/{usuario}',[ProductoController::class,'destroy']);

//Fin Usaurio

//Rutas transaccionales
//Producto
Route::post('producto',[ProductoController::class,'store']);
Route::put('producto/{productoid}',[ProductoController::class,'update']);
Route::delete('producto/{productoid}',[ProductoController::class,'destroy']);

//Departamento
Route::get('departamento/all',[DepartamentoController::class,'index']);
Route::get('departamento',[DepartamentoController::class,'indexActivo']);
Route::get('departamento/{departamentoid}',[DepartamentoController::class,'show']);
Route::post('departamento',[DepartamentoController::class,'store']);
Route::put('departamento/{departamentoid}',[DepartamentoController::class,'update']);
Route::delete('departamento/{departamentoid}',[DepartamentoController::class,'destroy']);
Route::put('departamento/{departamentoid}/restore',[DepartamentoController::class,'restore']);

//Categorias 
Route::get('categoria/all',[CategoriaController::class,'index']);

Route::get('categoria/{categoriaid}',[CategoriaController::class,'show']);
Route::post('categoria',[CategoriaController::class,'store']);
Route::put('categoria/{categoriaid}',[CategoriaController::class,'update']);
Route::delete('categoria/{categoriaid}',[CategoriaController::class,'destroy']);
Route::put('categoria/{categoriaid}/restore',[CategoriaController::class,'restore']);

//Atributos
Route::get('atributo/all',[AtributoController::class,'index']);
Route::get('atributo',[AtributoController::class,'indexActivo']);
Route::get('atributo/{atributoid}',[AtributoController::class,'show']);
Route::post('atributo',[AtributoController::class,'store']);
Route::put('atributo/{atributoid}',[AtributoController::class,'update']);
Route::delete('atributo/{atributoid}',[AtributoController::class,'destroy']);
Route::put('atributo/{atributoid}/restore',[AtributoController::class,'restore']);

//AtributoProducto
Route::post('atributoproducto',[AtributoProductoController::class,'store']);
Route::delete('atributoproducto/{atributoproductoid}',[AtributoProductoController::class,'destroy']);

//CategoriaProducto
Route::post('categoriaproducto',[CategoriaProductoController::class,'store']);
Route::delete('categoriaproducto/{categoriaproductoid}',[CategoriaProductoController::class,'destroy']);

//Departamento
Route::get('municipio/departamento/{departamentoid}/all',[MunicipioController::class,'index']);
Route::get('municipio/departamento/{departamentoid}',[MunicipioController::class,'indexActivo']);
Route::get('municipio/{municipioid}',[MunicipioController::class,'show']);
Route::post('municipio',[MunicipioController::class,'store']);
Route::put('municipio/{municipioid}',[MunicipioController::class,'update']);
Route::delete('municipio/{municipioid}',[MunicipioController::class,'destroy']);
Route::put('municipio/{municipioid}/restore',[MunicipioController::class,'restore']);

//Tienda 
Route::get('tienda/all',[TiendaController::class,'index']);
Route::get('tienda',[TiendaController::class,'indexActivo']);
Route::get('tienda/{tiendaid}',[TiendaController::class,'show']);
Route::post('tienda',[TiendaController::class,'store']);
Route::put('tienda/{tiendaid}',[TiendaController::class,'update']);
Route::delete('tienda/{tiendaid}',[TiendaController::class,'destroy']);
Route::put('tienda/{tiendaid}/restore',[TiendaController::class,'restore']);

//Inventario
Route::post('inventario',[InventarioController::class,'store']);

Route::put('inventario/{inventarioid}',[InventarioController::class,'update']);

//Tienda 
Route::get('rolusuario/all',[RolUsuarioController::class,'index']);
Route::get('rolusuario',[RolUsuarioController::class,'indexActivo']);
Route::get('rolusuario/{rolusuarioid}',[RolUsuarioController::class,'show']);
Route::post('rolusuario',[RolUsuarioController::class,'store']);
Route::put('rolusuario/{rolusuarioid}',[RolUsuarioController::class,'update']);
Route::delete('rolusuario/{rolusuarioid}',[RolUsuarioController::class,'destroy']);
Route::put('rolusuario/{rolusuarioid}/restore',[RolUsuarioController::class,'restore']);

//RolPantalla
Route::post('rolpantalla',[RolPantallaController::class,'store']);
Route::delete('rolpantalla/{categoriaproductoid}',[RolPantallaController::class,'destroy']);

//Pantalla 
Route::get('pantalla/all',[PantallaController::class,'index']);
Route::get('pantalla',[PantallaController::class,'indexActivo']);
Route::get('pantalla/{pantallaid}',[PantallaController::class,'show']);
Route::post('pantalla',[PantallaController::class,'store']);
Route::put('pantalla/{pantallaid}',[PantallaController::class,'update']);
Route::delete('pantalla/{pantallaid}',[PantallaController::class,'destroy']);
Route::put('pantalla/{pantallaid}/restore',[PantallaController::class,'restore']);

//Carrito 
Route::get('carrito/usuario/{usuarioid}',[CarritoController::class,'index']);
Route::get('carrito/{carritoid}',[CarritoController::class,'show']);
Route::post('carrito',[CarritoController::class,'store']);
Route::put('carrito/{carritoid}',[CarritoController::class,'update']);
Route::delete('carrito/{carritoid}',[CarritoController::class,'destroy']);


//TipoPago 
Route::get('tipopago/all',[TipoPagoController::class,'index']);
Route::get('tipopago',[TipoPagoController::class,'indexActivo']);
Route::get('tipopago/{tipopagoid}',[TipoPagoController::class,'show']);
Route::post('tipopago',[TipoPagoController::class,'store']);
Route::put('tipopago/{tipopagoid}',[TipoPagoController::class,'update']);
Route::delete('tipopago/{tipopagoid}',[TipoPagoController::class,'destroy']);
Route::put('tipopago/{tipopagoid}/restore',[TipoPagoController::class,'restore']);
});

