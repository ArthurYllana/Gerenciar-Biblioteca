<?php

class Livro {
    private $conexao;
    private $tableName = 'livros';
    
    public $id;
    public $titulo;
    public $autor;
    public $ano_publicacao;
    public $categoria;

    public function __construct($db) {
        $this->conexao = $db->getConnection();
    }

    public function salvar($titulo, $autor, $ano_publicacao, $categoria) {
        $comandoSQL = "INSERT INTO `{$this->tableName}` 
                      (titulo, autor, ano_publicacao, categoria) 
                      VALUES (:titulo, :autor, :ano, :categoria)";
        
        try {
            $stmt = $this->conexao->prepare($comandoSQL);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR, 250);
            $stmt->bindParam(':autor', $autor, PDO::PARAM_STR, 250);
            $stmt->bindParam(':ano', $ano_publicacao, PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR, 100);
            
            return $stmt->execute();
        } catch (PDOException $erro) {
            error_log("Erro ao registrar livro: " . $erro->getMessage());
            throw new Exception("Erro ao registrar o livro.");
        }
    }

    public function listar() {
        $comandoSQL = "SELECT * FROM `{$this->tableName}` ORDER BY `id` DESC";
        
        try {
            $stmt = $this->conexao->prepare($comandoSQL);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $erro) {
            error_log("Erro ao listar livros: " . $erro->getMessage());
            throw new Exception("Erro ao listar os livros.");
        }
    }

    public function buscarPorId($id) {
        $comandoSQL = "SELECT * FROM `{$this->tableName}` WHERE id = :id";
        
        try {
            $stmt = $this->conexao->prepare($comandoSQL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $erro) {
            error_log("Erro ao buscar livro: " . $erro->getMessage());
            throw new Exception("Erro ao encontrar o livro.");
        }
    }

    public function alterar($id, $titulo, $autor, $ano_publicacao, $categoria) {
        $comandoSQL = "UPDATE `{$this->tableName}` 
                       SET titulo = :titulo, 
                           autor = :autor, 
                           ano_publicacao = :ano, 
                           categoria = :categoria 
                       WHERE id = :id";
        
        try {
            $stmt = $this->conexao->prepare($comandoSQL);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR, 250);
            $stmt->bindParam(':autor', $autor, PDO::PARAM_STR, 250);
            $stmt->bindParam(':ano', $ano_publicacao, PDO::PARAM_INT);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR, 100);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $erro) {
            error_log("Erro ao alterar livro: " . $erro->getMessage());
            throw new Exception("Erro ao alterar dados do livro.");
        }
    }

    public function excluir($id) {
        $comandoSQL = "DELETE FROM `{$this->tableName}` WHERE id = :id";
        
        try {
            $stmt = $this->conexao->prepare($comandoSQL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $erro) {
            error_log("Erro ao excluir livro: " . $erro->getMessage());
            throw new Exception("Erro ao excluir o livro.");
        }
    }
}
?>