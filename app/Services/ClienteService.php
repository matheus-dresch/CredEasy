<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function registra(array $clienteData): Cliente|bool
    {
        $renda = $clienteData['renda'];
        $renda = floatval(preg_replace('/[\D]/', '', $renda)) / 100;

        $clienteData['renda'] = $renda;

        $clienteData['senha'] = password_hash($clienteData['senha'], PASSWORD_ARGON2I);

        [
            'cep' => $cep,
            'uf' => $estado,
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
