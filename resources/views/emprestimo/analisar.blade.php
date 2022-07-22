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
                    <td id="valor_total" >R$ {{ number_format($emprestimo->valor_final, 2, ',', '.') }}</td>
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
        <div>
            @if ($emprestimo->status === 'SOLICITADO')
                <form action="{{ route('emprestimo.atualizar', $emprestimo->id) }}" class="w-100" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col pe-1">
                            <label for="valor_parc" class="form-label text-light">Taxa de juros (%)</label>
                            <input class="form-control" type="number" min="10" max="20" step="0.1"
                                name="taxa" id="taxa" value="{{ $emprestimo->taxa_juros }}">
                        </div>
                        <div class="col ps-1">
                            <label for="valor_parc" class="form-label text-light">Valor da parcela</label>
                            <input class="form-control disabled" type="text" id="valor_parc" disabled
                                value="R$ {{ number_format($emprestimo->valor_final / $emprestimo->qtd_parcelas, 2, ',', '.') }}">
                        </div>
                    </div>
                    <div class="d-flex w-100 mt-3">
                        <button type="submit" value="1" name="status"
                            class="form-control btn btn-outline-success w-100 me-1">
                            Aprovar
                        </button>
                        <button type="submit" value="2" name="status" class="btn btn-outline-danger w-100 ms-1">
                            Rejeitar
                        </button>
                    </div>
                </form>
            @else
                <div class="row">
                    <div class="col pe-1">
                        <label for="valor_parc" class="form-label text-light fw-bold">Taxa de juros (%)</label>
                        <input class="form-control disabled" disabled value="{{ $emprestimo->taxa_juros }}">
                    </div>
                    <div class="col ps-1">
                        <label for="valor_parc" class="form-label text-light fw-bold">Valor da parcela</label>
                        <input class="form-control disabled" type="text" id="valor_parc" disabled
                            value="R$ {{ number_format($emprestimo->valor_final / $emprestimo->qtd_parcelas, 2, ',', '.') }}">
                    </div>
                </div>
            @endif
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
    <script>
        const valorEmprestimo = {!! json_encode($emprestimo->valor) !!};
        const quantidadeParcelas = {!! json_encode($emprestimo->qtd_parcelas) !!};
    </script>
    <script src="{{ asset('js/emprestimo/calculaJuros.js') }}"></script>
</x-layout.cliente>
