<?php

require_once "../models/Livro.php";
require_once "../models/Database.php";

class LivroController {
    private $livroModel;
    private $db;

    public function __construct() {
        try {
            $this->db = new Database('127.0.0.1', 'biblioteca', 'root', '');
            $this->livroModel = new Livro($this->db);
        } catch (Exception $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    public function salvar() {
        try {
            $this->validatePostData(['titulo', 'autor', 'ano_publicacao', 'categoria']);
            
            $this->livroModel->salvar(
                substr(trim($_POST['titulo']), 0, 250),
                substr(trim($_POST['autor']), 0, 250),
                (int)$_POST['ano_publicacao'],
                substr(trim($_POST['categoria']), 0, 100)
            );
            
            $this->setSuccessMessage("Livro adicionado com sucesso!");
            $this->redirectToIndex();
            
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function listar() {
        try {
            $livros = $this->livroModel->listar();
            require "../views/listar.php";
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function alterar() {
        try {
            $this->validatePostData(['id', 'titulo', 'autor', 'ano_publicacao', 'categoria']);
            
            $this->livroModel->alterar(
                (int)$_POST['id'],
                substr(trim($_POST['titulo']), 0, 250),
                substr(trim($_POST['autor']), 0, 250),
                (int)$_POST['ano_publicacao'],
                substr(trim($_POST['categoria']), 0, 100)
            );
            
            $this->setSuccessMessage("Livro alterado com sucesso!");
            $this->redirectToIndex();
            
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function excluir() {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception("ID não informado.");
            }
            
            $this->livroModel->excluir((int)$_GET['id']);
            $this->setSuccessMessage("Livro excluído com sucesso!");
            $this->redirectToIndex();
            
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    public function editarForm() {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception("ID não informado.");
            }
            
            $livro = $this->livroModel->buscarPorId((int)$_GET['id']);
            
            if (!$livro) {
                throw new Exception("Livro não encontrado.");
            }
            
            require "../views/editar.php";
            
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    private function validatePostData($requiredFields) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Método de requisição inválido.");
        }
        
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                throw new Exception("O campo {$field} é obrigatório.");
            }
            
            // Validações específicas por campo
            $value = trim($_POST[$field]);
            
            if ($field === 'titulo') {
                if (empty($value)) {
                    throw new Exception("O título não pode estar vazio.");
                }
                if (mb_strlen($value) > 250) {
                    throw new Exception("O título não pode exceder 250 caracteres.");
                }
            }
            
            if ($field === 'autor') {
                if (empty($value)) {
                    throw new Exception("O autor não pode estar vazio.");
                }
                if (mb_strlen($value) > 250) {
                    throw new Exception("O autor não pode exceder 250 caracteres.");
                }
            }
            
            if ($field === 'categoria') {
                if (empty($value)) {
                    throw new Exception("A categoria não pode estar vazia.");
                }
                if (mb_strlen($value) > 100) {
                    throw new Exception("A categoria não pode exceder 100 caracteres.");
                }
            }
            
            if ($field === 'ano_publicacao') {
                if (!is_numeric($value) || $value < 1000 || $value > 2099) {
                    throw new Exception("Ano de publicação inválido (deve ser entre 1000 e 2099).");
                }
            }
            
            if ($field === 'id' && !is_numeric($value)) {
                throw new Exception("ID inválido.");
            }
        }
    }

    private function setSuccessMessage($message) {
        $_SESSION['mensagem'] = $message;
    }

    private function redirectToIndex() {
        header("Location: ../views/livro_index.php");
        exit;
    }

    private function handleError($exception) {
        $_SESSION['erro'] = $exception->getMessage();
        $this->redirectToIndex();
    }
}