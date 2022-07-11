<!DOCTYPE html>
<html lang="ptbr" class="html">

<head>
    <?php require __DIR__ . '/../head-html.php'; ?>
    <link rel="stylesheet" href="./Assets/CSS/Cliente/style.css">
    <title>CredEasy - Área do Cliente</title>
</head>

<body>
    <header id="header-nav" class="navbar navbar-expand-md navbar-dark sticky-top">
        <section class="container-fluid">

            <a id="header-title" class="navbar-brand">CredEasy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <section class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbar-link rounded active">ínicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-link rounded" href="./suporte.html">suporte</a>
                    </li>
                </ul>
            </section>
        </section>
    </header>
    <main class="p-3">
        <section>
            <h3 class="text-light mb-4">Bem-vindo(a), você está na área do cliente.</h3>
        </section>
        <section class="d-grid container-fluid">
            <div class="row">
                <div class="col-12 col-lg-4 mb-2 px-1">
                    <article class="p-3 rounded d-flex align-items-center perfil-container">
                        <img src="./Assets/Icons/prof.png" class="img-5 rounded-circle border border-3">
                        <div class="ms-3">
                            <h5 class="d-block text-light">Olá, <?php echo $nome ?></h5>
                            <div class="d-flex flex-column">
                                <a href="" class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span class="material-symbols-outlined fs-5 me-2">account_circle</span>Minha conta</a>
                                <a href="" class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span class="material-symbols-outlined fs-5 me-2">settings</span>Configurações</a>
                                <a href="/do-logout" class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span class="material-symbols-outlined fs-5 me-2">logout</span>Sair</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-lg-4 mb-2 px-1">
                    <article class="p-3 rounded d-flex align-items-center perfil-container">
                        <img src="./Assets/Icons/money.svg" class="img-5 rounded-circle" style="filter: invert(1)">
                        <div class="ms-3 ">
                            <h5 class="d-block text-light">Próxima parcela</h5>
                            <div class="d-flex flex-column">
                                <span class="d-flex align-items-center text-light text-decoration-none"><span class="material-symbols-outlined fs-5 me-2">event</span>20/05/2022</span>
                                <span class="d-flex align-items-center text-light text-decoration-none"><span class="material-symbols-outlined fs-5 me-2">paid</span>R$ 242,90</span>
                                <a href="" class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span class="material-symbols-outlined fs-5 me-2">arrow_circle_right</span>Acessar</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-12 col-lg-4 mb-2 px-1">
                    <article class="p-3 rounded d-flex align-items-center perfil-container">
                        <img src="./Assets/Icons/star.svg" class="img-5 rounded-circle" style="filter: invert(1)">
                        <div class="ms-3 ">
                            <h5 class="d-block text-light">Último empréstimo</h5>
                            <div class="d-flex flex-column">
                                <span class="d-flex align-items-center text-light text-decoration-none"><span class="material-symbols-outlined fs-5 me-2">info</span><?php echo $ultimoEmprestimo ? $ultimoEmprestimo->getNomeEmprestimo() : 'Não encontrado' ?></span>
                                <span class="d-flex align-items-center text-light text-decoration-none"><span class="material-symbols-outlined fs-5 me-2">paid</span>R$ <?php echo $ultimoEmprestimo ? $ultimoEmprestimo->getValor() : '----' ?></span>
                                <a href="" class="side-btn d-flex align-items-center text-light text-decoration-none fw-bold"><span class="material-symbols-outlined fs-5 me-2">arrow_circle_right</span>Acessar</a>
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
                        <a href="/novo-emprestimo" class="p-4 fs-3 fs-lg-1 m-0 fw-bolder rounded d-flex justify-content-center align-items-center text-decoration-none text-light">
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
                            <p class="ps-3 fs-5">R$ <?php echo number_format($totalEmprestado, 2, ',', '.'); ?></p>
                        </div>
                        <div>
                            <h5 class="m-0">&bull; Total pago:</h5>
                            <p class="ps-3 fs-5">R$ <?php echo number_format($totalPago, 2, ',', '.'); ?></p>
                        </div>
                        <div>
                            <h5 class="m-0">&bull; Nº de empréstimos:</h5>
                            <p class="ps-3 fs-5"><?php echo $qtdEmprestimos ?></p>
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
                        <div class="table-responsive">
                            <table class="table text-light" style="overflow: scroll;">
                                <thead>
                                    <th>Empréstimo</th>
                                    <th>Valor</th>
                                    <th>Parcelas</th>
                                </thead>
                                <tbody>

                                    <?php foreach ($emprestimos as $emprestimo) : ?>
                                        <tr>
                                            <td><?php echo $emprestimo->getNomeEmprestimo(); ?></td>
                                            <td>R$ <?php echo number_format($emprestimo->getValor(), 2, ',', '.'); ?></td>
                                            <td><?php echo $emprestimo->getParcelas()->count(); ?></td>
                                            <td>
                                                <a href="" class="btn btn-outline-purple d-flex">
                                                    <span class="material-symbols-outlined">
                                                        arrow_circle_right
                                                    </span>
                                                    <span class="d-none d-sm-inline">
                                                        Acessar
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer mt-auto container-fluid d-block" st>
        <section id="scrollspyHeading3" class="container-fluid d-grid">
            <div class="row">
                <div class="col-12 col-lg-3 p-3 d-flex align-items-center justify-content-center">
                    <h3 id="header-title" class="m-0 text-light">CredEasy</h3>
                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-center align-items-center">
                    <a href="" class="text-light nav-link d-flex">
                        <span>Termos legais</span>
                    </a>
                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-center align-items-center">
                    <a href="" class="text-light nav-link d-flex">
                        <span>Termos de uso</span>
                    </a>
                </div>
                <div class="col-12 col-lg-2 d-flex justify-content-center align-items-center">
                    <a href="" class="text-light nav-link d-flex">
                        <span>Privacidade</span>
                    </a>
                </div>
                <div class="col-12 col-lg-3 d-flex justify-content-center my-3">
                    <a href="https://facebook.com"><img src="./Assets/Icons/facebook.svg" alt="facebook" style="width: 2rem;"></a>
                    <a href="https://twitter.com"><img src="./Assets/Icons/twitter.svg" alt="twitter" style="width: 2rem;"></a>
                    <a href="https://youtube.com"><img src="./Assets/Icons/youtube.svg" alt="youtube" style="width: 2rem;"></a>
                    <a href="https://instagram.com"><img src="./Assets/Icons/instagram.svg" alt="instagram" style="width: 2rem;"></a>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <span class="text-secondary" style="font-size: .75rem;">Todos direitos reservados CredEasy&copy;
                        2022.</span>
                </div>
            </div>
        </section>
    </footer>
    <script src="./Assets/Bootstrap/bootstrap.min.js"></script>
</body>

</html>