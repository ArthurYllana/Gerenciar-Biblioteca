<?php

require_once "../models/Livro.php";
require_once "../models/Database.php";

// O controlador vai gerenciar as telas e os objetos da classe Livro

class LivroController {
    // atributos
    private $livroModel; // objeto da classe Livro
    private $db; // opcional

    // métodos
    public function __construct() {
        // Toda vez que inicializa o controlador, inicializa um objeto Livro
        $this->db = new Database('localhost','biblioteca','root','');
        $this->livroModel = new Livro($this->db->getConnection());
    }

    // Funções que são chamadas quando o usuário CLICA nos botões correspondentes na tela (view)
    // papel deles é chamar as funções do Livro model

    public function salvar() {
        $this->livroModel->salvar($_POST['titulo'], $_POST['autor'], $_POST['ano_publicacao'], $_POST['categoria']);
        $_SESSION['mensagem'] = "Livro adicionado com sucesso!"; // session para mensagem se enviado com sucessso
        header("Location: ../views/livro_index.php");
        exit;
    }

    public function listar() {
        $livros = $this->livroModel->listar();
        require "../views/listar.php"; // chama a tela que lista os livros
    }

    public function alterar() {
        if ($_POST) { // verifica se o formulário foi submetido (via POST)
            $this->livroModel->alterar($_POST['id'], $_POST['titulo'], $_POST['autor'], $_POST['ano_publicacao'], $_POST['categoria']);
            $_SESSION['mensagem'] = "Livro alterado com sucesso!";
            header("Location: ../views/livro_index.php");
            exit;
        }
    }

    public function excluir() {
        if (isset($_GET['id'])) { // verifica se livro com este id existe (via GET)
            $this->livroModel->excluir($_GET['id']);
            $_SESSION['mensagem'] = "Livro excluído com sucesso!";
            header("Location: ../views/livro_index.php");
            exit;
        }
        else {
            die("ID não informado.");
        }
    }

    // Função extra que é chamada quando for alterar
    // ela mostra um form para editar diretamente por ele
    public function editarForm() {
        if (!isset($_GET['id'])) {
            die("ID não informado.");
        }

        $livro = $this->livroModel->buscarPorId($_GET['id']); // verifica se o livro com esse ID existe
        if (!$livro) {
            die("Livro não encontrado.");
        }

        require "../views/editar.php";
    }
}

?>