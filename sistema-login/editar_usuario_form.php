<?php
// Inclui o arquivo da classe Usuarios1
require_once 'classes/Alunos.php';

// Cria uma instância da classe Usuarios1
$alunos = new Alunos();

// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$alunos->conectar("projeto_login", "localhost", "root", "");

// Verifica se o ID do usuário foi enviado via GET
if (isset($_GET['id'])) {
    // Recupera o ID do usuário enviado via GET
    $id_alunos = $_GET['id'];
    
    // Busca os dados do usuário
    $alunos = $alunos->buscarUsuario($id_alunos);
    
    if (!$alunos) {
        echo "Erro ao buscar usuário: " . $alunos->msgERRO;
        exit();
    }
} else {
    echo "ID do usuário não fornecido.";
    exit();
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style/editar.css">
</head>
<body>
    <div class="container">
        <form action="editar_usuario.php" method="post" class="form-edit">
            <input type="hidden" name="id" value="<?php echo $alunos['id_alunos']; ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $alunos['nome']; ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo $alunos['telefone']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $alunos['email']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Salvar" class="btn-submit">
            </div>
        </form>
    </div>
</body>
</html>
