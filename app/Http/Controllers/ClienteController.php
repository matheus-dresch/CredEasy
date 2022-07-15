<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Parcela;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $cliente = Cliente::where('cpf', '030.342.600-40')->with('emprestimos')->first();
        $emprestimos = $cliente->emprestimos()->orderBy('data_solicitacao')->get();

        $proximaParcela = Parcela::join('emprestimos', 'parcelas.emprestimo_id', '=', 'emprestimos.id')
            ->join('clientes', 'emprestimos.cliente_cpf', '=', 'clientes.cpf')
            ->where('parcelas.status', 'ABERTA')
            ->select('parcelas.valor', 'parcelas.data_vencimento', 'parcelas.id', 'parcelas.status')
            ->orderBy('parcelas.data_vencimento')
            ->first();

        return view('cliente.index')
            ->with('emprestimos', $emprestimos)
            ->with('cliente', $cliente)
            ->with('parcela', $proximaParcela);
    }
}
