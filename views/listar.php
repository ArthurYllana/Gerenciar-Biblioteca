<!-- a view vai mostrar na tela o que foi acessado no banco de dados -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Livros</title>
    <link rel="stylesheet" type="text/css" href="../styles/lista.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <div class="list-container">
        <div class="list">
            <h1>Livros da Biblioteca Comunitária</h1>
            <div class="botoes">
                <a class="btn" id="adicionar-livro" href="./adicionar.php">+ Adicionar Livro</a>
                <a class="btn" id="sair" href="../index.php">Sair</a>
            </div>
            <br><br>
            <table>
                <tr class="nome-colunas">
                    <th>ID</th>
                    <th>TÍtulo</th>
                    <th>Autor</th>
                    <th>Ano de Publicação</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
                <!-- Criar uma repetição para exibir todos os livros, usando a variável $livros -->
                <?php
                    while ($livro = $livros->fetch(PDO::FETCH_ASSOC)):  ?>
                    <tr>
                        <td><?= $livro['id'] ?></td>
                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td><?= htmlspecialchars($livro['autor']) ?></td>
                        <td><?= htmlspecialchars($livro['ano_publicacao']) ?></td>
                        <td><?= htmlspecialchars($livro['categoria']) ?></td>
                        <td>
                            <a
                                class="btn"
                                id="editar"
                                href="livro_index.php?acao=editar&id=<?= $livro['id'] ?>"
                            > 
                                Editar
                            </a>
                            <a
                                class="btn"
                                id="excluir"
                                href="livro_index.php?acao=excluir&id=<?= $livro['id'] ?>"
                                onclick=
                                    "return confirm('Deseja realmente excluir o livro <?= $livro['titulo'] ?>?')">
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <!--<div class="mensagem-sucesso"> Livro registrado com sucesso! </div>-->

    <?php
        if (isset($_SESSION['mensagem'])): ?>
            <div class="mensagem-sucesso"><?= $_SESSION['mensagem'] ?></div>
            <?php unset($_SESSION['mensagem']); ?>
    <?php endif; ?>

</body>
</html>