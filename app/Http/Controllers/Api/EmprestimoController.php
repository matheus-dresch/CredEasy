<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmprestimoFormRequest;
use App\Models\Emprestimo;
use App\Models\Parcela;
use App\Services\EmprestimoService;
use DateInterval;
use DateTimeImmutable;
use DomainException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function todos(Request $request)
    {
        if ($request->query('todos') && $request->user()->tipo === 'GESTOR') {
            $json = [];

            $json['todosEmprestimos'] = Emprestimo::all();

            $emprestimosParaAnalise = Emprestimo::where('status', 'SOLICITADO')
                ->where('cliente_id', '!=', $request->user()->id)
                ->get();

            if ($emprestimosParaAnalise) $json['emprestimosParaAnalise'] = $emprestimosParaAnalise;

            return response()->json($json);
        }

        return $request->user()->emprestimos;
    }

    public function um(int $emprestimoId)
    {

        $emprestimo = Emprestimo::with('cliente')->find($emprestimoId);

        if (!$emprestimo) {
            return response('', 404);
        }

        $emprestimo->tem_parcelas = $emprestimo->temParcelas();

        return $emprestimo;
    }

    public function parcelas(int $id)
    {
        $emprestimo = Emprestimo::with('parcelas')->find($id);

        if ($emprestimo && $emprestimo->temParcelas()) {
            $parcelas = $emprestimo->parcelas;

            if ($emprestimo->status === 'APROVADO') {
                $proximaParcela = $emprestimo->proximaParcela() - 1;
                $parcelas[$proximaParcela]->proxima = true;
            }

            return $parcelas;
        } else {
            return response('', 404);
        };
    }

    public function pagaParcela(Request $request)
    {
        $parcela = Parcela::with('emprestimo')->find($request->parcela);
        $emprestimo = $parcela->emprestimo;

        if ($parcela->numero != $emprestimo->proximaParcela()) {
            return response('', 401);
        }

        $parcela->status = 'PAGA';
        $parcela->data_pagamento = now();
        $parcela->save();

        if ($parcela->numero === $emprestimo->qtd_parcelas) {
            $emprestimo->status = 'QUITADO';
            $emprestimo->data_quitacao = now();
            $emprestimo->save();
        }

        return response(['parcela' => $parcela], 200);
    }

    public function registra(EmprestimoFormRequest $request, EmprestimoService $emprestimoService)
    {
        $emprestimoData = $request->all();

        try {
            $emprestimo = $emprestimoService->registra($emprestimoData);
            return response($emprestimo, 201);
        } catch (DomainException $e) {
            return response($e, 422);
        }
    }

    public function analisa(int $id, Request $request)
    {
        $emprestimo = Emprestimo::find($id);

        if ($emprestimo->status != 'SOLICITADO') {
            throw new AuthorizationException();
        }

        $emprestimo->status = $request->status ? 'APROVADO' : 'REJEITADO';
        $emprestimo->save();

        if ($emprestimo->status === 'APROVADO') $this->criaParcelas($emprestimo);

        return response($emprestimo, 200);
    }

    private function criaParcelas(Emprestimo $emprestimo)
    {
        $qtdParcelas = $emprestimo->qtd_parcelas;
        $valorParcela = $emprestimo->valor_final / $qtdParcelas;

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
}
