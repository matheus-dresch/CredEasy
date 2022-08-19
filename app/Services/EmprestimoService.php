<?php

namespace App\Services;

use App\Models\Emprestimo;
use App\Traits\ServiceTrait;
use DomainException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class EmprestimoService
{
    use ServiceTrait;

    /**
     * @throws DomainException CODE 0 = VALOR MINIMO EMPRESTIMO
     * @throws DomainException CODE 1 = VALOR MAXIMO EMPRESTIMO
     * @throws DomainException CODE 2 = VALOR MINIMO PARCELA
     */
    public function registra(array $emprestimoData): Emprestimo
    {
        $VALOR_MAXIMO_EMPRESTIMO = 100000000;
        $VALOR_MINIMO_EMPRESTIMO = 1000;
        $VALOR_MINIMO_PARCELA = 200;
        $TAXA_JUROS_MAXIMA = 20;
        $TAXA_JUROS_MINIMA = 10;

        //? Converte a renda que vem mascarada para um float (R$ 1200,50 -> 120050 -> 1200.50)
        $valor = floatval(preg_replace('/[\D]/', '', $emprestimoData['valor'])) / 100;

        if ($valor < $VALOR_MINIMO_EMPRESTIMO) throw new DomainException("O valor mínimo do empréstimo é de R$ {$this->formataDinheiro($VALOR_MINIMO_EMPRESTIMO)}");
        if ($valor > $VALOR_MAXIMO_EMPRESTIMO) throw new DomainException("O valor máximo do empréstimo é de R$ {$this->formataDinheiro($VALOR_MAXIMO_EMPRESTIMO)}");

        //? Inicializa os valores padrão do empréstimo
        $emprestimoData['valor'] = $valor;
        $emprestimoData['taxa_juros'] = $TAXA_JUROS_MAXIMA;
        $emprestimoData['data_solicitacao'] = now();
        $emprestimoData['cliente_id'] = Auth::user()->id;
        $emprestimoData['valor_final'] = $emprestimoData['valor'] * $TAXA_JUROS_MAXIMA / 100 + 1;

        $valorMinimo = $valor * ($TAXA_JUROS_MINIMA / 100 + 1);
        $valorParcela = $valorMinimo / $emprestimoData['qtd_parcelas'];
        if ($valorParcela < $VALOR_MINIMO_PARCELA) throw new DomainException("O valor mínimo da parcela é de R$ {$VALOR_MINIMO_PARCELA}");

        $emprestimo = Emprestimo::create($emprestimoData);

        return $emprestimo;
    }

    public function atualizar(Emprestimo $emprestimo, float $taxa, bool $status): Emprestimo
    {
        $this->validaAtualizacao($emprestimo);

        if ($status) return $this->aprovaEmprestimo($emprestimo, $taxa);
        
        $emprestimo->status = "REJEITADO";
        $emprestimo->save();

        return $emprestimo;
    }

    private function aprovaEmprestimo(Emprestimo $emprestimo, float $taxa)
    {
        $taxaJuros = 1 + ($taxa / 100);
        
        $emprestimo->taxa_juros = $taxa;
        $emprestimo->status = "APROVADO";
        $emprestimo->valor_final = $emprestimo->valor * $taxaJuros;
        $emprestimo->save();

        $this->parcelaService()->criaParcelas(
            $emprestimo->id, 
            $emprestimo->valor_final, 
            $emprestimo->qtd_parcelas
        );

        return $emprestimo;
    }

    private function validaAtualizacao(Emprestimo $emprestimo): void
    {
        if (Auth::user()->tipo != "GESTOR") throw new AuthorizationException("Você não tem permissão para atualizar este empréstimo");
        if ($emprestimo->status != "SOLICITADO") throw new DomainException("O empréstimo não pode mais ser atualizado");
        if ($emprestimo->cliente_id === Auth::user()->cpf) throw new AuthorizationException("Você não pode atualizar seu próprio empréstimo");
    }

    public function checaParcelasAtrasadas(Int $id)
    {
        $emprestimo = Emprestimo::find($id);
        $parcelas = $emprestimo->parcelas()->where('status', 'ABERTA')->get();

        foreach ($parcelas as $parcela) {
            if ($parcela->data_vencimento < now()) {
                $this->parcelaService()->atualizaParcela($parcela);
            }
        }

        return;
    }

    private function formataDinheiro(int $valor): string
    {
        return number_format($valor, 2, ',', '.');
    }
}
