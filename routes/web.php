<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Oauth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('logout', function () {
    auth()->logout();
    return redirect('login');
});

Route::get('login', function(){
    return view('auth.login');
})->name('login');

Route::get('register', function(){
    return view('auth.register');
})->name('register');

Route::get('dashboard', function(){
    return view('welcome');
})->name('dashboard')->middleware('auth');

Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('register', [AuthController::class, 'register'])->name('register.post');