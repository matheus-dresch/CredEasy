<x-layout.cliente title="Minha conta" classes="d-flex flex-column align-items-center">
        <div class="p-3 w-75 bg-dark-25 rounded-4">
            <table class="table text-light">
                <h1 class="text-light text-center"> Olá, {!! $cliente->primeiroNome() !!}!</h1>
                <tbody>
                    <tr>
                        <th class="w-25">Nome</th>
                        <td>{{ $cliente->nome }}</td>
                    </tr>
                    <tr>
                        <th>CPF</th>
                        <td>{{ $cliente->cpf }}</td>
                    </tr>
                    <tr>
                        <th>Telefone</th>
                        <td>{{ $cliente->telefone }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ $cliente->email }}</td>
                    </tr>
                    <tr>
                        <th>Profissão</th>
                        <td>{{ $cliente->profissao }}</td>
                    </tr>
                    <tr>
                        <th>Endereço</th>
                        <td>{{ $cliente->endereco }}</td>
                    </tr>
                    <tr>
                        <th>Renda</th>
                        <td>R$ {{ number_format($cliente->renda, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="" class="btn btn-outline-purple d-flex">
                <span class="material-symbols-outlined">
                    arrow_circle_right
                </span>
                <span class="d-none d-sm-inline">
                    Atualizar cadastro
                </span>
            </a>
        </div>
</x-layout.cliente>
