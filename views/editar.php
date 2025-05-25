<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar livro</title>
    <link rel="stylesheet" type="text/css" href="../styles/form.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
    <div class="form-container">
        <form action="livro_index.php?acao=alterar" method="POST">
            <div class="form-card">
                <h1>Editar livro</h1>
            </div>
            <input 
                type="hidden"
                name="id"
                value="<?= $livro['id'] ?>"
            >
            <label for="titulo">Título:</label>
            <br>
            <input
                type="text"
                name="titulo"
                id="titulo"
                value="<?= htmlspecialchars($livro['titulo']) ?>"
                required
            >
            <br><br>
            <label for="autor">Autor:</label>
            <br>
            <input
                type="text"
                name="autor"
                id="autor"
                value="<?= htmlspecialchars($livro['autor']) ?>"
                required
            >
            <br><br>
            <label for="ano_publicacao">Ano de Publicação:</label>
            <br>
            <input
                type="number"
                name="ano_publicacao"
                id="ano_publicacao"
                min="1000"
                max="2099"
                step="1"
                value="<?= htmlspecialchars($livro['ano_publicacao']) ?>"
                required>
            <br><br>
            <label for="categoria">Categoria:</label>
            <br>
            <select 
                name="categoria" 
                id="categoria" 
                required
            >
                <option 
                    value="Romance" 
                    <?= $livro['categoria'] === 'Romance' ? 'selected' : '' ?>
                >
                    Romance
                </option>
                <option 
                    value="Conto" 
                    <?= $livro['categoria'] === 'Conto' ? 'selected' : '' ?>
                >
                    Conto
                </option>
                <option 
                    value="Crônica" 
                    <?= $livro['categoria'] === 'Crônica' ? 'selected' : '' ?>
                >
                    Crônica
                </option>
                <option 
                    value="Poesia" 
                    <?= $livro['categoria'] === 'Poesia' ? 'selected' : '' ?>
                >
                    Poesia
                </option>
                <option 
                    value="Teatro" 
                    <?= $livro['categoria'] === 'Teatro' ? 'selected' : '' ?>
                >
                    Teatro
                </option>
            </select>
            <br><br>
            <div class="botoes">
                <input type="submit" value="Alterar">
                <a 
                    class="btn"
                    id="cancelar"
                    href="livro_index.php"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>