<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Model implements Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'cpf',
        'nome',
        'celular',
        'endereco',
        'profissao',
        'renda',
        'email',
        'senha',
        'tipo'
    ];

    public $timestamps = false;

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function numerosTotais()
    {
        $qtdEmprestimos = $this->emprestimos->count();

        $emprestimos = $this->emprestimos->filter(fn ($emprestimo) => in_array($emprestimo->status, [ 'APROVADO', 'QUITADO' ]));
        $totalEmp = $emprestimos->reduce(fn ($acum, $item) => $acum + $item['valor']);

        $totalPago = 0;
        $totalEmp = 0;
        foreach ($emprestimos as $emprestimo) {
            $totalEmp += $emprestimo->valor;

            $parcelasPagas = $emprestimo->parcelas->filter(fn ($parcela) => $parcela->status === "PAGA");

            foreach ($parcelasPagas as $parcela) {
                $totalPago += $parcela->valor;
            }
        }

        return [
            'emprestado' => $totalEmp,
            'pago' => $totalPago,
            'emprestimos' => $qtdEmprestimos
        ];
    }

    public function proximaParcela()
    {
        $parcela = Parcela::select('parcelas.emprestimo_id', 'parcelas.data_vencimento', 'parcelas.valor')
            ->join('emprestimos', 'parcelas.emprestimo_id', 'emprestimos.id')
            ->where('cliente_id', $this->id)
            ->where('parcelas.status', '!=', 'PAGA')
            ->orderBy('parcelas.data_vencimento')
            ->limit(1)
            ->first();

        return $parcela;
    }

    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['email'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['senha'];
    }

    public function setRememberToken($value)
    {

    }

    public function getRememberToken()
    {
        return '';
    }

    public function getRememberTokenName()
    {
        return '';
    }
}
