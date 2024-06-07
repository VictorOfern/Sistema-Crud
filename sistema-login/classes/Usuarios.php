<?php

class Usuarios {

    private $pdo; 
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $senha) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->msgERRO = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha) {
        if (!$this->pdo) {
            return false;
        }
        
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false; 
        } else {
            $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));

            $sql->execute();
            return true;
        }
    }
    
    public function logar($email, $senha) {
        if (!$this->pdo) {
            return false;
        }

        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true;
        } else {
            return false;
        }
    }
    
    public function listarUsuarios() {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("SELECT id_usuario, nome, telefone, email FROM usuarios");
            $sql->execute();

            if ($sql) {
                $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $usuarios;
            } else {
                $this->msgERRO = "Erro ao executar a consulta SQL.";
                return false;
            }
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao executar a consulta SQL: " . $e->getMessage();
            return false;
        }
    }

    public function editarUsuario($id_usuario, $nome, $telefone, $email) {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email WHERE id_usuario = :id");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao editar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function excluirUsuario($id_usuario) {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
            $sql->bindValue(":id", $id_usuario);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            $this->msgERRO = "Erro ao excluir usuário: " . $e->getMessage();
            return false;
        }
    }

    public function buscarUsuario($id_usuario) {
        if (!$this->pdo) {
            $this->msgERRO = "Erro: Conexão com o banco de dados não estabelecida.";
            return false;
        }

        try {
            $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
            $sql->bindValue(":id", $id_usuario);
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
