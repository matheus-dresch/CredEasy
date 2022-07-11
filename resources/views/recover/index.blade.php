<x-form-default title="Recuperar" css="recover">
    <form action="/" class="form" method="post">
        <h1>Recupere sua conta</h1>
        <div class="input-div">
            <label class="input-label">
                <h6 class="text-light">Seu CPF</h6>
                <input class="input-box" id="cpf" type="text" name="cpf" placeholder="XXX.XXX.XXX-XX"
                    maxlength="14" required>
            </label>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-purple rounded-pill px-3 py-0 my-3">Enviar e-mail</button>
        </div>
    </form>
    <script src="{{ asset('js/login/focus.js') }}"></script>
    <script src="{{ asset('js/login/mask.js') }}"></script>
</x-form-default>
