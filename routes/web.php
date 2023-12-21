<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Familia
Route::get('/familias', [App\Http\Controllers\FamiliaController::class, 'index']);
Route::get('/familias/create', [App\Http\Controllers\FamiliaController::class, 'create']);
Route::get('/familias/{familia}/edit', [App\Http\Controllers\FamiliaController::class, 'edit']);
Route::post('/familias', [App\Http\Controllers\FamiliaController::class, 'store']);
Route::put('/familias/{familia}', [App\Http\Controllers\FamiliaController::class, 'update']);
Route::delete('/familias/{familia}', [App\Http\Controllers\FamiliaController::class, 'destroy']);

//Grupo
Route::get('/grupos', [App\Http\Controllers\GrupoController::class, 'index']);
Route::get('/grupos/create', [App\Http\Controllers\GrupoController::class, 'create']);
Route::get('/grupos/{grupo}/edit', [App\Http\Controllers\GrupoController::class, 'edit']);
Route::post('/grupos', [App\Http\Controllers\GrupoController::class, 'store']);
Route::put('/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'update']);
Route::delete('/grupos/{grupo}', [App\Http\Controllers\GrupoController::class, 'destroy']);
//SubGrupo
Route::get('/subgrupos', [App\Http\Controllers\SubgrupoController::class, 'index']);
Route::get('/subgrupos/create', [App\Http\Controllers\SubgrupoController::class, 'create']);
Route::get('/subgrupos/{subgrupo}/edit', [App\Http\Controllers\SubgrupoController::class, 'edit']);
Route::post('/subgrupos', [App\Http\Controllers\SubgrupoController::class, 'store']);
Route::put('/subgrupos/{subgrupo}', [App\Http\Controllers\SubgrupoController::class, 'update']);
Route::delete('/subgrupos/{subgrupo}', [App\Http\Controllers\SubgrupoController::class, 'destroy']);
//Producto
Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index']);
Route::get('/productos/create', [App\Http\Controllers\ProductoController::class, 'create']);
Route::get('/productos/{producto}/edit', [App\Http\Controllers\ProductoController::class, 'edit']);
Route::post('/productos', [App\Http\Controllers\ProductoController::class, 'store']);
Route::put('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'update']);
Route::delete('/productos/{producto}', [App\Http\Controllers\ProductoController::class, 'destroy']);
//Ruta

//Ubicacion
Route::get('/ubicaciones/{user_id}', [App\Http\Controllers\UbicacionController::class, 'create']);
Route::post('/ubicaciones', [App\Http\Controllers\UbicacionController::class, 'store']);
Route::get('/ubicaciones/{user_id}/edit', [App\Http\Controllers\UbicacionController::class, 'edit']);
Route::put('/ubicaciones/{ubicacion}', [App\Http\Controllers\UbicacionController::class, 'update']);

Route::get('/ubicaciones/vendedores/{user_id}', [App\Http\Controllers\UbicacionController::class, 'createv']);
Route::post('/ubicaciones/vendedores', [App\Http\Controllers\UbicacionController::class, 'storev']);
Route::get('/ubicaciones/vendedores/{user_id}/edit', [App\Http\Controllers\UbicacionController::class, 'editv']);
Route::put('/ubicaciones/vendedores/{ubicacion}', [App\Http\Controllers\UbicacionController::class, 'updatev']);
//solo visualizacion
Route::get('/ubicaciones/vendedores', [App\Http\Controllers\UbicacionController::class, 'show']);

//Ruta
Route::get('/rutas', [App\Http\Controllers\RutaController::class, 'index']);
Route::get('/rutas/create', [App\Http\Controllers\RutaController::class, 'create']);
Route::get('/rutas/{ruta}/edit', [App\Http\Controllers\RutaController::class, 'edit']);
Route::post('/rutas', [App\Http\Controllers\RutaController::class, 'store']);
Route::put('/rutas/{ruta}', [App\Http\Controllers\RutaController::class, 'update']);
Route::delete('/rutas/{ruta}', [App\Http\Controllers\RutaController::class, 'destroy']);
Route::get('/ver_rutas', [App\Http\Controllers\RutaController::class, 'verRuta']);


//vendedores
Route::get('/vendedores', [App\Http\Controllers\VendedorController::class, 'index']);
Route::get('/vendedores/create', [App\Http\Controllers\VendedorController::class, 'create']);
Route::get('/vendedores/{vendedor}/edit', [App\Http\Controllers\VendedorController::class, 'edit']);
Route::post('/vendedores', [App\Http\Controllers\VendedorController::class, 'store']);
Route::put('/vendedores/{vendedor}', [App\Http\Controllers\VendedorController::class, 'update']);
Route::delete('/vendedores/{vendedor}', [App\Http\Controllers\VendedorController::class, 'destroy']);

//clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index']);
Route::get('/clientes/create', [App\Http\Controllers\ClienteController::class, 'create']);
Route::get('/clientes/{cliente}/edit', [App\Http\Controllers\ClienteController::class, 'edit']);
Route::post('/clientes', [App\Http\Controllers\ClienteController::class, 'store']);
Route::put('/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'update']);
Route::delete('/clientes/{cliente}', [App\Http\Controllers\ClienteController::class, 'destroy']);

//personal monitoreo
Route::get('/monitores', [App\Http\Controllers\MonitorController::class, 'index']);
Route::get('/monitores/create', [App\Http\Controllers\MonitorController::class, 'create']);
Route::get('/monitores/{monitor}/edit', [App\Http\Controllers\MonitorController::class, 'edit']);
Route::post('/monitores', [App\Http\Controllers\MonitorController::class, 'store']);
Route::put('/monitores/{monitor}', [App\Http\Controllers\MonitorController::class, 'update']);
Route::delete('/monitores/{monitor}', [App\Http\Controllers\MonitorController::class, 'destroy']);

//tiemporeal
Route::get('/vermaps', [App\Http\Controllers\VermapController::class, 'index']);
Route::get('/vermaps/{id}', [App\Http\Controllers\VermapController::class, 'verUbicacionCompartida']);

//googlemaps
// Route::get('/mapa', 'MapaController@mostrarMapa');
Route::get('/mapa', [App\Http\Controllers\MapaController::class, 'mostrarMapa']);

//Reporte
Route::get('/reportesprom', [App\Http\Controllers\ReportesController::class, 'reportesprom']);

//imagenes
Route::get('/imagenes/create/{id}', [App\Http\Controllers\ImagenController::class, 'create']);
Route::post('/imagenes', [App\Http\Controllers\ImagenController::class, 'store']);

Route::get('/captura/{id}', [App\Http\Controllers\ImagenController::class, 'mostrarCaptura'])->name('mostrarCaptura');
Route::post('/captura/procesar', [App\Http\Controllers\ImagenController::class, 'procesarCaptura'])->name('procesarCaptura');

//Promociones
Route::get('/promociones', [App\Http\Controllers\PromocionController::class, 'index']);
Route::get('/promociones/create', [App\Http\Controllers\PromocionController::class, 'create']);
Route::get('/promociones/{grupo}/edit', [App\Http\Controllers\PromocionController::class, 'edit']);
Route::post('/promociones', [App\Http\Controllers\PromocionController::class, 'store']);
Route::put('/promociones/{grupo}', [App\Http\Controllers\PromocionController::class, 'update']);
Route::delete('/promociones/{grupo}', [App\Http\Controllers\PromocionController::class, 'destroy']);

//tipo de pago
Route::get('/tipopagos', [App\Http\Controllers\TipoPagoController::class, 'index']);
Route::get('/tipopagos/create', [App\Http\Controllers\TipoPagoController::class, 'create']);
Route::get('/tipopagos/{tipopago}/edit', [App\Http\Controllers\TipoPagoController::class, 'edit']);
Route::post('/tipopagos', [App\Http\Controllers\TipoPagoController::class, 'store']);
Route::put('/tipopagos/{tipopago}', [App\Http\Controllers\TipoPagoController::class, 'update']);
Route::delete('/tipopagos/{tipopago}', [App\Http\Controllers\TipoPagoController::class, 'destroy']);

//VENTAS
Route::get('/ventas', [App\Http\Controllers\VentaController::class, 'index']);
Route::get('/ventas/create', [App\Http\Controllers\VentaController::class, 'create']);
// Route::get('/ventas/{venta}/edit', [App\Http\Controllers\VentaController::class, 'edit']);
Route::post('/ventas', [App\Http\Controllers\VentaController::class, 'store']);
// Route::put('/ventas/{venta}', [App\Http\Controllers\VentaController::class, 'update']);
Route::delete('/ventas/{venta}', [App\Http\Controllers\VentaController::class, 'destroy']);
Route::get('/ventas/{venta}', [App\Http\Controllers\VentaController::class, 'RecolectarDatos']);

//AUXILIARES
//VERIFICAR PAGO QR
Route::post('/verificar', [App\Http\Controllers\VentaController::class, 'verificar']);
Route::get('/verificar/{id}', [App\Http\Controllers\VentaController::class, 'ConsultarEstado']);


















//salas
// Route::get('/salas', [App\Http\Controllers\SalasController::class, 'index']);
// Route::get('/salas/create', [App\Http\Controllers\SalasController::class, 'create']);
// Route::get('/salas/{sala}/edit', [App\Http\Controllers\SalasController::class, 'edit']);
// Route::post('/salas', [App\Http\Controllers\SalasController::class, 'store']);
// Route::put('/salas/{sala}', [App\Http\Controllers\SalasController::class, 'update']);
// Route::delete('/salas/{sala}', [App\Http\Controllers\SalasController::class, 'destroy']);
//Desarrolladores

// Route::resource('desarrolladores', 'App\Http\Controllers\DesarrolladorController');
// Route::get('/desarrolladores', [App\Http\Controllers\DesarrolladorController::class, 'index']);
// Route::get('/desarrolladores/create', [App\Http\Controllers\DesarrolladorController::class, 'create']);
// Route::get('/desarrolladores/{desarrollador}/edit', [App\Http\Controllers\DesarrolladorController::class, 'edit']);
// Route::post('/desarrolladores', [App\Http\Controllers\DesarrolladorController::class, 'store']);
// Route::put('/desarrolladores/{desarrollador}', [App\Http\Controllers\DesarrolladorController::class, 'update']);
// Route::delete('/desarrolladores/{desarrollador}', [App\Http\Controllers\DesarrolladorController::class, 'destroy']);
