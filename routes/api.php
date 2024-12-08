<?php

use App\Http\Controllers\Oauth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//MIDDLEWARES
use App\Http\Middleware\AddToTokenResponse;
//CONTROLADORES
use App\Http\Controllers\Siga\ScopeController;
use App\Http\Controllers\Siga\RolController;
use App\Http\Controllers\Siga\ConsumidorController;
use App\Http\Controllers\Siga\PermisoController;
use App\Http\Controllers\Siga\EndPointController;
use App\Http\Controllers\Siga\RutaController;
use App\Http\Controllers\Siga\SolicitudController;
use App\Http\Controllers\Siga\ModeloController;
// MODELOS
// RUTAS DE AUTENTICACION //
Route::get('/me', [AuthController::class,"me"])->middleware('auth:api');
Route::get('/check', [AuthController::class, "auth_consumer"])->middleware('client');
Route::get('/logout', [AuthController::class, "logout"])->middleware('auth:api');
// BULK ROUTES //
Route::post('permisos/scopes', [PermisoController::class, 'storeScopes'])->middleware('auth:api');
Route::delete('permisos/scopes', [PermisoController::class, 'deleteScopes'])->middleware('auth:api');
// RUTAS DE SIGA //
Route::resource('scopes', ScopeController::class)->middleware('auth:api');
Route::resource('roles', RolController::class)->middleware('auth:api');
Route::resource('consumidores', ConsumidorController::class)->middleware('auth:api');
Route::resource('permisos', PermisoController::class)->middleware('auth:api');
Route::resource('endpoints', EndPointController::class)->middleware('auth:api');
Route::resource('rutas', RutaController::class)->middleware('auth:api');
Route::resource('solicitudes', SolicitudController::class)->middleware('auth:api');
Route::resource('modelos', ModeloController::class)->middleware('auth:api');