<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AutenticaGestor;
use App\Models\Emprestimo;
use Illuminate\Http\Request;

class GestorController extends Controller
{


    public function __construct()
    {

    }

    public function index()
    {
        $emprestimos = Emprestimo::where('status', 'SOLICITADO')->get();
        return view('gestor.index')->with('emprestimos', $emprestimos);
    }
}
