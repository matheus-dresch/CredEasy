<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupFormRequest;
use App\Models\Cliente;
use App\Models\Parcela;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente = Cliente::find('030.342.600-40')->with('emprestimos')->first();
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

    public function store(SignupFormRequest $request)
    {
        $clienteData = $request->all();

        $renda = $clienteData['renda'];
        $renda = floatval(preg_replace('/[\D]/', '', $renda)) / 100;

        $clienteData['renda'] = $renda;

        $clienteData['senha'] = password_hash($clienteData['senha'], PASSWORD_ARGON2I);

        [
            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'bairro' => $bairro,
            'rua' => $rua,
            'numcasa' => $numcasa,
        ] = $clienteData;

        $endereco = "$estado, $cidade - $cep, $bairro, $rua, $numcasa";
        $clienteData['endereco'] = $endereco;

        Cliente::create($clienteData);

        return to_route('cliente.index');
    }
}
