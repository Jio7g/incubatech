<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest'); 

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password reset link request routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Password reset routes...
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\UserController;

Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');
Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');
Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('users.update');
// ...

//ruta para crear clientes
Route::get('/clientes/crear', [ClientController::class, 'create'])->name('clients.create');
Route::get('/clientes', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clientes/{client}/editar', [ClientController::class, 'edit'])->name('clients.edit');
Route::delete('/clientes/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::put('/clientes/{client}', [ClientController::class, 'update'])->name('clients.update');








