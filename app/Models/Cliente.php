<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

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

    // protected $table = 'cliente';

    public function emprestimos()
    {
        $this->hasMany(Emprestimo::class);
    }
}
