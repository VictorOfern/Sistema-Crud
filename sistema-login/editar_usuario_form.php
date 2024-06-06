<?php
// Inclui o arquivo da classe Usuarios1
require_once 'classes/Usuarios.php';

// Cria uma instância da classe Usuarios1
$usuarios = new Usuarios();

// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$usuarios->conectar("projeto_login", "localhost", "root", "");

// Verifica se o ID do usuário foi enviado via GET
if (isset($_GET['id'])) {
    // Recupera o ID do usuário enviado via GET
    $id_usuario = $_GET['id'];
    
    // Busca os dados do usuário
    $usuario = $usuarios->buscarUsuario($id_usuario);
    
    if (!$usuario) {
        echo "Erro ao buscar usuário: " . $usuarios->msgERRO;
        exit();
    }
} else {
    echo "ID do usuário não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style/main1.css">
</head>
<body>
    
    <form action="editar_usuario.php" method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['id_usuario']; ?>">
        <p for="nome">Nome:</p>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>"><br>
        <p for="telefone">Telefone:</p>
        <input type="text" id="telefone" name="telefone" value="<?php echo $usuario['telefone']; ?>"><br>
        <p for="email">Email:</p>
        <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>"><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>
