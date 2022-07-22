<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\GestorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParcelaController;
use Illuminate\Support\Facades\Auth;
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
//? Rotas livres (sem middleware)

Route::get('/', function () {
    return view('home');
});

Route::get('/cadastro', [CadastroController::class, 'index'])->name('cadastro.index');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

Route::get('/entrar', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/entrar', [LoginController::class, 'auth'])->name('login.auth');


//! -----
//? Rotas autenticadas CLIENTE (Autenticador)

Route::middleware('auth')->group(function () {

    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index');
    Route::get('/cliente/minha-conta', [ClienteController::class, 'conta'])->name('cliente.conta');

    Route::get('/emprestimo/form', [EmprestimoController::class, 'form'])
    ->name('emprestimo.form');
    Route::get('/emprestimo/{emprestimo}', [EmprestimoController::class, 'show'])
    ->name('emprestimo.show');
    Route::get('/emprestimo/parcelas/{emprestimo}', [ParcelaController::class, 'lista'])
        ->name('emprestimo.parcelas');
    Route::get('/emprestimo/analisar/{emprestimo}', [EmprestimoController::class, 'analisar'])
        ->name('emprestimo.analisar');
    Route::post('/emprestimo', [EmprestimoController::class, 'store'])
        ->name('emprestimo.store');
    Route::patch('/emprestimo/atualizar/{emprestimo}', [EmprestimoController::class, 'atualizar'])
        ->name('emprestimo.atualizar');

    Route::patch('parcela/{parcela}', [ParcelaController::class, 'pagaParcela'])
        ->name('parcela.paga-parcela');

    Route::resource('/gestor', GestorController::class)
        ->only(['index']);

});

//! -----
//? Rotas autenticadas GESTOR (AutenticaGestor)

Route::middleware('auth.gestor')->group(function () {
    Route::resource('/gestor', GestorController::class)
        ->only(['index']);

    Route::get('/emprestimo/analisar/{emprestimo}', [EmprestimoController::class, 'analisar'])
        ->name('emprestimo.analisar');
});
