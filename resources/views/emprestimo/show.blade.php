<x-layout.cliente title="Empréstimo {{ $emprestimo->id }}" classes="d-flex flex-column align-items-center">
    @include('flash::message')
    <div class="p-3 w-50 bg-dark-25 rounded-4">
        <table class="table text-light">
            <h1 class="text-light text-center"> Empréstimo '{!! $emprestimo->nome !!}'</h1>
            <tbody>
                <tr>
                    <th>ID</td>
                    <td># {{ $emprestimo->id }}</td>
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
                    <th>Valor total
                        <span class="badge bg-secondary rounded-circle" data-bs-toggle="tooltip"
                            title="Valor total estimado com os juros">
                            ?
                        </span>
                    </th>
                    <td>R$
                        @if ($emprestimo->valor_final)
                            {{ number_format($emprestimo->valor_final, 2, ',', '.') }}
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
                    <th>Nº parcelas</th>
                    <td>{{ $emprestimo->parcelas->count() }}</td>
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
        <div class="d-flex mt-3">
            <form action="{{ route('emprestimo.muda-status', $emprestimo->id) }}" class="w-50" method="post">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="status" checked class="d-none">
                <button type="submit" href="" class="btn btn-outline-success w-100 me-1">
                    Aprovar
                </button>
            </form>
            <form action="{{ route('emprestimo.muda-status', $emprestimo->id) }}" class="w-50" method="post">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="status" class="d-none">
                <button type="submit" class="btn btn-outline-danger w-100 ms-1">
                    Rejeitar
                </button>
            </form>
        </div>
    </div>

</x-layout.cliente>
