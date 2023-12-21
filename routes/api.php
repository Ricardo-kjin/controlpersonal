<?php

use App\Http\Controllers\API\DeveloperController;
use App\Http\Controllers\VentaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/url-callback', [VentaController::class, 'urlCallback']);


Route::get('developer/{user}',[DeveloperController::class,'obtenerUSer']);
Route::get('cargar/{sala}',[DeveloperController::class,'cargarProy']);
Route::put('guardar/{sala}',[DeveloperController::class,'guardar']);
