<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Icons/credeasy.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../CSS/Recuperar/style.css">
    <title>CredEasy - Recuperar</title>
</head>
<body>
    <header id="header-nav" class="navbar navbar-expand-md navbar-dark sticky-top">
        <section class="container-fluid">
            <a id="header-title" class="navbar-brand" href="/">CredEasy</a>
    </header>
    <main class="p-3">
        <section class="d-flex justify-content-center">
            <div id="main-head" class="text-center py-2 px-5 rounded-pill" style="width: fit-content;">
                <h4 class="text-purple">Esqueceu sua senha?</h4>
                <h5 class="text-light">Não se preocupe.</h5>
            </div>
        </section>
        <section class="d-flex justify-content-center my-3">
            <div id="main-form" class="rounded-4 py-3">
                <form action="">
                    <div class="py-2 px-3">
                        <label id="input-label">
                            <h6 class="text-light text-center">Seu e-mail </h6>
                            <input type="email" name="user-email" id="input-email" placeholder="exemplo@email.com">
                            <h6 id="input-text" class="text-secondary pt-2">Enviaremos as instruções por ele.</h6>
                        </label>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <button id="sub-button" type="submit" class="btn btn-outline-purple rounded-pill px-3 py-0 fw-boldc">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>