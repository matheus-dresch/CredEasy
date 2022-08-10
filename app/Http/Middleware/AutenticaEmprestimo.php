<?php

namespace App\Http\Middleware;

use App\Models\Emprestimo;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class AutenticaEmprestimo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $emprestimo = Emprestimo::find($request->route('id'));
        $cliente = $request->user();

        if (! $emprestimo->cliente_id === $cliente->id && !$cliente->tipo === 'GESTOR') {
            throw new AuthorizationException();
        };

        return $next($request);
    }
}
