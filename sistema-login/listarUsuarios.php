<?php
require_once 'classes/Usuarios.php';

// Instancia a classe Usuarios
$usuarios = new Usuarios();

// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$usuarios->conectar("projeto_login", "localhost", "root", "");

// Obtém os usuários do banco de dados
$lista_usuarios = $usuarios->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="style/listarusuarios.css">
</head>
<body>

<table>
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php
    // Verifica se a lista de usuários está vazia ou se ocorreu algum erro ao buscar os usuários
    if (!$lista_usuarios) {
        echo "<tr><td colspan='3'>Erro ao buscar os usuários: " . $usuarios->msgERRO . "</td></tr>";
    } else {
        // Verifica se há usuários na lista
        if (count($lista_usuarios) > 0) {
            // Loop através dos usuários e exibe cada um em uma linha da tabela
            foreach ($lista_usuarios as $usuario) {
                echo "<tr>";
                echo "<td>" . $usuario['nome'] . "</td>";
                echo "<td>" . $usuario['telefone'] . "</td>";
                echo "<td>" . $usuario['email'] . "</td>";
                echo "<td>";
                echo "<a href='editar_usuario_form.php?id=" . $usuario['id_usuario'] . "'>Editar</a> ";
                echo "<form method='post' action='excluir_usuario.php' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $usuario['id_usuario'] . "'>";
                echo "<input type='submit' value='Excluir'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum usuário encontrado.</td></tr>";
        }
    }
    ?>
</table>

</body>
</html>
