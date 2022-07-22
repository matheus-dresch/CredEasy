<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $dates = ['data_solicitacao', 'data_quitacao'];
    protected $fillable = [
        'nome',
        'valor',
        'valor_final',
        'taxa_juros',
        'data_solicitacao',
        'data_quitacao',
        'status',
        'cliente_cpf',
        'qtd_parcelas'
    ];

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }

    public function parcelasPagas()
    {
        return $this->parcelas
            ->filter(fn ($parcela) => $parcela->status === "PAGA")
            ->count();
    }
}
