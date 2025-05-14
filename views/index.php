<?php

session_start();

require_once "../controllers/LivrosController.php";
$livroController = new LivroController();

if (isset($_SESSION['livro_edicao'])) {
    $livro = $_SESSION['livro_edicao'];
    unset($_SESSION['livro_edicao']);
}

if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) : null;
    $titulo = isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '';
    $autor = isset($_POST['autor']) ? htmlspecialchars($_POST['autor']) : '';
    $ano_publicacao = isset($_POST['ano_publicacao']) ? filter_var($_POST['ano_publicacao'], FILTER_SANITIZE_NUMBER_INT) : '';
    $categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';

    if (isset($_POST['adicionar'])) {
        $livroController->adicionar($titulo, $autor, $ano_publicacao, $categoria);
    } else if (isset($_POST['atualizar'])) {
        $livroController->atualizar($id, $titulo, $autor, $ano_publicacao, $categoria);
    } else if (isset($_POST['deletar'])) {
        $livroController->deletar($id);
    } else if (isset($_POST['editar'])) {
        $livroController->editar($id);
        exit();
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Livros</title>
    <style>
        .success { color: green; }
        .error { color: red; }
        label { display: block; margin: 10px 0; }
        input { margin-left: 5px; }
    </style>
</head>
<body>
    <h1>Gerenciamento de Livros</h1>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?= isset($livro['id']) ? htmlspecialchars($livro['id']) : '' ?>">

        <label>Título: <input type="text" name="titulo" required value="<?= isset($livro['titulo']) ? htmlspecialchars($livro['titulo']) : '' ?>"></label>
        <label>Autor: <input type="text" name="autor" required value="<?= isset($livro['autor']) ? htmlspecialchars($livro['autor']) : '' ?>"></label>
        <label>Ano de Publicação: <input type="number" name="ano_publicacao" required value="<?= isset($livro['ano_publicacao']) ? htmlspecialchars($livro['ano_publicacao']) : '' ?>"></label>
        <label>Categoria: <input type="text" name="categoria" required value="<?= isset($livro['categoria']) ? htmlspecialchars($livro['categoria']) : '' ?>"></label>

        <?php if (isset($livro['id']) && !empty($livro['id'])): ?>
            <button type="submit" name="atualizar">Atualizar</button>
            <button type="button" onclick="window.location.href='index.php'">Cancelar</button>
        <?php else: ?>
            <button type="submit" name="adicionar">Adicionar</button>
        <?php endif; ?>
    </form>

    <?php
        $livroController->listarTodos();
    ?>
</body>
</html>