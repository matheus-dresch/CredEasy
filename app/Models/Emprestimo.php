<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    public function cliente()
    {
        $this->belongsTo(Cliente::class);
    }

    public function parcelas()
    {
        $this->hasMany(Parcela::class);
    }
}
