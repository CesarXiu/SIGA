<?php

use Illuminate\Support\Facades\Route;
//CONTROLADORES
/*
    TODOS SE ENCUENTRAN BAJO EL NAMESPACE App\Http\Controllers\Siga
    A EXCEPCION DE AuthController QUE SE ENCUENTRA EN App\Http\Controllers\Oauth
*/
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Siga\RolController;
use App\Http\Controllers\Siga\RutaController;
use App\Http\Controllers\Siga\ScopeController;
use App\Http\Controllers\Oauth\AuthController;
use App\Http\Controllers\Siga\ModeloController;
use App\Http\Controllers\Siga\PermisoController;
use App\Http\Controllers\Siga\EndPointController;
use App\Http\Controllers\Siga\SolicitudController;
use App\Http\Controllers\Siga\ConsumidorController;
use App\Http\Controllers\Siga\CompartidoController;
// MODELOS
// RUTAS DE AUTENTICACION //
Route::get('/me', [AuthController::class,"me"])->middleware('auth:api'); //OBTEN LA INFORMACION DEL USUARIO AUTENTICADO
Route::get('/check', [AuthController::class, "auth_consumer"])->middleware('client'); //VERIFICA SI EL CONSUMIDOR PUEDE ACCEDER A LA API SII
Route::get('/logout', [AuthController::class, "logout"])->middleware('auth:api'); //ELIMINA EL TOKEN DE ACCESO Y CIERRA SESION DEL USUARIO
// BULK ROUTES //
Route::post('permisos/scopes', [PermisoController::class, 'storeScopes'])->middleware('auth:api');//AGREGA PERMISOS A UN ROL
Route::delete('permisos/scopes', [PermisoController::class, 'deleteScopes'])->middleware('auth:api');//ELIMINA PERMISOS DE UN ROL
Route::put('rutas/endpoint', [RutaController::class, 'bulkUpdate'])->middleware('auth:api');//CAMBIA EL ENDPOINT DE UNA LISTA DE RUTAS
Route::put('compartidos', [CompartidoController::class, 'bulkUpdate'])->middleware('auth:api');//ACTUALIZA UNA LISTA DE COMPARTIDOS (ESTADO ACTIVO)
// RUTAS DE SIGA //
Route::apiResource('users', UsuarioController::class)->middleware('auth:api'); //RUTAS DE LOS USUARIOS PARA EL MANEJO DE LOS USUARIOS
Route::apiResource('scopes', ScopeController::class)->middleware('auth:api'); //RUTAS DE LOS SCOPES PARA EL MANEJO DE LOS ALCANCES
Route::apiResource('roles', RolController::class)->middleware('auth:api'); //RUTAS DE LOS ROLES PARA EL MANEJO DE LOS PERMISOS POR USUARIO
Route::apiResource('consumidores', ConsumidorController::class)->middleware('auth:api'); //RUTAS DE LOS CONSUMIDORES PARA EL MANEJO DE LOS PERMISOS DE ACCESO
Route::apiResource('compartidos', CompartidoController::class)->middleware('auth:api'); //RUTAS DE LAS CUENTAS COMPARTIDAS, PARA PERMITIR A OTRO USUARIO UTILIZAR TUS CONSUMIDORES
Route::apiResource('permisos', PermisoController::class)->middleware('auth:api'); //RUTAS DE PERMISOS, DONDE SE MANEJAN LOS PERMISOS DE LOS ROLES
Route::apiResource('endpoints', EndPointController::class)->middleware('auth:api'); //RUTAS DE LOS ENDPOINTS PARA EL MANEJO DE LOS GRUPOS DE RUTAS
Route::apiResource('rutas', RutaController::class)->middleware('auth:api'); //RUTAS DE LAS RUTAS PARA EL MANEJO DE LAS RUTAS DE LA API SII
Route::apiResource('solicitudes', SolicitudController::class)->middleware('auth:api'); //RUTAS DE LAS SOLICITUDES PARA EL MANEJO DE LAS SOLICITUDES DE ACCESO A LA API SII
Route::apiResource('modelos', ModeloController::class)->middleware('auth:api'); //RUTAS DE LOS MODELOS PARA EL MANEJO DE LOS DATOS QUE SE SOLICITAN EN UNA SOLICITUD