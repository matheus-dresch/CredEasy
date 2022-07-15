<x-layout.cliente title="Empréstimo {{ $emprestimo->id }}" classes="d-flex flex-column align-items-center">
    <h1 class="text-light"> Empréstimo '{!! $emprestimo->nome !!}'</h1>
    <div class="p-3 w-25 bg-dark-25 rounded-4">
        <table class="table text-light">
            <tbody>
                <tr>
                    <th>ID</td>
                    <td>{{ $emprestimo->id }}</td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td>{{ $emprestimo->nome }}</td>
                </tr>
                <tr>
                    <th>Valor inicial</th>
                    <td>R$ {{ number_format($emprestimo->valor, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Valor total pago</th>
                    <td>R$
                        @if ($emprestimo->valor_final)
                            {{ number_format($emprestimo->valor_final, 2, ',', '.') }} }}
                        @else
                            {{ '--' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Taxa de juros</th>
                    <td>{{ number_format($emprestimo->taxa_juros, 2, ',', '.') }}%</td>
                </tr>
                <tr>
                    <th>Data de solicitação</th>
                    <td>{{ $emprestimo->data_solicitacao->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Data de quitação</th>
                    <td>
                        @if ($emprestimo->data_quitacao)
                            {{ $emprestimo->data_quitacao->format('d/m/Y') }}
                        @else
                            {{ '--/--/----' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $emprestimo->status }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('parcela.list', $emprestimo->id) }} " class="btn btn-outline-purple d-flex">
            <span class="material-symbols-outlined">
                arrow_circle_right
            </span>
            <span class="d-none d-sm-inline">
                Acessar parcelas
            </span>
        </a>
    </div>

</x-layout.cliente>
