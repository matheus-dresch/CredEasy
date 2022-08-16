<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function todos()
    {
        return Cliente::all();
    }

    public function dados()
    {
        /** @var Cliente $cliente */
        $cliente = Auth::user();

        $ultimoEmprestimo = $cliente->emprestimos()->first();
        $proximaParcela = $cliente->proximaParcela();
        $dados = $cliente->numerosTotais();

        return response()->json([
            'cliente' => $cliente,
            'emprestimos' => $cliente->emprestimos,
            'ultimo_emprestimo' => $ultimoEmprestimo,
            'proxima_parcela' => $proximaParcela,
            'dados' => [
                'total_emprestado' => $dados['emprestado'],
                'total_pago' => $dados['pago'],
                'qtd_emprestimos' => $dados['emprestimos']
            ]
        ]);
    }

    public function emprestimos(Cliente $cliente)
    {
        return $cliente->emprestimos;
    }

    public function auth(Request $request)
    {
        $loginData = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ]);

        if (!Auth::attempt(['email' => $loginData['email'], 'password' => $loginData['senha']])) {
            return response()->json(['message' => 'Usuário ou senha inválidos'], 401);;
        }

        /** @var \App\Models\Cliente $user */
        $user = Auth::user();
        $token =  $user->createToken('token');

        return response()->json([
            'token' => $token->plainTextToken,
            'nome' => $user->nome,
            'gestor' => $user->tipo === 'GESTOR'
        ]);
    }

    public function cadastro(Request $request, ClienteService $clienteService)
    {
        $clienteData = $request->values;
        $clienteService->registra($clienteData);

        return response('', 201);
    }
}
