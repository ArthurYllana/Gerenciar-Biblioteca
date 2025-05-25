<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adicionar livro</title>
    <link rel="stylesheet" type="text/css" href="../styles/form.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <div class="form-container">
        <form action="livro_index.php?acao=salvar" method="POST">
            <div class="form-card">
                <h1>Adicionar livro</h1>
            </div>
            <label for="titulo">Título:</label><br>
            <input type="text" name="titulo" id="titulo" placeholder="Digite o título do livro" required><br><br>

            <label for="autor">Autor:</label><br>
            <input type="text" name="autor" id="autor" placeholder="Digite o nome do autor do livro"required><br><br>

            <label for="ano_publicacao">Ano de Publicação:</label><br>
            <input type="number" name="ano_publicacao" id="ano_publicacao" min="1000" max="2099" step="1" value="2025" required><br><br>

            <label for="categoria">Categoria:</label><br>
            <select name="categoria" id="categoria" required>
                <option value="Romance">Romance</option>
                <option value="Conto">Conto</option>
                <option value="Crônica">Crônica</option>
                <option value="Poesia">Poesia</option>
                <option value="Teatro">Teatro</option>
            </select><br><br>

            <div class="botoes">
                <input type="submit" value="Salvar">
                <input type="reset" value="Resetar">
                <a class="btn" id="cancelar" href="livro_index.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>