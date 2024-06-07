<?php
// Verifica se os dados do aluno foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram enviados
    if (isset($_POST["nome"]) && isset($_POST["curso"]) && isset($_POST["matricula"])) {
        // Inclua aqui o arquivo de conexão com o banco de dados
        require_once "banco_dados.php";

        // Coleta os dados do formulário
        $nome = $_POST["nome"];
        $curso = $_POST["curso"];
        $matricula = $_POST["matricula"];

        // Verifica se já existe um aluno com a matrícula fornecida
        $check_sql = "SELECT COUNT(*) AS total FROM aluno WHERE matricula = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $matricula);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        $row = $result->fetch_assoc();
        $total_alunos = $row["total"];

        if ($total_alunos > 0) {
            // Retorna uma resposta de erro se a matrícula já existe
            http_response_code(400);
            echo "<script>alert('Já existe um aluno com essa matricula.');</script>";
        } else {
            // Prepara a instrução SQL para inserir o aluno no banco de dados
            $sql = "INSERT INTO aluno (nome, curso, matricula) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $curso, $matricula);

            // Executa a instrução SQL
            if ($stmt->execute()) {
                // Retorna uma resposta de sucesso
                http_response_code(200);
                echo "<script>alert('Aluno adicionado com sucesso.');</script>";
            } else {
                // Retorna uma resposta de erro
                http_response_code(500);
                echo "Erro ao adicionar aluno.";
            }

            // Fecha a conexão com o banco de dados
            $stmt->close();
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Retorna uma resposta de erro se algum campo estiver faltando
        http_response_code(400);
        echo "Todos os campos são obrigatórios.";
    }
} else {
    // Retorna uma resposta de erro se o método de requisição não for POST
    http_response_code(405);
    echo "Método não permitido.";
}
?>
