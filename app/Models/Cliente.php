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

    protected $hidden = ['senha', 'emprestimos'];

    protected $appends = ['total_pago', 'total_emprestado', 'quantidade_emprestimos'];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function getTotalPagoAttribute(): float
    {
        $totalPago = 0;
        
        foreach ($this->emprestimos as $emprestimo) {
            if (! $emprestimo->parcelas()->exists()) continue;

            foreach ($emprestimo->parcelas as $parcela) {
                if ($parcela->status === "PAGA") $totalPago += $parcela->valor;
            }
        }

        return $totalPago;
    }

    public function getQuantidadeEmprestimosAttribute(): int
    {
        return $this->emprestimos->count();
    }

    public function getTotalEmprestadoAttribute(): float
    {
        $totalPago = $this->emprestimos->reduce(fn ($acum, $item) => $acum + $item->valor);

        return $totalPago;
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
