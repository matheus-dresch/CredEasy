<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmprestimoFormRequest;
use App\Models\Emprestimo;
use App\Services\EmprestimoService;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmprestimoController extends Controller
{

    public function __construct(private EmprestimoService $emprestimoService)
    {
    }

    //! Views
    public function form()
    {
        return view('emprestimo.form');
    }

    public function show(Emprestimo $emprestimo)
    {
        if ($emprestimo->cliente_id != Auth::user()->cpf) {
            flash("Você não tem permissão para acessar esse recurso.")->warning();
            return to_route('cliente.index');
        }

        return view('emprestimo.show')->with('emprestimo', $emprestimo);
    }

    public function analisar(Emprestimo $emprestimo)
    {
        return view('emprestimo.analisar')->with('emprestimo', $emprestimo)->with('cliente', $emprestimo->cliente);
    }

    //! Resources
    public function store(EmprestimoFormRequest $request, EmprestimoService $emprestimoService)
    {
        $emprestimoData = $request->all();

        try {
            $emprestimo = $emprestimoService->registra($emprestimoData);
            flash("O empréstimo '{$emprestimo->nome}' foi solicitado, agurde a aprovação.");
        } catch (DomainException $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

        return to_route('cliente.index');
    }

    public function atualizar(Emprestimo $emprestimo, Request $request)
    {
        $request->validate([
            'taxa' => ['required', 'numeric', 'min:10', 'max:20'],
            'status' => ['required', 'integer']
        ]);

        $status = $request->status == 1 ? "APROVADO" : "REJEITADO";
        try {
            $this->emprestimoService->atualizar($emprestimo, $request->taxa, $status);
        } catch (DomainException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        flash("O empréstimo foi atualizado com sucesso.");
        return redirect()->back();
    }

    public function emprestimos()
    {
        $emprestimos = Emprestimo::all();
        $emprestimosJson = json_decode($emprestimos);

        return response()->json($emprestimosJson);
    }
}
