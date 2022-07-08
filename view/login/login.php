<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Icons/credeasy.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./Assets/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./Assets/CSS/Login/style.css">
    <title>CredEasy - Login</title>
</head>

<body>
    <header id="header-nav" class="navbar navbar-expand-md navbar-dark sticky-top">
        <section class="container-fluid">
            <a id="header-title" class="navbar-brand" href="../">CredEasy</a>
    </header>
    <main class="p-3">
        <section class="d-flex justify-content-center">
            <h4 id="main-head" class="text-center bg-dark-25 text-purple rounded-pill px-4 py-2 mb-3">Seja bem-vindo de volta :)</h4>
        </section>
        <section class="d-flex justify-content-center">
            <div id="main-form" class="my-3">
                <form action="/do-login" class="bg-dark-25 rounded-4 py-3" method="post">
                    <div class="px-3 mt-2 mb-4">
                        <label class="input-label">
                            <h6 class="text-light">Seu CPF</h6>
                            <input class="input-box" type="text" name="cpf" placeholder="XXX.XXX.XXX-XX">
                        </label>
                    </div>
                    <div class="px-3 my-3">
                        <label class="input-label">
                            <h6 class="text-light">Sua senha</h6>
                            <input class="input-box" type="password" name="senha" placeholder="senha">
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-purple rounded-pill px-3 py-0 my-3">Entrar</button>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                        <a class="text-light td-none fw-bold" href="/recover">&#8250; Esqueci minha senha</a>
                        <a class="text-light td-none fw-bold" href="/signup">&#8250; Não sou cliente</a>
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
    <script src="./Assets/JS/Login/focus.js"></script>
</body>

</html>