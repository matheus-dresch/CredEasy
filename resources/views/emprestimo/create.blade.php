<x-layout.form title="Novo empréstimo" css="login">
    <section class="d-flex flex-column align-items-center">
        <div id="main-form" class="my-3">
            <form action="{{ route('emprestimo.store') }}" class="bg-dark-25 rounded-4 py-3" method="post">
                @csrf
                <h1>Solicite um empréstimo</h1>
                <div class="px-3 mt-2 mb-4">
                    <label class="input-label">
                        <h6 class="text-light">Nome do empréstimo</h6>
                        <input class="input-box" type="text" name="nome" placeholder="Contas de julho">
                    </label>
                </div>
                <div class="px-3 mt-2 mb-4">
                    <label class="input-label">
                        <h6 class="text-light">Valor do empréstimo</h6>
                        <input class="input-box" type="text" name="valor" placeholder="R$ 1.277,80"
                            data-type="income">
                    </label>
                </div>
                <div class="px-3 mt-2 mb-4">
                    <label class="input-label">
                        <h6 class="text-light">Quantidade de parcelas</h6>
                        <input class="input-box" type="number" name="parcelas" placeholder="12">
                    </label>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-purple rounded-pill px-3 py-0 my-3">Solicitar</button>
                </div>
            </form>
        </div>
    </section>
    <script src="{{ asset('js/login/focus.js') }}"></script>
    <script src="{{ asset('js/mask/money.js') }}"></script>
    </x-form-default>
