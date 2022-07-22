<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastroRequest;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function index()
    {
        return view('cadastro');
    }

    public function store(Request $request, ClienteService $service)
    {
        $clienteData = $request->except('_token');
        $cliente= $service->registra($clienteData);

        flash("Faça o login para começar a usar a CredEasy! :)")->success();
        return to_route('login');
    }
}
