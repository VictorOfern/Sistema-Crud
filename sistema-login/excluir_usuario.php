<?php
// Inclui o arquivo da classe Usuarios1
require_once 'classes/Usuarios.php';

// Cria uma instância da classe Usuarios1
$usuarios = new Usuarios();

// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$usuarios->conectar("projeto_login", "localhost", "root", "");

// Verifica se o ID do usuário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera o ID do usuário enviado via POST
    $id_usuario = $_POST['id'];
    
    // Exclui o usuário com o ID fornecido
    $excluido = $usuarios->excluirUsuario($id_usuario);
    
    if ($excluido) {
        // Redireciona de volta para a página de listar usuários após a exclusão
        header("Location: listarUsuarios.php");
        exit();
    } else {
        // Se houver algum erro ao excluir o usuário, exibe uma mensagem de erro
        echo "Erro ao excluir usuário: " . $usuarios->msgERRO;
    }
}
?>
