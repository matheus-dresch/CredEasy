<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Services\ClienteService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{

    use ApiResponse;

    public function detalhes()
    {
        /** @var Cliente $cliente */
        $cliente = Auth::user();

        $ultimoEmprestimo = $cliente->emprestimos()->first();
        $proximaParcela = $cliente->proximaParcela();

        return response()->json([
            'cliente' => $cliente,
            'emprestimos' => $cliente->emprestimos,
            'ultimo_emprestimo' => $ultimoEmprestimo,
            'proxima_parcela' => $proximaParcela,
        ]);
    }

    public function emprestimos(Cliente $cliente)
    {
        return $cliente->emprestimos;
    }

    public function cadastro(Request $request, ClienteService $clienteService)
    {
        $clienteData = $request->values;
        $clienteService->registra($clienteData);

        return $this->respostaSucesso('');
    }
}
