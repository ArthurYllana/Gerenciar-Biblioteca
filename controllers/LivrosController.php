<?php

require_once "../models/Livro.php";
require_once "../models/Database.php";

class LivroController {
    private $livroModel;
    private $db;

    public function __construct() {
        try {
            $this->db = new Database('localhost', 'biblioteca', 'root', '');
            $this->livroModel = new Livro($this->db);
        } catch (Exception $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    public function salvar() {
        try {
            $this->validatePostData(['titulo', 'autor', 'ano_publicacao', 'categoria']);
            
            $this->livroModel->salvar(
                trim($_POST['titulo']),
                trim($_POST['autor']),
                (int)$_POST['ano_publicacao'],
                trim($_POST['categoria'])
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
                trim($_POST['titulo']),
                trim($_POST['autor']),
                (int)$_POST['ano_publicacao'],
                trim($_POST['categoria'])
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

    // Métodos auxiliares
    private function validatePostData($requiredFields) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Método de requisição inválido.");
        }
        
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                throw new Exception("O campo {$field} é obrigatório.");
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