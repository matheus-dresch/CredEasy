<?php

namespace App\Services;

use App\Models\Emprestimo;
use App\Models\Parcela;
use DateInterval;
use DateTimeImmutable;
use DomainException;
use Illuminate\Support\Facades\Auth;

class EmprestimoService
{

    public function registra(array $emprestimoData): Emprestimo
    {
        // Converte a renda que vem mascarada para um float (R$ 1200,50 -> 120050 -> 1200.50)
        $valor = floatval(preg_replace('/[\D]/', '', $emprestimoData['valor'])) / 100;

        if ($valor < 1000) {
            throw new DomainException("O valor do empréstimo deve ser de no mínimo R$ 1.000,00");
        } else if ($valor > 1000000000) {
            throw new DomainException("O valor do empréstimo deve ser de no máximo R$ 1.000.000.000,00");
        }

        $emprestimoData['valor'] = $valor;

        $emprestimoData['taxa_juros'] = 20;
        $emprestimoData['data_solicitacao'] = now();
        $emprestimoData['cliente_id'] = Auth::user()->id;
        $emprestimoData['valor_final'] = $valor * 1.2;

        $valorParcela = ($valor * 1.1) / $emprestimoData['qtd_parcelas'];

        if ($valorParcela < 200) {
            $valorFormatado = number_format($valorParcela, 2, '.', ',');
            $msg = "Valor mínimo da parcela: R$ 200,00; Valor calculado: R$ $valorFormatado";

            throw new DomainException($msg);
        }

        $emprestimo = Emprestimo::create($emprestimoData);

        return $emprestimo;
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

    public function atualizar(Emprestimo $emprestimo, float $taxa, string $status)
    {
        $this->validaAtualizacao($emprestimo);

        $emprestimo->status = $status;
        $emprestimo->taxa_juros = $taxa;

        if ($status === "APROVADO") {
            $this->criaParcelas($emprestimo);
        }

        $taxaJuros = 1 + ($taxa / 100);
        $emprestimo->valor_final = $emprestimo->valor * $taxaJuros;

        return $emprestimo->save();
    }

    private function validaAtualizacao(Emprestimo $emprestimo)
    {

        if ($emprestimo->status != "SOLICITADO") {
            throw new DomainException("O empréstimo já foi '{$emprestimo->status}' e não pode mais ser atualizado.");
        } else if ($emprestimo->cliente_id === Auth::user()->cpf) {
            throw new DomainException("Você não pode atualizar seu próprio empréstimo.");
        }
    }
}
