<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="stylesheet" type="text/css" href="./styles/home.css">
    <title>Sistema de Gestão de Livros</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bem-vindo à Biblioteca Comunitária</h1>
            <h2>Sistema de Gestão de Livros</h2>
        </div>
        
        <div class="card">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Digite seu usuário" required>
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                </div>
                
                <div class="image-container">
                    <img class="icon" src="./assets/book-icon.png" alt="Ícone de Livro">
                </div>
            </form>
        </div>
        
        <div class="actions">
            <button type="submit" class="btn" id="entrar">Entrar</button>
            <a href="#" class="link">Esqueci minha senha</a>
        </div>
    </div>
</body>
</html>