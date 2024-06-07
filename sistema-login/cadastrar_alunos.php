<?php

require_once 'classes/Alunos.php';
$u = new Alunos();

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
        <h1 class= "titulo">Cadastro de Alunos</h1>
        <div class = "corpo_form">
            <form method="POST">
                <input class = "nome" type="text" name="nome" placeholder="Nome Completo" maxlength="30"/>
                <input class = "email" type="email" name="email" placeholder="E-mail" maxlength="40"/>
                <input class = "telefone" type="telefone" name="telefone" placeholder="Telefone" maxlength="40"/>
                <input class = "submit" type="submit" value="CADASTRAR" name="" maxlength="15"/>
            </form>
        </div>
    </div>
</main>
</body>

<?php

if(isset($_POST['nome'])):
    
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $telefone = addslashes($_POST['telefone']);

    if(!empty($nome) && !empty($email)):

        $u->conectar("projeto_login", "localhost", "root", "");

        if($u->msgERRO == ""):

            if($u->cadastrar($nome, $email, $telefone)):
                echo "<script>showAlert('Cadastrado com Sucesso! Acesse para entrar!');</script>";
            else:
                echo "<script>showAlert('Email já cadastrado!');</script>";
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
