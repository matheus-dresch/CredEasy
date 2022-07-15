<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Parcela;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    public function update(Parcela $parcela)
    {
        $parcela->status = 'PAGO';
        $parcela->data_pagamento = now();
        $parcela->save();

        $emprestimo = $parcela->emprestimo;

        $emprestimoQuitado = true;
        foreach($emprestimo->parcelas as $parcela) {
            if ($parcela->status === 'ABERTA') {
                $emprestimoQuitado = false;
                break;
            }
        }

        if ($emprestimoQuitado) {
            $emprestimo->status = 'QUITADO';
            $emprestimo->data_quitacao = now();
            $emprestimo->save();
        }

        return to_route('parcela.list', $parcela->emprestimo_id);
    }

    public function list(Emprestimo $emprestimo)
    {
        $parcelas = $emprestimo->parcelas;

        return view('parcela.list')->with('parcelas', $parcelas)->with('emprestimo', $emprestimo);
    }
}
