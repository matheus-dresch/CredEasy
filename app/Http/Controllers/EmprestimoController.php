<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoForRequest;
use App\Models\Emprestimo;
use App\Models\Parcela;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Else_;

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
        $emprestimoData['cliente_cpf'] = '030.342.600-40';
        $emprestimoData['valor_final'] = $valor * 1.1;

        $qtdParcelas = $emprestimoData['parcelas'];
        $valorParcela = ($valor * 1.1) / $qtdParcelas;

        if ($valorParcela < 200) {
            $valorFormatado = number_format($valorParcela, 2, '.', ',');
            $msg = "Valor mínimo da parcela: R$ 200,00; Valor calculado: R$ $valorFormatado";

            flash($msg)->error();

            return to_route('emprestimo.create');
        }

        $emprestimo = Emprestimo::create($emprestimoData);

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

        flash("O empréstimo '{$emprestimo->nome} foi solicitado, agurde a aprovação.");

        return to_route('cliente.index');
    }

    public function show(Emprestimo $emprestimo)
    {
        return view('emprestimo.show')->with('emprestimo', $emprestimo);
    }

    public function mudaStatus(Emprestimo $emprestimo, Request $request)
    {
        if ($emprestimo->status === 'SOLICITADO') {
            if ($request->status === 'on') {
                $emprestimo->status = 'APROVADO';
            } else {
                $emprestimo->status = 'REJEITADO';
            }

            $emprestimo->save();
        } else {
            $status = strtolower($emprestimo->status);
            flash("Este empréstimo já foi {$status} e não é possível atualizá-lo.")->error();
        }

        return to_route('emprestimo.show', $emprestimo->id);
    }
}
