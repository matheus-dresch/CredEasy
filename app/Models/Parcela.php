<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $dates = ['data_vencimento', 'data_pagamento'];
    public $timestamps = false;

    public function emprestimo()
    {
        return $this->belongsTo(Emprestimo::class);
    }

    public function scopePagas(Builder $query)
    {
        $query->where('status', 'PAGA');
    }
}
