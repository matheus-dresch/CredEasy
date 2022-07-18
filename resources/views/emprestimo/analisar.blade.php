<x-layout.cliente title="Analisar" classes="d-flex flex-column align-items-center">
    @include('flash::message')
    @if ($errors->any())
        <div class="alert alert-danger rounded-4 w-50">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="p-3 w-50 bg-dark-25 rounded-4">
        <table class="table text-light">
            <h3 class="text-light text-center"> Empréstimo '{!! $emprestimo->nome !!}'</h3>
            <tbody>
                <tr>
                    <th class="w-50">ID</td>
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
                    <td>R$ {{ number_format($emprestimo->valor_final, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Taxa de juros</th>
                    <td class="align-items-center">
                        <form action="{{ route('emprestimo.muda-taxa', $emprestimo->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="number" class="rounded input-box btn-sm" name="taxa"
                                value="{{ $emprestimo->taxa_juros }}" step="0.1" max="20" min="10">
                            <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Valor parcela</th>
                    <td>R$ {{ number_format($emprestimo->valor_final / $emprestimo->qtd_parcelas, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Data de solicitação</th>
                    <td>{{ $emprestimo->data_solicitacao->format('d/m/Y') }}
                    </td>
                </tr>
                <tr>
                    <th>Nº parcelas</th>
                    <td>{{ $emprestimo->qtd_parcelas }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $emprestimo->status }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table text-light">
            <h3 class="text-light text-center"> Cliente '{!! $cliente->nome !!}'</h1>
                <tr>
                    <th class="w-50">CPF</th>
                    <td>{{ $cliente->cpf }}</td>
                </tr>
                <tr>
                    <th>Profissão</th>
                    <td>{{ $cliente->profissao }}</td>
                </tr>
                <tr>
                    <th>Renda</th>
                    <td>R$ {{ number_format($cliente->renda, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Telefone</th>
                    <td>{{ $cliente->telefone }}</td>
                </tr>
        </table>
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
    <style>
        .input-box {
            outline: none;
            border: none;
            background-color: #fff3;
            color: #fff;
        }
    </style>
</x-layout.cliente>
