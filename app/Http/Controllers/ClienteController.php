<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $emprestimos = Emprestimo::all();

        return view('cliente.index')->with('emprestimos', $emprestimos);
    }
}
