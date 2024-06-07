<?php
require_once 'classes/Alunos.php';

// Instancia a classe Usuarios
$alunos = new Alunos();

// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$alunos->conectar("projeto_login", "localhost", "root", "");

// Obtém os usuários do banco de dados
$lista_alunos = $alunos->listarAlunos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="style/listarUsuarios.css">
    <script>
        function confirmarExclusao() {
            return confirm('Tem certeza que deseja excluir este usuário?');
        }
    </script>
</head>
<body>

<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>
    <?php
    // Verifica se a lista de usuários está vazia ou se ocorreu algum erro ao buscar os usuários
    if (!$lista_alunos) {
        echo "<tr><td colspan='3'>Erro ao buscar os usuários: " . $alunos->msgERRO . "</td></tr>";
    } else {
        // Verifica se há usuários na lista
        if (count($lista_alunos) > 0) {
            // Loop através dos usuários e exibe cada um em uma linha da tabela
            foreach ($lista_alunos as $alunos) {
                echo "<tr>";
                echo "<td>" . $alunos['nome'] . "</td>";
                echo "<td>" . $alunos['telefone'] . "</td>";
                echo "<td>" . $alunos['email'] . "</td>";
                echo "<td>";
                echo "<a href='editar_usuario_form.php?id=" . $alunos['id_alunos'] . "'>Editar</a> ";
                echo "<form method='post' action='excluir_usuario.php' style='display:inline;' onsubmit='return confirmarExclusao();'>";
                echo "<input type='hidden' name='id' value='" . $alunos['id_alunos'] . "'>";
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

<a class = "cad_aluno" href="cadastrar_alunos.php">Cadastrar Aluno</a>

</body>
</html>
