<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoForRequest;
use App\Models\Emprestimo;
use App\Models\Parcela;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function create()
    {
        return view('emprestimo.create');
    }

    public function store(EmprestimoForRequest $request)
    {
        $emprestimoData = $request->all();

        // Converte a renda que vem mascarada para um float (R$ 1200,50 -> 120050 -> 1200.50)
        $valor = floatval(preg_replace('/[\D]/', '', $emprestimoData['valor'])) / 100;
        $emprestimoData['valor'] = $valor;

        $emprestimoData['taxa_juros'] = fake()->randomFloat(2, 1, 5);
        $emprestimoData['data_solicitacao'] = now();
        $emprestimoData['cliente_cpf'] = '055.652.727-50';

        $emprestimo = Emprestimo::create($emprestimoData);

        $qtdParcelas = $emprestimoData['parcelas'];
        $valorParcela = $valor / $qtdParcelas;

        $parcelas = [];
        $dataVencimento = (new DateTimeImmutable())->add(new DateInterval('P1M'));
        for ($i = 1; $i <= $qtdParcelas; $i++) {
            $parcelas[] = [
                'emprestimo_id' => $emprestimo->id,
                'valor' => $valorParcela,
                'numero' => $i,
                'data_vencimento' => $dataVencimento
            ];
            $dataVencimento = $dataVencimento->add(new DateInterval('P1M'));
        }

        Parcela::insert($parcelas);

        return to_route('cliente.index');
    }

    public function show(Emprestimo $emprestimo)
    {
        return view('emprestimo.show')->with('emprestimo', $emprestimo);
    }
}
