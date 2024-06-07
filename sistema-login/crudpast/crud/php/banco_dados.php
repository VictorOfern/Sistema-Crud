<?php
// Conexão com o banco de dados MySQL
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud2";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Funções CRUD para manipulação dos alunos
// Implemente as funções CRUD aqui
?>
