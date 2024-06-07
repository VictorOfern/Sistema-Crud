<?php

class Alunos {

    private $pdo; 
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $telefone) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $telefone);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $telefone) {
        if (!$this->pdo) {
            return false;
        }
        
        $sql = $this->pdo->prepare("SELECT id_alunos FROM alunos WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
 
        if ($sql->rowCount() > 0) {
            return false; 
        } else {
            $sql = $this->pdo->prepare("INSERT INTO alunos (nome, email, telefone) VALUES (:n, :e, :t)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":t", $telefone);
            $sql->execute();
            return true;
        }
    }
    
    public function logar($email, $senha) {
        if (!$this->pdo) {
            return false;
        }

        $sql = $this->pdo->prepare("SELECT id_alunos FROM alunos WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_alunos'] = $dado['id_alunos'];
            return true;
        } else {
            return false;
        }
    }
    
    public function listarAlunos() {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("SELECT id_alunos, nome, email, telefone FROM alunos");
            $sql->execute();

            if ($sql) {
                $alunos = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $alunos;
            } else {
                $this->msgERRO = "Erro ao executar a consulta SQL.";
                return false;
            }
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao executar a consulta SQL: " . $e->getMessage();
            return false;
        }
    }

    public function editarUsuario($id_alunos, $nome, $telefone, $email) {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("UPDATE alunos SET nome = :nome, email = :email, telefone = :telefone WHERE id_alunos = :id");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":id", $id_alunos);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao editar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function excluirUsuario($id_alunos) {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("DELETE FROM alunos WHERE id_alunos = :id");
            $sql->bindValue(":id", $id_alunos);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao excluir usuário: " . $e->getMessage();
            return false;
        }
    }

    public function buscarUsuario($id_alunos) {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("SELECT * FROM alunos WHERE id_alunos = :id");
            $sql->bindValue(":id", $id_alunos);
            $sql->execute();

            if ($sql) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                $this->msgERRO = "Erro ao executar a consulta SQL.";
                return false;
            }
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao executar a consulta SQL: " . $e->getMessage();
            return false;
        }
    }
}

?>
