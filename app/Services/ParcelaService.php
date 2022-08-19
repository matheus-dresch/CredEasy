<?php

namespace App\Services;

use App\Models\Parcela;
use DateInterval;
use DateTimeImmutable;
use DomainException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ParcelaService
{
    public function criaParcelas(int $emprestimoId, float $valorTotal, int $quantidadeParcelas)
    {
        $valorParcela = $valorTotal / $quantidadeParcelas;

        $parcelas = [];
        $dataVencimento = (new DateTimeImmutable())->add(new DateInterval('P1M'));

        for ($i = 1; $i <= $quantidadeParcelas; $i++) {
            $parcelas[] = [
                'emprestimo_id' => $emprestimoId,
                'valor' => $valorParcela,
                'numero' => $i,
                'data_vencimento' => $dataVencimento,
                'taxa_multa' => 0
            ];

            $dataVencimento = $dataVencimento->add(new DateInterval('P1M'));
        }

        Parcela::insert($parcelas);
    }

    public function pagaParcela(int $parcelaId): Parcela
    {
        /** @var Parcela $parcela */
        $parcela = Parcela::with('emprestimo')->find($parcelaId);
        $emprestimo = $parcela->emprestimo;
        
        if ($emprestimo->cliente_id != Auth::user()->id) throw new AuthorizationException('Usuário não é vinculado à parcela', 0);
        if ($parcela->numero != $emprestimo->proximaParcela()) throw new DomainException('A parcela anterior ainda não foi paga', 1);

        $parcela->status = "PAGA";
        $parcela->data_pagamento = now();
        $parcela->save();

        return $parcela;
    }

    public function atualizaParcela(Parcela $parcela): Parcela
    {
        $parcela->status = "ATRASADA";
        $parcela->valor *= 1.02;
        $parcela->save();

        return $parcela;
    }
}