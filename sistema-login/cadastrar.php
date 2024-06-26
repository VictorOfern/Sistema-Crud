<?php

require_once 'classes/Usuarios.php';
$u = new Usuarios();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="style/cadastrox2.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body>
<main class = "apresentacao_cadastro">
    <div id="corpo-form-cad">
        <h1 class= "titulo">Cadastre-se</h1>
        <div class = "corpo_form">
            <form method="POST">
                <input class = "nome" type="text" name="nome" placeholder="Nome Completo" maxlength="30"/>
                <input class = "cpf" type="cpf" name="cpf" placeholder="CPF" maxlength="15"/>
                <input class = "telefone" type="text" name="telefone" placeholder="Telefone" maxlength="30"/>
                <input class = "email" type="email" name="email" placeholder="Usuário" maxlength="40"/>
                <input class = "senha" type="password" name="senha" placeholder="Senha" maxlength="15"/>
                <input class = "conf_senha" type="password" name="conf_senha" placeholder="Confirmar Senha"/>
                <input class = "submit" type="submit" value="CADASTRAR" name="" maxlength="15"/>
                <a class = "entrar" href="index.php">Entrar</a>
            </form>
        </div>
    </div>
</main>
</body>

<?php

if(isset($_POST['nome'])):
    
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $conf_senha = addslashes($_POST['conf_senha']);
    $cpf = addslashes($_POST['cpf']);

    if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($conf_senha)):

        $u->conectar("projeto_login", "localhost", "root", "");

        if($u->msgERRO == ""):

            if($senha==$conf_senha):

                if($u->cadastrar($nome, $telefone, $email, $senha, $cpf)):
                    echo "<script>showAlert('Cadastrado com Sucesso! Acesse para entrar!');</script>";
                else:
                    echo "<script>showAlert('Email já cadastrado!');</script>";
                endif;

            else:
                echo "<script>showAlert('Senha e Confirmar Senha não correspondem!');</script>";
            endif;

        else:
            echo "<script>showAlert('Erro: {$u->msgERRO}');</script>";
        endif;
    
    else:
        echo "<script>showAlert('Preencha Todos os Campos!');</script>";
    endif;
endif;

?>

</html>
