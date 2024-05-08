<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\IncubationDataController;
use App\Http\Controllers\IncubationClientController;

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
Route::resource('clients', 'ClientController');

// Custom route for creating clients if you want a different URI than '/clients/create'.
Route::get('/clientes/crear', [ClientController::class, 'create'])->name('clients.create');

// Custom route for storing clients if you want a different URI than '/clients'.
Route::post('/clientes/store', [ClientController::class, 'store'])->name('clients.store');

Route::get('/clientes', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clientes/{client}/editar', [ClientController::class, 'edit'])->name('clients.edit');
Route::delete('/clientes/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::put('/clientes/{client}', [ClientController::class, 'update'])->name('clients.update');

//rutas para datos de incubacion

Route::get('/incubation/create', [IncubationDataController::class, 'create'])->name('incubation.create');
Route::post('/incubation', [IncubationDataController::class, 'store'])->name('incubation.store');
Route::get('/incubation', [IncubationDataController::class, 'index'])->name('incubation.index'); // Suponiendo que quieras listar los registros
Route::get('/api/clients', [IncubationDataController::class, 'getClients']);



//ruta para lista de clientes con incubacion
Route::get('/incubation-clients', [IncubationClientController::class, 'index'])->name('incubations_clients.index');
Route::get('/incubations/{client}', [IncubationClientController::class, 'show'])->name('incubations.show');
Route::get('/incubaciones/compartir/{clientId}/{token}', [IncubationClientController::class, 'showSharedIncubation'])->name('incubations.shared');
Route::get('/incubaciones/compartir/{clientId}', [IncubationClientController::class, 'generateShareLink'])->name('incubations.share');







