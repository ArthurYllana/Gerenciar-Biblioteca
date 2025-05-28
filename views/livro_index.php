<?php
    require_once "../controllers/LivroController.php";
    session_start();

    $controller = new LivroController();

    // Controla a ação informada na requisição
    // Se nenhuma ação for especificada, assume 'listar' como padrão
    $acao = $_GET['acao'] ?? 'listar';

    switch ($acao) {
        case 'salvar':
            $controller->salvar();
            break;
        case 'editar':
            $controller->editarForm();
            break;
        case 'alterar':
            $controller->alterar();
            break;
        case 'excluir':
            $controller->excluir();
            break;
        default: // Caso padrão: lista todos os livros
            $controller->listar();
            break;
    }
?>