<?php

use App\Http\Controllers\Oauth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//CONTROLADORES
use App\Http\Controllers\Siga\ScopeController;
use App\Http\Controllers\Siga\RolController;
use App\Http\Controllers\Siga\ConsumidorController;
use App\Http\Controllers\Siga\PermisoController;
use App\Http\Controllers\Siga\EndPointController;
use App\Http\Controllers\Siga\RutaController;
use App\Http\Controllers\Siga\SolicitudController;
//MODELOS
use App\Models\Siga\Consumidor;

// RUTAS DE PRUEBA //
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('/orders', [AuthController::class, "auth_consumer"])->middleware('client');
// RUTAS DE SIGA //
Route::resource('scopes', ScopeController::class)->middleware('auth:api');
Route::resource('roles', RolController::class)->middleware('auth:api');
Route::resource('consumidores', ConsumidorController::class)->middleware('auth:api');
Route::resource('permisos', PermisoController::class)->middleware('auth:api');
Route::resource('endpoints', EndPointController::class)->middleware('auth:api');
Route::resource('rutas', RutaController::class)->middleware('auth:api');
Route::resource('solicitudes', SolicitudController::class);//->middleware('auth:api');