<x-layout.cliente title="Área do Gestor">
    <section>
        <h3 class="text-light mb-4">Bem-vindo(a), você está na área do gestor.</h3>
    </section>
    <div class="row">
        <div class="col-12 mb-2 px-1">
            <article class="perfil-container rounded text-light text-center">
                <h3 class="d-flex align-items-center p-2">
                    <span class="fs-2 me-2 material-symbols-outlined">
                        pending_actions
                    </span>
                    Empréstimos para análise
                </h3>
                <div class="table-responsive">
                    <table class="table text-light" style="overflow: scroll;">
                        <thead>
                            <th>Empréstimo</th>
                            <th>Valor</th>
                            <th>Parcelas</th>
                            <th>Data</th>
                        </thead>
                        <tbody>

                            @foreach ($emprestimos as $emprestimo)
                                <tr>
                                    <td>{{ $emprestimo->nome }}</td>
                                    <td>R$ {{ number_format($emprestimo->valor, 2, ',', '.') }} </td>
                                    <td> {{ $emprestimo->qtd_parcelas }} </td>
                                    <td> {{ $emprestimo->data_solicitacao->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('emprestimo.analisar', $emprestimo->id) }} "
                                            class="btn btn-outline-purple d-flex">
                                            <span class="material-symbols-outlined">
                                                arrow_circle_right
                                            </span>
                                            <span class="d-none d-sm-inline">
                                                Analisar
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </article>
        </div>
    </div>
</x-layout.cliente>
