<x-layout.cliente title="Empréstimo {{ $emprestimo->id }}">
    <h1> Empréstimo {{ $emprestimo->id }}</h1>
    <ul class="list-group">
        <li class="list-group-item"> ID: {{ $emprestimo->id }} </li>
        <li class="list-group-item"> Nome: {{ $emprestimo->nome }} </li>
        <li class="list-group-item"> Valor: {{ $emprestimo->valor }} </li>
        <li class="list-group-item"> Valor final: {{ $emprestimo->valor_final }} </li>
        <li class="list-group-item"> Taxa: {{ $emprestimo->taxa_juros }} </li>
        <li class="list-group-item"> Data soli.: {{ $emprestimo->data_solicitacao }} </li>
        <li class="list-group-item"> Data quit.: {{ $emprestimo->data_quitacao }} </li>
        <li class="list-group-item"> Status.: {{ $emprestimo->status }} </li>
        <li class="list-group-item"> Qtd. parcelas: {{ $emprestimo->parcelas->count() }} </li>
    </ul>

</x-layout.cliente>
