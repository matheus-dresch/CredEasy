<?php

namespace App\Repositories;

use App\Http\Requests\SignupFormRequest;
use App\Models\Cliente;

class ClienteRepository
{
    public function add(array $clienteData): Cliente
    {
        $renda = $clienteData['renda'];
        $renda = floatval(preg_replace('/[\D]/', '', $renda)) / 100;

        $clienteData['renda'] = $renda;

        $clienteData['senha'] = password_hash($clienteData['senha'], PASSWORD_ARGON2I);

        [
            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'bairro' => $bairro,
            'rua' => $rua,
            'numcasa' => $numcasa,
        ] = $clienteData;

        $endereco = "$estado, $cidade - $cep, $bairro, $rua, $numcasa";
        $clienteData['endereco'] = $endereco;

        return Cliente::create($clienteData);
    }
}
