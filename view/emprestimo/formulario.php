<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require __DIR__ . '/../head-html.php'; ?>
    <title>CredEasy - Novo Emprestimo</title>
    <link rel="stylesheet" href="./Assets/CSS/Login/style.css">
</head>

<body>
    <?php require __DIR__ . '/../header-cliente.php'; ?>
    <main class="m-3">
        <section class="d-flex justify-content-center">
            <h4 id="main-head" class="text-center bg-dark-25 text-purple rounded-pill px-4 py-2 mb-3">Novo empréstimo</h4>
        </section>
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
    </main>
</body>

</html>