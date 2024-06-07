<?php
    require_once 'classes/Usuarios.php';
    $usuario = new Usuarios();
    require_once 'classes/Admins.php';
    $admin = new Admins();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Sistema de Login </title>
    <link rel="stylesheet" href="style/main2.css">
    <link rel="shortcut icon" href="imagens/icon/faicon.jpg">
</head>

<body>
    <main class = "apresentacao">
        <section class = "apresentacao_logo">
            <img class="foto_logo" src="imagens/rock1.png" alt="logo">
                <h1 class="apresentacao__conteudo__titulo">Escola do <strong style="color: #FF0000"><span>Rock</span></strong></h1>
        </section>
        <section class = "apresentacao_login">
            <div id="corpo-form">
                <h1 class = "login">Login</h1>
                <form method="POST">
                    <input class = "input_usuario" type="email" name="email" placeholder="Usuário" id = "email"/>
                    <input class = "input_senha" type="password" name="senha" placeholder="Senha" id = "senha"/>
                    <input class = "input_acessar" type="submit" value="ACESSAR" name="" id = "submit"/>
                    <a href="cadastrar.php">Ainda não é inscrito? <strong>Inscreva-se!</strong></a>
                </form>
            </div>
        </section>
    </main>
    
    <script>

        function logar[]{
            var login = document.getElementById('email').value;
            var login = document.getElementById('senha').value;

            if(email == )
        }

    </script>

</body>

<?php

if (isset($_POST['email'])):

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if (!empty($email) && !empty($senha)):

        $usuario->conectar("projeto_login", "localhost", "root", "");

        if ($usuario->msgERRO == ""):

            if ($usuario->logar($email, $senha)):

                header("location: listarUsuarios.php");
            else:
                ?>
                <script type="text/javascript">
                    alert("E-mail e/ou Senha Incorretos!");
                </script>
                <?php

            endif;

        else:

            ?>

            <script type="text/javascript">
                alert("Erro: <?php echo $usuario->msgERRO; ?>");
            </script>

        <?php


        endif;

    else:
        ?>
        <script type="text/javascript">
            alert("Preencha Todos os Campos!");
        </script>

    <?php
    endif;

    if (!empty($email) && !empty($senha)):

        $admin->conectar("projeto_login", "localhost", "root", "");

        if ($admin->msgERRO == ""):

            if ($admin->logar($email, $senha)):

                header("location: listarUsuarios.php");
            else:
                ?>
                <script type="text/javascript">
                    alert("E-mail e/ou Senha Incorretos!");
                </script>
                <?php

            endif;

        else:

            ?>

            <script type="text/javascript">
                alert("Erro: <?php echo $admin->msgERRO; ?>");
            </script>

        <?php


        endif;

    else:
        ?>
        <script type="text/javascript">
            alert("Preencha Todos os Campos!");
        </script>

    <?php
    endif;

endif;


?>

</html>
