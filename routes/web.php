<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\RecoverController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//? Home

Route::get('/', function () {
    return view('home');
});

//! ---
//? Resources

Route::resource('/login', LoginController::class)
    ->only(['index']);

Route::resource('/signup', SignupController::class)
    ->only(['index']);

Route::resource('/recover', RecoverController::class)
    ->only(['index']);

Route::resource('/cliente', ClienteController::class)
    ->only(['index', 'store']);

Route::resource('/gestor', GestorController::class)
    ->only(['index']);

Route::resource('/emprestimo', EmprestimoController::class)
    ->only(['create', 'show', 'store']);

Route::resource('/parcela', ParcelaController::class)
    ->only(['update']);

//! ---
//? Rotas personalizadas

Route::get('/parcela/list/{emprestimo}', [ParcelaController::class, 'list'])
    ->name('parcela.list');

Route::patch('/emprestimo/{emprestimo}', [EmprestimoController::class, 'mudaStatus'])
    ->name('emprestimo.muda-status');
