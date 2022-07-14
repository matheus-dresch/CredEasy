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
        $valor = $request->get('valor');
        $valor = floatval(preg_replace('/[\D]/', '', $valor)) / 100;

        $qtdParcelas = $request->get('parcelas');
        $valorParcela = $valor / $qtdParcelas;

        $emprestimo = new Emprestimo();
        $emprestimo->nome_emprestimo = $request->get('nome');
        $emprestimo->valor = $valor;
        $emprestimo->taxa_juros = 1.05;
        $emprestimo->data_solicitacao = now();
        $emprestimo->status = "SOLICITADO";
        $emprestimo->cliente_cpf = '340.994.187-82';

        $emprestimo->save();

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

        dd($emprestimo);
        return 'oi';
    }
}
