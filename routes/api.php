<?php

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EmprestimoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/emprestimos/{id}', [EmprestimoController::class, 'um']);
    Route::get('/emprestimos/{id}/parcelas', [EmprestimoController::class, 'parcelas']);
    Route::get('/emprestimos', [EmprestimoController::class, 'todos']);
    Route::post('/emprestimos', [EmprestimoController::class, 'registra']);
    Route::patch('/emprestimos/{id}', [EmprestimoController::class, 'analisa']);

    Route::patch('/parcela', [EmprestimoController::class, 'pagaParcela']);

    Route::get('/cliente', [ClienteController::class, 'dados']);
    Route::get('/clientes', [ClienteController::class, 'todos']);
    Route::get('/clientes/{cliente}/emprestimos', [ClienteController::class, 'emprestimos']);

});

Route::post('/login', [ClienteController::class, 'auth']);
Route::post('/cadastro', [ClienteController::class, 'cadastro']);
