<?php

use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('home');
});

Route::resource('/login', LoginController::class)
    ->only(['index']);

Route::resource('/signup', SignupController::class)
    ->only(['index']);

Route::resource('/recover', RecoverController::class)
    ->only(['index']);
