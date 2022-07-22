<x-layout.cliente title="Área do Cliente">
    <section>
        <h3 class="text-light mb-4">Bem-vindo(a), você está na área do cliente.</h3>
    </section>
    <section class="d-grid container-fluid">
        @include('flash::message')
        <div class="row">
            <div class="col-12 col-lg-4 mb-2 px-1">
                <article class="p-3 rounded d-flex align-items-center perfil-container">
                    <img src="{{ asset('icons/profile.svg') }}" class="img-5 rounded-circle" style="filter: invert(1)">
                    <div class="ms-3">
                        <h5 class="d-block text-light">Olá, {{ $cliente->primeiroNome() }}</h5>
                        <div class="d-flex flex-column">
                            <a href="{{ route('cliente.conta') }}"
                                class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span
                                    class="material-symbols-outlined fs-5 me-2">account_circle</span>Minha conta</a>
                            <a href=""
                                class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span
                                    class="material-symbols-outlined fs-5 me-2">settings</span>Configurações</a>
                            <a href="{{ route('logout') }}"
                                class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span
                                    class="material-symbols-outlined fs-5 me-2">logout</span>Sair</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-12 col-lg-4 mb-2 px-1">
                <article class="p-3 rounded d-flex align-items-center perfil-container">
                    <img src="{{ asset('icons/money.svg') }}" class="img-5 rounded-circle" style="filter: invert(1)">
                    <div class="ms-3 ">
                        <h5 class="d-block text-light">Próxima parcela</h5>
                        <div class="d-flex flex-column">
                            @if ($parcela)
                                <span class="d-flex align-items-center text-light text-decoration-none"><span
                                        class="material-symbols-outlined fs-5 me-2">event</span>{{ $parcela->data_vencimento->format('d/m/Y') }}</span>
                                <span class="d-flex align-items-center text-light text-decoration-none"><span
                                        class="material-symbols-outlined fs-5 me-2">paid</span>R$
                                    {{ number_format($parcela->valor, 2, ',', '.') }}</span>
                                <a href="{{ route('emprestimo.parcelas', $parcela->emprestimo_id) }}"
                                    class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span
                                        class="material-symbols-outlined fs-5 me-2">arrow_circle_right</span>Acessar</a>
                            @else
                                <span class="d-flex align-items-center text-light text-decoration-none"><span
                                        class="material-symbols-outlined fs-5 me-2">event</span>--/--/----</span>
                                <span class="d-flex align-items-center text-light text-decoration-none"><span
                                        class="material-symbols-outlined fs-5 me-2">paid</span>R$ ---</span>
                            @endif
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-12 col-lg-4 mb-2 px-1">
                <article class="p-3 rounded d-flex align-items-center perfil-container">
                    <img src="{{ asset('icons/star.svg') }}" class="img-5 rounded-circle" style="filter: invert(1)">
                    <div class="ms-3 ">
                        <h5 class="d-block text-light">Último empréstimo</h5>
                        <div class="d-flex flex-column">
                            @if ($emprestimos->first())
                                <span class="d-flex align-items-center text-light text-decoration-none">
                                    <span class="material-symbols-outlined fs-5 me-2">info</span>
                                    {{ $emprestimos->first()->nome }}
                                </span>
                                <span class="d-flex align-items-center text-light text-decoration-none">
                                    <span class="material-symbols-outlined fs-5 me-2">paid</span>
                                    R$ {{ number_format($emprestimos->first()->valor, 2, ',', '.') }}
                                </span>
                                <a href="{{ route('emprestimo.show', $emprestimos->first()->id) }}"
                                    class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold">
                                    <span class="material-symbols-outlined fs-5 me-2">arrow_circle_right</span>
                                    Acessar
                                </a>
                            @else
                                <span class="d-flex align-items-center text-light text-decoration-none">
                                    <span class="material-symbols-outlined fs-5 me-2">info</span>
                                    --------
                                </span>
                                <span class="d-flex align-items-center text-light text-decoration-none">
                                    <span class="material-symbols-outlined fs-5 me-2">paid</span>
                                    R$ ---
                                </span>
                            @endif
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col pb-2 px-1">
                <article class="perfil-container rounded text-light text-center" style="height: 100%;"></article>
            </div>
            <div class="col-12 col-lg-6 mb-2 px-1">
                <article id="emp-btn-1" class="emp-btn rounded text-light text-center">
                    <a href="{{ route('emprestimo.form') }}";
                        class="p-4 fs-3 fs-lg-1 m-0 fw-bolder rounded d-flex justify-content-center align-items-center text-decoration-none text-light">
                        <span class="material-symbols-outlined fs-2 me-2 d-none d-lg-inline">
                            paid
                        </span>
                        SOLICITAR EMPRÉSTIMO
                    </a>
                </article>
            </div>
            <div class="col-3 pb-2 px-1">
                <article class="perfil-container rounded text-light text-center" style="height: 100%;"></article>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 mb-2 px-1">
                <article class="rounded text-light perfil-container px-2">
                    <h5 class="d-flex align-items-center p-2">
                        <span class="fs-4 me-2 material-symbols-outlined">
                            monitoring
                        </span>
                        Estatísticas
                    </h5>
                    <div>
                        <h5 class="m-0">&bull; Total emprestado:</h5>
                        <p class="ps-3 fs-5">R$ {{ $estatisticas['emprestado'] }}</p>
                    </div>
                    <div>
                        <h5 class="m-0">&bull; Total pago:</h5>
                        <p class="ps-3 fs-5">R$ {{ $estatisticas['pago'] }}</p>
                    </div>
                    <div>
                        <h5 class="m-0">&bull; Nº de empréstimos:</h5>
                        <p class="ps-3 fs-5"> {{ $estatisticas['emprestimos'] }} </p>
                    </div>
                </article>
            </div>
            <div class="col-12 col-lg-4 mb-2 px-1">
                <article class="rounded text-light perfil-container px-2">
                    <h5 class="d-flex align-items-center p-2">
                        <span class="fs-4 me-2 material-symbols-outlined">
                            support
                        </span>
                        Está com problemas?
                    </h5>
                    <h6>&RightArrow; Entre em contato com nosso suporte!</h6>
                    <ul>
                        <li>
                            <span class="fw-bold">E-mail:</span>
                            <p href="suporte@credeasy.com.br">suporte@credeasy.com.br</p>
                        </li>
                        <li>
                            <span class="fw-bold">Telefone (ligações):</span>
                            <p>(54) 9 9972-4910</a>
                        </li>
                        <li>
                            <span class="fw-bold">Celular (WhatsApp):</span>
                            <p>(54) 9 9938-2150</a>
                        </li>
                    </ul>
                </article>
            </div>
            <div class="col-12 col-lg-4 mb-2 px-1">
                <article class="rounded text-light perfil-container">
                    <h5 class="d-flex align-items-center p-2">
                        <span class="fs-4 me-2 material-symbols-outlined">
                            warning
                        </span>
                        Avisos
                    </h5>
                    <ul style="max-height: 25rem;">
                        <li>Você não tem nenhum aviso no momento
                        </li>
                    </ul>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-2 px-1">
                <article class="perfil-container rounded text-light text-center">
                    <h3 class="d-flex align-items-center p-2">
                        <span class="fs-4 me-2 material-symbols-outlined">
                            auto_awesome
                        </span>
                        Acesso rápido
                    </h3>
                    <div class="m-3">
                        <button class="btn btn-outline-primary btn-sm remover-filtros w-20">Todos</button>
                        <button class="btn btn-outline-warning btn-sm btn-filtro w-20" data-status="SOLICITADO">Solicitados</button>
                        <button class="btn btn-outline-success btn-sm btn-filtro w-20" data-status="APROVADO">Aprovados</button>
                        <button class="btn btn-outline-danger btn-sm btn-filtro w-20" data-status="REJEITADO">Rejeitados</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-light" style="overflow: scroll;">
                            <thead>
                                <th>Empréstimo</th>
                                <th>Valor</th>
                                <th>Parcelas</th>
                                <th>Status</th>
                            </thead>
                            <tbody id="tabela_emprestimos">

                                @foreach ($emprestimos as $emprestimo)
                                    <tr class="emprestimo" data-status="{{ $emprestimo->status }}">
                                        <td class="w-20">{{ $emprestimo->nome }}</td>
                                        <td class="w-20">R$ {{ number_format($emprestimo->valor, 2, ',', '.') }} </td>
                                        <td class="w-20">
                                            {{ $emprestimo->parcelasPagas() }} / {{ $emprestimo->qtd_parcelas }}
                                        </td>
                                        <td class="w-20"> {{ $emprestimo->status }}</td>
                                        <td class="w-20">
                                            <a href="{{ route('emprestimo.show', $emprestimo->id) }} "
                                                class="btn btn-outline-purple d-flex">
                                                <span class="material-symbols-outlined">
                                                    arrow_circle_right
                                                </span>
                                                <span class="d-none d-sm-inline">
                                                    Acessar
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
    </section>
    <script src="{{ asset('js/cliente/filtro.js') }}"></script>
</x-layout.cliente>
