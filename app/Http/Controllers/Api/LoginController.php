<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponse;

    public function auth(Request $request)
    {
        $loginData = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ]);

        $credenciaisCorretas = Auth::attempt([
            'email' => $loginData['email'],
            'password' => $loginData['senha']
        ]);

        if (! $credenciaisCorretas) return $this->respostaErro("Crendenciais inválidas", 401);            

        /** @var \App\Models\Cliente $cliente */
        $cliente = Auth::user();
        $token =  $cliente->createToken('token')->plainTextToken;

        return $this->respostaSucesso([
            'token' => $token,
            'gestor' => $cliente->tipo === "GESTOR"
    ]);
    }
}
