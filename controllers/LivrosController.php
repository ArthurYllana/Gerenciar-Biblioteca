<?php

require_once "../models/Livros.php";
require_once "../models/Database.php";

class LivroController {
    private $livroModel;
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->livroModel = new Livro($this->db->getConnection());
    }

    public function listarTodos() {
        $livros = $this->livroModel->buscarTodos();
        include "../views/LivrosListarTodos.php";
    }

    public function adicionar($titulo, $autor, $ano_publicacao, $categoria) {
        if ($this->livroModel->inserir($titulo, $autor, $ano_publicacao, $categoria)) {
            $_SESSION['mensagem'] = "<p class='success'>Livro adicionado com sucesso!</p>";
        } else {
            $_SESSION['mensagem'] = "<p class='error'>Erro ao adicionar livro.</p>";
        }
    }

    public function atualizar($id, $titulo, $autor, $ano_publicacao, $categoria) {
        if ($this->livroModel->alterar($id, $titulo, $autor, $ano_publicacao, $categoria)) {
            $_SESSION['mensagem'] = "<p class='success'>Livro atualizado com sucesso!</p>";
        } else {
            $_SESSION['mensagem'] = "<p class='error'>Erro ao atualizar livro.</p>";
        }
    }

    public function deletar($id) {
        if ($this->livroModel->apagar($id)) {
            $_SESSION['mensagem'] = "<p class='success'>Livro deletado com sucesso!</p>";
        } else {
            $_SESSION['mensagem'] = "<p class='error'>Erro ao deletar livro.</p>";
        }
    }

    public function editar($id) {
        $livro = $this->livroModel->buscar($id);
        if ($livro) {
            $_SESSION['livro_edicao'] = $livro;
            header("Location: ../views/index.php");
            exit();
        } else {
            $_SESSION['mensagem'] = "<p class='error'>Livro não encontrado.</p>";
            header("Location: ../views/index.php");
            exit();
        }
    }
}