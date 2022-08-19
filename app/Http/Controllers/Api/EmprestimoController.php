<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmprestimoFormRequest;
use App\Models\Emprestimo;
use App\Services\EmprestimoService;
use App\Traits\ApiResponse;
use App\Traits\ServiceTrait;
use DomainException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmprestimoController extends Controller
{

    use ServiceTrait, ApiResponse;

    public function detalhes(int $emprestimoId, Request $request)
    {
        $emprestimo = Emprestimo::find($emprestimoId);
        if (!$emprestimo) return $this->respostaErro("O empréstimo não existe", 404);

        if ($request->query('cliente')) {
            // if (Auth::user()->tipo != "GESTOR") return $this->respostaErro("Você não tem permissão para acessar este recurso", 403);

            return $this->respostaSucesso([
                'emprestimo' => $emprestimo,
                'cliente' => $emprestimo->cliente
            ]);
        }

        return $this->respostaSucesso([
            'emprestimo' => $emprestimo,
            'tem_parcelas' => $emprestimo->temParcelas()
        ]);
    }

    public function lista(Request $request)
    {
        if (!$request->query('gestor')) return Auth::user()->emprestimos;
        if (!Auth::user()->tipo === 'GESTOR') return $this->respostaErro('Você não tem permissão para acessar esse recurso.', 403);

        $emprestimosSolicitados = Emprestimo::where('status', 'SOLICITADO')
            ->where('cliente_id', '!=', Auth::user()->id)
            ->get();

        return $this->respostaSucesso([
            'emprestimos_solicitados' => $emprestimosSolicitados
        ]);
    }

    public function parcelas(int $id)
    {
        $emprestimo = Emprestimo::with('parcelas')->find($id);

        if (!$emprestimo || !$emprestimo->temParcelas()) return $this->respostaErro("O empréstimo não existe ou não tem parcelas", 404);

        $this->emprestimoService()->checaParcelasAtrasadas($id);

        return $this->respostaSucesso([
            'emprestimo' => $emprestimo->id,
            'parcelas' => $emprestimo->parcelas,
            'proxima_parcela' => $emprestimo->proximaParcela()
        ]);
    }

    public function pagaParcela(int $id)
    {
        try {
            $parcela = $this->parcelaService()->pagaParcela($id);
        } catch (AuthorizationException $err) {
            return $this->respostaErro($err->getMessage(), 403);
        } catch (DomainException $err) {
            return $this->respostaErro($err->getMessage(), 422);
        }

        return $this->respostaSucesso(['parcela' => $parcela], "Parcela {$parcela->numero} paga com sucesso!");
    }

    public function registra(EmprestimoFormRequest $request, EmprestimoService $emprestimoService)
    {
        $emprestimoData = $request->all();

        try {
            $emprestimo = $emprestimoService->registra($emprestimoData);
            return $this->respostaSucesso(['emprestimo' => $emprestimo], "O empréstimo {$emprestimo->nome} foi solicitado com sucesso", 201);
        } catch (DomainException $err) {
            return $this->respostaErro($err->getMessage(), 422);
        }
    }

    public function analisa(int $id, Request $request, EmprestimoService $emprestimoService)
    {
        $request->validate([
            'taxa' => ['required', 'numeric', 'min:10', 'max:20'],
            'status' => ['required', 'boolean']
        ]);

        $emprestimo = Emprestimo::find($id);

        if (!$emprestimo) return $this->respostaErro("O empréstimo não existe", 404);

        try {
            $emprestimo = $emprestimoService->atualizar($emprestimo, $request->taxa, $request->status);
            return $this->respostaSucesso(['emprestimo' => $emprestimo], "O empréstimo foi atualizado com sucesso");
        } catch (AuthorizationException $err) {
            return $this->respostaErro($err->getMessage(), 403);
        } catch (DomainException $err) {
            return $this->respostaErro($err->getMessage(), 422);
        }
    }
}
