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
        'telefone',
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

        $emprestimos = $this->emprestimos->filter(fn ($emprestimo) => $emprestimo->status === "APROVADO");
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
            'emprestado' => number_format($totalEmp, 2, ',', '.'),
            'pago' => number_format($totalPago, 2, ',', '.'),
            'emprestimos' => $qtdEmprestimos
        ];
    }

    public function primeiroNome(): string
    {
        return explode(' ', $this->nome)[0];
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
