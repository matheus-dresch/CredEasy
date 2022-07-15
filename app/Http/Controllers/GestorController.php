<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class GestorController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::all();
        return view('gestor.index')->with('emprestimos', $emprestimos);
    }
}
