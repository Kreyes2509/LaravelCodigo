<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    return view('Auth.login');
});

Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('sesion', [AuthController::class, 'login'])->name('sesion');
Route::get('registrar', [AuthController::class, 'registrarView'])->name('registrar');
Route::post('signUp', [AuthController::class, 'Registrar'])->name('signUp');
Route::get('signout', [AuthController::class, 'cerrarSesion'])->name('signout');
Route::get('verificarCode/{id}', [AuthController::class, 'CodeView'])->name('CodeView');


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});
