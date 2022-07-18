<x-layout.cliente title="Parcelas" classes="d-flex flex-column align-items-center">
    <h1 class="text-light">Parcelas do empréstimo '{!! $emprestimo->nome !!}'</h1>
    <div class="bg-dark-25 rounded-4 w-75 p-3">
        <table class="table text-light">
            <thead>
                <th>Número</th>
                <th>Valor</th>
                <th>Data venc.</th>
                <th>Data pgto.</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($parcelas as $parcela)
                    <tr>
                        <td><b># {{ $parcela->numero }}</b></th>
                        <td>R$ {{ number_format($parcela->valor, 2, ',', '.') }}</td>
                        <td>{{ $parcela->data_vencimento->format('d/m/Y') }}</td>
                        <td>
                            @if ($parcela->data_pagamento)
                                {{ $parcela->data_pagamento->format('d/m/Y') }}
                            @else
                                {{ '--/--/----' }}
                            @endif
                        </td>
                        <td>{{ $parcela->status }}</td>
                        <td>
                            @if ($parcela->status === 'ABERTA')
                            <form action="{{ route('parcela.paga-parcela', $parcela->id) }}" class="w-100" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-purple d-flex w-100">
                                    <span class="material-symbols-outlined me-2">
                                        arrow_circle_right
                                    </span>
                                    <span class="d-none d-sm-inline">
                                        Pagar
                                    </span>
                                </button>
                            </form>
                            @else
                                <a disabled class="btn btn-outline-success d-flex disabled">
                                    <span class="material-symbols-outlined me-2">
                                        task_alt
                                    </span>
                                    <span class="d-none d-sm-inline">
                                        Pago
                                    </span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.cliente>
