<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function todos()
    {
        return Cliente::all();
    }

    public function um(int $cliente)
    {
        $clienteModel = Cliente::find($cliente);
        return $clienteModel;
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
            return response('', 401);
        }

        $user = Auth::user();
        // $token =  $user->createToken('token');

        return response()->json([
            // 'token' => $token->plainTextToken,
            'nome' => $user->nome,
            'gestor' => $user->tipo === 'GESTOR'
        ]);
    }
}
