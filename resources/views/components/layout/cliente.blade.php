<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('icons/credeasy.ico')}}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/cliente/style.css') }}">
    @vite(['resources/css/app.css'])
    <title>CredEasy - {{ $title }}</title>
</head>

<body>
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
                        <a href="/dashboard" class="nav-link navbar-link rounded active">ínicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-link rounded" href="./suporte.html">suporte</a>
                    </li>
                </ul>
            </section>
        </section>
    </header>
    <main class="p-3">

    {{ $slot }}

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
                    <a href="https://facebook.com"><img src="{{ asset('icons/facebook.svg') }}" alt="facebook" style="width: 2rem;"></a>
                    <a href="https://twitter.com"><img src="{{ asset('icons/twitter.svg') }}" alt="twitter" style="width: 2rem;"></a>
                    <a href="https://youtube.com"><img src="{{ asset('icons/youtube.svg') }}" alt="youtube" style="width: 2rem;"></a>
                    <a href="https://instagram.com"><img src="{{ asset('icons/instagram.svg') }}" alt="instagram" style="width: 2rem;"></a>
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
    @vite(['resources/js/app.js'])
</body>

</html>
</body>

</html>
