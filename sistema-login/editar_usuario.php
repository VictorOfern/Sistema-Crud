<?php
// Inclui o arquivo da classe Usuarios1
require_once 'classes/Alunos.php';

// Cria uma instância da classe Usuarios1
$alunos = new Alunos();

// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$alunos->conectar("projeto_login", "localhost", "root", "");

// Verifica se os dados do formulário foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $id_alunos = $_POST['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    
    // Edita o usuário com os dados fornecidos
    $editado = $alunos->editarUsuario($id_alunos, $nome, $telefone, $email);
    
    if ($editado) {
        // Redireciona de volta para a página de listar usuários após a edição
        header("Location: listarUsuarios.php");
        exit();
    } else {
        // Se houver algum erro ao editar o usuário, exibe uma mensagem de erro
        echo "Erro ao editar usuário: " . $alunos->msgERRO;
    }
}
?>
