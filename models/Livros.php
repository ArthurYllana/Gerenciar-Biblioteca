<?php

class Livro {
    private $conexao;
    private $tableName = "livros";
    public $id;
    public $titulo;
    public $autor;
    public $ano_publicacao;
    public $categoria;

    public function __construct($db) {
        $this->conexao = $db;
    }

    public function buscarTodos() {
        $comandoSQL = "SELECT * FROM ".$this->tableName;
        $acesso = $this->conexao->prepare($comandoSQL);
        $acesso->execute();
        return $acesso;
    }

    public function buscar($id) {
        $comandoSQL = "SELECT * FROM ".$this->tableName." WHERE id = ?";
        $acesso = $this->conexao->prepare($comandoSQL);
        $acesso->execute([$id]);
        return $acesso->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($titulo, $autor, $ano_publicacao, $categoria) {
        $comandoSQL = "INSERT INTO ".$this->tableName." (titulo, autor, ano_publicacao, categoria) VALUES (?, ?, ?, ?)";
        $acesso = $this->conexao->prepare($comandoSQL);
        return $acesso->execute([$titulo, $autor, $ano_publicacao, $categoria]);
    }

    public function apagar($id) {
        $comandoSQL = "DELETE FROM ".$this->tableName." WHERE id = ?";
        $acesso = $this->conexao->prepare($comandoSQL);
        return $acesso->execute([$id]);
    }

    public function alterar($id, $titulo, $autor, $ano_publicacao, $categoria) {
        $comandoSQL = "UPDATE ".$this->tableName." SET titulo = ?, autor = ?, ano_publicacao = ?, categoria = ? WHERE id = ?";
        $acesso = $this->conexao->prepare($comandoSQL);
        return $acesso->execute([$titulo, $autor, $ano_publicacao, $categoria, $id]);
    }
}
?>