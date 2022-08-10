<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Parcela;
use App\Services\ClienteService;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{

    public function __construct(private ClienteService $service)
    {
    }

    public function index()
    {
        /**
         * @var Cliente $cliente
         */
        $cliente = Auth::user();
        $emprestimos = $cliente->emprestimos()->orderBy('data_solicitacao')->get();

        $proximaParcela = Parcela::select('parcelas.emprestimo_id', 'parcelas.data_vencimento', 'parcelas.valor')
            ->join('emprestimos', 'parcelas.emprestimo_id', 'emprestimos.id')
            ->where('cliente_id', $cliente->id)
            ->where('parcelas.status', '!=', 'PAGA')
            ->orderBy('parcelas.data_vencimento')
            ->limit(1)
            ->first();

        $cliente->numerosTotais();

        return view('cliente.index')
            ->with('emprestimos', $emprestimos)
            ->with('cliente', $cliente)
            ->with('parcela', $proximaParcela)
            ->with('estatisticas', $cliente->numerosTotais());
    }

    public function conta()
    {
        $cliente = Auth::user();

        return view('cliente.conta')
            ->with('cliente',  $cliente);
    }
}
