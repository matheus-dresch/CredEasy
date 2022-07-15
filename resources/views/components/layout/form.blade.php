<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('icons/credeasy.ico') }}" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset("css/$css/style.css") }}">
    <title>CredEasy - {{ $title }}</title>
</head>

<body>
    <header id="header-nav" class="navbar navbar-expand-md navbar-dark sticky-top">
        <section class="container-fluid">
            <a id="header-title" class="navbar-brand" href="../">CredEasy</a>
    </header>
    <main class="p-3">
        <section class="d-flex flex-column align-items-center">
            @if ($errors->any())
                <div class="alert alert-danger w-100 rounded-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ $slot }}

        </section>
    </main>
    @vite(['resources/js/app.js'])
    <script src="https://github.com/codermarcos/simple-mask-money/releases/download/v3.0.0/simple-mask-money.js"></script>
</body>

</html>