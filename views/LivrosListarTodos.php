<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Livros</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-buttons { display: flex; gap: 5px; }
    </style>
</head>
<body>
    <h2>Lista de Livros</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano de Publicação</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($livro = $livros->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($livro['id']) ?></td>
                    <td><?= htmlspecialchars($livro['titulo']) ?></td>
                    <td><?= htmlspecialchars($livro['autor']) ?></td>
                    <td><?= htmlspecialchars($livro['ano_publicacao']) ?></td>
                    <td><?= htmlspecialchars($livro['categoria']) ?></td>
                    <td class="action-buttons">
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">
                            <button type="submit" name="editar">Editar</button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">
                            <button type="submit" name="deletar" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>