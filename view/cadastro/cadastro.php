<?php 
    $user_email = isset($_POST['email']) ? $_POST['email'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./Assets/CSS/Cadastro/style.css">
    <link rel="shortcut icon" href="./Assets/Images/favicon.ico" type="image/x-icon">
    <title>Cadastro - CredEasy</title>
</head>

<body>
    <header id="header-nav" class="navbar navbar-expand-md navbar-dark sticky-top">
        <section class="container-fluid">
            <a id="header-title" class="navbar-brand" href="../">CredEasy</a>
    </header>
    <main class="p-3">
        <form action="/do-signup" method="POST" class="signup-form">
            <h1>Olá! Seja muito bem-vindo ;) </h1>
            <p>Dados pessoais:</p>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_name" type="text" name="nome" placeholder="Seu nome"
                        data-type="name" required minlength="10" maxlength="255">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_cpf" type="tel" name="cpf" placeholder="Seu CPF" data-type="cpf"
                        max-length="14" required maxlength="14">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_phone" type="tel" name="numero" placeholder="Seu Nº de celular"
                        data-type="phone" maxlength="16" required>
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_profession" type="text" name="profissao"
                        placeholder="Sua profissão" data-type="profession" required>
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_income" type="tel" name="renda" placeholder="Sua renda"
                        data-type="income" required>
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_email" type="email" name="email" placeholder="Seu e-mail"
                        data-type="email" required value="<?php echo $user_email; ?>">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <p>Endereço:</p>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_cep" type="text" name="cep" placeholder="Seu CEP" data-type="cep"
                        required maxlength="9" minlength="9">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_state" type="text" name="estado" placeholder="Seu estado"
                        data-type="state" required maxlength="255">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_city" type="text" name="cidade" placeholder="Sua cidade"
                        data-type="city" required maxlength="255">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_district" type="text" name="bairro" placeholder="Seu bairro"
                        data-type="district" required maxlength="255">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_road" type="text" name="rua" placeholder="Sua rua"
                        data-type="road" required maxlength="255">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_housenumber" type="text" name="numcasa"
                        placeholder="O Nº da sua casa" data-type="housenumber" required maxlength="255">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <p>Senha:</p>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_password" type="password" name="senha"
                        placeholder="Uma senha difícil" data-type="password" required
                        pattern="((?=.*\d{2,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,8})">
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <div class="input-div">
                <label class="input-label">
                    <input class="input-box user_passwordconfirm" type="password" name="naousar"
                        placeholder="Confirme sua senha" data-type="confirmpassword" required>
                </label>
                <span class="error-message">Campo inválido</span>
            </div>
            <button class="submit-button" type="submit">Cadastrar</button>
            <a href="/login">&#8250; Já sou cliente</a>
        </form>
    </main>
    <script src="https://github.com/codermarcos/simple-mask-money/releases/download/v3.0.0/simple-mask-money.js"></script>
    <script src="./Assets/JS/Cadastro/focus.js"></script>
    <script src="./Assets/JS/Cadastro/valida.js"></script>
    <script src="./Assets/JS/Cadastro/cpfValidator.js"></script>
    <script src="./Assets/JS/Cadastro/inputMasks.js"></script>
</body>

</html>