<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<h1>Gerenciamento de Alunos</h1>

<!-- Formulário para adicionar aluno -->
<form action="php/adicionar_aluno.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <label for="curso">Curso:</label>
    <input type="text" id="curso" name="curso" required>
    <label for="matricula">Matrícula:</label>
    <input type="text" id="matricula" name="matricula" required>
    <button type="submit">Adicionar Aluno</button>

</form>

<!-- Lista de alunos -->
<div id="lista-alunos">
    <!-- Aqui será exibida a lista de alunos -->
</div>
</body>
</html>
