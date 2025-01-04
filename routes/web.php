<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Oauth\AuthController;

// Define la ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Define la ruta para cerrar sesión
Route::post('logout', function () {
    auth()->logout();
    return redirect('login');
});

// Define la ruta para la página de inicio de sesión
Route::get('login', function(){
    return view('auth.login');
})->name('login');

// Define la ruta para la página de registro
Route::get('register', function(){
    return view('auth.register');
})->name('register');

// Define la ruta para el dashboard, protegida por middleware de autenticación
Route::get('dashboard', function(){
    return view('welcome');
})->name('dashboard')->middleware('auth');

// Define la ruta para el inicio de sesión mediante POST
Route::post('login', [AuthController::class, 'login'])->name('login.post');

// Define la ruta para el registro mediante POST
Route::post('register', [AuthController::class, 'register'])->name('register.post');