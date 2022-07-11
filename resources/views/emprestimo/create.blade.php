<x-form-default title="Cadastro" css="">
        <section class="d-flex justify-content-center">
            <div id="main-form" class="my-3">
                <form action="/do-login" class="bg-dark-25 rounded-4 py-3" method="post">
                    <div class="px-3 mt-2 mb-4">
                        <label class="input-label">
                            <h6 class="text-light">Nome do empréstimo</h6>
                            <input class="input-box" type="text" name="nome" placeholder="Contas de julho">
                        </label>
                    </div>
                    <div class="px-3 mt-2 mb-4">
                        <label class="input-label">
                            <h6 class="text-light">Valor do empréstimo</h6>
                            <input class="input-box" type="text" name="valor" placeholder="R$ 1.277,80">
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-purple rounded-pill px-3 py-0 my-3">Solicitar</button>
                    </div>
                </form>
                <?php if (isset($_SESSION['msg'])) : ?>
                    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> mt-3 rounded-4">
                        <strong>
                            <?php
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg_type']);
                            unset($_SESSION['msg']);
                            ?>
                        </strong>
                    </div>
                <?php endif; ?>
            </div>
        </section>
</x-form-default>
