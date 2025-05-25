<?php

class Livro {
    // atributos
    private $conexao; // conexão com o banco de dados do tipo Database
    private $tableName = 'livros';
    
    public $id;
    public $titulo;
    public $autor;
    public $ano_publicacao;
    public $categoria;

    // métodos
    public function __construct($db) { // toda vez que cria um objeto Livro precisa passar a database
        $this->conexao = $db;
    }

    // REGISTRAR LIVRO
    public function salvar($titulo, $autor, $ano_publicacao, $categoria) {
        // inserir usando parâmetros
        $comandoSQL = "INSERT INTO `{$this->tableName}` (titulo, autor, ano_publicacao, categoria) VALUES (?, ?, ?, ?)";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->execute([$titulo, $autor, $ano_publicacao, $categoria]);
        }
        catch (PDOException $erro) {
            echo "Erro ao registrar o livro: " . $erro->getMessage();
        }
    }

    // LISTAR TODOS LIVROS REGISTRADOS
    public function listar() {
        $comandoSQL = "SELECT * FROM `{$this->tableName}` ORDER BY `id` DESC"; // ordenar por ID
        try {
            $acesso = $this->conexao->prepare($comandoSQL); // prepare() valida o comando SQL para o acesso
            $acesso->execute(); // executa o comando SQL
            return $acesso;
        }
        catch (PDOException $erro) {
            echo "Erro ao listar os livros: " . $erro->getMessage();
        }
    }

    // BUSCAR LIVRO PELO ID (usado para alterar e excluir)
    public function buscarPorId($id) {
        // retornar linha da tabela com o id igual
        $comandoSQL = "SELECT * FROM {$this->tableName} WHERE id = ?";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->execute([$id]);
            return $acesso->fetch(PDO::FETCH_ASSOC); // retorna a linha encontrada
        }
        catch (PDOException $erro) {
            echo "Erro ao encontrar o livro: " . $erro->getMessage();
        }
    }

    // ALTERAR DADOS DO LIVRO
    public function alterar($id, $titulo, $autor, $ano_publicacao, $categoria) {
        $comandoSQL = "UPDATE `{$this->tableName}` SET titulo = ?, autor = ?, ano_publicacao = ?, categoria = ? WHERE id = ?";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            return $acesso->execute([$titulo, $autor, $ano_publicacao, $categoria, $id]);    
        }
        catch (PDOException $erro) {
            echo "Erro ao alterar dados do livro: " . $erro->getMessage();
        }    
    }

    // APAGAR LIVRO
    public function excluir($id) {
        $comandoSQL = "DELETE FROM `{$this->tableName}` WHERE id = ?";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->execute([$id]);
        }
        catch (PDOException $erro) {
            echo "Erro ao excluir o livro: " . $erro->getMessage();
        }
    }
}

?>