
<!DOCTYPE html>
<html>
<head>
    <title>Autenticação de permissão</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            flex-direction: column; /* Muda para coluna */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        form {
            background-color: #262626;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: white;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Autenticação de permissão</h2>
    <form method="post">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br><br>
        <button type="submit"><strong>Entrar</strong></button>
    </form>
</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $senhaInserida = $_POST["senha"];
        $senhaCorreta = "entrada@123"; // Substitua pela senha desejada

        if ($senhaInserida === $senhaCorreta) {
            header("Location: cadastrar_admins.php"); // Redireciona para a página desejada
            exit();
        } else {
            ?>
                <script type="text/javascript">
                    alert("Senha Incorreta!");
                </script>
            <?php
        }
    }
    ?>
</html>