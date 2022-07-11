<x-form-default title="Entrar" css="login">
                <form action="/do-login" class="form" method="post">
                    <h1>Bem-vindo(a) novamente!</h1>
                    <div class="input-div">
                        <label class="input-label">
                            <h6 class="text-light">Seu CPF</h6>
                            <input class="input-box" id="cpf" type="text" name="cpf" placeholder="XXX.XXX.XXX-XX" maxlength="14" required>
                        </label>
                    </div>
                    <div class="input-div">
                        <label class="input-label">
                            <h6 class="text-light">Sua senha</h6>
                            <input class="input-box" type="password" name="senha" placeholder="senha" required>
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-purple rounded-pill px-3 py-0 my-3">Entrar</button>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <a class="text-light td-none" href="/recover">&#8250; Esqueci minha senha</a>
                        <a class="text-light td-none" href="/signup">&#8250; Não sou cliente</a>
                    </div>
                </form>
        <script src="{{ asset("js/login/focus.js") }}"></script>
        <script src="{{ asset("js/login/mask.js") }}"></script>
</x-default>
