<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Parcela;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    public function pagaParcela(Parcela $parcela, Request $request)
    {

        $emprestimo = $parcela->emprestimo;

        $proximaParcela = $emprestimo->parcelas()->where('status', 'ABERTA')->first()->numero;

        if ($parcela->numero != $proximaParcela) {
            flash("Você precisa pagar a parcela anterior primeiro.")->error();
            return to_route('parcela.lista', $emprestimo->id);
            dd('oi');
        }

        $parcela->status = 'PAGA';
        $parcela->data_pagamento = now();
        $parcela->save();

        if ($parcela->numero === $emprestimo->qtd_parcelas) {
            $emprestimo->status = 'QUITADO';
            $emprestimo->data_quitacao = now();
            $emprestimo->save();
        }

        flash("A parcela de número {$parcela->numero} foi paga.")->success();
        return to_route('parcela.lista', $parcela->emprestimo_id);
    }

    public function lista(Emprestimo $emprestimo)
    {
        $parcelas = $emprestimo->parcelas;

        $proximaParcela = $emprestimo->parcelas()->where('status', 'ABERTA')->first();

        return view('emprestimo.parcelas')
            ->with('parcelas', $parcelas)
            ->with('emprestimo', $emprestimo)
            ->with('proximaParcela', $proximaParcela ? $proximaParcela->numero : INF);
    }
}
