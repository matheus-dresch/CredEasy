<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Icons/credeasy.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./Assets/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./Assets/CSS/Home/style.css">
    <title>CredEasy - Home</title>
</head>

<body data-spy="scroll" data-target="#header-nav">
    <header id="header-nav" class="navbar navbar-expand-md navbar-dark sticky-top">
        <section class="container-fluid">
            
            <a id="header-title" class="navbar-brand">CredEasy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <section class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbar-link rounded" href="#scrollspyHeading1">ínicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-link rounded" href="#scrollspyHeading2">sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-link rounded" href="#scrollspyHeading3">termos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 mb-3 mb-md-0">
                        <a href="/login" class="btn btn-outline-light px-4 fw-bold">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <form action="/signup" method="POST" class="d-flex" id="cadastroForm">
                            <input type="email" name="email" id="email" placeholder="Seu e-mail">
                            <button id="submitBtn" type="submit" class="btn btn-outline-purple rounded-end">Cadastrar</button>
                        </form>
                    </li>
                </ul>
            </section>
        </section>
    </header>
    <main>

        <section id="scrollspyHeading1" class="container-fluid d-grid" style="max-width: 100vw;">
            <section id="banner1" class="row main-row" style="max-width: 100vw;"> 
                <article class="col info-banner-img p-0">
                    <img class="objfit-cover w-100 h-100" src="./Assets/Images/Home/banner1.webp" alt="">
                </article>
                <article class="col-md-4 col-sm-12 info-banner-txt py-5 p-md-0 d-flex flex-column justify-content-center align-items-center">
                    <h2 class="banner-title fst-italic text-center">
                        Precisando de crédito?
                    </h2>
                    <p class="banner-text text-center text-light fs-4">Conte conosco!</p>
                    <a class="btn btn-outline-purple d-block w-50 fw-bold" href="/signup">Cadastrar</a>
                </article>
            </section>
            <section id="banner2" class="row main-row" style="max-width: 100vw;"> 
                <article class="col-md-4 col-sm-12 info-banner-txt py-5 p-md-0 d-flex flex-column justify-content-center align-items-center">
                    <h2 class="banner-title fst-italic text-center">
                        Já é nosso cliente?
                    </h2>
                    <p class="banner-text text-center text-light fs-4">Acesse sua conta</p>
                    <a class="btn btn-outline-purple d-block w-50 fw-bold" href="/login">Entrar</a>
                </article>
                <article class="col info-banner-img p-0">
                    <img class="objfit-cover w-100 h-100" src="./Assets/Images/Home/banner2.webp" alt="">
                </article>
            </section>
            <section id="banner3" class="row main-row" style="max-width: 100vw;"> 
                <article class="col info-banner-img p-0">
                    <img class="objfit-cover w-100 h-100" src="./Assets/Images/Home/banner3.webp" alt="">
                </article>
                <article class="col-md-4 col-sm-12 info-banner-txt py-5 p-md-0 d-flex flex-column justify-content-center align-items-center">
                    <h2 class="banner-title fst-italic text-center">
                        Quer apenas simular?
                    </h2>
                    <p class="banner-text text-center text-light fs-4">Simule seu empréstimo.</p>
                    <a class="btn btn-outline-purple d-block w-50 fw-bold" href="./simular.html">Simular agora</a>
                </article>
            </section>
        </section>
        <section id="scrollspyHeading2" class="container-fluid d-grid">
            <div id="info-section" class="row">
                <article class="col-lg-6 p-4 about-banner">
                    <h3 class="info-title text-center text-lg-start">Um pouco sobre a gente</h3>
                    <p class="text-light text-justify">
                        A CredEasy&copy; nasceu em 2022, com o principal
                        objetivo de proporcionar uma boa experiência à nossos usuários, cobrando taxas justas e que não
                        pesem em seus bolsos. Conosco você pode realizar seus mais diversos sonhos, de comprar aquele carro
                        que você tanto almeja até a viagem mais perfeita de todas!
                    </p>
                </article>
                <article class="col-lg-6 p-4 about-banner">
                    <h3 class="info-title text-center text-lg-start">Nossos números</h3>
                    <div class="d-grid gap-3">
                        <div class="row justify-content-center justify-content-lg-evenly gap-2">
                            <div class="col-md-12 col-lg-4 card info-card px-1" style="max-width: 11em;">
                                <div class="card-header text-center border-0">
                                    <h4 class="purple fw-bold m-0">17,8</h4>
                                    <h5 class="purple fw-bold m-0">Milhões</h5>
                                </div>
                                <div class="card-body pt-0">
                                    <h6 class="card-text text-light text-center">Em empréstimos</h6>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 card info-card px-1" style="max-width: 11rem;">
                                <div class="card-header text-center border-0">
                                    <h4 class="purple fw-bold m-0">43,7</h4>
                                    <h5 class="purple fw-bold m-0">Milhões</h5>
                                </div>
                                <div class="card-body pt-0">
                                    <h6 class="card-text text-light text-center">Em investimentos</h6>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 card info-card px-1" style="max-width: 11rem;">
                                <div class="card-header text-center border-0">
                                    <h4 class="purple fw-bold m-0">108,9</h4>
                                    <h5 class="purple fw-bold m-0">Milhões</h5>
                                </div>
                                <div class="card-body pt-0">
                                    <h6 class="card-text text-light text-center">Em patrimônio</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div id="products-section" class="row main-row">
                <article class="col p-4">
                    <h3 class="info-title text-center text-lg-start mb-3">Conheça nossas linhas de crédito</h3>
                    <div class="d-grid">
                        <div class="row justify-content-center justify-content-lg-evenly gap-2">
                            <div class="col-12 col-lg-auto card product-card text-light" style="width: 15rem;">
                                <div class="card-header d-flex px-1 border-secondary">
                                    <span class="material-symbols-outlined">
                                        person
                                    </span>
                                    <span class="text-center w-100">Crédito pessoal</span>
                                </div>
                                <div class="card-body text-center">
                                    O crédito perfeito para aquela situação que você precisa de um dinheiro rápido e fácil.
                                </div>
                            </div>
                            <div class="col-12 col-lg-auto  card product-card text-light" style="width: 15rem;">
                                <div class="card-header d-flex px-1 border-secondary">
                                    <span class="material-symbols-outlined">
                                        flight_takeoff
                                    </span>
                                    <span class="text-center w-100">Crédito turismo</span>
                                </div>
                                <div class="card-body text-center">
                                    Querendo viajar? Temos a linha de crédito perfeita para você realizar aquela viagem dos sonhos.
                                </div>
                            </div>
                            <div class="col-12 col-lg-auto  card product-card text-light" style="width: 15rem;">
                                <div class="card-header d-flex px-1 border-secondary">
                                    <span class="material-symbols-outlined">
                                        apartment
                                    </span>
                                    <span class="text-center w-100">Crédito imobiliário</span>
                                </div>
                                <div class="card-body text-center">
                                    Seja para um apartamento ou para uma casa própria, temos a linha de crédito feita para você.
                                </div>
                            </div>
                            <div class="col-12 col-lg-auto  card product-card text-light" style="width: 15rem;">
                                <div class="card-header d-flex px-1 border-secondary">
                                    <span class="material-symbols-outlined">
                                        directions_car
                                    </span>
                                    <span class="text-center w-100">Crédito veículo</span>
                                </div>
                                <div class="card-body text-center">
                                    Precisando de um carro, moto ou caminhão? Não se preocupe, faça seu financiamento com a gente!
                                </div>
                            </div>
                            <div class="col-12 col-lg-auto card product-card text-light" style="width: 15rem;">
                                <div class="card-header d-flex px-1 border-secondary">
                                    <span class="material-symbols-outlined">
                                        house
                                    </span>
                                    <span class="text-center w-100">Crédito reforma</span>
                                </div>
                                <div class="card-body text-center">
                                    Quer dar uma renovada na sua casa, ou até mesmo contruir uma nova? Deixa que a gente te ajuda!
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </main>
    <footer>
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
                    <span class="text-secondary" style="font-size: .75rem;">Todos direitos reservados CredEasy&copy; 2022.</span>
                </div>
            </div>
        </section>
    </footer>
    <script src="./Assets/Bootstrap/bootstrap.min.js"></script>
</body>

</html>