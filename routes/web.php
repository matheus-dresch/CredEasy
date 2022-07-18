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

//! -----

Route::get('/', function () {
    return view('home');
});

Route::get('/entrar', function () {
    return view('entrar');
})->name('login');

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('signup');

//! -----

Route::resource('/cliente', ClienteController::class)
    ->only(['index', 'store']);

Route::resource('/gestor', GestorController::class)
    ->only(['index']);

Route::resource('/emprestimo', EmprestimoController::class)
    ->only(['create', 'show', 'store']);

//! ---
//? Rotas personalizadas

Route::patch('/emprestimo/atualizar/{emprestimo}', [EmprestimoController::class, 'atualizar'])
    ->name('emprestimo.atualizar');

Route::get('/emprestimo/parcelas/{emprestimo}', [ParcelaController::class, 'lista'])
    ->name('parcela.lista');

Route::get('/emprestimo/analisar/{emprestimo}', [EmprestimoController::class, 'analisar'])
    ->name('emprestimo.analisar');

Route::patch('parcela/{parcela}', [ParcelaController::class, 'pagaParcela'])
    ->name('parcela.paga-parcela');
