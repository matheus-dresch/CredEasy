<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Emprestimo;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $cliente = Cliente::where('cpf', '055.652.727-50')->with('emprestimos')->first();
        $emprestimos = $cliente->emprestimos()->orderBy('data_solicitacao')->get();

        return view('cliente.index')->with('emprestimos', $emprestimos)->with('cliente', $cliente);
    }
}
