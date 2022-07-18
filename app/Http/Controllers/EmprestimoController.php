<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoFormRequest;
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

    public function store(EmprestimoFormRequest $request)
    {
        $emprestimoData = $request->all();

        // Converte a renda que vem mascarada para um float (R$ 1200,50 -> 120050 -> 1200.50)
        $valor = floatval(preg_replace('/[\D]/', '', $emprestimoData['valor'])) / 100;

        if ($valor < 1000) {
            return to_route('emprestimo.create')
                ->withInput()
                ->withErrors('O valor mínimo é de R$ 1000,00');
        }

        $emprestimoData['valor'] = $valor;

        $emprestimoData['taxa_juros'] = 20;
        $emprestimoData['data_solicitacao'] = now();
        $emprestimoData['cliente_cpf'] = '030.342.600-40';
        $emprestimoData['valor_final'] = $valor * 1.2;

        $valorParcela = ($valor * 1.1) / $emprestimoData['qtd_parcelas'];

        if ($valorParcela < 200) {
            $valorFormatado = number_format($valorParcela, 2, '.', ',');
            $msg = "Valor mínimo da parcela: R$ 200,00; Valor calculado: R$ $valorFormatado";

            return to_route('emprestimo.create')
                ->withInput()
                ->withErrors($msg);
        }

        $emprestimo = Emprestimo::create($emprestimoData);

        flash("O empréstimo '{$emprestimo->nome}' foi solicitado, agurde a aprovação.");

        return to_route('cliente.index');
    }

    public function show(Emprestimo $emprestimo)
    {
        return view('emprestimo.show')->with('emprestimo', $emprestimo);
    }

    public function analisar(Emprestimo $emprestimo)
    {
        return view('emprestimo.analisar')->with('emprestimo', $emprestimo)->with('cliente', $emprestimo->cliente);
    }

    private function criaParcelas(Emprestimo $emprestimo)
    {
        $qtdParcelas = $emprestimo->qtd_parcelas;
        $valorParcela = $emprestimo->valor / $qtdParcelas;

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
    }

    public function atualizar(Emprestimo $emprestimo, Request $request)
    {
        $request->validate([
            'taxa' => ['numeric', 'min:10', 'max:20']
        ]);

        if ($emprestimo->status != 'SOLICITADO') {
            return to_route('emprestimo.analisar', $emprestimo->id)
                ->withErrors('Este empréstimo não pode mais ser atualizado.');
        }

        if (isset($request->taxa)) {
            $emprestimo->taxa_juros = $request->taxa;
            $emprestimo->valor_final = $emprestimo->valor * ( $request->taxa / 100 + 1);
            flash('A taxa foi atualizada.');
        } else if (isset($request->status)) {
            $emprestimo->status = $request->status === 'on' ? 'APROVADO' : 'REJEITADO';

            if ($request->status === 'on') {
                $this->criaParcelas($emprestimo);
            }
        }

        $emprestimo->save();
        return to_route('emprestimo.analisar', $emprestimo->id);
    }
}
