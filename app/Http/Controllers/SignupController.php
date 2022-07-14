<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
    {
        return view('signup.index');
    }

    public function store(SignupFormRequest $request)
    {
        $clienteData = $request->all();

        $renda = $clienteData['renda'];
        $renda = floatval(preg_replace('/[\D]/', '', $renda)) / 100;

        $clienteData['renda'] = $renda;

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

        Cliente::create($clienteData);

        return to_route('cliente.index');
    }
}
